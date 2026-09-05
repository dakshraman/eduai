<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduAI — Modern School Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        @keyframes fadeInUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .gradient-text { background:linear-gradient(135deg,var(--secondary),var(--primary)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    </style>
</head>
<body class="bg-background">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 border-b border-border bg-card/80 backdrop-blur-sm" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-lg bg-primary flex items-center justify-center">
                        <span class="text-sm font-bold text-primary-foreground">E</span>
                    </div>
                    <span class="font-semibold text-lg text-foreground">EduAI</span>
                </div>
                <div class="hidden md:flex items-center gap-6">
                    <a href="#features" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">Features</a>
                    <a href="#pricing" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">Pricing</a>
                    <a href="#testimonials" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">Testimonials</a>
                    <a href="#faq" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">FAQ</a>
                    <a href="{{ route('login') }}" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">Login</a>
                    <x-ui.button href="{{ route('register') }}" size="sm">Start Free Trial</x-ui.button>
                </div>
                <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-muted-foreground">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <div x-show="mobileOpen" x-transition class="md:hidden border-t border-border bg-card px-4 pb-4">
            <a href="#features" class="block py-3 text-sm font-medium text-muted-foreground">Features</a>
            <a href="#pricing" class="block py-3 text-sm font-medium text-muted-foreground">Pricing</a>
            <a href="#testimonials" class="block py-3 text-sm font-medium text-muted-foreground">Testimonials</a>
            <a href="#faq" class="block py-3 text-sm font-medium text-muted-foreground">FAQ</a>
            <hr class="my-2 border-border">
            <a href="{{ route('login') }}" class="block py-3 text-sm font-medium text-primary">Login</a>
            <div class="mt-2">
                <x-ui.button href="{{ route('register') }}" class="w-full">Start Free Trial</x-ui.button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-28 pb-20 px-4 overflow-hidden" style="background: linear-gradient(135deg, var(--secondary), var(--primary), var(--accent));">
        <div class="absolute inset-0 bg-white/5"></div>
        <div class="max-w-7xl mx-auto relative">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-fade-in-up">
                    <x-ui.badge variant="secondary" class="mb-4">Trusted by 500+ schools</x-ui.badge>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-foreground leading-tight mb-6">
                        Modern School Management <span class="gradient-text">Made Simple</span>
                    </h1>
                    <p class="text-lg text-muted-foreground mb-8 leading-relaxed max-w-lg">
                        Streamline your school operations with EduAI — the all-in-one platform for student management, attendance, fees, exams, and more.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <x-ui.button href="{{ route('register') }}" size="lg">Start Free — No Card Needed</x-ui.button>
                        <x-ui.button href="#features" variant="outline" size="lg">See Features</x-ui.button>
                    </div>
                    <p class="text-sm text-muted-foreground mt-4">14-day free trial · No credit card required · Cancel anytime</p>
                </div>
                <div class="hidden lg:block animate-float">
                    <div class="rounded-2xl border border-border bg-card p-6 shadow-xl">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="rounded-xl bg-background p-5 border border-border">
                                <div class="text-3xl font-bold text-primary">2,847</div>
                                <div class="text-sm text-muted-foreground mt-1">Active Students</div>
                            </div>
                            <div class="rounded-xl bg-background p-5 border border-border">
                                <div class="text-3xl font-bold text-green-500">98.5%</div>
                                <div class="text-sm text-muted-foreground mt-1">Attendance Rate</div>
                            </div>
                        </div>
                        <div class="rounded-xl bg-background p-5 border border-border">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-muted-foreground">Fee Collection</span>
                                <span class="text-sm font-bold text-primary">$124,500</span>
                            </div>
                            <div class="w-full bg-secondary/30 rounded-full h-2">
                                <div class="h-2 rounded-full bg-primary" style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="bg-card py-12 border-b border-border">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">500+</div>
                    <div class="text-muted-foreground mt-1 text-sm font-medium">Schools</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">50K+</div>
                    <div class="text-muted-foreground mt-1 text-sm font-medium">Students</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">99.9%</div>
                    <div class="text-muted-foreground mt-1 text-sm font-medium">Uptime</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">24/7</div>
                    <div class="text-muted-foreground mt-1 text-sm font-medium">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 px-4 bg-background">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <x-ui.badge variant="secondary" class="mb-3">Features</x-ui.badge>
                <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mt-3 mb-4">Everything Your School Needs</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">One powerful platform to manage students, teachers, fees, exams, attendance, and communication.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-secondary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Student Management</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Complete student profiles with enrollment, class assignment, roll numbers, and admission tracking.</p>
                    </div>
                </x-ui.card>

                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-secondary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Attendance Tracking</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Quick daily attendance with class-wise marking, reports, and parent notifications.</p>
                    </div>
                </x-ui-card>

                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-primary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Fee Management</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Flexible fee structures, online payments, due date tracking, and automated receipts.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-accent/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Exams & Results</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Create exams, enter marks, generate report cards, and analyze student performance.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-primary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Class & Section</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Organize classes, sections, subjects, and teacher assignments with ease.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-accent/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Notices & Events</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Send notices to students/parents, manage school events, and holiday calendars.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-secondary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Teacher Portal</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Dedicated teacher profiles, class management, and attendance marking tools.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-primary/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Analytics Dashboard</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Real-time insights on enrollment, fees, attendance, and academic performance.</p>
                    </div>
                </x-ui-card>

                <x-ui-card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="w-12 h-12 rounded-xl bg-accent/50 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-foreground mb-2">Secure & Reliable</h3>
                        <p class="text-muted-foreground text-sm leading-relaxed">Enterprise-grade security with 99.9% uptime, automatic backups, and SSL encryption.</p>
                    </div>
                </x-ui-card>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24 px-4 bg-background">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <x-ui.badge variant="secondary" class="mb-3">How It Works</x-ui.badge>
                <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mt-3 mb-4">Get Started in 3 Simple Steps</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-2xl font-bold text-primary-foreground mx-auto mb-6">1</div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Create Your School</h3>
                    <p class="text-muted-foreground text-sm">Sign up and set up your school profile with basic details in under 2 minutes.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-2xl font-bold text-primary-foreground mx-auto mb-6">2</div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Add Students & Teachers</h3>
                    <p class="text-muted-foreground text-sm">Import your data or add students, teachers, and classes manually.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-2xl font-bold text-primary-foreground mx-auto mb-6">3</div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Start Managing</h3>
                    <p class="text-muted-foreground text-sm">Track attendance, manage fees, conduct exams — everything from one dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 px-4 bg-background">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <x-ui.badge variant="secondary" class="mb-3">Pricing</x-ui.badge>
                <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mt-3 mb-4">Simple, Transparent Pricing</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">No hidden fees. Start free, upgrade when you're ready.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Starter -->
                <div class="rounded-2xl border border-border bg-card p-8 hover:shadow-lg transition-shadow">
                    <div class="text-sm font-semibold text-muted-foreground uppercase tracking-wider mb-2">Starter</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-foreground">$29</span>
                        <span class="text-muted-foreground ml-2 text-sm">/month</span>
                    </div>
                    <p class="text-muted-foreground text-sm mb-8">Perfect for small schools getting started.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Up to 200 students</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>5 teacher accounts</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All core features</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Email support</li>
                    </ul>
                    <x-ui.button variant="outline" class="w-full" href="{{ route('register') }}">Get Started</x-ui.button>
                </div>

                <!-- Pro -->
                <div class="rounded-2xl border-2 border-primary bg-card p-8 hover:shadow-lg transition-shadow relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <x-ui.badge>MOST POPULAR</x-ui.badge>
                    </div>
                    <div class="text-sm font-semibold text-primary uppercase tracking-wider mb-2">Pro</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-foreground">$79</span>
                        <span class="text-muted-foreground ml-2 text-sm">/month</span>
                    </div>
                    <p class="text-muted-foreground text-sm mb-8">For growing schools with more needs.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Up to 1,000 students</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>25 teacher accounts</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All features + reports</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Priority support</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Custom branding</li>
                    </ul>
                    <x-ui.button class="w-full" href="{{ route('register') }}">Get Started</x-ui.button>
                </div>

                <!-- School -->
                <div class="rounded-2xl border border-border bg-card p-8 hover:shadow-lg transition-shadow">
                    <div class="text-sm font-semibold text-muted-foreground uppercase tracking-wider mb-2">School</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-foreground">$199</span>
                        <span class="text-muted-foreground ml-2 text-sm">/month</span>
                    </div>
                    <p class="text-muted-foreground text-sm mb-8">For large institutions with full needs.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Unlimited students</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Unlimited teachers</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All features + API</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Dedicated support</li>
                        <li class="flex items-center text-sm text-foreground"><svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>On-premise option</li>
                    </ul>
                    <x-ui.button variant="outline" class="w-full" href="{{ route('register') }}">Contact Sales</x-ui.button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-24 px-4 bg-background">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <x-ui.badge variant="secondary" class="mb-3">Testimonials</x-ui.badge>
                <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mt-3 mb-4">Loved by Schools Worldwide</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="flex text-yellow-400 text-sm mb-4">★★★★★</div>
                        <p class="text-foreground mb-6 leading-relaxed text-sm">"EduAI replaced 4 different tools we were using. The attendance tracking alone saved us 2 hours every day. Setup was incredibly easy."</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-primary/20 flex items-center justify-center text-xs font-bold text-primary">JR</div>
                            <div class="ml-3">
                                <div class="font-bold text-foreground text-sm">James Robertson</div>
                                <div class="text-xs text-muted-foreground">Principal, Oakridge Academy</div>
                            </div>
                        </div>
                    </div>
                </x-ui.card>

                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="flex text-yellow-400 text-sm mb-4">★★★★★</div>
                        <p class="text-foreground mb-6 leading-relaxed text-sm">"The fee management system is brilliant. Parents can pay online, we get instant notifications, and the reports are automatically generated."</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-secondary/30 flex items-center justify-center text-xs font-bold text-foreground">SK</div>
                            <div class="ml-3">
                                <div class="font-bold text-foreground text-sm">Sarah Kim</div>
                                <div class="text-xs text-muted-foreground">Admin Director, Sunrise School</div>
                            </div>
                        </div>
                    </div>
                </x-ui-card>

                <x-ui.card class="hover:shadow-lg transition-shadow">
                    <div class="pt-6">
                        <div class="flex text-yellow-400 text-sm mb-4">★★★★★</div>
                        <p class="text-foreground mb-6 leading-relaxed text-sm">"We manage 1,200 students across 3 campuses from one dashboard. The analytics give us real-time insights into everything."</p>
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-primary/20 flex items-center justify-center text-xs font-bold text-primary">MP</div>
                            <div class="ml-3">
                                <div class="font-bold text-foreground text-sm">Michael Patel</div>
                                <div class="text-xs text-muted-foreground">Director, Global International School</div>
                            </div>
                        </div>
                    </div>
                </x-ui-card>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-24 px-4 bg-background">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-16">
                <x-ui.badge variant="secondary" class="mb-3">FAQ</x-ui.badge>
                <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mt-3 mb-4">Frequently Asked Questions</h2>
            </div>
            <div class="space-y-3" x-data="{ active: null }">
                <div class="rounded-xl border border-border overflow-hidden bg-card">
                    <button @click="active = active === 1 ? null : 1" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-accent/5 transition">
                        <span class="font-semibold text-foreground text-sm">How long is the free trial?</span>
                        <svg class="w-5 h-5 text-muted-foreground transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 1" x-transition class="px-6 pb-4 text-muted-foreground text-sm">14 days, completely free. No credit card required. You can explore all features and decide if EduAI is right for your school.</div>
                </div>
                <div class="rounded-xl border border-border overflow-hidden bg-card">
                    <button @click="active = active === 2 ? null : 2" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-accent/5 transition">
                        <span class="font-semibold text-foreground text-sm">Can I migrate from another system?</span>
                        <svg class="w-5 h-5 text-muted-foreground transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 2" x-transition class="px-6 pb-4 text-muted-foreground text-sm">Yes! We offer free data migration for Pro and School plans. Our team will help transfer your existing student, teacher, and fee data.</div>
                </div>
                <div class="rounded-xl border border-border overflow-hidden bg-card">
                    <button @click="active = active === 3 ? null : 3" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-accent/5 transition">
                        <span class="font-semibold text-foreground text-sm">Is my data secure?</span>
                        <svg class="w-5 h-5 text-muted-foreground transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 3" x-transition class="px-6 pb-4 text-muted-foreground text-sm">Absolutely. We use 256-bit SSL encryption, daily automated backups, and SOC 2 compliant infrastructure. Your data is safe with us.</div>
                </div>
                <div class="rounded-xl border border-border overflow-hidden bg-card">
                    <button @click="active = active === 4 ? null : 4" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-accent/5 transition">
                        <span class="font-semibold text-foreground text-sm">Can I cancel anytime?</span>
                        <svg class="w-5 h-5 text-muted-foreground transition-transform duration-300" :class="active === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 4" x-transition class="px-6 pb-4 text-muted-foreground text-sm">Yes, no contracts or commitments. Cancel anytime from your dashboard. You'll keep access until the end of your billing period.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-24 px-4 overflow-hidden" style="background: linear-gradient(135deg, var(--secondary), var(--primary));">
        <div class="absolute inset-0 bg-white/5"></div>
        <div class="max-w-4xl mx-auto text-center relative">
            <h2 class="text-3xl md:text-4xl font-extrabold text-foreground mb-6">Ready to Transform Your School?</h2>
            <p class="text-foreground/80 text-lg mb-8 max-w-2xl mx-auto">Join 500+ schools already using EduAI. Start your free trial today — no credit card required.</p>
            <x-ui.button href="{{ route('register') }}" size="lg" class="bg-white text-foreground hover:bg-white/90">Start Free Trial</x-ui.button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-foreground text-background py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="h-8 w-8 rounded-lg bg-primary flex items-center justify-center">
                            <span class="text-sm font-bold text-primary-foreground">E</span>
                        </div>
                        <span class="ml-2 text-xl font-bold text-white">EduAI</span>
                    </div>
                    <p class="text-sm leading-relaxed text-background/60">Modern school management platform trusted by 500+ schools worldwide.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#features" class="text-background/60 hover:text-white transition">Features</a></li>
                        <li><a href="#pricing" class="text-background/60 hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Integrations</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-background/60 hover:text-white transition">About</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-background/60 hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="text-background/60 hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-background/20 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-background/60">&copy; {{ date('Y') }} EduAI. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-background/60 hover:text-white transition text-sm">Twitter</a>
                    <a href="#" class="text-background/60 hover:text-white transition text-sm">GitHub</a>
                    <a href="#" class="text-background/60 hover:text-white transition text-sm">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
