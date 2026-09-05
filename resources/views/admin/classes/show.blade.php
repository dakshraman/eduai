@extends('layouts.app')

@section('title', 'Class Details')

@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('classes.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ $class->name }}</h1>
    </div>

    {{-- Sections --}}
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Sections</h2>
        </div>
        <div class="p-5">
            @forelse($class->sections ?? [] as $section)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <span class="text-indigo-600 font-semibold text-sm">{{ $section->name }}</span>
                        </div>
                        <span class="text-sm text-gray-700">{{ $section->students_count ?? $section->students->count() ?? 0 }} students</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <form method="POST" action="{{ route('sections.destroy', [$class, $section]) }}" onsubmit="return confirm('Delete this section?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400 text-center py-6">No sections yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Add Section --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="text-sm font-semibold text-gray-900 mb-3">Add Section</h3>
        <form method="POST" action="{{ route('sections.store', $class) }}" class="flex gap-3">
            @csrf
            <input type="text" name="name" placeholder="Section name (e.g. A)" required
                   class="flex-1 max-w-xs px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('name') border-red-500 @enderror">
            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">Add</button>
        </form>
    </div>
</div>
@endsection
