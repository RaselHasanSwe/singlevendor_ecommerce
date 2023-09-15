<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Frontend\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $data['cart_total'] = CartService::cartTotalWithAditional();
        //dd($data['cart_total']);
        return view('frontend.cart.index', $data);
    }

    public function addToCart(Request $request)
    {
        CartService::addCart($request);
        $mini_cart = view('frontend.__pertials.mini-cart')->render();
        return response()->json(['mini_cart' => $mini_cart, 'total_item' => CartService::totalItem()]);
    }

    public function removeCart( Request $request)
    {
        CartService::removeCart($request->rowId);
        $cart_total = CartService::cartTotalWithAditional();
        return response()->json([
            'total_price' => CartService::cartTotal(),
            'total_item' => CartService::totalItem(),
            'big_cart_total' => view('frontend.__pertials.big-cart-total',compact('cart_total'))->render()
        ]);

    }

    public function updateCart(Request $request)
    {
        $qty = explode(',', $request->update_qty);
        $rowId = explode(',', $request->update_rowid);
        if(count($rowId) > 0){
            foreach ($rowId as $key => $id) {
                CartService::updateCart($id, $qty[$key]);
            }
        }
        $cart_total = CartService::cartTotalWithAditional();

        return response()->json([
            'success' => 'Cart updated successfully',
            'mini_cart' => view('frontend.__pertials.mini-cart')->render(),
            'total_item' => CartService::totalItem(),
            'big_cart' => view('frontend.__pertials.big-cart')->render(),
            'big_cart_total' => view('frontend.__pertials.big-cart-total',compact('cart_total'))->render()
        ]);
    }

    public function addCoupon(Request $request)
    {
        if(Session::has('order_aditional')){
            if(array_key_exists('coupon', Session::get('order_aditional'))){
                return response()->json(['status' => false, 'message' => 'Coupon Already Applied!']);
            }
        }
        $coupon = Coupon::where('code', strtoupper($request->code))->orWhere('code', strtolower($request->code))->first();
        if(!$coupon) return response()->json(['status' => false, 'message' => 'Invalid Coupon Code1']);
        $current_time = strtotime(date('Y-m-d H:i'));

        if($current_time >= strtotime($coupon->start_at) && strtotime($coupon->end_at) >= $current_time){
            if(str_replace(',','', CartService::cartTotal())  >= $coupon->amount){
                $order_aditional = [
                    'coupon' => [
                        'code' => $request->code,
                        'id' => $coupon->id,
                        'amount' => $coupon->amount
                    ]
                ];
                Session::put('order_aditional', $order_aditional);
                $cart_total = CartService::cartTotalWithAditional();
                return response()->json([
                    'status' => true,
                    'message' => 'Coupon Applied Successfully',
                    'big_cart_total' => view('frontend.__pertials.big-cart-total',compact('cart_total'))->render()
                ]);
            }else{
                return response()->json(['status' => false,'message' => 'Invalid Coupon Code']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Invalid Coupon Code']);
    }

}
