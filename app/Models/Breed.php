<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $fillable = [
        'breed_name',
        'species_id',
        'status',
        'description',
        'image',
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }
}
