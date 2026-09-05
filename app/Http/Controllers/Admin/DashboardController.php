<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Event;
use App\Models\FeePayment;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;

        $stats = [
            'students' => Student::where('school_id', $schoolId)->count(),
            'teachers' => Teacher::where('school_id', $schoolId)->count(),
            'classes' => ClassModel::where('school_id', $schoolId)->count(),
            'notices' => Notice::where('school_id', $schoolId)->count(),
        ];

        // Monthly enrollment (last 6 months)
        $enrollmentData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $enrollmentData[] = Student::where('school_id', $schoolId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Fee collection by month (last 6 months)
        $feeData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $feeData[] = FeePayment::where('school_id', $schoolId)
                ->whereYear('payment_date', $date->year)
                ->whereMonth('payment_date', $date->month)
                ->sum('amount_paid');
        }

        // Attendance this week
        $attendanceData = [
            'present' => Attendance::where('school_id', $schoolId)
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', 'present')->count(),
            'absent' => Attendance::where('school_id', $schoolId)
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', 'absent')->count(),
            'late' => Attendance::where('school_id', $schoolId)
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', 'late')->count(),
        ];

        // Students by class
        $classData = ClassModel::where('school_id', $schoolId)
            ->withCount('students')
            ->get()
            ->pluck('students_count', 'name');

        $notices = Notice::where('school_id', $schoolId)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'enrollmentData', 'feeData', 'attendanceData', 'classData', 'notices'));
    }
}
