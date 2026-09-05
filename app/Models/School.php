<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'address',
        'phone',
        'email',
        'logo',
        'favicon',
        'domain',
        'timezone',
        'currency',
        'currency_symbol',
        'active_status',
        'trial_ends_at',
    ];

    protected $casts = [
        'active_status' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function academicYears(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function feeCategories(): HasMany
    {
        return $this->hasMany(FeeCategory::class);
    }

    public function feeStructures(): HasMany
    {
        return $this->hasMany(FeeStructure::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
