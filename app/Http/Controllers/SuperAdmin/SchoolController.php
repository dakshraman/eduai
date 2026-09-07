<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
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