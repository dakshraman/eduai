@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-4xl space-y-6" x-data="{ activeTab: 'general' }">
    <h1 class="text-2xl animate-fade-in-up font-bold text-gray-900">System Settings</h1>

    {{-- Tabs --}}
    <div class="border-b border-gray-200">
        <nav class="flex gap-6">
            <button @click="activeTab = 'general'"
                    class="pb-3 text-sm font-semibold border-b-2 transition"
                    :class="activeTab === 'general' ? 'border-[#CDC1FF] text-[#CDC1FF]' : 'border-transparent text-gray-500 hover:text-gray-700'">
                General
            </button>
            <button @click="activeTab = 'academic'"
                    class="pb-3 text-sm font-semibold border-b-2 transition"
                    :class="activeTab === 'academic' ? 'border-[#CDC1FF] text-[#CDC1FF]' : 'border-transparent text-gray-500 hover:text-gray-700'">
                Academic
            </button>
            <button @click="activeTab = 'system'"
                    class="pb-3 text-sm font-semibold border-b-2 transition"
                    :class="activeTab === 'system' ? 'border-[#CDC1FF] text-[#CDC1FF]' : 'border-transparent text-gray-500 hover:text-gray-700'">
                System
            </button>
        </nav>
    </div>

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- General Tab --}}
        <div x-show="activeTab === 'general'" x-transition class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">School Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name *</label>
                    <input type="text" name="name" value="{{ old('name', $school->name ?? '') }}" required
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('name') border-red-500 @enderror">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $school->email ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('email') border-red-500 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $school->phone ?? '') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <textarea name="address" rows="2"
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('address') border-red-500 @enderror">{{ old('address', $school->address ?? '') }}</textarea>
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="url" name="website" value="{{ old('website', $school->domain ?? '') }}" placeholder="https://"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('website') border-red-500 @enderror">
                    @error('website') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('logo') border-red-500 @enderror">
                    @error('logo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    @if($school->logo ?? null)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $school->logo) }}" alt="Current logo" class="h-12 rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Academic Tab --}}
        <div x-show="activeTab === 'academic'" x-transition class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">Academic Settings</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Timezone</label>
                    <select name="timezone" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi">
                        @foreach(timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}" {{ old('timezone', $school->timezone ?? 'UTC') === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                    <input type="text" name="currency" value="{{ old('currency', $school->currency ?? 'USD') }}"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('currency') border-red-500 @enderror">
                    @error('currency') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Currency Symbol</label>
                    <input type="text" name="currency_symbol" value="{{ old('currency_symbol', $school->currency_symbol ?? '$') }}" maxlength="5"
                           class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi @error('currency_symbol') border-red-500 @enderror">
                    @error('currency_symbol') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Academic Week Start</label>
                    <select name="academic_week_start" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi">
                        <option value="monday" {{ old('academic_week_start', 'monday') === 'monday' ? 'selected' : '' }}>Monday</option>
                        <option value="sunday" {{ old('academic_week_start', 'monday') === 'sunday' ? 'selected' : '' }}>Sunday</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Format</label>
                    <select name="date_format" class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm input-scandi">
                        <option value="Y-m-d" {{ old('date_format', 'Y-m-d') === 'Y-m-d' ? 'selected' : '' }}>Y-m-d</option>
                        <option value="d/m/Y" {{ old('date_format') === 'd/m/Y' ? 'selected' : '' }}>d/m/Y</option>
                        <option value="m/d/Y" {{ old('date_format') === 'm/d/Y' ? 'selected' : '' }}>m/d/Y</option>
                        <option value="d-M-Y" {{ old('date_format') === 'd-M-Y' ? 'selected' : '' }}>d-M-Y</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- System Tab --}}
        <div x-show="activeTab === 'system'" x-transition class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 border-b border-gray-100 pb-3">System Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Code</label>
                    <input type="text" value="{{ $school->code ?? 'N/A' }}" readonly
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Trial Status</label>
                    <div class="flex items-center gap-2">
                        @if($school->trial_ends_at && $school->trial_ends_at->isFuture())
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">
                                Trial — {{ $school->trial_ends_at->diffForHumans() }}
                            </span>
                        @elseif($school->active_status)
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">Inactive</span>
                        @endif
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                    <input type="text" value="{{ $school->slug ?? 'N/A' }}" readonly
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                    <input type="text" value="{{ $school->created_at?->format('M d, Y H:i') ?? 'N/A' }}" readonly
                           class="w-full px-4 py-2 rounded-lg border border-gray-200 text-sm bg-gray-50 text-gray-500 cursor-not-allowed">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#BFECFF]/200 hover:bg-primary-600 text-[#1e293b] text-sm font-semibold btn-ripple rounded-xl transition">Save Settings</button>
        </div>
    </form>
</div>
@endsection
