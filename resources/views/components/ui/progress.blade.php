@props([
    'value' => 0,
    'max' => 100,
    'class' => '',
])

@php
    $percentage = min(max(($value / $max) * 100, 0), 100);
@endphp

<div {{ $attributes->merge(['class' => 'relative h-2 w-full overflow-hidden rounded-full bg-gray-100 ' . $class]) }}>
    <div
        class="h-full rounded-full bg-[#CDC1FF] transition-all duration-500 ease-out"
        style="width: {{ $percentage }}%"
    ></div>
</div>
