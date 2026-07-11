<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    // We control exactly which fields are writable inside the controller's
    // validation rules per section, so mass assignment here is safe.
    protected $guarded = ['id'];

    /**
     * Always return the single settings row (id = 1).
     * Creates it once automatically if it doesn't exist yet.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
