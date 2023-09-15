<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_id',
        'product_id',
        'price',
        'shipping_apply',
        'is_free',
    ];
}
