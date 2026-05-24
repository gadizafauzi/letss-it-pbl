<header class="h-20 bg-white border-b border-slate-200 shadow-sm pl-6 pr-6 lg:pl-8 lg:pr-12 flex items-center justify-between shrink-0">

    <div class="flex items-center gap-4 min-w-0">
        <button type="button" id="desktopToggle"
            class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center shrink-0 transition-all duration-300 hover:bg-emerald-50 hover:border-emerald-100 hover:text-emerald-600">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

        <div class="min-w-0">
            <h2 class="text-[22px] font-extrabold tracking-tight text-slate-800 leading-none truncate">
                {{ $headerTitle ?? 'Dashboard' }}
            </h2>

            <p class="text-sm text-slate-500 mt-1 font-medium truncate">
                {{ $headerSubtitle ?? 'Selamat datang kembali' }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3 shrink-0 pl-4">

        <div class="hidden sm:flex flex-col items-end justify-center leading-tight h-11">
            <p class="text-sm font-bold text-slate-800 whitespace-nowrap">
                {{ auth()->user()->name ?? 'Guru' }}
            </p>

            <p class="text-xs text-slate-400 mt-1 whitespace-nowrap">
                {{ ucfirst(auth()->user()->role ?? 'Teacher') }}
            </p>
        </div>

        <div class="relative w-11 h-11 min-w-[44px] flex items-center justify-center overflow-visible">

            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-emerald-200">
                {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
            </div>

            <span class="absolute -bottom-[2px] -right-[2px] w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full">
            </span>

        </div>
    </div>
</header>
