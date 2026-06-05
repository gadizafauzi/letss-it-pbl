@php
    $navs = [
        ['key' => 'profil', 'label' => 'Profil', 'route' => "public.unit.{$unit}.profil"],
        ['key' => 'guru', 'label' => 'Guru', 'route' => "public.unit.{$unit}.guru"],
        ['key' => 'ekskul', 'label' => 'Ekstrakurikuler', 'route' => "public.unit.{$unit}.ekskul"],
        ['key' => 'fasilitas', 'label' => 'Fasilitas', 'route' => "public.unit.{$unit}.fasilitas"],
        ['key' => 'prestasi', 'label' => 'Prestasi', 'route' => "public.unit.{$unit}.prestasi"],
    ];

    $colors = [
        'tk' => ['bg' => 'bg-sky-500', 'text' => 'text-white'],
        'sd' => ['bg' => 'bg-amber-500', 'text' => 'text-white'],
        'smp' => ['bg' => 'bg-indigo-600', 'text' => 'text-white'],
    ];

    $activeBg = $colors[$unit]['bg'] ?? 'bg-sky-500';
    $activeText = $colors[$unit]['text'] ?? 'text-white';
@endphp

<div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
    <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
        @foreach($navs as $nav)
            @if($active === $nav['key'])
                <a href="{{ route($nav['route']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap {{ $activeBg }} {{ $activeText }}">{{ $nav['label'] }}</a>
            @else
                <a href="{{ route($nav['route']) }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">{{ $nav['label'] }}</a>
            @endif
        @endforeach
    </div>
</div>
