@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('email') border-red-500 @enderror">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password"
               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition @error('password') border-red-500 @enderror">
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                   class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <span class="text-sm text-gray-600">Remember me</span>
        </label>
    </div>

    <button type="submit"
            class="w-full px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Sign In
    </button>

    <p class="text-center text-sm text-gray-500">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Register</a>
    </p>
</form>
@endsection
