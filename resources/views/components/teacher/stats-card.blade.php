<div
    class="group bg-white border border-slate-200 rounded-3xl px-4 py-4 lg:px-6 lg:py-5 flex items-center justify-between
    transition-all duration-300 cursor-pointer
    hover:-translate-y-1 hover:border-emerald-300
    hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.18)]">

    <div>

        <p class="text-xs font-bold tracking-widest text-slate-400 uppercase">
            {{ $title }}
        </p>

        <h3 class="text-3xl lg:text-4xl font-extrabold text-slate-900 mt-2 leading-none"
            id="{{ $id ?? '' }}">

            {{ $value }}

        </h3>

    </div>

    <div
        class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl {{ $bg }}
        flex items-center justify-center text-white shadow-md
        transition-all duration-300
        group-hover:-rotate-12
        group-hover:scale-110">

        {{ $slot }}

    </div>

</div>
