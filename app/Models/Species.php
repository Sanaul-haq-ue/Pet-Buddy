<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = [
        'species_name',
        'scientific_classification',
        'care_notes',
    ];
}
