@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl animate-fade-in-up font-bold text-gray-900">Events</h1>
        <a href="{{ route('events.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold btn-ripple rounded-xl transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Event
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($events ?? [] as $event)
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 overflow-hidden hover:shadow-md transition">
                @if($event->image)
                    <div class="h-40 bg-gray-100">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-10 h-10 rounded-lg bg-[#BFECFF]/30 flex flex-col items-center justify-center shrink-0">
                            <span class="text-[10px] font-bold text-[#CDC1FF] leading-none">{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('M') : '' }}</span>
                            <span class="text-sm font-bold text-[#b5a8e8] leading-none">{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d') : '' }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 text-sm">{{ $event->title }}</h3>
                            @if($event->event_time)
                                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</p>
                            @endif
                        </div>
                    </div>
                    @if($event->location)
                        <p class="text-sm text-gray-500 flex items-center gap-1 mt-2">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            {{ $event->location }}
                        </p>
                    @endif
                    @if($event->description)
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-12 text-center text-gray-400 text-sm">
                No events yet.
            </div>
        @endforelse
    </div>
</div>
@endsection
