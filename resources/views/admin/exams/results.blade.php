@extends('layouts.app')

@section('title', 'Enter Results - ' . $exam->name)

@section('content')
<div class="space-y-6">
    {{-- Exam Info --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $exam->name }}</h1>
                <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-500">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $exam->class->name ?? '-' }}
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $exam->start_date ? \Carbon\Carbon::parse($exam->start_date)->format('d M Y') : '' }} - {{ $exam->end_date ? \Carbon\Carbon::parse($exam->end_date)->format('d M Y') : '' }}
                    </span>
                    <span class="px-2 py-0.5 text-xs font-medium rounded-full
                        {{ ($exam->exam_type ?? 'midterm') === 'final' ? 'bg-red-100 text-red-700' :
                           (($exam->exam_type ?? 'midterm') === 'midterm' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ ucfirst($exam->exam_type ?? 'midterm') }}
                    </span>
                </div>
            </div>
            <a href="{{ route('exams.show', $exam) }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">&larr; Back to Exam</a>
        </div>
    </div>

    {{-- Results Entry Form --}}
    @if($subjects->isEmpty() || $students->isEmpty())
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <div class="text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="font-medium">No students or subjects found for this class.</p>
                <p class="text-sm mt-1">Add students and subjects to this class before entering results.</p>
            </div>
        </div>
    @else
        <form method="POST" action="{{ route('exams.storeResults', $exam) }}">
            @csrf
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="text-left px-5 py-3 font-semibold text-gray-600 sticky left-0 bg-gray-50">#</th>
                                <th class="text-left px-5 py-3 font-semibold text-gray-600 sticky left-10 bg-gray-50">Student Name</th>
                                <th class="text-left px-5 py-3 font-semibold text-gray-600">Roll No</th>
                                @foreach($subjects as $subject)
                                    <th class="text-center px-3 py-3 font-semibold text-gray-600 min-w-[120px]">
                                        {{ $subject->name }}
                                        <div class="text-xs font-normal text-gray-400">(Out of {{ $subject->full_mark ?? '-' }})</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-5 py-3 text-gray-500 sticky left-0 bg-white">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-3 font-medium text-gray-900 sticky left-10 bg-white">{{ $student->user->name ?? '-' }}</td>
                                    <td class="px-5 py-3 text-gray-600">{{ $student->roll_number ?? '-' }}</td>
                                    @foreach($subjects as $subject)
                                        @php
                                            $key = $student->id . '_' . $subject->id;
                                            $existing = $existingResults->has($key) ? $existingResults[$key]->marks_obtained : '';
                                        @endphp
                                        <td class="px-3 py-3 text-center">
                                            <input type="number" name="marks[{{ $key }}]"
                                                   value="{{ $existing }}"
                                                   min="0" max="{{ $subject->full_mark ?? 100 }}" step="0.5"
                                                   placeholder="0"
                                                   class="w-20 px-2 py-1.5 text-center rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                        Save All Results
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
@endsection
