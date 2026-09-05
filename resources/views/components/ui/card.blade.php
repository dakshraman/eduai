@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-200/50 bg-white/80 backdrop-blur-xl shadow-sm ' . $class]) }}>
    {{ $slot }}
</div>
