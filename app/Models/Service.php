<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'company_id',
        'district_id',
        'upazila_id',
        'union_id',
        'location',
        'image',
        'status',
        'service_type',
    ];

    public function pricings()
    {
        return $this->hasMany(ServicePricing::class, 'service_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    public function availability()
    {
        return $this->hasMany(ServiceAvailability::class, 'service_id');
    }
}
