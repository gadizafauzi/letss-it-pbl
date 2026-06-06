<header class="h-20 bg-[var(--bg-header)]/95 backdrop-blur-sm border-b border-[var(--border-color)] shadow-sm px-4 md:pl-8 md:pr-12 flex items-center justify-between shrink-0 transition-colors duration-300">

    <div class="flex items-center gap-4 min-w-0">
        <button type="button" id="desktopToggle"
            class="w-10 h-10 rounded-xl bg-[var(--bg-card)] border border-[var(--border-color)] shadow-sm flex items-center justify-center shrink-0 transition-all duration-300 hover:bg-[var(--theme-bg-light)] hover:border-[var(--theme-primary)] hover:text-[var(--theme-primary)] text-[var(--text-main)]">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <div class="min-w-0">
            <h2 class="text-lg md:text-[22px] font-extrabold tracking-tight text-[var(--text-main)] leading-none truncate">
                {{ $headerTitle ?? 'Dashboard' }}
            </h2>

            <p class="text-xs md:text-sm text-[var(--theme-primary)] mt-1 font-medium truncate opacity-90">
                {{ $headerSubtitle ?? 'Selamat datang kembali' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3 shrink-0 pl-4">

        <!-- Theme Toggle Button -->
        <button id="themeToggle" class="w-10 h-10 rounded-xl bg-[var(--bg-card)] border border-[var(--border-color)] shadow-sm flex items-center justify-center shrink-0 transition-all duration-300 hover:bg-[var(--theme-bg-light)] hover:border-[var(--theme-primary)] text-[var(--text-main)] group overflow-hidden relative mr-2">
            <!-- Sun Icon (visible in dark mode) -->
            <i data-lucide="sun" class="w-5 h-5 absolute transition-all duration-500 transform translate-y-8 opacity-0 dark:translate-y-0 dark:opacity-100 group-hover:rotate-45 group-hover:scale-110 text-yellow-400"></i>
            <i data-lucide="moon" class="w-5 h-5 absolute transition-all duration-500 transform translate-y-0 opacity-100 dark:-translate-y-8 dark:opacity-0 group-hover:-rotate-12 group-hover:scale-110 text-slate-500"></i>
        </button>

        <div class="hidden sm:flex flex-col items-end justify-center leading-tight h-11">
            <p class="text-xs md:text-sm font-bold text-[var(--text-main)] whitespace-nowrap">
                {{ auth()->user()->name ?? 'Guru' }}
            </p>

            <p class="hidden lg:block text-[11px] md:text-xs text-[var(--theme-primary)] mt-0.5 whitespace-nowrap opacity-90">
                {{ strtolower(auth()->user()->role ?? '') === 'teacher' ? 'Guru' : ucfirst(auth()->user()->role ?? 'Teacher') }}
            </p>
        </div>

        <div class="relative w-11 h-11 min-w-[44px] flex items-center justify-center overflow-visible">

            @php
                $teacherHeader = \App\Models\Teacher::where('user_id', auth()->id())->first();
            @endphp
            
            <div class="w-11 h-11 rounded-2xl bg-[var(--theme-primary)] flex items-center justify-center text-white font-bold text-lg shadow-lg overflow-hidden" style="box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--theme-primary) 30%, transparent);">
                @if($teacherHeader && $teacherHeader->photo && $teacherHeader->photo !== 'default.png' && $teacherHeader->photo !== 'default.jpg' && $teacherHeader->photo !== 'default_user.png')
                    <img src="{{ asset('storage/photos/' . $teacherHeader->photo) }}" alt="Photo" class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                @endif
            </div>

            <span class="absolute -bottom-[2px] -right-[2px] w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full">
            </span>

        </div>
    </div>
</header>
