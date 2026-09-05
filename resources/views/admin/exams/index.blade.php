@extends('layouts.app')

@section('title', 'Exams')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl animate-fade-in-up font-bold text-gray-900">Exams</h1>
        <a href="{{ route('exams.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold btn-ripple rounded-xl transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Exam
        </a>
    </div>

    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Class</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Start Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">End Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Type</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($exams ?? [] as $exam)
                        <tr class="table-row-hover">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $exam->name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $exam->class->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $exam->start_date ? \Carbon\Carbon::parse($exam->start_date)->format('M d, Y') : '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $exam->end_date ? \Carbon\Carbon::parse($exam->end_date)->format('M d, Y') : '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full
                                    {{ ($exam->exam_type ?? 'midterm') === 'final' ? 'bg-red-100 text-red-700' :
                                       (($exam->exam_type ?? 'midterm') === 'midterm' ? 'bg-amber-100 text-amber-700' : 'bg-blue-100 text-blue-700') }}">
                                    {{ ucfirst($exam->exam_type ?? 'midterm') }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <a href="{{ route('exams.results', $exam) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#CDC1FF] hover:text-[#b5a8e8] hover:bg-[#BFECFF]/20 btn-ripple rounded-xl transition">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Results
                                </a>
                                <form method="POST" action="{{ route('exams.destroy', $exam) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No exams found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
