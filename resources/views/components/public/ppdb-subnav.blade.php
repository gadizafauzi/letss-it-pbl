@php
    $navs = [
        ['route' => 'public.ppdb.index', 'label' => 'Informasi'],
        ['route' => 'public.ppdb.jadwal', 'label' => 'Jadwal & Timeline'],
    ];
@endphp

<div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
    <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
        @foreach($navs as $nav)
            <a href="{{ route($nav['route']) }}" class="subnav-link {{ request()->routeIs($nav['route']) ? 'active' : '' }}">
                {{ $nav['label'] }}
            </a>
        @endforeach
    </div>
</div>
