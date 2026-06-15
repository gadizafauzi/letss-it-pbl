<header class="h-16 lg:h-20 bg-[#F0F4FA]/80 dark:bg-slate-900/80 backdrop-blur-md flex items-center justify-between px-4 lg:px-8 z-30 sticky top-0">
    <div class="flex items-center gap-4">
        <button id="menuToggle" class="p-2 lg:hidden text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 dark:text-slate-400 rounded-lg">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <button id="desktopToggle" class="hidden lg:flex p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 dark:text-slate-400 rounded-lg transition-colors">
            <i data-lucide="align-left" class="w-5 h-5"></i>
        </button>
    </div>

    <div class="flex items-center gap-4 lg:gap-6">
        <div class="hidden sm:flex items-center gap-2 text-slate-500 dark:text-slate-400">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            <span class="text-sm font-medium">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>

        <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 hidden sm:block"></div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-right">
                <p class="text-sm font-bold text-slate-700 dark:text-slate-100 leading-tight">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Administrator</p>
            </div>

            {{-- ALPINE DROPDOWN --}}
            @php
                // Ambil inisial nama
                $name = Auth::user()->name ?? 'Admin';
                $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->join('');
            @endphp
            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false" class="w-9 h-9 lg:w-10 lg:h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shadow-md hover:bg-blue-700 transition-colors focus:outline-none relative">
                    {{ $initials }}
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white dark:border-slate-800 rounded-full"></span>
                </button>

                {{-- DROPDOWN MENU --}}
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 py-2 z-50"
                     style="display: none;">
                     
                    <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700 sm:hidden">
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-100">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Administrator</p>
                    </div>

                    <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        Profil Saya
                    </a>

                    
                    <div class="h-px bg-slate-100 dark:bg-slate-700 my-1"></div>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
