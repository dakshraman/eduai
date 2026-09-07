<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;
        $teacher = Teacher::where('user_id', Auth::id())->first();

        $stats = [
            'classes' => ClassModel::where('school_id', $schoolId)->count(),
            'students' => Student::where('school_id', $schoolId)->count(),
            'exams' => Exam::where('school_id', $schoolId)->count(),
            'todayAttendance' => Attendance::where('school_id', $schoolId)
                ->whereDate('date', now()->toDateString())
                ->count(),
        ];

        $classes = ClassModel::where('school_id', $schoolId)->get();
        $upcomingExams = Exam::with('class')
            ->where('school_id', $schoolId)
            ->where('end_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->take(5)
            ->get();
        $notices = Notice::where('school_id', $schoolId)
            ->where('active_status', true)
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('Teacher/Dashboard', [
            'stats' => $stats,
            'teacher' => $teacher,
            'classes' => $classes,
            'upcomingExams' => $upcomingExams,
            'notices' => $notices,
        ]);
    }
}