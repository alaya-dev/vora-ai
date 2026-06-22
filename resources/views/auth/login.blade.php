<x-guest-layout>
    <!-- Page Heading -->
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ __('auth_ui.connexion') }}</h2>
        <p class="mt-1.5 text-sm text-slate-500">{{ __('Welcome back') }}</p>
    </div>

    <!-- Tabs -->
    <div class="flex border border-slate-100 mb-6 p-1 bg-slate-50 rounded-xl">
        <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-xs sm:text-sm font-bold rounded-lg bg-white text-slate-900 shadow-sm transition duration-150">
            {{ __('auth_ui.connexion') }}
        </a>
        <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-xs sm:text-sm font-bold rounded-lg text-slate-500 hover:text-slate-900 transition duration-150">
            {{ __('auth_ui.create_account') }}
        </a>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">{{ __('auth_ui.email_professional') }}</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 ps-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Mail Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="name@company.com"
                    class="w-full ps-11 pe-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-600 @enderror rounded-xl focus:bg-white focus:ring-4 transition duration-150 text-sm">
            </div>
            @error('email')
                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ showPassword: false }">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">{{ __('auth_ui.password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition duration-150" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 ps-3.5 flex items-center pointer-events-none text-slate-400">
                    <!-- Lock Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full ps-11 pe-12 py-2.5 bg-slate-50 border @error('password') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-600 @enderror rounded-xl focus:bg-white focus:ring-4 transition duration-150 text-sm">
                
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 end-0 pe-3.5 flex items-center text-slate-400 hover:text-slate-600 transition">
                    <!-- Show/Hide Icons -->
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="w-4 h-4 rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500/20 focus:ring-2 focus:border-emerald-600 transition">
                <label for="remember_me" class="ms-2 text-sm font-semibold text-slate-600 select-none">{{ __('Remember me') }}</label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-500/10 hover:shadow-emerald-500/20 transition duration-150">
                {{ __('auth_ui.login_secure') }}
            </button>
        </div>

        <!-- Social Logins -->
        <div class="pt-4 text-center">
            <p class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-3">{{ __('auth_ui.or_continue_with') }}</p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition text-sm font-semibold">
                    <!-- Google Icon -->
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#EA4335" d="M12.24 10.285V14.4h6.887c-.275 1.565-1.88 4.604-6.887 4.604-4.33 0-7.866-3.577-7.866-8s3.536-8 7.866-8c2.46 0 4.105 1.025 5.047 1.926l3.245-3.125C18.465 2.021 15.65 1 12.24 1 6.033 1 1 6.033 1 12.24s5.033 11.24 11.24 11.24c6.478 0 10.793-4.537 10.793-10.986 0-.74-.08-1.305-.177-1.785H12.24z"/>
                    </svg>
                    Google
                </button>
                <button type="button" class="flex-1 flex items-center justify-center gap-2 px-4 py-2 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition text-sm font-semibold">
                    <!-- Facebook Icon -->
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                    </svg>
                    Facebook
                </button>
            </div>
        </div>

        <!-- Extra Bottom Link and Language Switcher -->
        <div class="text-center pt-4 border-t border-slate-100 flex flex-col items-center gap-3">
            @if (Route::has('register'))
                <p class="text-sm text-slate-500">
                    {{ __('auth_ui.dont_have_account_question') }} 
                    <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition duration-150">
                        {{ __('Register') }}
                    </a>
                </p>
            @endif

            <!-- Mini Language Selector FR | AR | EN -->
            <div class="flex items-center justify-center gap-2 text-xs font-bold text-slate-400">
                <a href="{{ route('lang.switch', 'fr') }}" class="hover:text-slate-600 transition {{ app()->getLocale() === 'fr' ? 'text-emerald-600' : '' }}">FR</a>
                <span>|</span>
                <a href="{{ route('lang.switch', 'ar') }}" class="hover:text-slate-600 transition {{ app()->getLocale() === 'ar' ? 'text-emerald-600' : '' }}">AR</a>
                <span>|</span>
                <a href="{{ route('lang.switch', 'en') }}" class="hover:text-slate-600 transition {{ app()->getLocale() === 'en' ? 'text-emerald-600' : '' }}">EN</a>
            </div>
        </div>
    </form>
</x-guest-layout>
