<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FeeController extends Controller
{
    public function index()
    {
        $student = Student::with('class')->where('user_id', Auth::id())->first();

        if (! $student) {
            return Inertia::render('Student/Fees/Index', [
                'structures' => [],
                'payments' => [],
                'summary' => [],
            ]);
        }

        $structures = FeeStructure::with('feeCategory')
            ->where('school_id', Auth::user()->school_id)
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

        return Inertia::render('Student/Fees/Index', [
            'structures' => $structures,
            'payments' => $payments,
            'summary' => $summary,
        ]);
    }
}