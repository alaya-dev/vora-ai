<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vora AI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: {{ app()->getLocale() === 'ar' ? "'Cairo', sans-serif" : "'Outfit', sans-serif" }};
            }
        </style>
    </head>
    <body class="text-slate-900 antialiased bg-slate-50 min-h-screen">
        <div class="min-h-screen flex flex-col md:flex-row">
            
            <!-- LEFT SIDE (BRANDING) -->
            <div class="relative hidden md:flex md:w-5/12 lg:w-1/2 bg-[#0B122C] text-white overflow-hidden flex-col justify-between p-12 lg:p-20">
                <!-- Subtle animated data network lines (Background) -->
                <div class="absolute inset-0 opacity-15 pointer-events-none">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse">
                                <path d="M 50 0 L 0 0 0 50" fill="none" stroke="#1E293B" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                        <!-- Pulsing nodes -->
                        <circle cx="120" cy="180" r="3.5" fill="#10B981" class="animate-pulse" />
                        <circle cx="280" cy="240" r="4.5" fill="#0D9488" class="animate-pulse" style="animation-delay: 1s;" />
                        <circle cx="440" cy="380" r="3.5" fill="#10B981" class="animate-pulse" style="animation-delay: 2s;" />
                        <circle cx="200" cy="480" r="5" fill="#0D9488" class="animate-pulse" style="animation-delay: 1.5s;" />
                    </svg>
                </div>
                
                <!-- Light map outline of Tunisia integrated into background -->
                <div class="absolute inset-y-0 right-0 w-3/4 opacity-15 pointer-events-none flex items-center justify-end">
                    <svg viewBox="0 0 300 600" class="h-full w-auto text-emerald-400/80" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M120,40 C140,30 160,40 180,35 C200,30 210,40 220,50 C230,60 210,80 200,90 C190,100 180,110 180,120 C180,130 170,140 160,150 C150,160 140,170 145,185 C150,200 160,210 165,220 C170,230 175,245 160,260 C145,275 140,290 135,305 C130,320 120,335 115,350 C110,365 115,380 120,395 C125,410 130,425 125,440 C120,455 110,470 100,480 C90,490 85,505 80,520 C75,535 70,550 60,565 C50,580 40,590 35,595 L30,600" stroke-dasharray="8 4" />
                        <!-- Tunis glowing badge -->
                        <circle cx="190" cy="70" r="8" fill="#10B981" class="animate-ping" style="animation-duration: 3s;" />
                        <circle cx="190" cy="70" r="4.5" fill="#10B981" />
                    </svg>
                </div>

                <!-- Logo -->
                <div class="relative z-10">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg class="w-5.5 h-5.5 text-[#0B122C]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4L10 20L13 13L20 10L4 4Z" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-white">VORA <span class="text-emerald-400 font-extrabold">AI</span></span>
                    </a>
                </div>

                <!-- Slogan -->
                <div class="relative z-10 my-auto max-w-md space-y-4">
                    <span class="inline-flex px-3 py-1 bg-emerald-500/10 text-emerald-400 rounded-full text-xs font-semibold tracking-wider uppercase">
                        Vora E-Commerce OS
                    </span>
                    <h1 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight text-white">
                        {{ __('auth_ui.slogan') }}
                    </h1>
                    <p class="text-slate-400 text-sm font-light leading-relaxed">
                        {{ __('landing.subtitle') }}
                    </p>
                </div>

                <!-- Version Info -->
                <div class="relative z-10 text-xs text-slate-500">
                    &copy; 2026 Vora AI. {{ __('landing.footer_desc') }}
                </div>
            </div>

            <!-- RIGHT SIDE (FORM PANEL) -->
            <div class="flex-1 bg-white flex flex-col justify-center items-center p-6 sm:p-12 lg:p-20 relative min-h-screen">
                
                <!-- Floating Language Switcher for Guest Pages inside RIGHT PANEL -->
                <div class="absolute top-6 end-8 z-50" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center space-x-1.5 rtl:space-x-reverse px-3 py-1.5 bg-slate-50 border border-slate-200/80 rounded-xl hover:bg-slate-100 text-xs font-bold text-slate-600 transition duration-150">
                        <span>
                            @if(app()->getLocale() === 'en')
                                🇬🇧 EN
                            @elseif(app()->getLocale() === 'fr')
                                🇫🇷 FR
                            @elseif(app()->getLocale() === 'ar')
                                🇸🇦 AR
                            @endif
                        </span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute end-0 mt-2 w-32 bg-white border border-slate-200 rounded-xl shadow-xl z-50 py-1 overflow-hidden"
                        style="display: none;">
                        <a href="{{ route('lang.switch', 'en') }}" class="flex items-center px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 hover:text-emerald-600 transition-colors {{ app()->getLocale() === 'en' ? 'font-bold bg-slate-50 text-emerald-600' : '' }}">
                            <span class="me-2">🇬🇧</span> English
                        </a>
                        <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 hover:text-emerald-600 transition-colors {{ app()->getLocale() === 'fr' ? 'font-bold bg-slate-50 text-emerald-600' : '' }}">
                            <span class="me-2">🇫🇷</span> Français
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 hover:text-emerald-600 transition-colors {{ app()->getLocale() === 'ar' ? 'font-bold bg-slate-50 text-emerald-600' : '' }}">
                            <span class="me-2">🇸🇦</span> العربية
                        </a>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="w-full max-w-md">
                    <!-- Logo for Mobile (visible only on small screens) -->
                    <div class="flex md:hidden items-center justify-center mb-8 gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/10">
                            <svg class="w-5 h-5 stroke-[#0B122C]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4L10 20L13 13L20 10L4 4Z" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">VORA <span class="text-emerald-500 font-extrabold">AI</span></span>
                    </div>

                    {{ $slot }}
                </div>

            </div>

        </div>
    </body>
</html>
