<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Inertia\Inertia;

class PlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::withCount('subscriptions')->get();

        return Inertia::render('SuperAdmin/Plans/Index', [
            'plans' => $plans,
        ]);
    }

    public function toggle(SubscriptionPlan $plan)
    {
        $plan->update(['active_status' => ! $plan->active_status]);

        return back()->with('success', $plan->active_status ? 'Plan activated.' : 'Plan deactivated.');
    }
}