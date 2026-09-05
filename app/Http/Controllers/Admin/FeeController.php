<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\FeeCategory;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    public function categories()
    {
        $categories = FeeCategory::where('school_id', Auth::user()->school_id)->latest()->paginate(20);
        return view('admin.fees.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        FeeCategory::create([
            'school_id' => Auth::user()->school_id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'active_status' => true,
        ]);

        return redirect()->route('fees.categories')->with('success', 'Fee category created successfully.');
    }

    public function structures(Request $request)
    {
        $query = FeeStructure::with(['class', 'feeCategory'])
            ->where('school_id', Auth::user()->school_id);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $structures = $query->latest()->paginate(20);
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        $categories = FeeCategory::where('school_id', Auth::user()->school_id)->get();

        return view('admin.fees.structures', compact('structures', 'classes', 'categories'));
    }

    public function storeStructure(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'fee_category_id' => 'required|exists:fee_categories,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'nullable|date',
        ]);

        FeeStructure::create([
            'school_id' => Auth::user()->school_id,
            'class_id' => $validated['class_id'],
            'fee_category_id' => $validated['fee_category_id'],
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'] ?? null,
            'active_status' => true,
        ]);

        return redirect()->route('fees.structures')->with('success', 'Fee structure created successfully.');
    }

    public function payments(Request $request)
    {
        $query = FeePayment::with(['student.user', 'feeStructure.feeCategory'])
            ->where('school_id', Auth::user()->school_id);

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        $payments = $query->latest()->paginate(20);
        $students = Student::with('user')
            ->where('school_id', Auth::user()->school_id)
            ->get();

        return view('admin.fees.payments', compact('payments', 'students'));
    }

    public function recordPayment(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_structure_id' => 'required|exists:fee_structures,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,bank,online,cheque',
            'payment_date' => 'required|date',
            'transaction_id' => 'nullable|string|max:255',
            'receipt_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
        ]);

        FeePayment::create([
            'school_id' => Auth::user()->school_id,
            'student_id' => $validated['student_id'],
            'fee_structure_id' => $validated['fee_structure_id'],
            'amount_paid' => $validated['amount_paid'],
            'payment_method' => $validated['payment_method'],
            'payment_date' => $validated['payment_date'],
            'transaction_id' => $validated['transaction_id'] ?? null,
            'receipt_number' => $validated['receipt_number'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('fees.payments')->with('success', 'Payment recorded successfully.');
    }

    public function receipt(FeePayment $payment)
    {
        $payment->load(['student.user', 'student.class', 'feeStructure.feeCategory', 'school']);
        $school = $payment->school ?? School::find(Auth::user()->school_id);

        return view('admin.fees.receipt', compact('payment', 'school'));
    }
}
