<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
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

    public function create()
    {
        return Inertia::render('SuperAdmin/Plans/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subscription_plans,name',
            'slug' => 'nullable|string|max:255|unique:subscription_plans,slug',
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
        ]);

        $validated['slug'] = $validated['slug'] ?? strtolower(str_replace(' ', '-', $validated['name']));
        $validated['active_status'] = true;

        SubscriptionPlan::create($validated);

        return redirect()->route('superadmin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(SubscriptionPlan $plan)
    {
        return Inertia::render('SuperAdmin/Plans/Edit', [
            'plan' => $plan,
        ]);
    }

    public function update(Request $request, SubscriptionPlan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subscription_plans,name,' . $plan->id,
            'slug' => 'nullable|string|max:255|unique:subscription_plans,slug,' . $plan->id,
            'description' => 'nullable|string',
            'price_monthly' => 'required|numeric|min:0',
            'price_yearly' => 'nullable|numeric|min:0',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'active_status' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? strtolower(str_replace(' ', '-', $validated['name']));

        $plan->update($validated);

        return redirect()->route('superadmin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(SubscriptionPlan $plan)
    {
        if ($plan->subscriptions()->count() > 0) {
            return back()->with('error', 'Cannot delete a plan with active subscriptions. Deactivate it instead.');
        }

        $plan->delete();

        return redirect()->route('superadmin.plans.index')->with('success', 'Plan deleted successfully.');
    }

    public function toggle(SubscriptionPlan $plan)
    {
        $plan->update(['active_status' => ! $plan->active_status]);

        return back()->with('success', $plan->active_status ? 'Plan activated.' : 'Plan deactivated.');
    }
}
