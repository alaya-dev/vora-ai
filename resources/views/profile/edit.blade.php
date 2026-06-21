@php
    $layout = auth()->user()->role === 'admin' ? 'admin-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    @if(auth()->user()->role !== 'admin')
        <x-slot name="header">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('messages.nav.profile') }}
            </h2>
        </x-slot>
    @else
        <!-- Admin header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('messages.nav.profile') }}</h1>
            <p class="mt-1.5 text-sm text-gray-500">{{ __('messages.profile.desc') }}</p>
        </div>
    @endif

    <div class="{{ auth()->user()->role !== 'admin' ? 'py-12' : '' }}">
        <div class="max-w-7xl mx-auto {{ auth()->user()->role !== 'admin' ? 'sm:px-6 lg:px-8' : '' }} space-y-6">
            <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-2xl shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-2xl shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if(auth()->user()->role !== 'admin')
                <div class="p-6 sm:p-8 bg-white border border-gray-200/80 rounded-2xl shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-dynamic-component>
