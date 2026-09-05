@extends('layouts.app')

@section('title', 'Library Issues')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('library.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Book Issues</h1>
        </div>
        <a href="{{ route('library.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Issue New Book
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Book Title</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Student</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Issue Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Due Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Return Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Fine</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($issues as $issue)
                        <tr class="hover:bg-[#FFF6E3] transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $issue->book->title ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $issue->student->user->name ?? 'N/A' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $issue->issue_date?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $issue->due_date?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $issue->return_date?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $statusClasses = match($issue->status) {
                                        'issued' => 'bg-blue-100 text-blue-700',
                                        'returned' => 'bg-green-100 text-green-700',
                                        'overdue' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $statusClasses }}">
                                    {{ ucfirst($issue->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                @if($issue->fine > 0)
                                    <span class="text-red-600 font-medium">${{ number_format($issue->fine, 2) }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right">
                                @if($issue->status !== 'returned')
                                    <form method="POST" action="{{ route('library.returnBook', $issue) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-semibold rounded-lg transition">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Return
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-xs">Returned</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center text-gray-400">No book issues found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
