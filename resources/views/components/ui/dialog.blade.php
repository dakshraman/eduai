@props([
    'id' => null,
    'title' => '',
    'description' => '',
])

<div
    @if($id) id="{{ $id }}" @endif
    x-data="{ open: false }"
    @if($id) {{ $attributes->merge([
        'class' => 'hidden',
    ]) }} @endif
    x-on:open-dialog.window="$event.detail?.id === '{{ $id }}' && (open = true)"
    x-on:close-dialog.window="$event.detail?.id === '{{ $id }}' && (open = false)"
>
    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm"
            @click.self="open = false"
        >
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-50 w-full max-w-lg rounded-2xl border border-gray-200/50 bg-white/95 backdrop-blur-xl p-6 shadow-2xl"
            >
                <div class="flex items-center justify-between mb-4">
                    <div>
                        @if($title)
                            <h2 class="text-lg font-semibold text-gray-900">{{ $title }}</h2>
                        @endif
                        @if($description)
                            <p class="text-sm text-gray-500 mt-1">{{ $description }}</p>
                        @endif
                    </div>
                    <button @click="open = false" class="p-2 text-gray-400 hover:text-gray-600 rounded-xl hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                {{ $slot }}
            </div>
        </div>
    </template>
</div>
