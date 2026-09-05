@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-gray-100 text-gray-700',
        'secondary' => 'bg-gray-50 text-gray-500',
        'destructive' => 'bg-red-50 text-red-600',
        'success' => 'bg-green-50 text-green-600',
        'warning' => 'bg-amber-50 text-amber-600',
        'info' => 'bg-blue-50 text-blue-600',
        'primary' => 'bg-[#CDC1FF]/30 text-[#1e293b]',
    ];
    $classes = 'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
