<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'school_id',
        'title',
        'author',
        'isbn',
        'category',
        'quantity',
        'available_quantity',
        'shelf_number',
        'active_status',
    ];

    protected $casts = [
        'active_status' => 'boolean',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function bookIssues(): HasMany
    {
        return $this->hasMany(BookIssue::class);
    }
}
