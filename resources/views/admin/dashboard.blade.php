@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="bg-gradient-to-r from-[#CDC1FF] to-[#BFECFF] rounded-3xl p-6 text-[#1e293b]">
        <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</h1>
        <p class="text-[#1e293b]/60 text-sm mt-1">Here's what's happening at your school today.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: #BFECFF30;">
                    <svg class="w-6 h-6 text-[#1e293b]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900" data-counter="{{ $stats['students'] ?? 0 }}">0</p>
                    <p class="text-sm text-gray-400">Total Students</p>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: #CDC1FF30;">
                    <svg class="w-6 h-6 text-[#1e293b]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900" data-counter="{{ $stats['teachers'] ?? 0 }}">0</p>
                    <p class="text-sm text-gray-400">Total Teachers</p>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.3s;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: #FFF6E399;">
                    <svg class="w-6 h-6 text-[#1e293b]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25a2.25 2.25 0 01-2.25-2.25v-2.25z"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900" data-counter="{{ $stats['classes'] ?? 0 }}">0</p>
                    <p class="text-sm text-gray-400">Total Classes</p>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: #FFCCEA40;">
                    <svg class="w-6 h-6 text-[#1e293b]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900" data-counter="{{ $stats['notices'] ?? 0 }}">0</p>
                    <p class="text-sm text-gray-400">Total Notices</p>
                </div>
            </div>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.5s;">
            <x-ui.card-header class="p-0 pb-4">
                <x-ui.card-title>Enrollment Trend</x-ui.card-title>
            </x-ui.card-header>
            <div class="relative" style="height: 280px;">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.6s;">
            <x-ui.card-header class="p-0 pb-4">
                <x-ui.card-title>Fee Collection</x-ui.card-title>
            </x-ui.card-header>
            <div class="relative" style="height: 280px;">
                <canvas id="feeChart"></canvas>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.7s;">
            <x-ui.card-header class="p-0 pb-4">
                <x-ui.card-title>Attendance Overview (This Week)</x-ui.card-title>
            </x-ui.card-header>
            <div class="relative" style="height: 280px;">
                <canvas id="attendanceChart"></canvas>
            </div>
        </x-ui.card>

        <x-ui.card class="p-5 animate-fade-in-up" style="animation-delay: 0.8s;">
            <x-ui.card-header class="p-0 pb-4">
                <x-ui.card-title>Students by Class</x-ui.card-title>
            </x-ui.card-header>
            <div class="relative" style="height: 280px;">
                <canvas id="classChart"></canvas>
            </div>
        </x-ui.card>
    </div>

    <x-ui.card class="animate-fade-in-up" style="animation-delay: 0.9s;">
        <x-ui.card-header class="flex flex-row items-center justify-between">
            <div>
                <x-ui.card-title>Recent Notices</x-ui.card-title>
            </div>
            <x-ui.button variant="ghost" size="sm" href="{{ route('notices.index') }}">View All</x-ui.button>
        </x-ui.card-header>
        <x-ui.card-content class="p-0">
            @forelse($notices as $notice)
                <div class="px-6 py-4 flex items-center justify-between border-b border-gray-50 last:border-0 table-row-hover">
                    <div class="flex items-center gap-3">
                        <x-ui.badge variant="{{ $notice->type === 'urgent' ? 'destructive' : ($notice->type === 'important' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($notice->type) }}
                        </x-ui.badge>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $notice->title }}</p>
                            <p class="text-xs text-gray-400">{{ $notice->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-gray-400">No notices yet.</div>
            @endforelse
        </x-ui.card-content>
    </x-ui.card>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const monthLabels = @json(collect(range(5, 0))->map(fn($i) => now()->subMonths($i)->format('M'))->values()->toArray());
    const chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 1500, easing: 'easeOutQuart' }
    };

    new Chart(document.getElementById('enrollmentChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Enrollments',
                data: @json($enrollmentData),
                borderColor: '#BFECFF',
                backgroundColor: 'rgba(191,236,255,0.2)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#CDC1FF',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
            }]
        },
        options: { ...chartDefaults, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });

    new Chart(document.getElementById('feeChart'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Collection',
                data: @json($feeData),
                backgroundColor: '#CDC1FF',
                borderRadius: 8,
                maxBarThickness: 40,
            }]
        },
        options: { ...chartDefaults, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { callback: function(v) { return '₦' + v.toLocaleString(); } } } } }
    });

    new Chart(document.getElementById('attendanceChart'), {
        type: 'doughnut',
        data: {
            labels: ['Present', 'Absent', 'Late'],
            datasets: [{
                data: [{{ $attendanceData['present'] }}, {{ $attendanceData['absent'] }}, {{ $attendanceData['late'] }}],
                backgroundColor: ['#CDC1FF', '#FFCCEA', '#FFF6E3'],
                borderWidth: 0,
                cutout: '65%',
            }]
        },
        options: { ...chartDefaults, plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true } } } }
    });

    const classNames = @json($classData->keys()->toArray());
    const classCounts = @json($classData->values()->toArray());
    new Chart(document.getElementById('classChart'), {
        type: 'bar',
        data: {
            labels: classNames,
            datasets: [{
                label: 'Students',
                data: classCounts,
                backgroundColor: '#BFECFF',
                borderRadius: 8,
                maxBarThickness: 36,
            }]
        },
        options: { ...chartDefaults, indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });
});
</script>
@endpush
@endsection
