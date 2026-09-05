@extends('layouts.app')

@section('title', 'Student Profile')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('students.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Student Profile</h1>
    </div>

    {{-- Profile Card --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
            <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center shrink-0 overflow-hidden">
                @if($student->avatar ?? null)
                    <img src="{{ asset('storage/' . $student->avatar) }}" alt="{{ $student->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-indigo-600 font-bold text-2xl">{{ strtoupper(substr($student->name, 0, 2)) }}</span>
                @endif
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-900">{{ $student->name }}</h2>
                <p class="text-sm text-gray-500">{{ $student->class->name ?? '-' }} {{ $student->section ?? '' }}</p>
                <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-600">
                    <span>Admission #: <strong>{{ $student->admission_number }}</strong></span>
                    <span>Roll: <strong>{{ $student->roll_number ?? '-' }}</strong></span>
                    <span>Status: <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $student->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($student->status) }}</span></span>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('students.edit', $student) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">Edit</a>
                <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-medium rounded-lg transition">Delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div x-data="{ activeTab: 'personal' }">
        <div class="border-b border-gray-200 flex gap-6">
            <button @click="activeTab = 'personal'" :class="activeTab === 'personal' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-1 py-3 text-sm font-medium border-b-2 transition">Personal Info</button>
            <button @click="activeTab = 'attendance'" :class="activeTab === 'attendance' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-1 py-3 text-sm font-medium border-b-2 transition">Attendance</button>
            <button @click="activeTab = 'fees'" :class="activeTab === 'fees' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-1 py-3 text-sm font-medium border-b-2 transition">Fee Status</button>
            <button @click="activeTab = 'exams'" :class="activeTab === 'exams' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="px-1 py-3 text-sm font-medium border-b-2 transition">Exam Results</button>
        </div>

        {{-- Personal --}}
        <div x-show="activeTab === 'personal'" class="bg-white rounded-xl border border-gray-200 p-6 mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Email:</span> <span class="font-medium text-gray-900">{{ $student->email }}</span></div>
                <div><span class="text-gray-500">Phone:</span> <span class="font-medium text-gray-900">{{ $student->phone ?? '-' }}</span></div>
                <div><span class="text-gray-500">Gender:</span> <span class="font-medium text-gray-900">{{ ucfirst($student->gender ?? '-') }}</span></div>
                <div><span class="text-gray-500">Date of Birth:</span> <span class="font-medium text-gray-900">{{ $student->dob ? \Carbon\Carbon::parse($student->dob)->format('M d, Y') : '-' }}</span></div>
                <div><span class="text-gray-500">Blood Group:</span> <span class="font-medium text-gray-900">{{ $student->blood_group ?? '-' }}</span></div>
                <div><span class="text-gray-500">Religion:</span> <span class="font-medium text-gray-900">{{ $student->religion ?? '-' }}</span></div>
                <div><span class="text-gray-500">Admission Date:</span> <span class="font-medium text-gray-900">{{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y') : '-' }}</span></div>
                <div><span class="text-gray-500">Session Year:</span> <span class="font-medium text-gray-900">{{ $student->session_year ?? '-' }}</span></div>
            </div>
        </div>

        {{-- Attendance --}}
        <div x-show="activeTab === 'attendance'" class="bg-white rounded-xl border border-gray-200 p-6 mt-4">
            <div class="text-center py-8 text-sm text-gray-400">Attendance summary will be displayed here.</div>
        </div>

        {{-- Fees --}}
        <div x-show="activeTab === 'fees'" class="bg-white rounded-xl border border-gray-200 p-6 mt-4">
            <div class="text-center py-8 text-sm text-gray-400">Fee status will be displayed here.</div>
        </div>

        {{-- Exams --}}
        <div x-show="activeTab === 'exams'" class="bg-white rounded-xl border border-gray-200 p-6 mt-4">
            <div class="text-center py-8 text-sm text-gray-400">Exam results will be displayed here.</div>
        </div>
    </div>
</div>
@endsection
