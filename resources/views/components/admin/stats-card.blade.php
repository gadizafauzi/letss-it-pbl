<div
    class="group bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-3xl p-3.5 sm:p-4 lg:p-5 flex items-center
    transition-all duration-300 cursor-pointer
    hover:-translate-y-1 hover:border-blue-200 dark:hover:border-slate-600
    hover:shadow-[-8px_12px_25px_rgba(59,130,246,0.12)] dark:hover:shadow-slate-900/50">

    <div class="flex items-center gap-3 sm:gap-4 w-full min-w-0">

        {{-- ICON --}}
        <div
            class="w-10 h-10 sm:w-12 sm:h-12 lg:w-13 lg:h-13 rounded-2xl {{ $bg }} flex items-center justify-center {{ $color }} shrink-0
            transition-all duration-300
            group-hover:-rotate-12
            group-hover:scale-110">

            <i data-lucide="{{ $icon }}" class="w-5 h-5 sm:w-6 sm:h-6"></i>

        </div>

        {{-- TEXT --}}
        <div class="min-w-0 flex-1 overflow-hidden">

            <h3 class="text-base sm:text-lg lg:text-xl xl:text-2xl font-extrabold text-slate-900 dark:text-slate-100 leading-tight tracking-tight truncate" title="{{ $value }}">
                {{ $value }}
            </h3>

            <p class="text-[10px] sm:text-xs font-bold tracking-wider text-slate-400 uppercase mt-1 truncate" title="{{ $title }}">
                {{ $title }}
            </p>

        </div>

    </div>

</div>
