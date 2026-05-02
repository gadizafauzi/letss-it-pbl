{{-- lagi maintenance --}}

{{-- @props([
    'route' => null,
    'icon' => null
])

@php
    $active = $route && request()->routeIs($route);
@endphp

<a href="{{ $route ? route($route) : '#' }}"
   class="flex items-center gap-3 px-3 py-2 rounded-md transition
   {{ $active ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">

    <!-- ICON -->
    @switch($icon)

        @case('home')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M3 12l9-9 9 9"/>
        </svg>
        @break

        @case('student')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
        </svg>
        @break

        @case('teacher')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M5 20h14M12 4v16"/>
        </svg>
        @break

        @case('class')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
        @break

        @case('book')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M4 19h16V5H4z"/>
        </svg>
        @break

        @case('teach')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M12 6v12M6 12h12"/>
        </svg>
        @break

        @case('calendar')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M8 7V3m8 4V3"/>
        </svg>
        @break

        @case('money')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M12 8c-2 0-4 1-4 3s2 3 4 3 4 1 4 3-2 3-4 3"/>
        </svg>
        @break

        @case('user')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M12 12a4 4 0 100-8 4 4 0 000 8z"/>
        </svg>
        @break

        @case('setting')
        <svg class="w-5 h-5" fill="none" stroke="currentColor">
            <path stroke-width="1.5" d="M12 6v6l4 2"/>
        </svg>
        @break

    @endswitch

    <span>{{ $slot }}</span>
</a> --}}

