<div
    class="group bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center
    transition-all duration-300 cursor-pointer
    hover:-translate-y-1 hover:border-emerald-300
    hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.18)]">

    <div class="flex items-center gap-4">

        {{-- ICON --}}
        <div
            class="w-14 h-14 rounded-2xl {{ $bg }} flex items-center justify-center {{ $color }}
            transition-all duration-300
            group-hover:-rotate-12
            group-hover:scale-110">

            <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>

        </div>

        {{-- TEXT --}}
        <div>

            <h3 class="text-2xl font-extrabold text-slate-900 leading-none">
                {{ $value }}
            </h3>

            <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mt-2">
                {{ $title }}
            </p>

        </div>

    </div>

</div>
