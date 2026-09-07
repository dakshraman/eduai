<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::id())->first();

        if (! $student) {
            return Inertia::render('Student/Attendance/Index', [
                'attendances' => [],
                'summary' => [],
            ]);
        }

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
            'half_day' => $all->where('status', 'half_day')->count(),
            'percentage' => $all->count() > 0
                ? round(($all->where('status', 'present')->count() / $all->count()) * 100, 1)
                : 0,
        ];

        return Inertia::render('Student/Attendance/Index', [
            'attendances' => $attendances,
            'summary' => $summary,
        ]);
    }
}