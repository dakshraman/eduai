@props([
    'options' => [],
    'placeholder' => 'Select...',
    'error' => null,
    'value' => null,
])

<select
    {{ $attributes->merge([
        'class' => 'flex h-10 w-full rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#CDC1FF]/50 focus:border-[#CDC1FF] disabled:cursor-not-allowed disabled:opacity-50 transition ' . ($error ? 'border-red-400 focus:ring-red-400/50' : '')
    ]) }}
>
    @if($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach($options as $key => $option)
        @if(is_array($option))
            <option value="{{ $option['value'] }}" {{ ($value ?? old($attributes->get('name'))) == $option['value'] ? 'selected' : '' }}>
                {{ $option['label'] }}
            </option>
        @else
            <option value="{{ $key }}" {{ ($value ?? old($attributes->get('name'))) == $key ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endif
    @endforeach
    {{ $slot }}
</select>
@if($error)
    <p class="mt-1.5 text-sm text-red-500">{{ $error }}</p>
@endif
