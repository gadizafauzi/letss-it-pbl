<header class="h-20 bg-white/95 backdrop-blur-sm border-b border-slate-100 shadow-sm px-4 md:pl-8 md:pr-12 flex items-center justify-between shrink-0">

    <div class="flex items-center gap-4 min-w-0">
        <button type="button" id="desktopToggle"
            class="w-10 h-10 rounded-xl bg-white border border-slate-200 shadow-sm flex items-center justify-center shrink-0 transition-all duration-300 hover:bg-slate-50 hover:border-[#3b5998] hover:text-[#3b5998] text-[#3b5998]">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <div class="min-w-0">
            <h2 class="text-lg md:text-[22px] font-extrabold tracking-tight text-[#3b5998] leading-none truncate">
                {{ $headerTitle ?? 'Dashboard' }}
            </h2>

            <p class="text-xs md:text-sm text-[var(--theme-primary)] mt-1 font-medium truncate opacity-90">
                {{ $headerSubtitle ?? 'Selamat datang kembali' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3 shrink-0 pl-4">

        <div class="hidden sm:flex flex-col items-end justify-center leading-tight h-11">
            <p class="text-xs md:text-sm font-bold text-[#3b5998] whitespace-nowrap">
                {{ auth()->user()->name ?? 'Guru' }}
            </p>

            <p class="hidden lg:block text-[11px] md:text-xs text-[var(--theme-primary)] mt-0.5 whitespace-nowrap opacity-90">
                {{ strtolower(auth()->user()->role ?? '') === 'teacher' ? 'Guru' : ucfirst(auth()->user()->role ?? 'Teacher') }}
            </p>
        </div>

        <div class="relative w-11 h-11 min-w-[44px] flex items-center justify-center overflow-visible">

            <div class="w-11 h-11 rounded-2xl bg-[var(--theme-primary)] flex items-center justify-center text-white font-bold text-lg shadow-lg" style="box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--theme-primary) 30%, transparent);">
                {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
            </div>

            <span class="absolute -bottom-[2px] -right-[2px] w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full">
            </span>

        </div>
    </div>
</header>
