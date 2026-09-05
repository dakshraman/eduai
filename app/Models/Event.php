<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'school_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'image',
        'created_by',
        'active_status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'active_status' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
