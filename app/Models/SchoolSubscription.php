<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolSubscription extends Model
{
    protected $fillable = [
        'school_id',
        'subscription_plan_id',
        'stripe_subscription_id',
        'stripe_customer_id',
        'status',
        'billing_period',
        'trial_ends_at',
        'current_period_start',
        'current_period_end',
        'cancelled_at',
    ];

    protected $casts = [
        'trial_ends_at' => 'date',
        'current_period_start' => 'date',
        'current_period_end' => 'date',
        'cancelled_at' => 'date',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function isTrial(): bool
    {
        return $this->status === 'trial';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isExpired(): bool
    {
        return $this->status === 'expired'
            || ($this->trial_ends_at && $this->trial_ends_at->isPast());
    }
}
