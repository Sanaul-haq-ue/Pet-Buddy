<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'user_id',
        'pet_name',
        'pet_age',
        'species',
        'breed',
        'status',
        'pet_description',
        'pet_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function species()
    {
        return $this->belongsTo(Species::class, 'species');
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class, 'breed');
    }
}
