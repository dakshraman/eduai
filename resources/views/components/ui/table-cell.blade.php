@props(['class' => ''])

<td {{ $attributes->merge(['class' => 'px-5 py-3 align-middle [&:has([role=checkbox])]:pr-0 ' . $class]) }}>
    {{ $slot }}
</td>
