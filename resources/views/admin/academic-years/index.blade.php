@extends('layouts.app')

@section('title', 'Academic Years')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <h1 class="text-2xl font-bold text-gray-900">Academic Years</h1>
    </div>

    {{-- Add Year Form --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3 mb-4">Add Academic Year</h2>
        <form method="POST" action="{{ route('academic-years.store') }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Year *</label>
                    <input type="text" name="year" value="{{ old('year') }}" placeholder="e.g. 2026-2027" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('year') border-red-500 @enderror">
                    @error('year') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Session 2026-2027" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('title') border-red-500 @enderror">
                    @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date *</label>
                    <input type="date" name="starting_date" value="{{ old('starting_date') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('starting_date') border-red-500 @enderror">
                    @error('starting_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date *</label>
                    <input type="date" name="ending_date" value="{{ old('ending_date') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('ending_date') border-red-500 @enderror">
                    @error('ending_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Add Year</button>
            </div>
        </form>
    </div>

    {{-- Years Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Year</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Title</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Start Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">End Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($years as $year)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $year->year }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $year->title }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $year->starting_date->format('M d, Y') }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $year->ending_date->format('M d, Y') }}</td>
                            <td class="px-5 py-3">
                                @if($year->is_default)
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span>
                                @else
                                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if(!$year->is_default)
                                        <form method="POST" action="{{ route('academic-years.activate', $year) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 rounded-lg transition">Activate</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('academic-years.destroy', $year) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No academic years found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
