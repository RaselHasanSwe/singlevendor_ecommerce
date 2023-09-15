<?php

namespace App\Mixins;

class StrMixin
{
    public function URI()
    {
        return function($url, $url1 = null, $url2 = null){
            $newUrl = $url;
            if($url1) $newUrl .= '/'.$url1;
            if($url2) $newUrl .= '/'.$url2;
            return url($newUrl);
        };
    }

    public function Price()
    {
        return function($product){
            $discount_amount = $product->discount;
            $price = $product->price;
            if($product->discount_type == 1)
                $discount_amount = $product->price * $product->discount / 100;
            if($discount_amount > 0){
                $price = $price - $discount_amount;
            }
            return number_format($price, 2);
        };
    }

    public function VariationPrice()
    {
        return function($price, $product){
            $price = str_replace( ',', '', $price );
            $discount_amount = $product->discount;
            if($product->discount_type == 1)
                $discount_amount = $price * $product->discount / 100;
            if($discount_amount > 0){
                $price = $price - $discount_amount;
            }
            return number_format($price, 2);
        };
    }

    public function CatFilterUrl()
    {
        return function($all_categories){
            if(isset($all_categories->subCategor) && $all_categories->subCategory !== null){
                $url = 'shop/'.$all_categories->category->slug.'/'.$all_categories->subCategory->slug.'/'.$all_categories->slug;
                return url($url);
            }
            if($all_categories->category !== null){
                $url = 'shop/'.$all_categories->category->slug.'/'.$all_categories->slug;
                return url($url);
            }
            return url('shop/'.$all_categories->slug);
        };
    }

    public function ShipTo()
    {
        return function($status, $city){
            $ship_to = 'Inside of '.$city;
            if($status == 2) $ship_to = 'Out of '.$city;
            return $ship_to;
        };
    }

    public function ShippingMargeAdmin()
    {
        return function($id, $arrItem){
            $data = [];
            if(!$arrItem) return $data;
            foreach ($arrItem as $key => $item) {
                if($item->shipping_id == $id){
                    $data['shipping_id'] = $id;
                    $data['product_id'] = $item->product_id;
                    $data['price'] = $item->price;
                    $data['shipping_apply'] = $item->shipping_apply;
                    $data['is_free'] = $item->is_free;
                }
            }
            return $data;
        };
    }

    public function Total()
    {
        return function($arr){
            $total = 0;
            foreach($arr as $item){
                $total += str_replace(',', '', $item);
            }
            return number_format($total, 2);
        };
    }

    public function OrderStatus()
    {
        return function($id){
            $status = 'Pending';
            if($id == 2) $status = 'Confirm';
            if($id == 3) $status = 'Delivered';
            if($id == 4) $status = 'Cancel';
            return $status;
        };
    }

    public function PaymentStatus()
    {
        return function($id){
            $status = 'Unpaid';
            if($id == 2) $status = 'Paid';
            if($id == 3) $status = 'Refund';
            return $status;
        };
    }

    public function PaymentMethod()
    {
        return function($id){
            $status = 'Cash On Devlivery';
            if($id == 2) $status = 'Bkash';
            if($id == 3) $status = 'Paypal';
            if($id == 3) $status = 'Stripe';
            return $status;
        };
    }

    public function number()
    {
        return function($value){
            return str_replace(',','', $value);
        };
    }

}
