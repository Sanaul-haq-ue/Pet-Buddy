<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $fillable = [
        'productSubCategory_name',
        'productCategory_id',
        'status',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'productCategory_id');
    }
}
