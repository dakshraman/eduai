<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('creator')
            ->where('school_id', Auth::user()->school_id)
            ->latest()
            ->paginate(20);

        return Inertia::render('Admin/Notices/Index', [
            'notices' => $notices,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Notices/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'notice_type' => 'required|in:general,exam,event,holiday',
            'published_at' => 'nullable|date',
        ]);

        Notice::create([
            'school_id' => Auth::user()->school_id,
            'title' => $validated['title'],
            'message' => $validated['message'],
            'notice_type' => $validated['notice_type'],
            'published_at' => $validated['published_at'] ?? now(),
            'created_by' => Auth::id(),
            'active_status' => true,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully.');
    }

    public function show(Notice $notice)
    {
        $notice->load('creator');
        return Inertia::render('Admin/Notices/Show', [
            'notice' => $notice,
        ]);
    }

    public function edit(Notice $notice)
    {
        return Inertia::render('Admin/Notices/Edit', [
            'notice' => $notice,
        ]);
    }

    public function update(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'notice_type' => 'required|in:general,exam,event,holiday',
            'published_at' => 'nullable|date',
            'active_status' => 'boolean',
        ]);

        $notice->update([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'notice_type' => $validated['notice_type'],
            'published_at' => $validated['published_at'] ?? $notice->published_at,
            'active_status' => $validated['active_status'] ?? true,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}
