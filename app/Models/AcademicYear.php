<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicYear extends Model
{
    protected $fillable = [
        'school_id',
        'year',
        'title',
        'starting_date',
        'ending_date',
        'active_status',
        'is_default',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'ending_date' => 'date',
        'active_status' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
