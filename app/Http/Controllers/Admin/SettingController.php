<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $school = School::find(auth()->user()->school_id);
        return view('admin.settings.index', compact('school'));
    }

    public function update(Request $request)
    {
        $school = School::find(auth()->user()->school_id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'website' => 'nullable|url',
            'timezone' => 'nullable|string',
            'currency' => 'nullable|string',
            'currency_symbol' => 'nullable|string',
            'academic_week_start' => 'nullable|in:monday,sunday',
            'date_format' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        $school->update($data);
        return redirect()->route('settings.index')->with('success', 'Settings updated.');
    }
}
