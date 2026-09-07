<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $parent = ParentModel::with('students.user', 'students.class', 'students.section')
            ->where('user_id', Auth::id())
            ->first();

        if (! $parent) {
            return Inertia::render('Parent/Dashboard', [
                'parent' => null,
                'children' => [],
            ]);
        }

        $children = $parent->students->map(function (Student $student) {
            $attendances = Attendance::where('student_id', $student->id)->get();
            $present = $attendances->where('status', 'present')->count();

            return [
                'id' => $student->id,
                'name' => $student->user->name ?? 'Student',
                'admission_number' => $student->admission_number,
                'roll_number' => $student->roll_number,
                'class' => $student->class->name ?? null,
                'section' => $student->section->name ?? null,
                'attendancePercentage' => $attendances->count() > 0
                    ? round(($present / $attendances->count()) * 100, 1)
                    : 0,
            ];
        });

        return Inertia::render('Parent/Dashboard', [
            'parent' => $parent,
            'children' => $children,
        ]);
    }
}