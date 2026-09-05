<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with('sections')
            ->where('school_id', Auth::user()->school_id)
            ->latest()
            ->paginate(20);

        return Inertia::render('Admin/Classes/Index', [
            'classes' => $classes,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Classes/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_numeric' => 'required|integer|min:1',
        ]);

        ClassModel::create([
            'school_id' => Auth::user()->school_id,
            'name' => $validated['name'],
            'name_numeric' => $validated['name_numeric'],
            'active_status' => true,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function show(ClassModel $class)
    {
        $class->load('sections');
        return Inertia::render('Admin/Classes/Show', [
            'class' => $class,
        ]);
    }

    public function edit(ClassModel $class)
    {
        return Inertia::render('Admin/Classes/Edit', [
            'class' => $class,
        ]);
    }

    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_numeric' => 'required|integer|min:1',
            'active_status' => 'boolean',
        ]);

        $class->update([
            'name' => $validated['name'],
            'name_numeric' => $validated['name_numeric'],
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }
}
