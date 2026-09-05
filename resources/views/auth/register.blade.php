@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="school_name" class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
            <input id="school_name" type="text" name="school_name" value="{{ old('school_name') }}" required autofocus
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('school_name') border-red-500 @enderror">
            @error('school_name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="school_code" class="block text-sm font-medium text-gray-700 mb-1">School Code</label>
            <input id="school_code" type="text" name="school_code" value="{{ old('school_code') }}" required
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('school_code') border-red-500 @enderror">
            @error('school_code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Admin Full Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required
               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('name') border-red-500 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('email') border-red-500 @enderror">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('password') border-red-500 @enderror">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition">
        </div>
    </div>

    <button type="submit"
            class="w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Create Account
    </button>

    <p class="text-center text-sm text-gray-500">
        Already have an account?
        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Sign In</a>
    </p>
</form>
@endsection
