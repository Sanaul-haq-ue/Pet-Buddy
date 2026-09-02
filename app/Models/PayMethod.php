<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    protected $fillable = [
        'name',
        'pay_type_id',
        'status',
        'note'
    ];

    public function paymentType()
    {
        return $this->belongsTo(PayType::class, 'pay_type_id');
    }
}
