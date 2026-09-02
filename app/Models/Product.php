<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'slug',
        'brand_id',
        'category_id',
        'sub_category_id',
        'description',
        'species_ids',
        'regular_price',
        'selling_price',
        'buying_price',
        'unit',
        'quantity',
        'sku_id',
        'image',
        'is_visible',
    ];

    protected $casts = [
        'species_ids' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }

    // public function unit()
    // {
    //     return $this->belongsTo(ProductUnit::class, 'unit_id');
    // }

    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }
}
