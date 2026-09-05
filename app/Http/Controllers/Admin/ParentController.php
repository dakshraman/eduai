<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $schoolId = Auth::user()->school_id;
        $query = ParentModel::with('user', 'students')->where('school_id', $schoolId);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $parents = $query->latest()->paginate(20);
        return Inertia::render('Admin/Parents/Index', [
            'parents' => $parents,
        ]);
    }

    public function create()
    {
        $schoolId = Auth::user()->school_id;
        $students = Student::where('school_id', $schoolId)->with('user')->get();
        return Inertia::render('Admin/Parents/Create', [
            'students' => $students,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'relation_type' => 'required|in:father,mother,guardian',
            'address' => 'nullable|string|max:255',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
            'school_id' => Auth::user()->school_id,
            'role' => 'parent',
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'active_status' => true,
        ]);

        $parent = ParentModel::create([
            'user_id' => $user->id,
            'school_id' => Auth::user()->school_id,
            'occupation' => $validated['occupation'] ?? null,
            'relation_type' => $validated['relation_type'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        if (!empty($validated['student_ids'])) {
            $parent->students()->sync($validated['student_ids']);
        }

        return redirect()->route('parents.index')->with('success', 'Parent created successfully.');
    }

    public function show(ParentModel $parent)
    {
        $parent->load('user', 'students.user', 'students.class');
        return Inertia::render('Admin/Parents/Show', [
            'parent' => $parent,
        ]);
    }

    public function edit(ParentModel $parent)
    {
        $parent->load('user');
        $schoolId = Auth::user()->school_id;
        $students = Student::where('school_id', $schoolId)->with('user')->get();
        $selectedStudents = $parent->students->pluck('id');
        return Inertia::render('Admin/Parents/Edit', [
            'parent' => $parent,
            'students' => $students,
            'selectedStudents' => $selectedStudents,
        ]);
    }

    public function update(Request $request, ParentModel $parent)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'occupation' => 'nullable|string|max:255',
            'relation_type' => 'required|in:father,mother,guardian',
            'address' => 'nullable|string|max:255',
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        $parent->user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        $parent->update([
            'occupation' => $validated['occupation'] ?? null,
            'relation_type' => $validated['relation_type'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        $parent->students()->sync($validated['student_ids'] ?? []);

        return redirect()->route('parents.index')->with('success', 'Parent updated successfully.');
    }

    public function destroy(ParentModel $parent)
    {
        $parent->students()->detach();
        $parent->user->delete();
        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Parent deleted successfully.');
    }
}
