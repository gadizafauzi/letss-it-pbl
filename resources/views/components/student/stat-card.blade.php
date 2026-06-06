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
        'emerald' => 'bg-gradient-to-br from-emerald-500 to-emerald-600 border border-emerald-400 shadow-[0_4px_15px_-3px_rgba(16,185,129,0.3)]',
        'indigo' => 'bg-gradient-to-br from-indigo-500 to-indigo-600 border border-indigo-400 shadow-[0_4px_15px_-3px_rgba(99,102,241,0.3)]',
        'blue' => 'bg-gradient-to-br from-blue-500 to-blue-600 border border-blue-400 shadow-[0_4px_15px_-3px_rgba(59,130,246,0.3)]',
        'amber' => 'bg-gradient-to-br from-amber-500 to-amber-600 border border-amber-400 shadow-[0_4px_15px_-3px_rgba(245,158,11,0.3)]',
        'red' => 'bg-gradient-to-br from-red-500 to-red-600 border border-red-400 shadow-[0_4px_15px_-3px_rgba(239,68,68,0.3)]',
        'purple' => 'bg-gradient-to-br from-purple-500 to-purple-600 border border-purple-400 shadow-[0_4px_15px_-3px_rgba(168,85,247,0.3)]',
        default => 'bg-gradient-to-br from-emerald-500 to-emerald-600 border border-emerald-400 shadow-[0_4px_15px_-3px_rgba(16,185,129,0.3)]',
    };

    $iconBgClass = match($color) {
        'emerald' => 'bg-emerald-100/20 text-emerald-50',
        'indigo' => 'bg-indigo-100/20 text-indigo-50',
        'blue' => 'bg-blue-100/20 text-blue-50',
        'amber' => 'bg-amber-100/20 text-amber-50',
        'red' => 'bg-red-100/20 text-red-50',
        'purple' => 'bg-purple-100/20 text-purple-50',
        default => 'bg-emerald-100/20 text-emerald-50',
    };
@endphp

<div class="stat-card group {{ $cardBgClass }} rounded-[24px] p-6 flex items-center gap-4 transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:scale-[1.02] {{ $hoverClass }}">
    <div class="flex-1">
        <h4 class="text-[10px] sm:text-xs font-bold uppercase tracking-wider mb-1 text-white/80 group-hover:text-white transition-colors">{{ $title }}</h4>
        @if(is_numeric($value))
            <span class="font-extrabold text-white text-xl sm:text-2xl drop-shadow-sm counter" data-target="{{ $value }}">{{ $value }}</span>
        @else
            <span class="font-extrabold text-white text-xl sm:text-2xl drop-shadow-sm">{{ $value }}</span>
        @endif
    </div>
    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-[14px] {{ $iconBgClass }} backdrop-blur-sm shadow-[0_4px_12px_rgba(0,0,0,0.05)] flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-12">
        <i data-lucide="{{ $icon }}" class="w-5 h-5 sm:w-6 sm:h-6"></i>
    </div>
</div>
