@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl space-y-6">
    <h1 class="text-2xl font-bold text-gray-900">School Settings</h1>

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">School Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name *</label>
                    <input type="text" name="school_name" value="{{ old('school_name', $settings->school_name ?? '') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('school_name') border-red-500 @enderror">
                    @error('school_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Code *</label>
                    <input type="text" name="school_code" value="{{ old('school_code', $settings->school_code ?? '') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('school_code') border-red-500 @enderror">
                    @error('school_code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" rows="2"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('address') border-red-500 @enderror">{{ old('address', $settings->address ?? '') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $settings->phone ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $settings->email ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('email') border-red-500 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                    <select name="timezone" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
                        @foreach(timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}" {{ old('timezone', $settings->timezone ?? 'UTC') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                    <input type="text" name="currency" value="{{ old('currency', $settings->currency ?? 'USD') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('currency') border-red-500 @enderror">
                    @error('currency') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('logo') border-red-500 @enderror">
                    @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if($settings->logo ?? null)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current logo" class="h-12 rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">Save Settings</button>
        </div>
    </form>
</div>
@endsection
