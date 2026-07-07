<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'user_id',
        'coupon_code',
        'subtotal',
        'discount_amount',
        'total',
        'pay_type_id',
        'pay_method_id',
        'transaction_no',
        'payment_screenshot',
        'shipping_name',
        'shipping_email',
        'shipping_mobile',
        'shipping_address',
        'status',
        'payment_status',
        'shipping_charge',
        'shipping_zone',
        'tracking_stage',
        'call_attempts',
        'cancelled_reason',
        'confirmed_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'shipped_at'   => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payType()
    {
        return $this->belongsTo(PayType::class,  'pay_type_id');
    }
    public function payMethod()
    {
        return $this->belongsTo(PayMethod::class, 'pay_method_id');
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->orderBy('created_at');
    }
}
