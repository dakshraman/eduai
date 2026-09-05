@props([
    'src' => null,
    'alt' => '',
    'fallback' => '',
    'size' => 'default',
])

@php
    $sizes = [
        'sm' => 'h-8 w-8 text-xs',
        'default' => 'h-10 w-10 text-sm',
        'lg' => 'h-12 w-12 text-base',
        'xl' => 'h-16 w-16 text-lg',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['default'];
@endphp

<div {{ $attributes->merge(['class' => 'relative flex shrink-0 overflow-hidden rounded-full ' . $sizeClass]) }}>
    @if($src)
        <img class="aspect-square h-full w-full object-cover" src="{{ $src }}" alt="{{ $alt }}" />
    @else
        <div class="flex h-full w-full items-center justify-center rounded-full bg-gradient-to-br from-[#BFECFF] to-[#CDC1FF] text-[#1e293b] font-semibold">
            {{ $fallback ?: strtoupper(substr($alt, 0, 2)) }}
        </div>
    @endif
</div>
