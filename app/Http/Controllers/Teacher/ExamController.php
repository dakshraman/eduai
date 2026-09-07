<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
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

        return Inertia::render('Teacher/Exams/Index', [
            'exams' => $exams,
        ]);
    }

    public function results(Exam $exam)
    {
        $schoolId = Auth::user()->school_id;
        $exam->load('class');
        $students = Student::with('user')
            ->where('school_id', $schoolId)
            ->where('class_id', $exam->class_id)
            ->get();
        $subjects = Subject::where('school_id', $schoolId)
            ->where('class_id', $exam->class_id)
            ->get();

        $existingResults = ExamResult::where('exam_id', $exam->id)
            ->get()
            ->keyBy(function ($r) {
                return $r->student_id . '_' . $r->subject_id;
            });

        return Inertia::render('Teacher/Exams/Results', [
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

        return redirect()->route('teacher.exams.results', $exam)->with('success', 'Results saved successfully.');
    }
}