@extends('layouts.guest', ['title' => 'Login'])
@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-foreground">Welcome back</h1>
        <p class="text-muted-foreground mt-1">Sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <x-ui.input name="email" type="email" label="Email" value="{{ old('email') }}" placeholder="admin@eduai.com" required />
        @error('email') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

        <x-ui.input name="password" type="password" label="Password" placeholder="Enter your password" required />
        @error('password') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded border-input">
                <span class="text-muted-foreground">Remember me</span>
            </label>
        </div>

        @if($errors->any() && !$errors->has('email') && !$errors->has('password'))
            <x-ui.alert variant="destructive">
                <p>{{ $errors->first() }}</p>
            </x-ui.alert>
        @endif

        <x-ui.button type="submit" class="w-full">Sign in</x-ui.button>
    </form>

    <p class="text-center text-sm text-muted-foreground">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">Sign up</a>
    </p>
</div>
@endsection
