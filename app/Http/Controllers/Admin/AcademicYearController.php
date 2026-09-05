<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AcademicYearController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;
        $years = AcademicYear::where('school_id', $schoolId)->latest()->get();
        return Inertia::render('Admin/AcademicYears/Index', [
            'years' => $years,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string',
            'title' => 'required|string',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after_or_equal:starting_date',
        ]);

        AcademicYear::create([
            'school_id' => Auth::user()->school_id,
            'year' => $request->year,
            'title' => $request->title,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'active_status' => false,
            'is_default' => false,
        ]);

        return redirect()->route('academic-years.index')->with('success', 'Academic year created.');
    }

    public function activate($id)
    {
        $schoolId = Auth::user()->school_id;
        AcademicYear::where('school_id', $schoolId)->update(['is_default' => false, 'active_status' => false]);
        AcademicYear::where('id', $id)->update(['is_default' => true, 'active_status' => true]);
        return redirect()->route('academic-years.index')->with('success', 'Academic year activated.');
    }

    public function destroy($id)
    {
        AcademicYear::where('id', $id)->delete();
        return redirect()->route('academic-years.index')->with('success', 'Academic year deleted.');
    }
}
