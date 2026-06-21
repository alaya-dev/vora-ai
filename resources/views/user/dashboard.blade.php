<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('dashboard.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Modern Card -->
            <div class="bg-white border border-gray-200/80 overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-8 sm:p-10">
                    <div class="max-w-xl">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 mb-6">
                            <span class="text-xl">👋</span>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ __('dashboard.welcome_back') }}, {{ auth()->user()->name }}!
                        </h3>
                        
                        <p class="text-gray-500 leading-relaxed mb-6">
                            {{ __('dashboard.logged_in_user') }} {{ __('dashboard.user_desc') }}
                        </p>

                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition duration-150">
                                <svg class="w-4 h-4 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('profile.title') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>