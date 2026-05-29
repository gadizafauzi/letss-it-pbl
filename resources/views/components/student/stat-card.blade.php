@props([
    'title',
    'value',
    'icon' => 'layout-dashboard',
    'color' => 'emerald'
])

@php
    $bgClass = match($color) {
        'emerald' => 'bg-emerald-50 text-emerald-500',
        'indigo' => 'bg-indigo-50 text-indigo-500',
        'blue' => 'bg-blue-50 text-blue-500',
        'amber' => 'bg-amber-50 text-amber-500',
        'red' => 'bg-red-50 text-red-500',
        default => 'bg-emerald-50 text-emerald-500',
    };

    $hoverClass = match($color) {
        'emerald' => 'hover:border-emerald-300 hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.2)]',
        'indigo' => 'hover:border-indigo-300 hover:shadow-[-8px_12px_25px_rgba(99,102,241,0.2)]',
        'blue' => 'hover:border-blue-300 hover:shadow-[-8px_12px_25px_rgba(59,130,246,0.2)]',
        'amber' => 'hover:border-amber-300 hover:shadow-[-8px_12px_25px_rgba(245,158,11,0.2)]',
        'red' => 'hover:border-red-300 hover:shadow-[-8px_12px_25px_rgba(239,68,68,0.2)]',
        default => 'hover:border-emerald-300 hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.2)]',
    };
@endphp

<div class="stat-card dashboard-card group bg-white rounded-[24px] border border-slate-200/80 p-6 shadow-sm flex items-center gap-4 transition-all duration-300 cursor-pointer hover:-translate-y-2 hover:scale-105 {{ $hoverClass }}">
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
