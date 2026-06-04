@props([
    'title',
    'value',
    'icon' => 'layout-dashboard',
    'color' => 'emerald'
])

@php
    $bgClass = match($color) {
        'emerald' => 'bg-emerald-100 text-emerald-500',
        'indigo' => 'bg-indigo-100 text-indigo-500',
        'blue' => 'bg-blue-100 text-blue-500',
        'amber' => 'bg-amber-100 text-amber-500',
        'red' => 'bg-red-100 text-red-500',
        'purple' => 'bg-purple-100 text-purple-500',
        default => 'bg-emerald-100 text-emerald-500',
    };

    $hoverClass = match($color) {
        'emerald' => 'hover:border-emerald-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        'indigo' => 'hover:border-indigo-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        'blue' => 'hover:border-blue-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        'amber' => 'hover:border-amber-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        'red' => 'hover:border-red-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        'purple' => 'hover:border-purple-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
        default => 'hover:border-emerald-300 hover:shadow-[-8px_12px_25px_var(--theme-stat-hover)]',
    };

    $cardBgClass = match($color) {
        'emerald' => 'bg-gradient-to-br from-white to-emerald-50/50 border-2 border-emerald-400 shadow-[0_4px_15px_-3px_rgba(16,185,129,0.15)]',
        'indigo' => 'bg-gradient-to-br from-white to-indigo-50/50 border-2 border-indigo-400 shadow-[0_4px_15px_-3px_rgba(99,102,241,0.15)]',
        'blue' => 'bg-gradient-to-br from-white to-blue-50/50 border-2 border-blue-400 shadow-[0_4px_15px_-3px_rgba(59,130,246,0.15)]',
        'amber' => 'bg-gradient-to-br from-white to-amber-50/50 border-2 border-amber-400 shadow-[0_4px_15px_-3px_rgba(245,158,11,0.15)]',
        'red' => 'bg-gradient-to-br from-white to-red-50/50 border-2 border-red-400 shadow-[0_4px_15px_-3px_rgba(239,68,68,0.15)]',
        'purple' => 'bg-gradient-to-br from-white to-purple-50/50 border-2 border-purple-400 shadow-[0_4px_15px_-3px_rgba(168,85,247,0.15)]',
        default => 'bg-gradient-to-br from-white to-emerald-50/50 border-2 border-emerald-400 shadow-[0_4px_15px_-3px_rgba(16,185,129,0.15)]',
    };
@endphp

<div class="stat-card dashboard-card group {{ $cardBgClass }} rounded-[24px] p-6 flex items-center gap-4 transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:scale-[1.02] {{ $hoverClass }}">
    <div class="stat-icon-wrap w-12 h-12 rounded-xl {{ $bgClass }} flex items-center justify-center shrink-0 transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110">
        <i data-lucide="{{ $icon }}" class="w-6 h-6"></i>
    </div>
    <div>
        <span class="text-slate-400 text-xs font-semibold uppercase block">{{ $title }}</span>
        @if(is_numeric($value))
            <span class="font-extrabold text-slate-800 text-xl counter" data-target="{{ $value }}">{{ $value }}</span>
        @else
            <span class="font-extrabold text-slate-800 text-xl">{{ $value }}</span>
        @endif
    </div>
</div>
