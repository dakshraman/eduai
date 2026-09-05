@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'relative w-full overflow-auto ' . $class]) }}>
    <table class="w-full caption-bottom text-sm">
        {{ $slot }}
    </table>
</div>
