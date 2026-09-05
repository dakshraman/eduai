@props([
    'type' => 'text',
    'error' => null,
])

<input
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'flex h-10 w-full rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#CDC1FF]/50 focus:border-[#CDC1FF] disabled:cursor-not-allowed disabled:opacity-50 transition ' . ($error ? 'border-red-400 focus:ring-red-400/50' : '')
    ]) }}
/>
@if($error)
    <p class="mt-1.5 text-sm text-red-500">{{ $error }}</p>
@endif
