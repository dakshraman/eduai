<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with('user')->where('school_id', Auth::user()->school_id);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $teachers = $query->latest()->paginate(20);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'employee_id' => 'required|string|unique:teachers',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
            'school_id' => Auth::user()->school_id,
            'role' => 'teacher',
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'active_status' => true,
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'school_id' => Auth::user()->school_id,
            'employee_id' => $validated['employee_id'],
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'qualification' => $validated['qualification'] ?? null,
            'experience' => $validated['experience'] ?? null,
            'active_status' => true,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'active_status' => 'boolean',
        ]);

        $teacher->user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        $teacher->update([
            'designation' => $validated['designation'] ?? null,
            'department' => $validated['department'] ?? null,
            'joining_date' => $validated['joining_date'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'qualification' => $validated['qualification'] ?? null,
            'experience' => $validated['experience'] ?? null,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
