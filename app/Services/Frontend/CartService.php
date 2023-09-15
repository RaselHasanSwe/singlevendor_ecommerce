<?php
namespace App\Services\Frontend;

use App\Models\Product;
use App\Models\Color;
use App\Models\ProductVariation;
use App\Models\Size;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartService {

    public static function addCart( Request $request)
    {

        $product = Product::where('id', $request->product_id)->with('images')->firstOrFail();
        $sizeName = ($request->size) ? Size::findOrFail($request->size)->first()->name : '';
        $colorName = ($request->color) ? Color::where('id', $request->color)->first()->name : '';
        $colorImage = '';
        $price = Str::Price($product);
        if($request->size && $request->color){
            $variation = ProductVariation::where('product_id', $request->product_id)
                ->where('color_id', $request->color)
                ->where('size_id', $request->size)
                ->first();
            if($variation){
                $colorImage = $variation->image;
                $price = Str::VariationPrice($variation->price, $product);
            }
        }

        $item = [
            'id' => $request->product_id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price'=> $price,
            'weight'=> 0,
            'options' => [
                'slug' => $product->slug,
                'image'=> $product->thumbnail,
                'color_image'=> $colorImage,
                'size' => $sizeName,
                'color'=> $colorName,
                'size_id' => $request->size,
                'color_id' => $request->color,
                'tax' => 0,
                'shipping'=> 0,
                'shipping_id' => '',
                'is_free_shipping' => false,
            ]
        ];
        Cart::add($item);
    }

    public static function updateCart($rowId, $qty)
    {
        Cart::update($rowId, $qty);
    }
    public static function removeCart($rowId)
    {
        Cart::remove($rowId);
    }

    public static function cartTotal()
    {
        $total = 0;
        foreach(Cart::content() as $item){
            $price = $item->price * $item->qty;
            $total += $price;
        }
        return number_format($total, 2);
    }

    public static function totalItem()
    {
        return Cart::content()->count();
    }

    public static function cartTotalWithAditional()
    {
        //dd(Cart::content());

        $coupon_total = 0;
        if(Session::has('order_aditional')){
            if(array_key_exists('coupon', Session::get('order_aditional')))
                $coupon_total = Session::get('order_aditional')['coupon']['amount'];
        }

        return ['cart_total' => self::cartTotal(), 'coupon_total' => number_format($coupon_total,2)];
    }

    public static function shippingTotal()
    {
        $shippingTotal = 0;
        foreach(Cart::content() as $item){
            if($item->options->shipping != '' || $item->options->shipping != null){
                $shippingTotal += $item->options->shipping;
            }
        }

        return number_format($shippingTotal, 2);

    }




}
