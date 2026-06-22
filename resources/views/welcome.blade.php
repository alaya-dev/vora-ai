<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('landing.seo_title') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: {{ app()->getLocale() === 'ar' ? "'Cairo', sans-serif" : "'Outfit', sans-serif" }};
            }
            .grid-bg {
                background-image: radial-gradient(rgba(16, 185, 129, 0.07) 1px, transparent 0);
                background-size: 24px 24px;
            }
        </style>
    </head>
    <body class="bg-white text-[#0B122C] antialiased min-h-screen relative overflow-x-hidden selection:bg-emerald-500 selection:text-white">
        
        <!-- Subtle network grid background lines -->
        <div class="absolute inset-0 grid-bg opacity-75 pointer-events-none z-0"></div>
        <div class="absolute top-0 left-1/4 right-1/4 h-[500px] bg-gradient-to-b from-emerald-50/40 via-teal-50/20 to-transparent rounded-full filter blur-3xl pointer-events-none z-0"></div>

        <!-- HEADER -->
        <header class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <nav class="flex items-center justify-between py-4 border-b border-slate-100 bg-white/70 backdrop-blur-md rounded-2xl px-4 sm:px-6 shadow-sm">
                <!-- Vora AI Logo -->
                <a href="/" class="flex items-center space-x-2.5 rtl:space-x-reverse">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center shadow-md shadow-emerald-500/10">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4L10 20L13 13L20 10L4 4Z" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight">VORA <span class="text-emerald-500 font-extrabold">AI</span></span>
                </a>

                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8 rtl:space-x-reverse font-semibold text-sm text-slate-600">
                    <a href="#features" class="hover:text-emerald-600 transition">{{ __('landing.features') }}</a>
                    <a href="#pricing" class="hover:text-emerald-600 transition">{{ __('landing.pricing') }}</a>
                    <a href="#about" class="hover:text-emerald-600 transition">{{ __('landing.about') }}</a>
                </div>

                <!-- CTA & Language switcher -->
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <!-- Language switcher dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1.5 rtl:space-x-reverse px-2.5 py-1.5 bg-slate-50 border border-slate-100 rounded-xl hover:bg-slate-100 text-xs font-bold text-slate-600 transition">
                            <span>
                                @if(app()->getLocale() === 'en')
                                    🇬🇧 EN
                                @elseif(app()->getLocale() === 'fr')
                                    🇫🇷 FR
                                @elseif(app()->getLocale() === 'ar')
                                    🇸🇦 AR
                                @endif
                            </span>
                            <svg class="w-3.5 h-3.5 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.outside="open = false"
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

                    <!-- Auth check -->
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold px-4 py-2 bg-[#0B122C] text-white hover:bg-slate-800 rounded-xl transition">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-block text-sm font-bold text-slate-700 hover:text-slate-900 px-3 py-2 transition">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-bold px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl shadow-md shadow-emerald-500/10 hover:shadow-emerald-500/20 transition">
                            {{ __('landing.start_analysis') }}
                        </a>
                    @endauth
                </div>
            </nav>
        </header>

        <!-- HERO SECTION & MAIN INTERACTION -->
        <main class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-24 text-center" x-data="analysisSimulator()">
            <div class="max-w-4xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold tracking-wide uppercase mb-6 border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ __('landing.hero_badge_title') }}
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-[#0B122C] leading-tight">
                    {{ __('landing.title') }}
                </h1>
                <p class="mt-6 text-base sm:text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed">
                    {{ __('landing.subtitle') }}
                </p>

                <!-- Centered AI Input Box -->
                <div class="mt-10 max-w-xl mx-auto" id="analyzer-section">
                    <form @submit.prevent="runAnalysis" class="flex flex-col sm:flex-row gap-3 p-2 bg-white border border-slate-200/80 shadow-xl rounded-2xl">
                        <div class="relative flex-1">
                            <input type="text" x-model="product" placeholder="{{ __('landing.placeholder') }}" 
                                class="w-full px-4 py-3 bg-transparent border-0 focus:ring-0 focus:outline-none text-sm text-[#0B122C] placeholder-slate-400"
                                :disabled="isAnalyzing">
                        </div>
                        <button type="submit" :disabled="isAnalyzing"
                            class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-bold text-sm transition-all shadow-md shadow-emerald-500/10 hover:shadow-emerald-500/20 active:scale-95 disabled:opacity-50">
                            <!-- Lightning Icon / Loader -->
                            <template x-if="!isAnalyzing">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </template>
                            <template x-if="isAnalyzing">
                                <svg class="animate-spin h-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </template>
                            <span x-text="isAnalyzing ? '{{ __('landing.analyzing') }}' : '{{ __('landing.button') }}'"></span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Loader Progress Text -->
            <div x-show="isAnalyzing" class="mt-8 transition-all duration-300" style="display: none;">
                <div class="inline-flex flex-col items-center gap-3 bg-slate-50 border border-slate-100 px-6 py-4 rounded-2xl max-w-sm mx-auto shadow-sm">
                    <span class="text-sm font-semibold text-emerald-600 animate-pulse" x-text="analysisStep"></span>
                    <!-- Progress bar simulated animation -->
                    <div class="w-40 h-1 bg-slate-200 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 animate-ping" style="width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- VISUAL DASHBOARD (BELOW INPUT) -->
            <div x-show="showResult" class="mt-12 max-w-4xl mx-auto transition-all duration-500" 
                x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0">
                
                <!-- Floating Analytics Dashboard Wrapper -->
                <div class="bg-white/80 border border-slate-100 shadow-2xl rounded-3xl p-6 sm:p-8 backdrop-blur-md relative overflow-hidden">
                    <div class="absolute top-0 end-0 w-32 h-32 bg-emerald-400/5 filter blur-2xl rounded-full"></div>
                    
                    <!-- Dashboard Header -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-6 mb-6">
                        <div class="text-start">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ __('landing.product_report') }}</span>
                            <h3 class="text-2xl font-extrabold text-[#0B122C]" x-text="currentProduct"></h3>
                        </div>
                        
                        <!-- Verdict glowing badge -->
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-slate-400">{{ __('landing.verdict') }}:</span>
                            <template x-if="verdict === 'GO'">
                                <span class="inline-flex px-3.5 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm font-extrabold tracking-wider animate-pulse shadow-md shadow-emerald-500/10">
                                    {{ __('GO') }}
                                </span>
                            </template>
                            <template x-if="verdict !== 'GO'">
                                <span class="inline-flex px-3.5 py-1.5 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl text-sm font-extrabold tracking-wider shadow-md shadow-rose-500/5">
                                    {{ __('NO GO') }}
                                </span>
                            </template>
                        </div>
                    </div>

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Demand Score Chart (Radial gauge) -->
                        <div class="bg-slate-50/50 border border-slate-100 rounded-2xl p-5 flex flex-col items-center justify-center">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('landing.demand_score') }}</h4>
                            <div class="relative w-36 h-36 flex items-center justify-center">
                                <!-- Circle Progress SVG -->
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="40" fill="transparent" stroke="#E2E8F0" stroke-width="8"></circle>
                                    <circle cx="50" cy="50" r="40" fill="transparent" 
                                        :stroke="verdict === 'GO' ? '#10B981' : '#F43F5E'" 
                                        stroke-width="8"
                                        stroke-linecap="round"
                                        :stroke-dasharray="251.2"
                                        :stroke-dashoffset="251.2 - (251.2 * demandScore) / 100"
                                        class="transition-all duration-1000 ease-out"></circle>
                                </svg>
                                <div class="absolute text-center">
                                    <span class="text-3xl font-extrabold tracking-tight text-[#0B122C]" x-text="demandScore + '%'"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Profit Margin Breakdown -->
                        <div class="bg-slate-50/50 border border-slate-100 rounded-2xl p-5 flex flex-col justify-between md:col-span-2">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 text-start">{{ __('landing.profit_margin') }}</h4>
                                
                                <!-- Sleek progress bar breakdown -->
                                <div class="w-full h-4 bg-slate-200 rounded-full overflow-hidden flex mb-4">
                                    <div class="h-full bg-slate-400 hover:opacity-90 transition" :style="'width: ' + Math.round((costOfGoods / sellingPrice) * 100) + '%'" title="Cost of Goods"></div>
                                    <div class="h-full bg-teal-400 hover:opacity-90 transition" :style="'width: ' + Math.round((adSpend / sellingPrice) * 100) + '%'" title="Ad Spend"></div>
                                    <div class="h-full bg-indigo-400 hover:opacity-90 transition" :style="'width: ' + Math.round((deliveryFees / sellingPrice) * 100) + '%'" title="Delivery & Fees"></div>
                                    <div class="h-full bg-emerald-500 hover:opacity-90 transition" :style="'width: ' + Math.round((netProfit / sellingPrice) * 100) + '%'" title="Net Profit"></div>
                                </div>
                                
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-start">
                                    <div>
                                        <span class="text-[11px] font-bold text-slate-400 block">{{ __('landing.selling_price') }}</span>
                                        <span class="text-base font-extrabold text-[#0B122C]" x-text="sellingPrice + ' DT'"></span>
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-bold text-slate-400 block">{{ __('landing.cost_goods') }}</span>
                                        <span class="text-sm font-semibold text-slate-500" x-text="costOfGoods + ' DT'"></span>
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-bold text-slate-400 block">{{ __('landing.ad_spend') }}</span>
                                        <span class="text-sm font-semibold text-teal-600" x-text="adSpend + ' DT'"></span>
                                    </div>
                                    <div class="bg-emerald-50/50 p-1.5 rounded-xl border border-emerald-100">
                                        <span class="text-[11px] font-bold text-emerald-700 block">{{ __('landing.net_profit') }}</span>
                                        <span class="text-sm font-extrabold text-emerald-600" x-text="netProfit + ' DT (' + marginPercent + '%)'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Insights -->
                        <div class="bg-slate-50/50 border border-slate-100 rounded-2xl p-5 flex flex-col text-start">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('landing.suppliers') }}</h4>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-emerald-100 text-emerald-700 rounded-lg shrink-0 mt-0.5">
                                        <!-- Map pin -->
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-bold text-slate-400 uppercase block">{{ __('landing.local_wholesale') }}</span>
                                        <span class="text-xs font-bold text-slate-700" x-text="supplierTn"></span>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="p-2 bg-indigo-100 text-indigo-700 rounded-lg shrink-0 mt-0.5">
                                        <!-- Globe / Ship -->
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2a2.5 2.5 0 002.5-2.5V14a2 2 0 012-2h.055M11 20.055V18a2 2 0 00-2-2h-.055M8 8H5a2 2 0 00-2 2v3a2 2 0 002 2h3m10-7h2a2 2 0 012 2v3a2 2 0 01-2 2h-2m-10-7v12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-[11px] font-bold text-slate-400 uppercase block">{{ __('landing.china_import') }}</span>
                                        <span class="text-xs font-bold text-slate-700" x-text="supplierCn"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Market Trend Curve -->
                        <div class="bg-slate-50/50 border border-slate-100 rounded-2xl p-5 flex flex-col text-start md:col-span-2">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">{{ __('landing.market_trend') }}</h4>
                            <div class="w-full h-28 relative">
                                <!-- Area chart graphic dynamic path -->
                                <svg class="w-full h-full" viewBox="0 0 100 30" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#10B981" stop-opacity="0.25" />
                                            <stop offset="100%" stop-color="#10B981" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <!-- Dynamic SVG Area -->
                                    <path :d="`M 0 30 L 0 ${30 - trend[0]/4} L 25 ${30 - trend[1]/4} L 50 ${30 - trend[2]/4} L 75 ${30 - trend[3]/4} L 100 ${30 - trend[4]/4} L 100 30 Z`" fill="url(#chartGradient)"></path>
                                    
                                    <!-- Dynamic SVG Line -->
                                    <path :d="`M 0 ${30 - trend[0]/4} L 25 ${30 - trend[1]/4} L 50 ${30 - trend[2]/4} L 75 ${30 - trend[3]/4} L 100 ${30 - trend[4]/4}`" 
                                        fill="none" 
                                        :stroke="verdict === 'GO' ? '#10B981' : '#F43F5E'" 
                                        stroke-width="2"
                                        stroke-linecap="round"></path>
                                </svg>
                                <div class="flex items-center justify-between text-[10px] font-bold text-slate-400 mt-2">
                                    <span>M-4</span>
                                    <span>M-3</span>
                                    <span>M-2</span>
                                    <span>M-1</span>
                                    <span class="text-emerald-500">{{ __('landing.current') }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <!-- FEATURES SECTION -->
        <section id="features" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-slate-100">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-extrabold tracking-tight text-[#0B122C] sm:text-4xl">
                    {{ __('landing.how_it_works_title') }}
                </h2>
                <p class="mt-4 text-slate-500 leading-relaxed">
                    {{ __('landing.how_it_works_subtitle') }}
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#0B122C]">{{ __('landing.feature_1_title') }}</h3>
                    <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                        {{ __('landing.feature_1_desc') }}
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#0B122C]">{{ __('landing.feature_2_title') }}</h3>
                    <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                        {{ __('landing.feature_2_desc') }}
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#0B122C]">{{ __('landing.feature_3_title') }}</h3>
                    <p class="mt-2 text-slate-500 text-sm leading-relaxed">
                        {{ __('landing.feature_3_desc') }}
                    </p>
                </div>
            </div>
        </section>

        <!-- PRICING SECTION -->
        <section id="pricing" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-slate-100">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-extrabold tracking-tight text-[#0B122C] sm:text-4xl">
                    {{ __('landing.pricing_title') }}
                </h2>
                <p class="mt-4 text-slate-500 leading-relaxed">
                    {{ __('landing.pricing_subtitle') }}
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto">
                <!-- Plan 1 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ __('landing.plan_free_title') }}</h3>
                        <p class="text-slate-400 text-xs mt-1">{{ __('landing.plan_free_subtitle') }}</p>
                        <div class="mt-4">
                            <span class="text-4xl font-extrabold text-[#0B122C]">0 DT</span>
                            <span class="text-slate-400 text-sm">/ {{ __('landing.month') }}</span>
                        </div>
                        <ul class="mt-6 space-y-3.5 text-sm text-slate-500 text-start">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_free_feature_1') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_free_feature_2') }}</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}" class="mt-8 block w-full text-center py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-sm font-bold rounded-xl transition">
                        {{ __('landing.plan_free_cta') }}
                    </a>
                </div>

                <!-- Plan 2 (Pro - Highlighted) -->
                <div class="bg-white p-8 rounded-2xl border-2 border-emerald-500 shadow-xl flex flex-col justify-between relative transform lg:-translate-y-2">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3 py-1 bg-emerald-500 text-white rounded-full text-[10px] font-bold tracking-wider uppercase">
                        {{ __('landing.plan_pro_popular') }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ __('landing.plan_pro_title') }}</h3>
                        <p class="text-slate-400 text-xs mt-1">{{ __('landing.plan_pro_subtitle') }}</p>
                        <div class="mt-4">
                            <span class="text-4xl font-extrabold text-[#0B122C]">59 DT</span>
                            <span class="text-slate-400 text-sm">/ {{ __('landing.month') }}</span>
                        </div>
                        <ul class="mt-6 space-y-3.5 text-sm text-slate-500 text-start">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-semibold text-slate-700">{{ __('landing.plan_pro_feature_1') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_pro_feature_2') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_pro_feature_3') }}</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}" class="mt-8 block w-full text-center py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl shadow-md shadow-emerald-500/10 transition">
                        {{ __('landing.plan_pro_cta') }}
                    </a>
                </div>

                <!-- Plan 3 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ __('landing.plan_ent_title') }}</h3>
                        <p class="text-slate-400 text-xs mt-1">{{ __('landing.plan_ent_subtitle') }}</p>
                        <div class="mt-4">
                            <span class="text-4xl font-extrabold text-[#0B122C]">199 DT</span>
                            <span class="text-slate-400 text-sm">/ {{ __('landing.month') }}</span>
                        </div>
                        <ul class="mt-6 space-y-3.5 text-sm text-slate-500 text-start">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_ent_feature_1') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ __('landing.plan_ent_feature_2') }}</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}" class="mt-8 block w-full text-center py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-sm font-bold rounded-xl transition">
                        {{ __('landing.plan_ent_cta') }}
                    </a>
                </div>
            </div>
        </section>

        <!-- ABOUT SECTION -->
        <section id="about" class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-slate-100 bg-slate-50/50 rounded-3xl mb-12">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-[#0B122C]">{{ __('landing.about_title') }}</h2>
                <p class="mt-4 text-slate-500 leading-relaxed text-sm">
                    {{ __('landing.about_desc') }}
                </p>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="relative z-10 border-t border-slate-100 bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-slate-400 text-sm">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4L10 20L13 13L20 10L4 4Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-700">Vora AI</span>
                </div>
                <div>
                    &copy; 2026 Vora AI. {{ __('landing.footer_desc') }}
                </div>
            </div>
        </footer>

        <!-- SIMULATOR JAVASCRIPT LOGIC -->
        <script>
            function analysisSimulator() {
                return {
                    product: '',
                    isAnalyzing: false,
                    analysisStep: '',
                    showResult: true,
                    
                    // Dashboard variables
                    currentProduct: 'Friteuse sans huile',
                    verdict: 'GO',
                    demandScore: 92,
                    sellingPrice: 249,
                    costOfGoods: 95,
                    adSpend: 35,
                    deliveryFees: 12,
                    netProfit: 107,
                    marginPercent: 43,
                    supplierTn: 'Grossiste Charguia (95 DT/u)',
                    supplierCn: 'Alibaba Verified (18.5 USD/u)',
                    trend: [30, 45, 60, 75, 92],
                    
                    init() {
                        const locale = '{{ app()->getLocale() }}';
                        if (locale === 'en') {
                            this.currentProduct = 'Air Fryer';
                            this.supplierTn = 'Charguia Wholesaler (95 TND/u)';
                            this.supplierCn = 'Alibaba Verified (18.5 USD/u)';
                        } else if (locale === 'ar') {
                            this.currentProduct = 'مقلاة بدون زيت';
                            this.supplierTn = 'تاجر جملة الشرقية (95 د.ت)';
                            this.supplierCn = 'موقع علي بابا (18.5 دولار)';
                        }
                    },

                    runAnalysis() {
                        if (!this.product.trim()) return;
                        
                        this.isAnalyzing = true;
                        this.showResult = false;
                        
                        const steps = {
                            fr: [
                                'Analyse des volumes de recherche Jumia & Google...',
                                'Calcul de la marge nette estimée en Tunisie...',
                                'Évaluation de la concurrence locale...',
                                'Recherche de fournisseurs potentiels...',
                                'Génération du verdict GO / NO GO...'
                            ],
                            en: [
                                'Analyzing Jumia & Google search volumes...',
                                'Calculating estimated net margin in Tunisia...',
                                'Evaluating local competitor strength...',
                                'Locating potential supplier channels...',
                                'Generating automated GO / NO GO verdict...'
                            ],
                            ar: [
                                'تحليل حجم البحث في جوميا وجوجل في تونس...',
                                'حساب صافي الهامش المتوقع في السوق المحلي...',
                                'تقييم شدة المنافسة المحلية...',
                                'البحث عن الموردين المتاحين...',
                                'توليد القرار النهائي للعلامة التجارية...'
                            ]
                        };
                        
                        const currentSteps = steps['{{ app()->getLocale() }}'] || steps['fr'];
                        let stepIndex = 0;
                        this.analysisStep = currentSteps[0];
                        
                        const interval = setInterval(() => {
                            stepIndex++;
                            if (stepIndex < currentSteps.length) {
                                this.analysisStep = currentSteps[stepIndex];
                            } else {
                                clearInterval(interval);
                                this.finishAnalysis();
                            }
                        }, 400);
                    },
                    
                    finishAnalysis() {
                        this.isAnalyzing = false;
                        this.showResult = true;
                        this.currentProduct = this.product;
                        
                        const term = this.product.toLowerCase().trim();
                        
                        if (term.includes('spinner') || term.includes('fidget') || term.includes('سبينر')) {
                            this.verdict = 'NO_GO';
                            this.demandScore = 18;
                            this.sellingPrice = 15;
                            this.costOfGoods = 5;
                            this.adSpend = 8;
                            this.deliveryFees = 7;
                            this.netProfit = -5;
                            this.marginPercent = -33;
                            this.supplierTn = 'Stock Invendu (Sousse)';
                            this.supplierCn = 'Guangzhou Plastics (0.15 USD/u)';
                            this.trend = [95, 75, 45, 25, 18];
                        } else if (term.includes('montre') || term.includes('watch') || term.includes('ساعة')) {
                            this.verdict = 'GO';
                            this.demandScore = 86;
                            this.sellingPrice = 129;
                            this.costOfGoods = 42;
                            this.adSpend = 25;
                            this.deliveryFees = 10;
                            this.netProfit = 52;
                            this.marginPercent = 40;
                            this.supplierTn = 'Sfax Importateurs (42 DT/u)';
                            this.supplierCn = 'Shenzhen Wearables (6.5 USD/u)';
                            this.trend = [40, 52, 45, 68, 86];
                        } else {
                            const length = this.product.length;
                            this.demandScore = Math.min(98, 45 + (length * 3) % 45 + Math.floor(Math.random() * 8));
                            
                            this.sellingPrice = 49 + (length * 7) % 180 + Math.floor(Math.random() * 15);
                            this.costOfGoods = Math.round(this.sellingPrice * 0.35);
                            this.adSpend = Math.round(this.sellingPrice * 0.18);
                            this.deliveryFees = 12;
                            this.netProfit = this.sellingPrice - this.costOfGoods - this.adSpend - this.deliveryFees;
                            this.marginPercent = Math.round((this.netProfit / this.sellingPrice) * 100);
                            
                            this.verdict = (this.netProfit > 18 && this.demandScore > 62) ? 'GO' : 'NO_GO';
                            
                            // Adjust translations for generic supplier responses
                            const locale = '{{ app()->getLocale() }}';
                            if (locale === 'en') {
                                this.supplierTn = 'Local Wholesaler (Tunisia)';
                                this.supplierCn = 'Alibaba Verified Supplier';
                            } else if (locale === 'ar') {
                                this.supplierTn = 'تاجر جملة محلي (تونس)';
                                this.supplierCn = 'مورد معتمد من علي بابا';
                            } else {
                                this.supplierTn = 'Grossiste local (Tunisie)';
                                this.supplierCn = 'Fournisseur certifié Alibaba';
                            }
                            
                            const baseTrend = 20 + Math.floor(Math.random() * 20);
                            this.trend = [
                                baseTrend,
                                baseTrend + 10 + Math.floor(Math.random() * 10),
                                baseTrend + 5 + Math.floor(Math.random() * 15),
                                baseTrend + 25 + Math.floor(Math.random() * 10),
                                this.demandScore
                            ];
                        }
                        this.product = '';
                    }
                }
            }
        </script>
    </body>
</html>
