@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Unit Pendidikan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Unit Pendidikan</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Jenjang pendidikan Islam terpadu dari TK hingga SMP.</p>
        </div>
    </div>

    <section class="public-section">
        <div class="w-full">
            @php
                $units = [
                    ['icon' => 'baby', 'color' => 'sky', 'title' => 'TK Islam Terpadu', 'desc' => 'Pembelajaran usia dini yang menyenangkan dengan pendekatan bermain dan mengenal Al-Qur\'an sejak dini.', 'route' => 'public.unit.tk.index', 'logo' => asset('images/tk.jpeg'),
                     'features' => ['Iqra & Hijaiyah', 'Sentra Bermain', 'Hafalan Juz 30', 'Seni & Kreativitas']],
                    ['icon' => 'school', 'color' => 'amber', 'title' => 'SD Islam Terpadu', 'desc' => 'Pendidikan dasar 6 tahun yang memadukan kurikulum nasional dengan kurikulum keislaman.', 'route' => 'public.unit.sd.index', 'logo' => asset('images/sd.jpeg'),
                     'features' => ['Target 5 Juz', 'Matematika & Sains', 'Bahasa Arab & Inggris', 'Ekstrakurikuler']],
                    ['icon' => 'graduation-cap', 'color' => 'indigo', 'title' => 'SMP Islam Terpadu', 'desc' => 'Jenjang menengah pertama yang mempersiapkan siswa untuk menjadi pribadi unggul.', 'route' => 'public.unit.smp.index', 'logo' => asset('images/smp.jpeg'),
                     'features' => ['Target 10 Juz', 'Lab IPA & Komputer', 'English & Arabic', 'Leadership Camp']],
                ];
            @endphp

            <div class="space-y-16">
                @foreach($units as $i => $unit)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                        <div class="{{ $i % 2 === 1 ? 'order-2 lg:order-1' : '' }}">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-{{ $unit['color'] }}-50 text-{{ $unit['color'] }}-600 text-xs font-bold mb-4">
                                <img src="{{ $unit['logo'] }}" alt="Logo" class="w-4 h-4 object-contain rounded-full bg-white p-0.5"> {{ $unit['title'] }}
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black text-[var(--theme-primary)] mb-4">{{ $unit['title'] }}</h2>
                            <p class="text-slate-500 leading-relaxed mb-6">{{ $unit['desc'] }}</p>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                @foreach($unit['features'] as $f)
                                    <div class="flex items-center gap-3 p-3 rounded-xl bg-{{ $unit['color'] }}-50/60">
                                        <i data-lucide="check" class="w-4 h-4 text-{{ $unit['color'] }}-500 flex-shrink-0"></i>
                                        <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route($unit['route']) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-{{ $unit['color'] === 'sky' ? 'sky-500 hover:bg-sky-600 shadow-sky-200' : ($unit['color'] === 'amber' ? 'amber-500 hover:bg-amber-600 shadow-amber-200' : 'indigo-600 hover:bg-indigo-700 shadow-indigo-200') }} text-white font-bold text-sm hover:-translate-y-1 transition-all duration-300 shadow-lg">
                                Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                        <div class="{{ $i % 2 === 1 ? 'order-1 lg:order-2' : '' }}">
                            @php
                                $photoMap = [
                                    'tk.jpeg'  => ['photo' => 'tk.jpeg',  'badge1' => ['icon'=>'users','label'=>'Usia Masuk','val'=>'4 – 6 Tahun'],  'badge2' => ['icon'=>'book-open','label'=>'Target Hafalan','val'=>'Juz 30']],
                                    'sd.jpeg'  => ['photo' => 'sd.jpeg',  'badge1' => ['icon'=>'users','label'=>'Usia Masuk','val'=>'6 – 7 Tahun'],  'badge2' => ['icon'=>'book-open','label'=>'Target Hafalan','val'=>'5 Juz']],
                                    'smp.jpeg' => ['photo' => 'smp.jpeg', 'badge1' => ['icon'=>'graduation-cap','label'=>'Masuk dari','val'=>'Lulusan SD/MI'], 'badge2' => ['icon'=>'book-open','label'=>'Target Hafalan','val'=>'10 Juz']],
                                ];
                                $logoBasename = basename(parse_url($unit['logo'], PHP_URL_PATH));
                                $pm = $photoMap[$logoBasename] ?? ['photo'=>$logoBasename,'badge1'=>['icon'=>'info','label'=>'','val'=>''],'badge2'=>['icon'=>'info','label'=>'','val'=>'']];
                            @endphp

                            <div class="relative group py-6 px-2">
                                {{-- Main logo frame --}}
                                <div class="w-full rounded-2xl border border-{{ $unit['color'] }}-100 bg-gradient-to-br from-{{ $unit['color'] }}-50 via-white to-{{ $unit['color'] }}-50/40 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:border-{{ $unit['color'] }}-200" style="min-height: 280px; padding: clamp(24px,5%,48px);">
                                    <img src="{{ asset('images/' . $pm['photo']) }}"
                                         alt="Logo {{ $unit['title'] }}"
                                         class="max-h-52 sm:max-h-64 w-auto object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
                                </div>

                                {{-- Floating badge top-right --}}
                                <div class="absolute top-2 right-0 bg-white rounded-2xl shadow-lg border border-{{ $unit['color'] }}-100/80 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:4s;">
                                    <div class="w-7 h-7 rounded-lg bg-{{ $unit['color'] }}-50 flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="{{ $pm['badge2']['icon'] }}" class="w-3.5 h-3.5 text-{{ $unit['color'] }}-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">{{ $pm['badge2']['label'] }}</p>
                                        <p class="text-xs font-black text-slate-800 mt-0.5">{{ $pm['badge2']['val'] }}</p>
                                    </div>
                                </div>

                                {{-- Floating badge bottom-left --}}
                                <div class="absolute bottom-2 left-0 bg-white rounded-2xl shadow-lg border border-amber-100 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:5.5s;">
                                    <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                                        <i data-lucide="{{ $pm['badge1']['icon'] }}" class="w-3.5 h-3.5 text-amber-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">{{ $pm['badge1']['label'] }}</p>
                                        <p class="text-xs font-black text-slate-800 mt-0.5">{{ $pm['badge1']['val'] }}</p>
                                    </div>
                                </div>

                                {{-- Pill accredited inside frame, bottom-right --}}
                                <div class="absolute bottom-10 right-4 bg-white/95 backdrop-blur-sm rounded-full px-3 py-1.5 flex items-center gap-1.5 border border-emerald-100 shadow-sm z-10">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0"></i>
                                    <span class="text-[11px] font-bold text-slate-700">Terakreditasi A</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
