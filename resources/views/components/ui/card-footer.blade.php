@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'flex items-center p-6 border-t border-gray-100 ' . $class]) }}>
    {{ $slot }}
</div>
