<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'class', 'section'])
            ->where('school_id', Auth::user()->school_id);

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->latest()->paginate(20);
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();

        return view('admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.students.create', compact('classes'));
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
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'admission_number' => 'required|string|unique:students',
            'roll_number' => 'nullable|string',
            'admission_date' => 'required|date',
            'session_year' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
            'school_id' => Auth::user()->school_id,
            'role' => 'student',
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'active_status' => true,
        ]);

        Student::create([
            'user_id' => $user->id,
            'school_id' => Auth::user()->school_id,
            'class_id' => $validated['class_id'],
            'section_id' => $validated['section_id'] ?? null,
            'admission_number' => $validated['admission_number'],
            'roll_number' => $validated['roll_number'] ?? null,
            'admission_date' => $validated['admission_date'],
            'session_year' => $validated['session_year'] ?? null,
            'active_status' => true,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'class', 'section', 'attendances', 'feePayments.feeStructure.feeCategory', 'examResults.exam', 'examResults.subject']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'roll_number' => 'nullable|string',
            'session_year' => 'nullable|string',
            'active_status' => 'boolean',
        ]);

        $student->user->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        $student->update([
            'class_id' => $validated['class_id'],
            'section_id' => $validated['section_id'] ?? null,
            'roll_number' => $validated['roll_number'] ?? null,
            'session_year' => $validated['session_year'] ?? null,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
