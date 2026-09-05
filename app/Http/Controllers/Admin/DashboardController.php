<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Notice;
use App\Models\Event;
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
            'events' => Event::where('school_id', $schoolId)->count(),
            'academic_years' => AcademicYear::where('school_id', $schoolId)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
