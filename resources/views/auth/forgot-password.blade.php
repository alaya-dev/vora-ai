<x-guest-layout>
    <!-- Page Heading -->
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ __('auth.forgot_password') }}</h2>
        <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">
            {{ __('auth.forgot_password_desc') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-500/10 hover:shadow-emerald-500/20 transition duration-150">
                {{ __('auth.send_reset_link') }}
            </button>
        </div>

        <!-- Return Link -->
        <div class="text-center pt-4 border-t border-slate-100">
            <a href="{{ route('login') }}" class="font-bold text-sm text-emerald-600 hover:text-emerald-700 transition duration-150">
                &larr; {{ __('Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
