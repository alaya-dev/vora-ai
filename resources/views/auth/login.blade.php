<x-guest-layout>
    <!-- Page title / branding header inside the card -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('messages.auth.login') }}</h2>
        <p class="mt-1 text-sm text-gray-500">{{ __('messages.auth.welcome_back') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('messages.auth.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('email') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('email')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-gray-700">{{ __('messages.auth.password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition duration-150" href="{{ route('password.request') }}">
                        {{ __('messages.auth.forgot_password') }}
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('password') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('password')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" 
                class="w-4.5 h-4.5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500/20 focus:ring-2 focus:border-indigo-600 transition">
            <label for="remember_me" class="ms-2 text-sm font-medium text-gray-600 select-none">{{ __('messages.auth.remember_me') }}</label>
        </div>

        <!-- Submit & Registration Link -->
        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                {{ __('messages.auth.login') }}
            </button>
        </div>

        @if (Route::has('register'))
            <div class="text-center pt-2">
                <p class="text-sm text-gray-500">
                    {{ __('messages.auth.dont_have_account') }} 
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700 transition duration-150">
                        {{ __('messages.auth.register_here') }}
                    </a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>
