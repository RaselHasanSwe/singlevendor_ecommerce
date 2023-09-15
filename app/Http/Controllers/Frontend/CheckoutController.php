<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\OrderComplete;
use App\Mail\OrderComplete as MailOrderComplete;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Admin;
use App\Models\Product;
use App\Models\ProductShipping;
use App\Models\Shipping;
use App\Models\UserShipping;
use App\Services\Frontend\OrderService;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if(Cart::content()->count() < 1)
            return redirect()->back()->with('error', 'You haven\'t choose any item for checkout');
        $data['admin'] = Admin::select('city')->first();
        $data['shipping'] = Shipping::get();

        if(Auth::guard('web')->check()){
            $data['ex_shipping'] = UserShipping::where('user_id', Auth::guard('web')->user()->id)->first();
        }
        return view('frontend.checkout.index', $data);
    }

    public function order(InvoiceService $invoice, Request $request, OrderService $order)
    {
        if(Cart::content()->count() < 1)
            return redirect()->back()->with('error', 'You haven\'t choose any item for checkout');

        $shipping_errors = [];
        foreach(Cart::content() as $row){
            if($row->options->shipping_id == '')
                $shipping_errors = $row->name;
        }
        if(count($shipping_errors) > 0)
            return redirect()->back()->with(['shipping_errors' => $shipping_errors])->withInput();

        $createdOrder = $order->generateOrder($request);
        $invoicePath = $invoice->getInvoice(orderId:$createdOrder['order']->id, status:'save');
        if($createdOrder['order']->email){
            $invoicePath = $invoice->getInvoice(orderId:$createdOrder['order']->id, status:'save');
            dispatch(new OrderComplete(body:'Your Order has been Placed', to:$createdOrder['order']->email, filePath:$invoicePath));
        }

        // Mail::to('rasel.laravel@gmail.com')
        //     ->send( new MailOrderComplete(body:'order has complete', filePath:$invoicePath));




        //return redirect()->route('frontend.payment.success');
    }

    public function shipping(Request $request)
    {
        $errors = [];
        $shipping_id = $request->shipping_id;
        foreach(Cart::content() as $row){
            $shipping = ProductShipping::where('product_id', $row->id)
                ->where('shipping_id', $shipping_id)->first();
            if($shipping){
                $shipping_price = $shipping->price;
                $is_shipping_free = false;

                if($shipping->is_free == 1){
                    $shipping_price = 0;
                    $is_shipping_free = true;
                }else{
                    if($shipping->shipping_apply == 1) $shipping_price = $shipping_price * $row->qty;
                }
                $option = $row->options->merge([
                    'shipping' => $shipping_price,
                    'shipping_id' => $shipping->shipping_id,
                    'is_free_shipping' => $is_shipping_free
                ]);
                Cart::update($row->rowId, ['options' => $option]);
            }else{
                $product = Product::where('id', $row->id)->first();
                $errors[] = $product->name;
            }
        }

        if(count($errors) > 0){
            foreach(Cart::content() as $row){
                $option = $row->options->merge([
                    'shipping' => 0,
                    'shipping_id' => '',
                    'is_free_shipping' => false
                ]);
                Cart::update($row->rowId, ['options' => $option]);
            }

            return response()->json([
                'status' => false,
                'message' => view('frontend.__pertials.shipping-alert', compact('errors'))->render(),
            ]);
        }

        Session::put('ex_shipping_id', $request->shipping_id);

        return response()->json([
            'status' => true,
            'order_summary' => view('frontend.__pertials.checkout-order-summary')->render()
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        return view('frontend.payment.success');
    }

    public function paymentCancel(Request $request)
    {
        return view('frontend.payment.cancel');
    }
}
