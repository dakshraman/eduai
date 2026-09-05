@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-col space-y-1.5 p-6 border-b border-gray-100 ' . $class]) }}>
    {{ $slot }}
</div>
