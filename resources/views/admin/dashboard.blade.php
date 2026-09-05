@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</h1>
        <p class="text-gray-500 text-sm mt-1">Here's what's happening at your school today.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['students'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Students</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['teachers'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Teachers</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['classes'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Classes</p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-rose-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['notices'] ?? 0 }}</p>
                <p class="text-sm text-gray-500">Total Notices</p>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Enrollment Trend --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Enrollment Trend</h2>
            <div class="relative" style="height: 280px;">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>

        {{-- Fee Collection --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Fee Collection</h2>
            <div class="relative" style="height: 280px;">
                <canvas id="feeChart"></canvas>
            </div>
        </div>

        {{-- Attendance Overview --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Attendance Overview (This Week)</h2>
            <div class="relative" style="height: 280px;">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        {{-- Students by Class --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Students by Class</h2>
            <div class="relative" style="height: 280px;">
                <canvas id="classChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Notices --}}
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Recent Notices</h2>
            <a href="{{ route('notices.index') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($notices as $notice)
                <div class="px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full
                            {{ $notice->type === 'urgent' ? 'bg-red-100 text-red-700' : ($notice->type === 'important' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                            {{ ucfirst($notice->type) }}
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $notice->title }}</p>
                            <p class="text-xs text-gray-500">{{ $notice->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-5 py-8 text-center text-sm text-gray-400">No notices yet.</div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Month labels (last 6 months)
    const monthLabels = @json(collect(range(5, 0))->map(fn($i) => now()->subMonths($i)->format('M'))->values()->toArray());

    // Enrollment Trend (Line Chart)
    new Chart(document.getElementById('enrollmentChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Enrollments',
                data: @json($enrollmentData),
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79,70,229,0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4F46E5',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Fee Collection (Bar Chart)
    new Chart(document.getElementById('feeChart'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Collection',
                data: @json($feeData),
                backgroundColor: '#22C55E',
                borderRadius: 6,
                maxBarThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: function(v) { return '₦' + v.toLocaleString(); } } }
            }
        }
    });

    // Attendance Overview (Doughnut Chart)
    new Chart(document.getElementById('attendanceChart'), {
        type: 'doughnut',
        data: {
            labels: ['Present', 'Absent', 'Late'],
            datasets: [{
                data: [{{ $attendanceData['present'] }}, {{ $attendanceData['absent'] }}, {{ $attendanceData['late'] }}],
                backgroundColor: ['#22C55E', '#EF4444', '#EAB308'],
                borderWidth: 0,
                cutout: '65%',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } }
            }
        }
    });

    // Students by Class (Horizontal Bar Chart)
    const classNames = @json($classData->keys()->toArray());
    const classCounts = @json($classData->values()->toArray());
    new Chart(document.getElementById('classChart'), {
        type: 'bar',
        data: {
            labels: classNames,
            datasets: [{
                label: 'Students',
                data: classCounts,
                backgroundColor: '#6366F1',
                borderRadius: 6,
                maxBarThickness: 36,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
});
</script>
@endpush
@endsection
