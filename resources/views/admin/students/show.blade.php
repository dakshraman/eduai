@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
<div class="space-y-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight">Student Profile</h1>
            <p class="text-muted-foreground">View student details and records</p>
        </div>
        <div class="flex items-center gap-2">
            <x-ui.button variant="outline" href="{{ route('students.edit', $student->id) }}">Edit</x-ui.button>
            <x-ui.button variant="outline" href="{{ route('students.index') }}">Back</x-ui.button>
        </div>
    </div>

    <x-ui.card>
        <x-ui.card-content class="p-6">
            <div class="flex items-center gap-6">
                <x-ui.avatar size="xl" :src="$student->avatar ? asset('storage/'.$student->avatar) : null" :alt="$student->name" />
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $student->name }}</h2>
                    <p class="text-muted-foreground">{{ $student->class->name ?? '-' }} - {{ $student->section ?? 'N/A' }}</p>
                    <div class="flex items-center gap-4 mt-2">
                        <x-ui.badge variant="info">Admission #{{ $student->admission_number }}</x-ui.badge>
                        <x-ui.badge variant="{{ $student->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($student->status) }}</x-ui.badge>
                    </div>
                </div>
            </div>
        </x-ui.card-content>
    </x-ui.card>

    <x-ui.tabs default="personal">
        <div class="border-b border-gray-200">
            <x-ui.tab value="personal" label="Personal Info" />
            <x-ui.tab value="attendance" label="Attendance" />
            <x-ui.tab value="fees" label="Fees" />
            <x-ui.tab value="exams" label="Exams" />
        </div>

        <x-ui.tab-content value="personal">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Personal Information</x-ui.card-title>
                </x-ui.card-header>
                <x-ui.card-content>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div><p class="text-sm text-gray-500">Email</p><p class="font-medium">{{ $student->email }}</p></div>
                        <div><p class="text-sm text-gray-500">Phone</p><p class="font-medium">{{ $student->phone ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Gender</p><p class="font-medium">{{ ucfirst($student->gender ?? '-') }}</p></div>
                        <div><p class="text-sm text-gray-500">Date of Birth</p><p class="font-medium">{{ $student->dob?->format('M d, Y') ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Blood Group</p><p class="font-medium">{{ $student->blood_group ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Religion</p><p class="font-medium">{{ $student->religion ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Roll Number</p><p class="font-medium">{{ $student->roll_number ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Admission Date</p><p class="font-medium">{{ $student->admission_date?->format('M d, Y') ?? '-' }}</p></div>
                        <div><p class="text-sm text-gray-500">Session Year</p><p class="font-medium">{{ $student->session_year ?? '-' }}</p></div>
                    </div>
                </x-ui.card-content>
            </x-ui.card>
        </x-ui.tab-content>

        <x-ui.tab-content value="attendance">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Attendance Records</x-ui-card-title>
                </x-ui.card-header>
                <x-ui.card-content class="p-0">
                    <x-ui.table>
                        <x-ui.table-header>
                            <x-ui.table-row>
                                <x-ui.table-head>Date</x-ui.table-head>
                                <x-ui.table-head>Status</x-ui.table-head>
                            </x-ui.table-row>
                        </x-ui.table-header>
                        <x-ui.table-body>
                            @forelse($student->attendance ?? [] as $record)
                                <x-ui.table-row>
                                    <x-ui.table-cell>{{ $record->date->format('M d, Y') }}</x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <x-ui.badge variant="{{ $record->status === 'present' ? 'success' : ($record->status === 'absent' ? 'destructive' : 'warning') }}">
                                            {{ ucfirst($record->status) }}
                                        </x-ui.badge>
                                    </x-ui.table-cell>
                                </x-ui.table-row>
                            @empty
                                <x-ui.table-row>
                                    <x-ui.table-cell colspan="2" class="text-center py-8 text-muted-foreground">No attendance records found.</x-ui.table-cell>
                                </x-ui.table-row>
                            @endforelse
                        </x-ui.table-body>
                    </x-ui.table>
                </x-ui.card-content>
            </x-ui.card>
        </x-ui.tab-content>

        <x-ui.tab-content value="fees">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Fee Records</x-ui.card-title>
                </x-ui.card-header>
                <x-ui.card-content class="p-0">
                    <x-ui.table>
                        <x-ui.table-header>
                            <x-ui.table-row>
                                <x-ui.table-head>Category</x-ui.table-head>
                                <x-ui.table-head>Amount</x-ui.table-head>
                                <x-ui.table-head>Status</x-ui.table-head>
                                <x-ui.table-head>Date</x-ui.table-head>
                            </x-ui.table-row>
                        </x-ui.table-header>
                        <x-ui.table-body>
                            @forelse($student->fees ?? [] as $fee)
                                <x-ui.table-row>
                                    <x-ui.table-cell class="font-medium">{{ $fee->category->name ?? '-' }}</x-ui.table-cell>
                                    <x-ui.table-cell>₦{{ number_format($fee->amount, 2) }}</x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <x-ui.badge variant="{{ $fee->status === 'paid' ? 'success' : ($fee->status === 'partial' ? 'warning' : 'destructive') }}">
                                            {{ ucfirst($fee->status) }}
                                        </x-ui.badge>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>{{ $fee->created_at->format('M d, Y') }}</x-ui.table-cell>
                                </x-ui.table-row>
                            @empty
                                <x-ui.table-row>
                                    <x-ui.table-cell colspan="4" class="text-center py-8 text-muted-foreground">No fee records found.</x-ui.table-cell>
                                </x-ui.table-row>
                            @endforelse
                        </x-ui.table-body>
                    </x-ui.table>
                </x-ui.card-content>
            </x-ui.card>
        </x-ui.tab-content>

        <x-ui.tab-content value="exams">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Exam Results</x-ui.card-title>
                </x-ui.card-header>
                <x-ui.card-content class="p-0">
                    <x-ui.table>
                        <x-ui.table-header>
                            <x-ui.table-row>
                                <x-ui.table-head>Exam</x-ui.table-head>
                                <x-ui.table-head>Subject</x-ui.table-head>
                                <x-ui.table-head>Marks</x-ui.table-head>
                                <x-ui.table-head>Grade</x-ui.table-head>
                            </x-ui.table-row>
                        </x-ui.table-header>
                        <x-ui.table-body>
                            @forelse($student->examResults ?? [] as $result)
                                <x-ui.table-row>
                                    <x-ui.table-cell class="font-medium">{{ $result->exam->name ?? '-' }}</x-ui.table-cell>
                                    <x-ui.table-cell>{{ $result->subject->name ?? '-' }}</x-ui.table-cell>
                                    <x-ui.table-cell>{{ $result->marks_obtained }}/{{ $result->total_marks }}</x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <x-ui.badge variant="primary">{{ $result->grade ?? '-' }}</x-ui.badge>
                                    </x-ui.table-cell>
                                </x-ui.table-row>
                            @empty
                                <x-ui.table-row>
                                    <x-ui.table-cell colspan="4" class="text-center py-8 text-muted-foreground">No exam results found.</x-ui.table-cell>
                                </x-ui.table-row>
                            @endforelse
                        </x-ui.table-body>
                    </x-ui.table>
                </x-ui.card-content>
            </x-ui.card>
        </x-ui.tab-content>
    </x-ui.tabs>
</div>
@endsection
