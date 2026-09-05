@props([
    'variant' => 'default',
    'size' => 'default',
    'href' => null,
    'onclick' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-semibold transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';
    $sizes = [
        'sm' => 'h-8 px-3 text-xs',
        'default' => 'h-10 px-5 py-2',
        'lg' => 'h-12 px-8 text-base',
        'icon' => 'h-10 w-10',
    ];
    $variants = [
        'default' => 'bg-[#CDC1FF] text-[#1e293b] hover:bg-[#b8b3e6] shadow-md shadow-[#CDC1FF]/30',
        'destructive' => 'bg-red-500 text-white hover:bg-red-600 shadow-md shadow-red-500/30',
        'outline' => 'border border-gray-200 bg-white hover:bg-gray-50 text-gray-700',
        'secondary' => 'bg-[#BFECFF]/30 text-[#1e293b] hover:bg-[#BFECFF]/50',
        'ghost' => 'hover:bg-gray-100 text-gray-600',
        'link' => 'text-[#CDC1FF] underline-offset-4 hover:underline',
        'success' => 'bg-green-500 text-white hover:bg-green-600 shadow-md shadow-green-500/30',
    ];
    $classes = $base . ' ' . ($sizes[$size] ?? $sizes['default']) . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes, 'onclick' => $onclick]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'onclick' => $onclick]) }}>
        {{ $slot }}
    </button>
@endif
