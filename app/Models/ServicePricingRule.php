<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePricingRule extends Model
{
    protected $fillable = [
        'service_pricing_id',
        'species_id',
        'breed_id',
        'size_id',
        'price',
        'sale_price',
        
    ];

    public function servicePricing()
    {
        return $this->belongsTo(ServicePricing::class, 'service_pricing_id');
    }

    public function species()
    {
        return $this->belongsTo(Species::class, 'species_id');
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class, 'breed_id');
    }

    public function size()
    {
        return $this->belongsTo(PetSize::class, 'size_id');
    }

}
