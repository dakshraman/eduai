<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EduAI') }} - @yield('title', 'Welcome')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-indigo-700 to-purple-800 px-4 py-12">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-white/10 backdrop-blur-sm mb-4">
                <span class="text-white font-bold text-xl">E</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">EduAI</h1>
            <p class="text-indigo-200 text-sm mt-1">School Management System</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">
            @if(session('status'))
                <div class="mb-4 px-4 py-3 bg-indigo-50 border border-indigo-200 text-indigo-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </div>

        <p class="text-center text-indigo-300 text-xs mt-6">&copy; {{ date('Y') }} EduAI. All rights reserved.</p>
    </div>
</body>
</html>
