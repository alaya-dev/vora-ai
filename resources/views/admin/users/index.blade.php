<x-admin-layout>
    <div x-data="{ showDeleteModal: false, deleteAction: '', userName: '' }">
        <!-- Header & Action Button -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ __('messages.users.title') }}</h1>
                <p class="mt-1.5 text-sm text-gray-500">{{ __('messages.users.desc') }}</p>
            </div>
            
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition duration-150">
                <svg class="w-5 h-5 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                {{ __('messages.users.add') }}
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white border border-gray-200/80 rounded-2xl p-5 mb-6 shadow-sm">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 start-0 ps-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('messages.users.search_placeholder') }}"
                        class="w-full ps-11 pe-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition duration-150 text-sm">
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold rounded-xl transition duration-150">
                    {{ __('messages.users.search') }}
                </button>
                @if($search)
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition duration-150">
                        {{ __('messages.users.cancel') }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Users Table Card -->
        <div class="bg-white border border-gray-200/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-start border-collapse">
                    <thead>
                        <tr class="bg-gray-50/75 border-b border-gray-200/80">
                            <th class="px-6 py-4 text-start text-xs font-semibold text-gray-400 uppercase tracking-wider w-16">ID</th>
                            <th class="px-6 py-4 text-start text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.users.table.name') }}</th>
                            <th class="px-6 py-4 text-start text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.users.table.email') }}</th>
                            <th class="px-6 py-4 text-start text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.users.table.role') }}</th>
                            <th class="px-6 py-4 text-start text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ __('messages.users.table.created_at') }}</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider w-36">{{ __('messages.users.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/40 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">
                                    #{{ $user->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-violet-50 text-violet-700 border border-violet-200/50">
                                            👑 {{ __('messages.users.form.admin') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200/50">
                                            👤 {{ __('messages.users.form.user') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2.5 rtl:space-x-reverse">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="{{ __('messages.users.edit') }}">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <!-- Delete -->
                                        @if(auth()->id() !== $user->id)
                                            <button type="button" 
                                                @click="userName = '{{ addslashes($user->name) }}'; deleteAction = '{{ route('admin.users.destroy', $user) }}'; showDeleteModal = true;"
                                                class="p-1.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" 
                                                title="{{ __('messages.users.delete') }}">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @else
                                            <span class="p-1.5 text-gray-200 cursor-not-allowed" title="{{ __('messages.alerts.self_delete') }}">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span>{{ __('messages.users.no_users') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <!-- Alpine.js Delete Confirmation Modal -->
        <div x-show="showDeleteModal" 
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4" 
            style="display: none;"
            role="dialog" 
            aria-modal="true">
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm transition-opacity" 
                x-show="showDeleteModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>

            <!-- Modal Content -->
            <div class="bg-white border border-gray-200/80 rounded-2xl overflow-hidden shadow-2xl max-w-md w-full z-10 p-6 transform transition-all"
                x-show="showDeleteModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4 sm:translate-y-0"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4 sm:translate-y-0">
                
                <div class="flex items-start space-x-4 rtl:space-x-reverse">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-900 leading-6">{{ __('messages.users.delete') }}</h3>
                        <p class="text-sm text-gray-500 mt-2">
                            {{ __('messages.users.delete_confirm') }}
                            <span class="font-semibold text-gray-950" x-text="userName"></span>?
                            {{ __('messages.users.delete_warning') }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3 rtl:space-x-reverse">
                    <button type="button" @click="showDeleteModal = false" class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100 transition duration-150">
                        {{ __('messages.users.cancel') }}
                    </button>
                    
                    <form :action="deleteAction" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-rose-500/20 transition duration-150">
                            {{ __('messages.users.delete_btn') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>
