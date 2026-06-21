<x-admin-layout>
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors mb-3">
            <svg class="w-4 h-4 me-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('users.title') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('users.edit') }}</h1>
        <p class="mt-1.5 text-sm text-gray-500">{{ __('users.form.edit_desc') }}</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-xl bg-white border border-gray-200/80 rounded-2xl p-8 shadow-sm">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('users.form.name') }}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50/50 border @error('name') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
                @error('name')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('users.form.email') }}</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50/50 border @error('email') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
                @error('email')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('users.form.password') }} <span class="text-xs text-gray-400 font-normal">({{ __('users.form.password_help') }})</span>
                </label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="w-full px-4 py-2.5 bg-gray-50/50 border @error('password') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm">
                @error('password')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Field -->
            <div>
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('users.form.role') }}</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2.5 bg-gray-50/50 border @error('role') border-rose-300 focus:ring-rose-500/20 focus:border-rose-500 @else border-gray-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl focus:bg-white focus:ring-2 transition duration-150 text-sm appearance-none">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>{{ __('users.form.user') }}</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>{{ __('users.form.admin') }}</option>
                </select>
                @error('role')
                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition duration-150">
                    {{ __('users.cancel') }}
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                    {{ __('users.form.update') }}
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
