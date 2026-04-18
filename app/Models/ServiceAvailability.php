<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceAvailability extends Model
{
    protected $fillable = [
        'service_id',
        'day_of_week',
        'start_time',
        'end_time',
        'off_dates',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
