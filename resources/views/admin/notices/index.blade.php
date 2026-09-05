@extends('layouts.app')

@section('title', 'Notices')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Notices</h1>
        <a href="{{ route('notices.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Notice
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($notices ?? [] as $notice)
            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-3">
                    <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                        {{ ($notice->type ?? 'general') === 'urgent' ? 'bg-red-100 text-red-700' :
                           (($notice->type ?? 'general') === 'important' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-600') }}">
                        {{ ucfirst($notice->type ?? 'general') }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $notice->created_at->format('M d, Y') }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">{{ $notice->title }}</h3>
                <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($notice->message, 120) }}</p>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-xl border border-gray-200 p-12 text-center text-gray-400 text-sm">
                No notices yet.
            </div>
        @endforelse
    </div>
</div>
@endsection
