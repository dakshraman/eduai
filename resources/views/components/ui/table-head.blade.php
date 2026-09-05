@props(['class' => ''])

<th {{ $attributes->merge(['class' => 'h-11 px-5 text-left align-middle font-semibold text-gray-500 [&:has([role=checkbox])]:pr-0 ' . $class]) }}>
    {{ $slot }}
</th>
