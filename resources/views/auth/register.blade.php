<x-guest-layout>
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">{{ __('auth.register') }}</h2>
        <p class="mt-1 text-sm text-gray-500">{{ __('auth.create_account') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('users.form.name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('name') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('name')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('auth.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('email') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('email')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('auth.password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('password') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('password')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('auth.confirm_password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••"
                class="w-full px-4 py-2.5 bg-gray-50/50 border @error('password_confirmation') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
            @error('password_confirmation')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit & Login Link -->
        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                {{ __('auth.register') }}
            </button>
        </div>

        <div class="text-center pt-2">
            <p class="text-sm text-gray-500">
                {{ __('auth.already_registered') }} 
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700 transition duration-150">
                    {{ __('auth.login') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
