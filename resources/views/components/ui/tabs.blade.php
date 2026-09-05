@props(['default' => ''])

<div x-data="{ activeTab: '{{ $default }}' }">
    {{ $slot }}
</div>
