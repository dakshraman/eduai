<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function results()
    {
        $student = Student::where('user_id', Auth::id())->first();

        if (! $student) {
            return Inertia::render('Student/Results/Index', [
                'grouped' => collect(),
                'overall' => [],
            ]);
        }

        $results = ExamResult::with('exam', 'subject')
            ->where('student_id', $student->id)
            ->get();

        $grouped = $results->groupBy('exam_id')->map(function ($rows) {
            $exam = $rows->first()->exam;
            $total = $rows->sum('marks_obtained');
            $fullMark = $rows->sum(fn ($r) => $r->subject->full_mark ?? 0);

            return [
                'exam' => $exam,
                'results' => $rows,
                'total' => round($total, 2),
                'fullMark' => round($fullMark, 2),
                'percentage' => $fullMark > 0 ? round(($total / $fullMark) * 100, 1) : 0,
            ];
        })->values();

        $totalMarks = $results->sum('marks_obtained');
        $fullMarks = $results->sum(fn ($r) => $r->subject->full_mark ?? 0);

        $overall = [
            'total' => round($totalMarks, 2),
            'fullMark' => round($fullMarks, 2),
            'percentage' => $fullMarks > 0 ? round(($totalMarks / $fullMarks) * 100, 1) : 0,
        ];

        return Inertia::render('Student/Results/Index', [
            'grouped' => $grouped,
            'overall' => $overall,
        ]);
    }
}