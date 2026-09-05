<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        return view('admin.settings.index', compact('school'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'timezone' => 'nullable|string|max:50',
            'currency' => 'nullable|string|max:10',
            'currency_symbol' => 'nullable|string|max:5',
        ]);

        Auth::user()->school->update($validated);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}
