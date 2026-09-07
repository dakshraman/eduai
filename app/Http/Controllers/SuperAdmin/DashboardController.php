<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolSubscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'schools' => School::count(),
            'users' => User::count(),
            'activeSubscriptions' => SchoolSubscription::where('status', 'active')->count(),
            'trialSchools' => SchoolSubscription::where('status', 'trial')->count(),
        ];

        $revenue = SchoolSubscription::where('status', 'active')
            ->with('plan')
            ->get()
            ->sum(fn ($s) => (float) ($s->plan?->price_monthly ?? 0));

        $schools = School::withCount('users')
            ->with('subscription.plan')
            ->latest()
            ->take(8)
            ->get();

        $plans = SubscriptionPlan::withCount('subscriptions')->get();

        return Inertia::render('SuperAdmin/Dashboard', [
            'stats' => $stats,
            'revenue' => round($revenue, 2),
            'schools' => $schools,
            'plans' => $plans,
        ]);
    }
}