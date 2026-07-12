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

    /**
     * Scope to only active pets — lets you write Pet::active()->get()
     * instead of repeating ->where('status', '1') everywhere.
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    /**
     * Full public URL for the pet image, or a placeholder if none uploaded.
     * Access as $pet->image_url in Blade instead of repeating the ternary each time.
     */
    public function getImageUrlAttribute()
    {
        return $this->pet_image
            ? asset($this->pet_image)
            : 'https://via.placeholder.com/150';
    }
}
