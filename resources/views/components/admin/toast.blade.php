@php
    $type = session('success') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : null));
    $message = session('success') ?? session('error') ?? session('warning');
    $title = $type === 'success' ? 'Berhasil!' : ($type === 'error' ? 'Gagal!' : 'Perhatian!');
    $duration = $type === 'error' ? 5000 : 4000;
    $iconName = $type === 'success' ? 'check-circle-2' : ($type === 'error' ? 'alert-circle' : 'alert-triangle');
    $iconColor = $type === 'success'
        ? 'bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400'
        : ($type === 'error'
            ? 'bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400'
            : 'bg-amber-100 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400');
    $barColor = $type === 'success' ? 'bg-emerald-400' : ($type === 'error' ? 'bg-red-400' : 'bg-amber-400');
@endphp

@if($type)
<div
    x-data="{ show: true, progress: 100 }"
    x-init="
        let start = null;
        const dur = {{ $duration }};
        function step(ts) {
            if (!start) start = ts;
            const elapsed = ts - start;
            progress = Math.max(0, 100 - (elapsed / dur) * 100);
            if (elapsed < dur && show) requestAnimationFrame(step);
            else show = false;
        }
        requestAnimationFrame(step);
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-8 scale-95"
    x-transition:enter-end="opacity-100 translate-x-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0 scale-100"
    x-transition:leave-end="opacity-0 translate-x-8 scale-95"
    class="fixed top-6 right-6 z-[999] w-[340px] overflow-hidden rounded-2xl bg-white dark:bg-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:shadow-slate-900/50 border border-slate-100 dark:border-slate-700/60"
    style="display: none;"
>
    {{-- MAIN CONTENT --}}
    <div class="flex items-start gap-3.5 px-4 pt-4 pb-3.5">

        {{-- ICON --}}
        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $iconColor }}">
            <i data-lucide="{{ $iconName }}" class="w-5 h-5"></i>
        </div>

        {{-- TEXT --}}
        <div class="flex-1 min-w-0 pt-0.5">
            <p class="text-sm font-bold text-slate-800 dark:text-slate-100 leading-snug">{{ $title }}</p>
            <p class="text-[13px] text-slate-500 dark:text-slate-400 mt-0.5 leading-snug">{{ $message }}</p>
        </div>

        {{-- CLOSE --}}
        <button
            type="button"
            @click="show = false"
            class="flex-shrink-0 mt-0.5 text-slate-300 hover:text-slate-500 dark:text-slate-600 dark:hover:text-slate-400 transition-colors cursor-pointer border-none bg-transparent p-0.5"
        >
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    {{-- PROGRESS BAR --}}
    <div class="h-[3px] w-full bg-slate-100 dark:bg-slate-700/50">
        <div
            class="h-full {{ $barColor }} transition-none rounded-full"
            :style="'width: ' + progress + '%'"
        ></div>
    </div>
</div>
@endif
