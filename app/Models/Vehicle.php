<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = ['school_id', 'transport_route_id', 'plate_number', 'vehicle_type', 'capacity', 'driver_name', 'driver_phone', 'active_status'];

    protected $casts = [
        'capacity' => 'integer',
        'active_status' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }
}
