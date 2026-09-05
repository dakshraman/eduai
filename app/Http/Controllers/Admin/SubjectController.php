<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::with('class')->where('school_id', Auth::user()->school_id);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $subjects = $query->latest()->paginate(20);
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();

        return view('admin.subjects.index', compact('subjects', 'classes'));
    }

    public function create()
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.subjects.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'subject_code' => 'nullable|string|max:50',
            'pass_mark' => 'nullable|integer|min:0',
            'full_mark' => 'nullable|integer|min:1',
        ]);

        Subject::create([
            'school_id' => Auth::user()->school_id,
            'class_id' => $validated['class_id'],
            'name' => $validated['name'],
            'subject_code' => $validated['subject_code'] ?? null,
            'pass_mark' => $validated['pass_mark'] ?? 0,
            'full_mark' => $validated['full_mark'] ?? 100,
            'active_status' => true,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        $subject->load('class', 'examResults');
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.subjects.edit', compact('subject', 'classes'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'subject_code' => 'nullable|string|max:50',
            'pass_mark' => 'nullable|integer|min:0',
            'full_mark' => 'nullable|integer|min:1',
            'active_status' => 'boolean',
        ]);

        $subject->update([
            'class_id' => $validated['class_id'],
            'name' => $validated['name'],
            'subject_code' => $validated['subject_code'] ?? null,
            'pass_mark' => $validated['pass_mark'] ?? 0,
            'full_mark' => $validated['full_mark'] ?? 100,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
