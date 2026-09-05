@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('events.index') }}" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Create Event</h1>
    </div>

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('title') border-red-500 @enderror">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Date *</label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('event_date') border-red-500 @enderror">
                    @error('event_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Time</label>
                    <input type="time" name="event_time" value="{{ old('event_time') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('event_time') border-red-500 @enderror">
                    @error('event_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('location') border-red-500 @enderror">
                @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-[#BFECFF] focus:ring-2 focus:ring-[#BFECFF]/30 transition @error('image') border-red-500 @enderror">
                @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold rounded-lg transition">Create Event</button>
            <a href="{{ route('events.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
