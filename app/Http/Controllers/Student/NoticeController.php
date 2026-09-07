<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;

        $notices = Notice::with('creator')
            ->where('school_id', $schoolId)
            ->where('active_status', true)
            ->latest()
            ->paginate(15);

        $events = Event::where('school_id', $schoolId)
            ->where('active_status', true)
            ->where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->get();

        return Inertia::render('Student/Notices/Index', [
            'notices' => $notices,
            'events' => $events,
        ]);
    }
}