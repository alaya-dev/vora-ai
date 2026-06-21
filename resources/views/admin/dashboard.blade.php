<x-admin-layout>
    <!-- Header/Title -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('messages.dashboard.title') }}</h1>
        <p class="mt-1.5 text-sm text-gray-500">{{ __('messages.dashboard.welcome') }}</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="relative overflow-hidden bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.dashboard.stats.total_users') }}</p>
                    <h3 class="text-3xl font-extrabold text-gray-950 mt-1 tracking-tight">{{ $totalUsers }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <!-- Subtle bottom gradient accent -->
            <div class="absolute bottom-0 inset-x-0 h-1 bg-gradient-to-r from-indigo-500 to-violet-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
        </div>

        <!-- Admins Card -->
        <div class="relative overflow-hidden bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.dashboard.stats.admins') }}</p>
                    <h3 class="text-3xl font-extrabold text-gray-950 mt-1 tracking-tight">{{ $adminCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 inset-x-0 h-1 bg-gradient-to-r from-violet-500 to-fuchsia-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
        </div>

        <!-- Normal Users Card -->
        <div class="relative overflow-hidden bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.dashboard.stats.normal_users') }}</p>
                    <h3 class="text-3xl font-extrabold text-gray-950 mt-1 tracking-tight">{{ $userCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="absolute bottom-0 inset-x-0 h-1 bg-gradient-to-r from-sky-500 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="bg-white border border-gray-200/80 rounded-2xl p-8 shadow-sm">
        <div class="max-w-2xl">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 mb-6">
                <span class="text-xl font-bold">✨</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-2">
                {{ __('messages.dashboard.welcome_back') }}, {{ auth()->user()->name }}!
            </h2>
            <p class="text-gray-500 leading-relaxed mb-6">
                {{ __('messages.dashboard.logged_in_admin') }} {{ __('messages.dashboard.admin_desc') }}
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition duration-150">
                    <svg class="w-4 h-4 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    {{ __('messages.nav.users') }}
                </a>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-100 transition duration-150">
                    <svg class="w-4 h-4 me-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('messages.nav.profile') }}
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>