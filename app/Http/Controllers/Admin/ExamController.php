<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('class')
            ->where('school_id', Auth::user()->school_id)
            ->latest()
            ->paginate(20);

        return Inertia::render('Admin/Exams/Index', [
            'exams' => $exams,
            'classes' => ClassModel::where('school_id', Auth::user()->school_id)->get(),
        ]);
    }

    public function create()
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return Inertia::render('Admin/Exams/Create', [
            'classes' => $classes,
        ]);
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

        return Inertia::render('Admin/Exams/Show', [
            'exam' => $exam,
            'subjects' => $subjects,
        ]);
    }

    public function edit(Exam $exam)
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        return Inertia::render('Admin/Exams/Edit', [
            'exam' => $exam,
            'classes' => $classes,
        ]);
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

    public function results(Exam $exam)
    {
        $exam->load('class');
        $students = Student::with('user')
            ->where('school_id', Auth::user()->school_id)
            ->where('class_id', $exam->class_id)
            ->get();
        $subjects = Subject::where('school_id', Auth::user()->school_id)
            ->where('class_id', $exam->class_id)
            ->get();

        $existingResults = ExamResult::where('exam_id', $exam->id)
            ->get()
            ->keyBy(function ($r) {
                return $r->student_id . '_' . $r->subject_id;
            });

        return Inertia::render('Admin/Exams/Results', [
            'exam' => $exam,
            'students' => $students,
            'subjects' => $subjects,
            'existingResults' => $existingResults,
        ]);
    }

    public function storeResults(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'marks' => 'required|array',
            'marks.*' => 'nullable|numeric|min:0',
        ]);

        $schoolId = Auth::user()->school_id;

        foreach ($validated['marks'] as $key => $marks) {
            if ($marks === null || $marks === '') {
                continue;
            }
            [$studentId, $subjectId] = explode('_', $key);

            ExamResult::updateOrCreate(
                [
                    'exam_id' => $exam->id,
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                ],
                [
                    'school_id' => $schoolId,
                    'marks_obtained' => $marks,
                ]
            );
        }

        return redirect()->route('exams.results', $exam)->with('success', 'Results saved successfully.');
    }

    public function studentResults(Student $student)
    {
        $student->load('user', 'class');
        $schoolId = Auth::user()->school_id;

        $results = ExamResult::with('exam', 'subject')
            ->where('student_id', $student->id)
            ->where('school_id', $schoolId)
            ->get();

        $overallTotal = $results->sum('marks_obtained');
        $overallFullMark = $results->sum(function ($r) {
            return $r->subject->full_mark ?? 0;
        });
        $overallPercentage = $overallFullMark > 0
            ? round(($overallTotal / $overallFullMark) * 100, 1)
            : 0;

        return Inertia::render('Admin/Exams/StudentResults', [
            'student' => $student,
            'results' => $results,
            'overallTotal' => $overallTotal,
            'overallFullMark' => $overallFullMark,
            'overallPercentage' => $overallPercentage,
        ]);
    }
}
