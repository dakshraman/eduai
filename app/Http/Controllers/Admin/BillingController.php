<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SchoolSubscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BillingController extends Controller
{
    public function index()
    {
        $school = School::find(auth()->user()->school_id);
        $subscription = SchoolSubscription::where('school_id', auth()->user()->school_id)->first();
        $plans = SubscriptionPlan::where('active_status', true)->get();

        return Inertia::render('Admin/Billing/Index', [
            'school' => $school,
            'subscription' => $subscription,
            'plans' => $plans,
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'billing_period' => 'required|in:monthly,yearly',
        ]);

        $plan = SubscriptionPlan::find($request->plan_id);
        $schoolId = auth()->user()->school_id;

        $existing = SchoolSubscription::where('school_id', $schoolId)->first();
        if ($existing && $existing->isActive()) {
            return back()->with('error', 'You already have an active subscription.');
        }

        SchoolSubscription::updateOrCreate(
            ['school_id' => $schoolId],
            [
                'subscription_plan_id' => $plan->id,
                'stripe_subscription_id' => null,
                'stripe_customer_id' => null,
                'status' => 'active',
                'billing_period' => $request->billing_period,
                'current_period_start' => now()->toDateString(),
                'current_period_end' => ($request->billing_period === 'monthly'
                    ? now()->addMonth()
                    : now()->addYear())->toDateString(),
            ]
        );

        return redirect()->route('billing.index')->with('success', 'Subscription activated! Welcome to ' . $plan->name . ' plan.');
    }

    public function cancel()
    {
        $subscription = SchoolSubscription::where('school_id', auth()->user()->school_id)->first();
        if ($subscription) {
            $subscription->update([
                'status' => 'cancelled',
                'cancelled_at' => now()->toDateString(),
            ]);
        }

        return redirect()->route('billing.index')->with('success', 'Subscription cancelled. You can use the system until the end of your billing period.');
    }

    public function invoices()
    {
        $invoices = [];

        return Inertia::render('Admin/Billing/Invoices', [
            'invoices' => $invoices,
        ]);
    }
}
