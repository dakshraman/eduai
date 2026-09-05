<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Welcome' }} - EduAI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen bg-background">
    <div class="flex min-h-screen">
        <!-- Left Panel -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-secondary via-primary to-accent">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,...')] opacity-5"></div>
            <div class="relative z-10 flex flex-col items-center justify-center w-full p-12">
                <div class="mb-8">
                    <div class="h-16 w-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">E</span>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-white text-center mb-4">EduAI</h1>
                <p class="text-white/80 text-center text-lg max-w-sm">Modern school management platform for the digital age.</p>
                <div class="mt-12 grid grid-cols-2 gap-4 w-full max-w-sm">
                    <div class="rounded-xl bg-white/10 backdrop-blur-sm p-4 text-center">
                        <div class="text-2xl font-bold text-white">500+</div>
                        <div class="text-sm text-white/70">Schools</div>
                    </div>
                    <div class="rounded-xl bg-white/10 backdrop-blur-sm p-4 text-center">
                        <div class="text-2xl font-bold text-white">50K+</div>
                        <div class="text-sm text-white/70">Students</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12 bg-background">
            <div class="w-full max-w-md animate-fade-in-up">
                <!-- Mobile logo -->
                <div class="lg:hidden flex items-center gap-2 mb-8 justify-center">
                    <div class="h-10 w-10 rounded-xl bg-primary flex items-center justify-center">
                        <span class="text-xl font-bold text-primary-foreground">E</span>
                    </div>
                    <span class="text-2xl font-bold text-foreground">EduAI</span>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
