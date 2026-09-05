@extends('layouts.app')

@section('title', 'Library')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Library Management</h1>
        <a href="{{ route('library.issues') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
            View Issues
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="text-sm font-medium text-gray-500">Total Books</div>
            <div class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['total_books'] }}</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="text-sm font-medium text-gray-500">Available</div>
            <div class="mt-1 text-3xl font-bold text-green-600">{{ $stats['available'] }}</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="text-sm font-medium text-gray-500">Issued</div>
            <div class="mt-1 text-3xl font-bold text-blue-600">{{ $stats['issued'] }}</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <div class="text-sm font-medium text-gray-500">Overdue</div>
            <div class="mt-1 text-3xl font-bold text-red-600">{{ $stats['overdue'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Books Table --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Books</h2>
                <button @click="showAddBook = true" class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Book
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold text-gray-600">Title</th>
                            <th class="text-left px-5 py-3 font-semibold text-gray-600">Author</th>
                            <th class="text-left px-5 py-3 font-semibold text-gray-600">ISBN</th>
                            <th class="text-left px-5 py-3 font-semibold text-gray-600">Category</th>
                            <th class="text-center px-5 py-3 font-semibold text-gray-600">Qty</th>
                            <th class="text-center px-5 py-3 font-semibold text-gray-600">Avail</th>
                            <th class="text-left px-5 py-3 font-semibold text-gray-600">Shelf</th>
                            <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-900">{{ $book->title }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $book->author }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $book->isbn ?? '-' }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $book->category ?? '-' }}</td>
                                <td class="px-5 py-3 text-center text-gray-600">{{ $book->quantity }}</td>
                                <td class="px-5 py-3 text-center">
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $book->available_quantity > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $book->available_quantity }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-gray-600">{{ $book->shelf_number ?? '-' }}</td>
                                <td class="px-5 py-3 text-right">
                                    <form method="POST" action="{{ route('library.destroyBook', $book) }}" onsubmit="return confirm('Delete this book?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-12 text-center text-gray-400">No books found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Issue Book Form --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6 h-fit" x-data="{ open: true }">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-4">Issue Book</h2>
            <form method="POST" action="{{ route('library.issueBook') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Book *</label>
                    <select name="book_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <option value="">Choose a book</option>
                        @foreach($books->filter(fn($b) => $b->available_quantity > 0) as $book)
                            <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->available_quantity }} available)</option>
                        @endforeach
                    </select>
                    @error('book_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student *</label>
                    <select name="student_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        <option value="">Choose a student</option>
                        @php
                            $students = \App\Models\Student::where('school_id', auth()->user()->school_id)->with('user')->get();
                        @endphp
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->user->name ?? 'N/A' }} ({{ $student->admission_number }})</option>
                        @endforeach
                    </select>
                    @error('student_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date *</label>
                    <input type="date" name="due_date" required min="{{ now()->toDateString() }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    @error('due_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                    Issue Book
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Add Book Modal --}}
<div x-data="{ showAddBook: false }" x-on:show-add-book.window="showAddBook = true">
    <template x-teleport="body">
        <div x-show="showAddBook" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div @click.away="showAddBook = false" x-show="showAddBook"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Add New Book</h3>
                    <button @click="showAddBook = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('library.storeBook') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                            <input type="text" name="title" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Author *</label>
                            <input type="text" name="author" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ISBN</label>
                            <input type="text" name="isbn" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <input type="text" name="category" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                            <input type="number" name="quantity" value="1" min="1" required class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Shelf Number</label>
                            <input type="text" name="shelf_number" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showAddBook = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.effect(() => {
        const hash = window.location.hash;
        if (hash === '#add-book') {
            window.dispatchEvent(new CustomEvent('show-add-book'));
        }
    });
});
</script>
@endpush
@endsection
