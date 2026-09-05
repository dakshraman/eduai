<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_yearly',
        'features',
        'stripe_price_monthly_id',
        'stripe_price_yearly_id',
        'active_status',
    ];

    protected $casts = [
        'features' => 'array',
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SchoolSubscription::class);
    }
}
