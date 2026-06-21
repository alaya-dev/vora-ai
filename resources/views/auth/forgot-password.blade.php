<x-guest-layout>
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('auth.forgot_password') }}</h2>
        <p class="mt-1 text-sm text-gray-500 leading-relaxed">
            {{ __('auth.forgot_password_desc') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('auth.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('email') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('email')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit & Return Link -->
        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                {{ __('auth.send_reset_link') }}
            </button>
        </div>

        <div class="text-center pt-2">
            <a href="{{ route('login') }}" class="font-semibold text-sm text-indigo-600 hover:text-indigo-700 transition duration-150">
                &larr; {{ __('auth.login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
