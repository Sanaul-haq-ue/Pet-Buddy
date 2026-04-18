<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePricing extends Model
{
    protected $fillable = [
        'service_id',
        'pricing_type',
        'price',
        'sale_price',
        'qty',
        'time',
        'label',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function rules()
    {
        return $this->hasMany(ServicePricingRule::class, 'service_pricing_id');
    }

}
