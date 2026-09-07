<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\ExamResult;
use App\Models\Notice;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::with('user', 'class', 'section')
            ->where('user_id', Auth::id())
            ->first();

        if (! $student) {
            return Inertia::render('Student/Dashboard', [
                'student' => null,
                'stats' => [],
                'notices' => [],
                'events' => [],
            ]);
        }

        $schoolId = Auth::user()->school_id;

        $attendances = Attendance::where('student_id', $student->id)->get();
        $total = $attendances->count();
        $present = $attendances->where('status', 'present')->count();
        $absent = $attendances->where('status', 'absent')->count();
        $late = $attendances->where('status', 'late')->count();

        $stats = [
            'attendancePercentage' => $total > 0 ? round(($present / $total) * 100, 1) : 0,
            'present' => $present,
            'absent' => $absent,
            'late' => $late,
            'totalDays' => $total,
            'examsTaken' => ExamResult::where('student_id', $student->id)->count(),
        ];

        $results = ExamResult::with('exam', 'subject')
            ->where('student_id', $student->id)
            ->get();

        $totalMarks = $results->sum('marks_obtained');
        $fullMarks = $results->sum(fn ($r) => $r->subject->full_mark ?? 0);
        $stats['averagePercentage'] = $fullMarks > 0 ? round(($totalMarks / $fullMarks) * 100, 1) : 0;

        $notices = Notice::where('school_id', $schoolId)
            ->where('active_status', true)
            ->latest()
            ->take(5)
            ->get();

        $events = Event::where('school_id', $schoolId)
            ->where('active_status', true)
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return Inertia::render('Student/Dashboard', [
            'student' => $student,
            'stats' => $stats,
            'notices' => $notices,
            'events' => $events,
        ]);
    }
}