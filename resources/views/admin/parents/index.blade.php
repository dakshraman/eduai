@extends('layouts.app')

@section('title', 'Parents')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in-up">
        <h1 class="text-2xl font-bold text-gray-900">Parents</h1>
        <a href="{{ route('parents.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold rounded-xl transition btn-ripple shadow-lg shadow-[#BFECFF]/40">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Parent
        </a>
    </div>

    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-4 animate-fade-in-up" style="animation-delay: 0.1s;">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search parents..."
                   class="flex-1 px-4 py-2.5 input-scandi text-sm">
            <button type="submit" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-xl transition">Search</button>
        </form>
    </div>

    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-[#FFF6E3]/50 border-b border-[#BFECFF]/20">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-500">Name</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-500">Email</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-500">Phone</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-500">Relation</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-500">Students</th>
                        <th class="text-right px-5 py-3 font-semibold text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($parents as $parent)
                        <tr class="table-row-hover">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $parent->user->name }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $parent->user->email }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ $parent->phone ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-[#BFECFF]/20 text-[#b5a8e8]">{{ ucfirst($parent->relation_type) }}</span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ $parent->students->count() }}</td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('parents.show', $parent) }}" class="p-1.5 text-gray-400 hover:text-[#CDC1FF] rounded-xl hover:bg-[#BFECFF]/20 transition" title="View">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('parents.edit', $parent) }}" class="p-1.5 text-gray-400 hover:text-amber-500 rounded-xl hover:bg-amber-50 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('parents.destroy', $parent) }}" onsubmit="return confirm('Are you sure?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-xl hover:bg-red-50 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">No parents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $parents->links() }}
        </div>
    </div>
</div>
@endsection
