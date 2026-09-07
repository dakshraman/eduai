<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $schoolId = Auth::user()->school_id;
        $classes = ClassModel::where('school_id', $schoolId)->get();
        $students = collect();
        $date = $request->date ?? now()->toDateString();
        $classId = $request->class_id;

        if ($classId) {
            $students = Student::with('user', 'section')
                ->where('school_id', $schoolId)
                ->where('class_id', $classId)
                ->get();
        }

        $existing = Attendance::where('school_id', $schoolId)
            ->where('date', $date)
            ->whereIn('student_id', $students->pluck('id'))
            ->get()
            ->keyBy('student_id');

        $attendanceData = $existing->map(function ($att) {
            return [
                'status' => $att->status,
                'remark' => $att->remark,
            ];
        });

        return Inertia::render('Teacher/Attendance/Index', [
            'classes' => $classes,
            'students' => $students,
            'date' => $date,
            'classId' => $classId,
            'attendanceData' => $attendanceData,
        ]);
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

        return redirect()->route('teacher.attendance.index', [
            'class_id' => $validated['class_id'],
            'date' => $validated['date'],
        ])->with('success', 'Attendance saved successfully.');
    }
}