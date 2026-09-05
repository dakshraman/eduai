@props([
    'orientation' => 'horizontal',
])

@if($orientation === 'horizontal')
    <div {{ $attributes->merge(['class' => 'shrink-0 bg-gray-200 h-[1px] w-full']) }}></div>
@else
    <div {{ $attributes->merge(['class' => 'shrink-0 bg-gray-200 w-[1px] h-full']) }}></div>
@endif
