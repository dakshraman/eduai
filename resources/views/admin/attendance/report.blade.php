@extends('layouts.app')

@section('title', 'Attendance Report')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Attendance Report</h1>
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export CSV
        </button>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-gray-200 p-4">
        <form method="GET" class="flex flex-col sm:flex-row gap-3 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                <select name="class_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
            </div>
            <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                Search
            </button>
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
        @php
            $total = $summary['total'];
            $pct = fn($count) => $total > 0 ? round(($count / $total) * 100, 1) : 0;
        @endphp
        <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
            <div class="text-2xl font-bold text-gray-900">{{ $total }}</div>
            <div class="text-xs font-medium text-gray-500 mt-1">Total Records</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $summary['present'] }}</div>
            <div class="text-xs font-medium text-gray-500 mt-1">Present ({{ $pct($summary['present']) }}%)</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
            <div class="text-2xl font-bold text-red-600">{{ $summary['absent'] }}</div>
            <div class="text-xs font-medium text-gray-500 mt-1">Absent ({{ $pct($summary['absent']) }}%)</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
            <div class="text-2xl font-bold text-amber-600">{{ $summary['late'] }}</div>
            <div class="text-xs font-medium text-gray-500 mt-1">Late ({{ $pct($summary['late']) }}%)</div>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
            <div class="text-2xl font-bold text-orange-600">{{ $summary['half_day'] }}</div>
            <div class="text-xs font-medium text-gray-500 mt-1">Half Day ({{ $pct($summary['half_day']) }}%)</div>
        </div>
    </div>

    {{-- Student-wise Summary --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Student-wise Summary</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Student Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Present</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Absent</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Late</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Total</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Percentage</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($studentSummary as $sid => $record)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $record['student']->user->name ?? '-' }}</td>
                            <td class="px-5 py-3 text-green-600 font-medium">{{ $record['present'] }}</td>
                            <td class="px-5 py-3 text-red-600 font-medium">{{ $record['absent'] }}</td>
                            <td class="px-5 py-3 text-amber-600 font-medium">{{ $record['late'] }}</td>
                            <td class="px-5 py-3 text-gray-900 font-medium">{{ $record['total'] }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 max-w-[100px]">
                                        <div class="h-2 rounded-full {{ $record['percentage'] >= 75 ? 'bg-green-500' : ($record['percentage'] >= 50 ? 'bg-amber-500' : 'bg-red-500') }}"
                                             style="width: {{ $record['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold {{ $record['percentage'] >= 75 ? 'text-green-600' : ($record['percentage'] >= 50 ? 'text-amber-600' : 'text-red-600') }}">
                                        {{ $record['percentage'] }}%
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No attendance data found. Select a class and date range to view the report.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
