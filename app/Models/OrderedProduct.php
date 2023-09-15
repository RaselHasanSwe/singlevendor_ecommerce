<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'prduct_name',
        'qty',
        'color_name',
        'size_name',
        'main_image',
        'color_image',
        'discount',
        'discount_type',
        'shipping_id',
        'shipping_original_price',
        'shipping_apply',
        'is_free',
        'product_original_price',
        'discounted_price',
        'total_shipping_price',
        'grand_total'
    ];
}
