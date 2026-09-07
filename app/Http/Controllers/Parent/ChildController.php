<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ExamResult;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChildController extends Controller
{
    private function child(Student $student): Student
    {
        $parent = ParentModel::where('user_id', Auth::id())->first();

        abort_if(! $parent || ! $parent->students()->whereKey($student->id)->exists(), 403);

        return $student->load('user', 'class', 'section');
    }

    public function show(Student $student)
    {
        $student = $this->child($student);

        $attendances = Attendance::where('student_id', $student->id)->get();
        $present = $attendances->where('status', 'present')->count();

        $summary = [
            'attendancePercentage' => $attendances->count() > 0
                ? round(($present / $attendances->count()) * 100, 1)
                : 0,
            'totalDays' => $attendances->count(),
            'present' => $present,
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
        ];

        $payments = FeePayment::with('feeStructure.feeCategory')
            ->where('student_id', $student->id)
            ->latest('payment_date')
            ->take(5)
            ->get();

        $results = ExamResult::with('exam', 'subject')
            ->where('student_id', $student->id)
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Parent/Children/Show', [
            'student' => $student,
            'summary' => $summary,
            'payments' => $payments,
            'results' => $results,
        ]);
    }

    public function attendance(Student $student)
    {
        $student = $this->child($student);

        $attendances = Attendance::with('class')
            ->where('student_id', $student->id)
            ->latest('date')
            ->paginate(20);

        $all = Attendance::where('student_id', $student->id)->get();
        $summary = [
            'total' => $all->count(),
            'present' => $all->where('status', 'present')->count(),
            'absent' => $all->where('status', 'absent')->count(),
            'late' => $all->where('status', 'late')->count(),
            'percentage' => $all->count() > 0
                ? round(($all->where('status', 'present')->count() / $all->count()) * 100, 1)
                : 0,
        ];

        return Inertia::render('Parent/Children/Attendance', [
            'student' => $student,
            'attendances' => $attendances,
            'summary' => $summary,
        ]);
    }

    public function results(Student $student)
    {
        $student = $this->child($student);

        $grouped = ExamResult::with('exam', 'subject')
            ->where('student_id', $student->id)
            ->get()
            ->groupBy('exam_id')
            ->map(function ($rows) {
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
            })
            ->values();

        return Inertia::render('Parent/Children/Results', [
            'student' => $student,
            'grouped' => $grouped,
        ]);
    }

    public function fees(Student $student)
    {
        $student = $this->child($student);

        $structures = FeeStructure::with('feeCategory')
            ->where('school_id', $student->school_id)
            ->where('class_id', $student->class_id)
            ->where('active_status', true)
            ->get();

        $payments = FeePayment::with('feeStructure.feeCategory')
            ->where('student_id', $student->id)
            ->latest('payment_date')
            ->get();

        $paidByStructure = $payments->groupBy('fee_structure_id')
            ->map(fn ($rows) => $rows->sum('amount_paid'));

        $structures = $structures->map(function ($structure) use ($paidByStructure) {
            $paid = (float) ($paidByStructure->get($structure->id) ?? 0);
            return [
                'id' => $structure->id,
                'category' => $structure->feeCategory->name ?? 'Fee',
                'amount' => (float) $structure->amount,
                'due_date' => $structure->due_date,
                'paid' => $paid,
                'balance' => max(0, round((float) $structure->amount - $paid, 2)),
                'status' => $paid >= (float) $structure->amount ? 'paid' : ($paid > 0 ? 'partial' : 'unpaid'),
            ];
        });

        $summary = [
            'totalDue' => $structures->sum('amount'),
            'totalPaid' => round($payments->sum('amount_paid'), 2),
            'outstanding' => $structures->sum('balance'),
        ];

        return Inertia::render('Parent/Children/Fees', [
            'student' => $student,
            'structures' => $structures,
            'payments' => $payments,
            'summary' => $summary,
        ]);
    }
}