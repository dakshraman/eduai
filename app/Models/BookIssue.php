<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookIssue extends Model
{
    protected $fillable = [
        'school_id',
        'book_id',
        'student_id',
        'issue_date',
        'return_date',
        'due_date',
        'status',
        'fine',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'return_date' => 'date',
        'due_date' => 'date',
        'fine' => 'decimal:2',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
