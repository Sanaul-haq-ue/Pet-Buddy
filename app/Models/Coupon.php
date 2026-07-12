<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'name',
        'code',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'usage_per_customer',
        'start_date',
        'expiry_date',
        'note',
        'status',
    ];

    protected $casts = [
        'start_date'  => 'datetime',
        'expiry_date' => 'datetime',
    ];
}
