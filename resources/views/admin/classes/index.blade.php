@extends('layouts.app')

@section('title', 'Classes')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in-up">
        <h1 class="text-2xl font-bold text-gray-900">Classes</h1>
        <a href="{{ route('classes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold rounded-xl transition btn-ripple shadow-lg shadow-[#BFECFF]/40">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Class
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($classes ?? [] as $class)
            <a href="{{ route('classes.show', $class) }}" class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-5 card-lift animate-fade-in-up group">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#BFECFF]/20 flex items-center justify-center group-hover:bg-primary-100 transition">
                        <svg class="w-5 h-5 text-[#CDC1FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $class->name }}</span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>{{ $class->sections_count ?? $class->sections->count() ?? 0 }} sections</span>
                    <span>{{ $class->students_count ?? $class->students->count() ?? 0 }} students</span>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-12 text-center text-gray-400 text-sm">
                No classes found. Create your first class to get started.
            </div>
        @endforelse
    </div>
</div>
@endsection
