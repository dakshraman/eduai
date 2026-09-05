<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('class')
            ->where('school_id', Auth::user()->school_id)
            ->latest()
            ->paginate(20);

        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.exams.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'exam_type' => 'required|in:unit,midterm,final,assignment',
        ]);

        Exam::create([
            'school_id' => Auth::user()->school_id,
            'name' => $validated['name'],
            'class_id' => $validated['class_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'exam_type' => $validated['exam_type'],
            'active_status' => true,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }

    public function show(Exam $exam)
    {
        $exam->load('class', 'examResults.student.user', 'examResults.subject');
        $subjects = Subject::where('school_id', Auth::user()->school_id)
            ->where('class_id', $exam->class_id)
            ->get();

        return view('admin.exams.show', compact('exam', 'subjects'));
    }

    public function edit(Exam $exam)
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return view('admin.exams.edit', compact('exam', 'classes'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'exam_type' => 'required|in:unit,midterm,final,assignment',
            'active_status' => 'boolean',
        ]);

        $exam->update([
            'name' => $validated['name'],
            'class_id' => $validated['class_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'exam_type' => $validated['exam_type'],
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }

    public function storeResult(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'marks_obtained' => 'required|numeric|min:0',
            'remarks' => 'nullable|string|max:255',
        ]);

        ExamResult::updateOrCreate(
            [
                'exam_id' => $exam->id,
                'student_id' => $validated['student_id'],
                'subject_id' => $validated['subject_id'],
            ],
            [
                'school_id' => Auth::user()->school_id,
                'marks_obtained' => $validated['marks_obtained'],
                'remarks' => $validated['remarks'] ?? null,
            ]
        );

        return redirect()->route('exams.show', $exam)->with('success', 'Result saved successfully.');
    }
}
