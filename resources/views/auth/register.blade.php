@extends('layouts.guest', ['title' => 'Register'])
@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-foreground">Create your school</h1>
        <p class="text-muted-foreground mt-1">Start your 14-day free trial</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-muted-foreground uppercase tracking-wider">School</h3>
            <x-ui.input name="school_name" label="School Name" value="{{ old('school_name') }}" placeholder="Oakridge Academy" required />
            @error('school_name') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

            <x-ui.input name="school_code" label="School Code" value="{{ old('school_code') }}" placeholder="OAK" required />
            @error('school_code') <p class="text-sm text-destructive">{{ $message }}</p> @enderror
        </div>

        <x-ui.separator />

        <div class="space-y-4">
            <h3 class="text-sm font-medium text-muted-foreground uppercase tracking-wider">Admin Account</h3>
            <x-ui.input name="name" label="Full Name" value="{{ old('name') }}" placeholder="John Doe" required />
            @error('name') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

            <x-ui.input name="email" type="email" label="Email" value="{{ old('email') }}" placeholder="admin@school.com" required />
            @error('email') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

            <x-ui.input name="password" type="password" label="Password" placeholder="Min 8 characters" required />
            @error('password') <p class="text-sm text-destructive">{{ $message }}</p> @enderror

            <x-ui.input name="password_confirmation" type="password" label="Confirm Password" placeholder="Repeat password" required />
        </div>

        @if($errors->any())
            <x-ui.alert variant="destructive">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-ui.alert>
        @endif

        <x-ui.button type="submit" class="w-full">Create account</x-ui.button>
    </form>

    <p class="text-center text-sm text-muted-foreground">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">Sign in</a>
    </p>
</div>
@endsection
