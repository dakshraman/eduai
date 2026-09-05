<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduAI — Modern School Management SaaS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81' },
                        secondary: { 50:'#f5f3ff',100:'#ede9fe',200:'#ddd6fe',300:'#c4b5fd',400:'#a78bfa',500:'#8b5cf6',600:'#7c3aed',700:'#6d28d9',800:'#5b21b6',900:'#4c1d95' },
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .gradient-hero { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); }
        .gradient-text { background: linear-gradient(135deg, #4f46e5, #7c3aed); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
    </style>
</head>
<body class="bg-white">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-md z-50 border-b border-gray-100" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">E</span>
                    </div>
                    <span class="ml-2 text-xl font-bold text-gray-900">EduAI</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-primary-600 transition font-medium">Features</a>
                    <a href="#pricing" class="text-gray-600 hover:text-primary-600 transition font-medium">Pricing</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-primary-600 transition font-medium">Testimonials</a>
                    <a href="#faq" class="text-gray-600 hover:text-primary-600 transition font-medium">FAQ</a>
                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Login</a>
                    <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-lg font-semibold transition">Start Free Trial</a>
                </div>
                <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
        <!-- Mobile menu -->
        <div x-show="mobileOpen" x-transition class="md:hidden bg-white border-t border-gray-100 px-4 pb-4">
            <a href="#features" class="block py-3 text-gray-600 font-medium">Features</a>
            <a href="#pricing" class="block py-3 text-gray-600 font-medium">Pricing</a>
            <a href="#testimonials" class="block py-3 text-gray-600 font-medium">Testimonials</a>
            <a href="#faq" class="block py-3 text-gray-600 font-medium">FAQ</a>
            <hr class="my-2">
            <a href="{{ route('login') }}" class="block py-3 text-primary-600 font-semibold">Login</a>
            <a href="{{ route('register') }}" class="block mt-2 bg-primary-600 text-white text-center py-3 rounded-lg font-semibold">Start Free Trial</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="gradient-hero pt-32 pb-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-96 h-96 bg-purple-300 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto relative">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center bg-white/15 backdrop-blur-sm rounded-full px-4 py-1.5 mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                        <span class="text-white/90 text-sm font-medium">Trusted by 500+ schools worldwide</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Modern School Management <span class="text-purple-200">Made Simple</span>
                    </h1>
                    <p class="text-lg text-white/80 mb-8 leading-relaxed max-w-lg">
                        Streamline your school operations with EduAI — the all-in-one platform for student management, attendance, fees, exams, and more. Setup in minutes, not months.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-primary-700 hover:bg-gray-50 px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                            Start Free — No Card Needed
                        </a>
                        <a href="#features" class="border-2 border-white/30 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition">
                            See Features
                        </a>
                    </div>
                    <p class="text-white/60 text-sm mt-4">14-day free trial · No credit card required · Cancel anytime</p>
                </div>
                <div class="hidden lg:block animate-float">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-white rounded-xl p-4">
                                <div class="text-3xl font-bold text-primary-600">2,847</div>
                                <div class="text-gray-500 text-sm">Active Students</div>
                            </div>
                            <div class="bg-white rounded-xl p-4">
                                <div class="text-3xl font-bold text-green-600">98.5%</div>
                                <div class="text-gray-500 text-sm">Attendance Rate</div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-600">Fee Collection</span>
                                <span class="text-sm font-bold text-primary-600">$124,500</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="bg-white py-12 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">500+</div>
                    <div class="text-gray-500 mt-1">Schools</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">50K+</div>
                    <div class="text-gray-500 mt-1">Students</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">99.9%</div>
                    <div class="text-gray-500 mt-1">Uptime</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-extrabold gradient-text">24/7</div>
                    <div class="text-gray-500 mt-1">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Features</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-4">Everything Your School Needs</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">One powerful platform to manage students, teachers, fees, exams, attendance, and communication — all in one place.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Student Management</h3>
                    <p class="text-gray-500 leading-relaxed">Complete student profiles with enrollment, class assignment, roll numbers, and admission tracking.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Attendance Tracking</h3>
                    <p class="text-gray-500 leading-relaxed">Quick daily attendance with class-wise marking, reports, and parent notifications.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fee Management</h3>
                    <p class="text-gray-500 leading-relaxed">Flexible fee structures, online payments, due date tracking, and automated receipts.</p>
                </div>
                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Exams & Results</h3>
                    <p class="text-gray-500 leading-relaxed">Create exams, enter marks, generate report cards, and analyze student performance.</p>
                </div>
                <!-- Feature 5 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Class & Section</h3>
                    <p class="text-gray-500 leading-relaxed">Organize classes, sections, subjects, and teacher assignments with ease.</p>
                </div>
                <!-- Feature 6 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Notices & Events</h3>
                    <p class="text-gray-500 leading-relaxed">Send notices to students/parents, manage school events, and holiday calendars.</p>
                </div>
                <!-- Feature 7 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Teacher Portal</h3>
                    <p class="text-gray-500 leading-relaxed">Dedicated teacher profiles, class management, and attendance marking tools.</p>
                </div>
                <!-- Feature 8 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Analytics Dashboard</h3>
                    <p class="text-gray-500 leading-relaxed">Real-time insights on enrollment, fees, attendance, and academic performance.</p>
                </div>
                <!-- Feature 9 -->
                <div class="bg-white rounded-2xl p-8 card-hover border border-gray-100">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Secure & Reliable</h3>
                    <p class="text-gray-500 leading-relaxed">Enterprise-grade security with 99.9% uptime, automatic backups, and SSL encryption.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">How It Works</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-4">Get Started in 3 Simple Steps</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Create Your School</h3>
                    <p class="text-gray-500">Sign up and set up your school profile with basic details in under 2 minutes.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Add Students & Teachers</h3>
                    <p class="text-gray-500">Import your data or add students, teachers, and classes manually.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-6">3</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Start Managing</h3>
                    <p class="text-gray-500">Track attendance, manage fees, conduct exams — everything from one dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Pricing</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-4">Simple, Transparent Pricing</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">No hidden fees. Start free, upgrade when you're ready.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Starter -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 card-hover">
                    <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Starter</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-gray-900">$29</span>
                        <span class="text-gray-500 ml-2">/month</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-8">Perfect for small schools getting started.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Up to 200 students</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>5 teacher accounts</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All core features</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Email support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center border-2 border-primary-600 text-primary-600 hover:bg-primary-50 py-3 rounded-xl font-bold transition">Get Started</a>
                </div>
                <!-- Pro -->
                <div class="bg-white rounded-2xl p-8 border-2 border-primary-600 card-hover relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary-600 text-white text-xs font-bold px-4 py-1 rounded-full">MOST POPULAR</div>
                    <div class="text-sm font-semibold text-primary-600 uppercase tracking-wider mb-2">Pro</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-gray-900">$79</span>
                        <span class="text-gray-500 ml-2">/month</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-8">For growing schools with more needs.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Up to 1,000 students</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>25 teacher accounts</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All features + reports</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Priority support</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Custom branding</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center bg-primary-600 hover:bg-primary-700 text-white py-3 rounded-xl font-bold transition">Get Started</a>
                </div>
                <!-- School -->
                <div class="bg-white rounded-2xl p-8 border border-gray-200 card-hover">
                    <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">School</div>
                    <div class="flex items-baseline mb-6">
                        <span class="text-4xl font-extrabold text-gray-900">$199</span>
                        <span class="text-gray-500 ml-2">/month</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-8">For large institutions with full needs.</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Unlimited students</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Unlimited teachers</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>All features + API</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>Dedicated support</li>
                        <li class="flex items-center text-gray-600"><svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>On-premise option</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center border-2 border-primary-600 text-primary-600 hover:bg-primary-50 py-3 rounded-xl font-bold transition">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Testimonials</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-4">Loved by Schools Worldwide</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">★★★★★</div>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"EduAI replaced 4 different tools we were using. The attendance tracking alone saved us 2 hours every day. Setup was incredibly easy."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold">JR</div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">James Robertson</div>
                            <div class="text-sm text-gray-500">Principal, Oakridge Academy</div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">★★★★★</div>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"The fee management system is brilliant. Parents can pay online, we get instant notifications, and the reports are automatically generated."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold">SK</div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">Sarah Kim</div>
                            <div class="text-sm text-gray-500">Admin Director, Sunrise School</div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">★★★★★</div>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"We manage 1,200 students across 3 campuses from one dashboard. The analytics give us real-time insights into everything."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold">MP</div>
                        <div class="ml-4">
                            <div class="font-bold text-gray-900">Michael Patel</div>
                            <div class="text-sm text-gray-500">Director, Global International School</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 px-4 bg-gray-50">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">FAQ</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-3 mb-4">Frequently Asked Questions</h2>
            </div>
            <div class="space-y-4" x-data="{ active: null }">
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = active === 1 ? null : 1" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold text-gray-900">How long is the free trial?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-4 text-gray-500">14 days, completely free. No credit card required. You can explore all features and decide if EduAI is right for your school.</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = active === 2 ? null : 2" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Can I migrate from another system?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-4 text-gray-500">Yes! We offer free data migration for Pro and School plans. Our team will help transfer your existing student, teacher, and fee data.</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = active === 3 ? null : 3" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Is my data secure?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-4 text-gray-500">Absolutely. We use 256-bit SSL encryption, daily automated backups, and SOC 2 compliant infrastructure. Your data is safe with us.</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = active === 4 ? null : 4" class="w-full px-6 py-4 text-left flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Can I cancel anytime?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="active === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-6 pb-4 text-gray-500">Yes, no contracts or commitments. Cancel anytime from your dashboard. You'll keep access until the end of your billing period.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-hero py-20 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Ready to Transform Your School?</h2>
            <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">Join 500+ schools already using EduAI. Start your free trial today — no credit card required.</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-primary-700 hover:bg-gray-50 px-10 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                Start Free Trial
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">E</span>
                        </div>
                        <span class="ml-2 text-xl font-bold text-white">EduAI</span>
                    </div>
                    <p class="text-sm leading-relaxed">Modern school management platform trusted by 500+ schools worldwide.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">Integrations</a></li>
                        <li><a href="#" class="hover:text-white transition">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; {{ date('Y') }} EduAI. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Twitter</a>
                    <a href="#" class="hover:text-white transition">GitHub</a>
                    <a href="#" class="hover:text-white transition">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
