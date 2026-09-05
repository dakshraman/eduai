@extends('layouts.app')

@section('title', 'Results - ' . ($student->user->name ?? 'Student'))

@section('content')
<div class="space-y-6">
    {{-- Student Info --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr($student->user->name ?? 'S', 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $student->user->name ?? '-' }}</h1>
                    <div class="flex flex-wrap gap-3 mt-1 text-sm text-gray-500">
                        <span>Admission: {{ $student->admission_number ?? '-' }}</span>
                        <span class="text-gray-300">|</span>
                        <span>Class: {{ $student->class->name ?? '-' }}</span>
                        <span class="text-gray-300">|</span>
                        <span>Roll: {{ $student->roll_number ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Overall Summary --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex flex-col sm:flex-row sm:items-center gap-6">
            <div class="flex-1 text-center">
                <div class="text-3xl font-bold text-gray-900">{{ $overallFullMark }}</div>
                <div class="text-xs font-medium text-gray-500 mt-1">Total Full Marks</div>
            </div>
            <div class="w-px h-12 bg-gray-200 hidden sm:block"></div>
            <div class="flex-1 text-center">
                <div class="text-3xl font-bold text-indigo-600">{{ $overallTotal }}</div>
                <div class="text-xs font-medium text-gray-500 mt-1">Marks Obtained</div>
            </div>
            <div class="w-px h-12 bg-gray-200 hidden sm:block"></div>
            <div class="flex-1 text-center">
                @php
                    $grade = $overallPercentage >= 90 ? 'A+' :
                             ($overallPercentage >= 80 ? 'A' :
                             ($overallPercentage >= 70 ? 'B+' :
                             ($overallPercentage >= 60 ? 'B' :
                             ($overallPercentage >= 50 ? 'C' :
                             ($overallPercentage >= 40 ? 'D' : 'F')))));
                @endphp
                <div class="text-3xl font-bold {{ $overallPercentage >= 50 ? 'text-green-600' : 'text-red-600' }}">{{ $overallPercentage }}%</div>
                <div class="text-xs font-medium text-gray-500 mt-1">Overall | Grade: {{ $grade }}</div>
            </div>
        </div>
    </div>

    {{-- Results Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Exam Results</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Exam Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Subject</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Marks Obtained</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Full Mark</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Percentage</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Grade</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($results as $result)
                        @php
                            $fullMark = $result->subject->full_mark ?? 100;
                            $pct = $fullMark > 0 ? round(($result->marks_obtained / $fullMark) * 100, 1) : 0;
                            $grade = $pct >= 90 ? 'A+' :
                                     ($pct >= 80 ? 'A' :
                                     ($pct >= 70 ? 'B+' :
                                     ($pct >= 60 ? 'B' :
                                     ($pct >= 50 ? 'C' :
                                     ($pct >= 40 ? 'D' : 'F')))));
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $result->exam->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $result->subject->name ?? '-' }}</td>
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $result->marks_obtained }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $fullMark }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-[80px]">
                                        <div class="h-2 rounded-full {{ $pct >= 50 ? 'bg-green-500' : 'bg-red-500' }}" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold {{ $pct >= 50 ? 'text-green-600' : 'text-red-600' }}">{{ $pct }}%</span>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full
                                    {{ $pct >= 60 ? 'bg-green-100 text-green-700' :
                                       ($pct >= 40 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $grade }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No exam results found for this student.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
