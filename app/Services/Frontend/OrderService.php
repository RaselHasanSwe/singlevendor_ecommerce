<?php
namespace App\Services\Frontend;

use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\ProductShipping;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderService {

    public function generateOrder(Request $request)
    {
        $coupon = $this->coupon();
        $ordered_product = $this->orderedProduct($request);

        $order['user_id'] = $this->user($request);
        $order['first_name'] = $request->first_name;
        $order['last_name'] = $request->last_name ?? null;
        $order['email'] = $request->email ?? null;
        $order['country'] = $request->country ?? null;
        $order['city'] = $request->city ?? null;
        $order['state'] = $request->state ?? null;
        $order['zip'] = $request->zip ?? null;
        $order['phone'] = $request->phone;
        $order['address_1'] = $request->address_1;
        $order['address_2'] = $request->address_2 ?? null;
        $order['order_note'] = $request->order_note ?? null;
        $order['invoice_id'] = time().rand(1,100);
        $order['grand_total'] = $ordered_product['total'] - $coupon['coupon_amount'];
        $order['payment_method'] = $request->payment_method ?? 1;
        $order['coupon_name'] = $coupon['coupon_name'];
        $order['coupon_code'] = $coupon['coupon_code'];
        $order['coupon_amount'] = $coupon['coupon_amount'];
        $orderCreated = Order::create($order);
        foreach($ordered_product['products'] as $key => $value){
            $ordered_product['products'][$key]['order_id'] = $orderCreated->id;
        }
        OrderedProduct::insert($ordered_product['products']);

        return ['order' => $orderCreated ];
    }

    protected function user(Request $request)
    {
        $id = null;

        if(Auth::guard('web')->check()){
            return Auth::guard('web')->user()->id;
        }

        if($request->has('new_account')){
            $hasUser = User::where('email', $request->email)->first();
            if($hasUser){
                $id =  $hasUser->id;
            }else{
                $user['name'] = $request->first_name.' '.$request->last_name;
                $user['email'] = $request->email;
                $user['password'] = $request->password;
                $new_user = User::create($user);
                $id = $new_user;
            }
        }
        return $id;
    }

    public function orderedProduct(Request $request)
    {
        $products = [];
        $grandTotal = 0;
        foreach(Cart::content() as $row){
            $product = Product::where('id', $row->id)->first();
            $shipping = ProductShipping::where('product_id', $row->id)
                ->where('shipping_id', $row->options->shipping_id)->first();
            $item['order_id'] = null;
            $item['product_id'] = $row->id;
            $item['prduct_name'] = $row->name;
            $item['qty'] = $row->qty;
            $item['color_name'] = $row->options->color;
            $item['size_name'] = $row->options->size;
            $item['main_image'] = $row->options->image;
            $item['color_image'] = $row->options->color_image;
            $item['discount'] = $product->discount;
            $item['discount_type'] = $product->discount_type;
            $item['shipping_id'] = $row->options->shipping_id;
            $item['shipping_original_price'] = $shipping->price;
            $item['shipping_apply'] = $shipping->shipping_apply;
            $item['is_free'] = $shipping->is_free;
            $item['product_original_price'] = $product->price;
            $item['discounted_price'] = $this->discountPrice($product, $row->options->color_id, $row->options->size_id);
            $item['total_shipping_price'] = $this->shippingPrice($shipping, $row->qty);
            $item['grand_total'] = ($row->qty * $item['discounted_price']) + $item['total_shipping_price'];
            $products[] = $item;
            $grandTotal += $item['grand_total'];
        }

        return ['products' =>$products, 'total' => $grandTotal];
    }

    public function discountPrice($product, $color_id, $size_id)
    {
        $price = $product->price;
        if($color_id && $size_id){
            $variation = ProductVariation::where('product_id', $product->id)
                ->where('color_id', $color_id)
                ->where('size_id', $size_id)
                ->first();
            $price = $variation ? $variation->price : $price;
        }

        if($product->discount){
            $discount_amount = $product->discount;
            $discount_amount = ($product->discount_type == 1) ? $price * $product->discount / 100 : $discount_amount;
            $price = $price - $discount_amount;
        }
        return $price;
    }

    public function shippingPrice($shipping, $qty)
    {
        $price = ($shipping->is_free == 1) ? 0 : $shipping->price;
        $price = ($shipping->shipping_apply == 1) ? $price * $qty : $price;
        return $price;
    }

    public function coupon()
    {
        $data['coupon_name'] = null;
        $data['coupon_code'] =  null;
        $data['coupon_amount'] = 0;
        if(Session::has('order_aditional')){
            $aditional = Session::get('order_aditional');
            if(array_key_exists('coupon', $aditional)){
                $data['coupon_name'] = $aditional['coupon']['coupon_name'];
                $data['coupon_code'] = $aditional['coupon']['coupon_code'];
                $data['coupon_amount'] = $aditional['coupon']['coupon_amount'];
            }
        }
        return $data;
    }

    public static function paymentMethod($status)
    {
        $method = 'Cod(Cash On Delivery)';
        if($status == 2) $method = 'Bkash';
        if($status == 3) $method = 'Paypal';
        if($status == 4) $method = 'Stripe';
        return $method;
    }

}
