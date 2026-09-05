@props(['class' => ''])

<h3 {{ $attributes->merge(['class' => 'text-lg font-semibold text-gray-900 leading-none tracking-tight ' . $class]) }}>
    {{ $slot }}
</h3>
