<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classes = ClassModel::where('school_id', Auth::user()->school_id)->get();
        $students = collect();
        $date = $request->date ?? now()->toDateString();
        $classId = $request->class_id;

        if ($classId) {
            $students = Student::with('user')
                ->where('school_id', Auth::user()->school_id)
                ->where('class_id', $classId)
                ->get();
        }

        return view('admin.attendance.index', compact('classes', 'students', 'date', 'classId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|in:present,absent,late,half_day',
            'attendance.*.remark' => 'nullable|string|max:255',
        ]);

        $schoolId = Auth::user()->school_id;

        foreach ($validated['attendance'] as $item) {
            Attendance::updateOrCreate(
                [
                    'school_id' => $schoolId,
                    'student_id' => $item['student_id'],
                    'date' => $validated['date'],
                ],
                [
                    'class_id' => $validated['class_id'],
                    'section_id' => $validated['section_id'] ?? null,
                    'status' => $item['status'],
                    'remark' => $item['remark'] ?? null,
                ]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance saved successfully.');
    }

    public function report(Request $request)
    {
        $schoolId = Auth::user()->school_id;
        $classes = ClassModel::where('school_id', $schoolId)->get();
        $classId = $request->class_id;
        $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? now()->toDateString();

        $query = Attendance::where('school_id', $schoolId)
            ->whereBetween('date', [$startDate, $endDate]);

        if ($classId) {
            $query->where('class_id', $classId);
        }

        $attendances = $query->with('student.user', 'class')->get();

        $summary = [
            'total' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'late' => $attendances->where('status', 'late')->count(),
            'half_day' => $attendances->where('status', 'half_day')->count(),
        ];

        $studentSummary = $attendances->groupBy('student_id')->map(function ($records) {
            $student = $records->first()->student;
            $total = $records->count();
            return [
                'student' => $student,
                'present' => $records->where('status', 'present')->count(),
                'absent' => $records->where('status', 'absent')->count(),
                'late' => $records->where('status', 'late')->count(),
                'total' => $total,
                'percentage' => $total > 0
                    ? round(($records->where('status', 'present')->count() / $total) * 100, 1)
                    : 0,
            ];
        });

        return view('admin.attendance.report', compact('classes', 'attendances', 'summary', 'studentSummary', 'classId', 'startDate', 'endDate'));
    }
}
