@props(['value' => ''])

<div x-show="activeTab === '{{ $value }}'" x-cloak>
    {{ $slot }}
</div>
