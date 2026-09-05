@props([
    'align' => 'right',
    'width' => '48',
])

<div class="relative" x-data="{ open: false }" @click.away="open = false" @keydown.escape.window="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
        class="absolute z-50 mt-2 {{ $align === 'right' ? 'right-0' : 'left-0' }} w-{{ $width }} rounded-2xl border border-gray-200/50 bg-white/90 backdrop-blur-xl shadow-xl py-1"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
