<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'brand_logo',
        'company_name',
        'status',
        'address',
        'location',
        'phone1',
        'phone2',
        'email',
        'business_card',
    ];
}
