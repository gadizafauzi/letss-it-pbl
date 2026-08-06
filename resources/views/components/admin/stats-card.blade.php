<div
    class="group bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl sm:rounded-3xl p-3.5 sm:p-4 lg:p-4.5 flex items-center
    transition-all duration-300 cursor-pointer
    hover:-translate-y-1 hover:border-blue-200 dark:hover:border-slate-600
    hover:shadow-[-8px_12px_25px_rgba(59,130,246,0.12)] dark:hover:shadow-slate-900/50">

    <div class="flex items-center gap-2.5 sm:gap-3 w-full min-w-0">

        {{-- ICON --}}
        <div
            class="w-9 h-9 sm:w-10 sm:h-10 lg:w-11 lg:h-11 rounded-xl sm:rounded-2xl {{ $bg }} flex items-center justify-center {{ $color }} shrink-0
            transition-all duration-300
            group-hover:-rotate-12
            group-hover:scale-110">

            <i data-lucide="{{ $icon }}" class="w-4 h-4 sm:w-5 sm:h-5"></i>

        </div>

        {{-- TEXT --}}
        <div class="min-w-0 flex-1">

            <h3 class="text-sm sm:text-base lg:text-lg xl:text-xl font-extrabold text-slate-900 dark:text-slate-100 leading-snug whitespace-nowrap">
                {{ $value }}
            </h3>

            <p class="text-[10px] sm:text-[11px] font-bold tracking-wider text-slate-400 uppercase mt-0.5 whitespace-nowrap">
                {{ $title }}
            </p>

        </div>

    </div>

</div>
