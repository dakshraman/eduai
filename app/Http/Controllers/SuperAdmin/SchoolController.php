<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = School::with('subscription.plan')
            ->withCount(['users', 'students', 'teachers'])
            ->latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        return Inertia::render('SuperAdmin/Schools/Index', [
            'schools' => $query->paginate(15)->withQueryString(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        $plans = SubscriptionPlan::where('active_status', true)->get();

        return Inertia::render('SuperAdmin/Schools/Create', [
            'plans' => $plans,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:schools,slug',
            'code' => 'required|string|max:50|unique:schools,code',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:50',
            'currency' => 'nullable|string|max:10',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|max:255|unique:users,email',
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['name']);
        unset($validated['slug']);

        $school = School::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'code' => $validated['code'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'timezone' => $validated['timezone'] ?? 'UTC',
            'currency' => $validated['currency'] ?? 'USD',
            'active_status' => true,
            'trial_ends_at' => now()->addDays(14),
        ]);

        \App\Models\User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make('password'),
            'school_id' => $school->id,
            'role' => 'admin',
            'active_status' => true,
        ]);

        return redirect()->route('superadmin.schools.index')->with('success', 'School created successfully. Admin password is "password".');
    }

    public function show(School $school)
    {
        $school->load('subscription.plan');

        $stats = [
            'users' => $school->users()->count(),
            'students' => $school->students()->count(),
            'teachers' => $school->teachers()->count(),
            'classes' => $school->classes()->count(),
        ];

        $recentUsers = $school->users()->latest()->take(10)->get(['id', 'name', 'email', 'role', 'active_status']);

        return Inertia::render('SuperAdmin/Schools/Show', [
            'school' => $school,
            'stats' => $stats,
            'recentUsers' => $recentUsers,
        ]);
    }

    public function edit(School $school)
    {
        $plans = SubscriptionPlan::where('active_status', true)->get();

        return Inertia::render('SuperAdmin/Schools/Edit', [
            'school' => $school,
            'plans' => $plans,
        ]);
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:schools,code,' . $school->id,
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:50',
            'currency' => 'nullable|string|max:10',
            'active_status' => 'boolean',
        ]);

        $school->update($validated);

        return redirect()->route('superadmin.schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        if ($school->users()->count() > 0) {
            return back()->with('error', 'Cannot delete a school with users. Deactivate it instead.');
        }

        $school->delete();

        return redirect()->route('superadmin.schools.index')->with('success', 'School deleted successfully.');
    }

    public function toggle(School $school)
    {
        $school->update(['active_status' => ! $school->active_status]);

        return back()->with('success', $school->active_status ? 'School activated.' : 'School deactivated.');
    }

    public function extendTrial(Request $request, School $school)
    {
        $days = $request->validate(['days' => 'required|integer|min:1|max:365'])['days'];

        $subscription = $school->subscription()->firstOrCreate([], [
            'status' => 'trial',
            'trial_ends_at' => now()->addDays($days),
        ]);

        $subscription->update([
            'status' => 'trial',
            'trial_ends_at' => now()->addDays($days),
        ]);

        return back()->with('success', "Trial extended by {$days} days.");
    }
}
