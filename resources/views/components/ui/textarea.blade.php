@props([
    'error' => null,
])

<textarea
    {{ $attributes->merge([
        'class' => 'flex min-h-[80px] w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-[#CDC1FF]/50 focus:border-[#CDC1FF] disabled:cursor-not-allowed disabled:opacity-50 transition resize-y ' . ($error ? 'border-red-400 focus:ring-red-400/50' : '')
    ]) }}
>{{ $slot ?? $attributes->get('value', '') }}</textarea>
@if($error)
    <p class="mt-1.5 text-sm text-red-500">{{ $error }}</p>
@endif
