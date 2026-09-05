@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="animate-fade-in-up">
        <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
        <p class="text-gray-400 text-sm mt-1">Manage your account settings and information.</p>
    </div>

    {{-- Profile Info --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-6 animate-fade-in-up" style="animation-delay: 0.1s;">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Profile Information</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 text-white flex items-center justify-center text-2xl font-bold overflow-hidden shrink-0 transition-transform hover:scale-105">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Profile Photo</label>
                    <input type="file" name="avatar" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-[#BFECFF]/20 file:text-[#b5a8e8] hover:file:bg-primary-100">
                    @error('avatar')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-1.5">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                           class="input-scandi w-full px-4 py-3 text-sm">
                    @error('name')<p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="input-scandi w-full px-4 py-3 text-sm">
                    @error('email')<p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-600 mb-1.5">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="input-scandi w-full px-4 py-3 text-sm">
                    @error('phone')<p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Role</label>
                    <input type="text" value="{{ ucfirst(str_replace('_', ' ', $user->role)) }}" disabled
                           class="input-scandi w-full px-4 py-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
            </div>

            @if($user->school)
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">School</label>
                    <input type="text" value="{{ $user->school->name }}" disabled
                           class="input-scandi w-full px-4 py-3 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                </div>
            @endif

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-[#BFECFF]/200 text-[#1e293b] text-sm font-medium rounded-xl hover:bg-primary-600 transition btn-ripple shadow-lg shadow-[#BFECFF]/40">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white/80 backdrop-blur-xl rounded-2xl border border-gray-200/50 p-6 animate-fade-in-up" style="animation-delay: 0.2s;">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h2>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4 max-w-md">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-600 mb-1.5">Current Password</label>
                <input type="password" id="current_password" name="current_password" required
                       class="input-scandi w-full px-4 py-3 text-sm">
                @error('current_password')<p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 mb-1.5">New Password</label>
                <input type="password" id="password" name="password" required
                       class="input-scandi w-full px-4 py-3 text-sm">
                @error('password')<p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1.5">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="input-scandi w-full px-4 py-3 text-sm">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-gray-800 transition btn-ripple">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
