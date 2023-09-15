<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'country',
        'city',
        'state',
        'zip',
        'phone',
        'address_1',
        'address_2',
        'order_note',
        'invoice_id',
        'grand_total',
        'order_status',
        'payment_status',
        'payment_method',
        'coupon_name',
        'coupon_code',
        'coupon_amount',
        'extra_amount',
        'extra_amount_note'
    ];

    public function products()
    {
        return $this->hasMany(OrderedProduct::class);
    }
}
