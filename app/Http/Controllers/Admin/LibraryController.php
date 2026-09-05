<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibraryController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;
        $books = Book::where('school_id', $schoolId)->latest()->get();
        $stats = [
            'total_books' => Book::where('school_id', $schoolId)->sum('quantity'),
            'available' => Book::where('school_id', $schoolId)->sum('available_quantity'),
            'issued' => BookIssue::where('school_id', $schoolId)->where('status', 'issued')->count(),
            'overdue' => BookIssue::where('school_id', $schoolId)->where('status', 'overdue')->count(),
        ];
        $students = Student::with('user')->where('school_id', $schoolId)->get();
        return Inertia::render('Admin/Library/Index', [
            'books' => $books,
            'stats' => $stats,
            'students' => $students,
        ]);
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'nullable|string',
            'category' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'shelf_number' => 'nullable|string',
        ]);
        $data = $request->all();
        $data['school_id'] = auth()->user()->school_id;
        $data['available_quantity'] = $request->quantity;
        Book::create($data);
        return redirect()->route('library.index')->with('success', 'Book added.');
    }

    public function destroyBook($id)
    {
        Book::find($id)->delete();
        return redirect()->route('library.index')->with('success', 'Book deleted.');
    }

    public function issueBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'student_id' => 'required|exists:students,id',
            'due_date' => 'required|date',
        ]);
        $book = Book::find($request->book_id);
        if ($book->available_quantity <= 0) {
            return back()->with('error', 'No copies available.');
        }
        BookIssue::create([
            'school_id' => auth()->user()->school_id,
            'book_id' => $request->book_id,
            'student_id' => $request->student_id,
            'issue_date' => now()->toDateString(),
            'due_date' => $request->due_date,
            'status' => 'issued',
        ]);
        $book->decrement('available_quantity');
        return redirect()->route('library.index')->with('success', 'Book issued.');
    }

    public function returnBook($id)
    {
        $issue = BookIssue::find($id);
        $issue->update(['return_date' => now()->toDateString(), 'status' => 'returned']);
        $issue->book->increment('available_quantity');

        if (now()->toDateString() > $issue->due_date) {
            $days = now()->diffInDays($issue->due_date);
            $issue->update(['fine' => $days * 1]);
        }

        return redirect()->route('library.index')->with('success', 'Book returned.');
    }

    public function issues()
    {
        $schoolId = auth()->user()->school_id;
        $issues = BookIssue::where('school_id', $schoolId)->with('book', 'student.user')->latest()->get();
        return Inertia::render('Admin/Library/Issues', [
            'issues' => $issues,
        ]);
    }
}
