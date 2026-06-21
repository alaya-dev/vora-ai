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
    <body class="text-gray-900 antialiased bg-slate-50/50">
        <!-- Floating Language Switcher for Guest Pages -->
        <div class="fixed top-4 end-4 z-50" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center space-x-1.5 rtl:space-x-reverse px-3 py-1.5 bg-white border border-gray-200/80 rounded-xl hover:bg-gray-50 text-sm font-medium text-gray-600 shadow-sm transition duration-150">
                <span>
                    @if(app()->getLocale() === 'en')
                        🇬🇧 EN
                    @elseif(app()->getLocale() === 'fr')
                        🇫🇷 FR
                    @elseif(app()->getLocale() === 'ar')
                        🇸🇦 AR
                    @endif
                </span>
                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                class="absolute end-0 mt-2 w-36 bg-white border border-gray-200 rounded-xl shadow-xl z-50 py-1 overflow-hidden"
                style="display: none;">
                <a href="{{ route('lang.switch', 'en') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ app()->getLocale() === 'en' ? 'font-bold bg-indigo-50/50 text-indigo-600' : '' }}">
                    <span class="me-2">🇬🇧</span> English
                </a>
                <a href="{{ route('lang.switch', 'fr') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ app()->getLocale() === 'fr' ? 'font-bold bg-indigo-50/50 text-indigo-600' : '' }}">
                    <span class="me-2">🇫🇷</span> Français
                </a>
                <a href="{{ route('lang.switch', 'ar') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors {{ app()->getLocale() === 'ar' ? 'font-bold bg-indigo-50/50 text-indigo-600' : '' }}">
                    <span class="me-2">🇸🇦</span> العربية
                </a>
            </div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50/50">
            <div class="mb-8">
                <a href="/" class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-4xl font-extrabold bg-gradient-to-r from-violet-600 to-indigo-600 bg-clip-text text-transparent">Vora AI</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white border border-gray-200/60 shadow-xl shadow-slate-100 sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
