@props([
    'value' => '',
    'label' => '',
])

<button
    type="button"
    @click="activeTab = '{{ $value }}'"
    :class="activeTab === '{{ $value }}' ? 'border-[#CDC1FF] text-[#1e293b]' : 'border-transparent text-gray-500 hover:text-gray-700'"
    class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors whitespace-nowrap"
>
    {{ $label ?? $slot }}
</button>
