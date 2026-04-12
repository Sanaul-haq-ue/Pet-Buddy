<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_name',
        'slug',
        'S_description',
        'category_id',
        'species_id',
        'company_id',
        'district_id',
        'upazila_id',
        'union_id',
        'location',
        'base_price',
        'timing',
        'offer_price',
        'capacity',
        'cover_image',
        'is_published',
    ];

    protected $casts = [
        'category_id' => 'array',
        'species_id' => 'array',
    ];
}
