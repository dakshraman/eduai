@extends('layouts.app')

@section('title', 'Parent Details')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('parents.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Parent Details</h1>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-4">Information</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Name</p>
                <p class="text-sm font-medium text-gray-900">{{ $parent->user->name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Email</p>
                <p class="text-sm font-medium text-gray-900">{{ $parent->user->email }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Phone</p>
                <p class="text-sm font-medium text-gray-900">{{ $parent->phone ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Relation</p>
                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-[#BFECFF]/30 text-[#b5a8e8]">{{ ucfirst($parent->relation_type) }}</span>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Occupation</p>
                <p class="text-sm font-medium text-gray-900">{{ $parent->occupation ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide">Address</p>
                <p class="text-sm font-medium text-gray-900">{{ $parent->address ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Linked Students</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Admission No.</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Class</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($parent->students as $student)
                        <tr class="hover:bg-[#FFF6E3] transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $student->user->name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $student->admission_number }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $student->class->name ?? '-' }} {{ $student->section->name ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-8 text-center text-gray-400">No students linked.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <a href="{{ route('parents.edit', $parent) }}" class="px-4 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold rounded-lg transition">Edit Parent</a>
        <a href="{{ route('parents.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Back to List</a>
    </div>
</div>
@endsection
