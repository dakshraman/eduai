@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Teachers</h1>
        <a href="{{ route('teachers.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Teacher
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-4">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search teachers..."
                   class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
            <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Search</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Employee ID</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Designation</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Department</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Phone</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($teachers ?? [] as $teacher)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $teacher->name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $teacher->employee_id }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $teacher->designation ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $teacher->department ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $teacher->phone ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $teacher->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('teachers.edit', $teacher) }}" class="p-1.5 text-gray-400 hover:text-amber-600 rounded-lg hover:bg-amber-50 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" onsubmit="return confirm('Are you sure?')" class="inline">
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
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">No teachers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($teachers) && $teachers instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="px-5 py-4 border-t border-gray-100">
                {{ $teachers->links('components.pagination') }}
            </div>
        @endif
    </div>
</div>
@endsection
