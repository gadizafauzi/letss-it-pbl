@extends('layouts.unit')

@section('navbar')
    <x-public.unit-navbar unitLogo="images/tk.jpeg" unitName="TK Islam Terpadu" />
@endsection

@section('footer')
    <x-public.unit-footer unitName="TK Islam Terpadu" />
@endsection

@section('content')
<div class="theme-tk">
    <style>
        :root {
            --unit-accent: #f97316;
            --unit-accent-lt: #fdba74;
        }

        /* ── Reveal animations ────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .reveal.reveal-left {
            transform: translateX(-30px);
        }

        .reveal.reveal-right {
            transform: translateX(30px);
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* ── Section badge ────────────────────────── */
        .unit-section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.85rem;
            border-radius: 999px;
            background: rgba(234, 88, 12, 0.10);
            border: 1px solid rgba(234, 88, 12, 0.22);
            color: #ea580c;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 0.75rem;
        }


        /* ── Section subtitle ─────────────────────── */
        .unit-section-desc {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.7;
            max-width: 640px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0.75rem;
        }

        .unit-section-desc.light {
            color: rgba(255, 255, 255, 0.55);
        }

        /* ── Stat card ────────────────────────────── */
        .unit-stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 1.25rem;
            text-align: center;
            transition: background 0.3s, border-color 0.3s;
        }

        .unit-stat-card:hover {
            background: rgba(234, 88, 12, 0.08);
            border-color: rgba(234, 88, 12, 0.3);
        }

        /* ── Curriculum card ──────────────────────── */
        .unit-curriculum-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .unit-curriculum-card:hover {
            border-color: #f97316;
            box-shadow: 0 6px 24px rgba(234, 88, 12, 0.10);
            transform: translateY(-3px);
        }

        .unit-curriculum-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(234, 88, 12, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #f97316;
            transition: background 0.3s;
        }

        .unit-curriculum-card:hover .unit-curriculum-icon {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
        }

        /* ── Teacher card ─────────────────────────── */
        .unit-teacher-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .unit-teacher-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.09);
            border-color: #fdba74;
        }

        .unit-teacher-photo {
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        .unit-teacher-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .unit-teacher-card:hover .unit-teacher-photo img {
            transform: scale(1.07);
        }

        .unit-teacher-info {
            padding: 0.75rem 0.85rem;
            text-align: center;
        }

        .unit-teacher-info h3 {
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unit-teacher-info p {
            font-size: 0.7rem;
            font-weight: 500;
            color: #f97316;
        }

        /* ── Timeline dot ─────────────────────────── */
        .unit-timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #f97316;
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.25);
            position: absolute;
            left: -8px;
            top: 1.4rem;
            transition: transform 0.3s;
        }

        .unit-timeline-card:hover .unit-timeline-dot {
            transform: scale(1.35);
        }

        /* ── Float animation ──────────────────────── */
        @keyframes float {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-16px); }
            100% { transform: translateY(0px); }
        }

        .animate-floating {
            animation: float 6s ease-in-out infinite;
        }

        /* ── Timeline line ────────────────────────── */
        .tl-line {
            background: linear-gradient(to bottom, #fb923c, #f97316, #ea580c);
            transform-origin: top center;
            transform: scaleY(0);
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .tl-line.visible {
            transform: scaleY(1);
        }

        .tl-dot {
            animation: tl-dot-pulse 2.8s ease-in-out infinite;
        }

        @keyframes tl-dot-pulse {
            0%, 100% { box-shadow: 0 0 0 3px rgba(234, 88, 12,.28), 0 0 10px rgba(234, 88, 12,.22); }
            50%       { box-shadow: 0 0 0 5px rgba(234, 88, 12,.15), 0 0 18px rgba(234, 88, 12,.40); }
        }

        @keyframes waveTranslateX {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }
        .anim-wave-front {
            animation: waveTranslateX 8s ease-in-out infinite alternate;
        }
        .anim-wave-mid {
            animation: waveTranslateX 6s ease-in-out infinite alternate;
        }
        .anim-wave-back {
            animation: waveTranslateX 14s ease-in-out infinite alternate;
        }
    </style>

    {{-- ════════════════════════════════════════════
         HERO SECTION
         ════════════════════════════════════════════ --}}
    <section id="home" class="relative min-h-[75vh] lg:min-h-[80vh] flex items-center overflow-hidden"
        style="background: linear-gradient(135deg, #431407 0%, #7c2d12 60%, #c2410c 100%);">

        <div class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(rgba(234, 88, 12,0.6) 1px, transparent 1px); background-size: 32px 32px;">
        </div>

        <div class="absolute top-1/4 left-0 w-72 h-72 rounded-full opacity-20"
            style="background: radial-gradient(circle, #f97316, transparent 70%); filter: blur(40px);"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full opacity-10"
            style="background: radial-gradient(circle, #fb923c, transparent 70%); filter: blur(60px);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-28 pb-20 w-full">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-3 mb-6 md:mb-10 text-[0.95rem] reveal reveal-left">
                <a href="{{ route('public.home') }}" class="text-orange-100/80 hover:text-white font-medium transition-colors duration-300">Beranda</a>
                <span class="text-orange-100/40">/</span>
                <span class="text-orange-300 font-semibold tracking-wide drop-shadow-md">TK Islam Terpadu</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Left text --}}
                <div class="reveal reveal-left">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-none tracking-tighter mt-2 mb-6">
                        @if($hero && $hero->title)
                            {{ $hero->title }}
                        @else
                            TK ISLAM<br>
                            <span style="background: linear-gradient(90deg, #f97316, #fb923c); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TERPADU</span>
                        @endif
                    </h1>

                    <p class="text-base text-slate-400 leading-relaxed mb-8 max-w-md">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : 'Membentuk karakter islami sejak usia dini dengan pendekatan belajar, bermain, dan berkarya yang menyenangkan.' }}
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil' }}" style="background: linear-gradient(135deg, #f97316, #ea580c); color: white;"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:-translate-y-1 hover:shadow-orange-500/30 transition-all duration-300">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Deskripsi Umum' }}
                        </a>
                        <a href="{{ $hero && $hero->button_secondary_link ? $hero->button_secondary_link : '#prestasi' }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm text-white transition-all duration-300 hover:-translate-y-1"
                            style="border: 2px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.05);">
                            <i data-lucide="play-circle" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_secondary_text ? $hero->button_secondary_text : 'Lihat Prestasi' }}
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block reveal reveal-right">
                    <div class="relative w-full h-[400px] lg:h-[480px] animate-floating">
                        <div class="absolute inset-0 bg-orange-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                        <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : asset('images/tk_dummy.png') }}" alt="TK Islam Terpadu SIT Mutiara Qur'an"
                            class="relative w-full h-full object-contain mix-blend-screen drop-shadow-2xl">
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- ════════════════════════════════════════════
         STATISTICS SECTION
         ════════════════════════════════════════════ --}}
    @php
        $studentCount = $unit->students()->count();
        $teacherCount = $unit->teachers()->count();
        $classCount = $unit->schoolClasses()->count();

        // Fallback to mock data if actual DB counts are 0
        if ($studentCount === 0) {
            $studentCount = 75;
            $teacherCount = 12;
            $classCount = 4;
        }

        $statisticBg = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        $bgImageUrl = ($statisticBg && $statisticBg->value) ? (str_starts_with($statisticBg->value, 'http') ? $statisticBg->value : Storage::url($statisticBg->value)) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80';
    @endphp
    <section class="relative py-16 md:py-20 z-20 bg-gradient-to-b from-[#7c2d12] via-orange-50/10 to-white border-b border-slate-100 overflow-hidden">
        @if($bgImageUrl)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-[0.10] mix-blend-multiply" style="background-image: url('{{ $bgImageUrl }}');"></div>
        @endif

        <!-- Top Fade Overlay (Blends Hero dark color into statistics) -->
        <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-[#7c2d12] to-transparent pointer-events-none z-10"></div>

        <!-- Bottom Fade Overlay -->
        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 max-w-6xl mx-auto">
                {{-- Siswa Aktif --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="users" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $studentCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Siswa Aktif</p>
                </div>

                {{-- Tenaga Pendidik --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 100ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="graduation-cap" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $teacherCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tenaga Pendidik</p>
                </div>

                {{-- Rombel Kelas --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 200ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="door-closed" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $classCount }}" data-suffix="">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Rombel Kelas</p>
                </div>

                {{-- Tahun Berdiri --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 300ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="building" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="10" data-suffix=" Tahun">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PROFIL SECTION
         ════════════════════════════════════════════ --}}
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">DESKRIPSI TK</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal reveal-left p-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-100 to-orange-50 rounded-2xl transform -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-slate-100 flex items-center justify-center min-h-[300px]">
                            <img src="{{ $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/logomq.jpg') }}" alt="Logo SIT"
                                class="w-40 h-40 object-contain animate-floating">
                        </div>
                    </div>
                </div>

                <div class="reveal reveal-right">
                    <h3 class="text-xl font-bold text-slate-800 mb-5">{{ $detail && $detail->description_title ? $detail->description_title : 'Pondasi Kuat untuk Generasi Qur\'ani' }}</h3>
                    <div class="space-y-4 text-[0.95rem] text-slate-600 leading-relaxed">
                        @if($detail && $detail->description_body)
                            {!! nl2br(e($detail->description_body)) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         GURU SECTION
         ════════════════════════════════════════════ --}}
    @php
        $statisticBg = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        $bgImageUrl = ($statisticBg && $statisticBg->value) ? (str_starts_with($statisticBg->value, 'http') ? $statisticBg->value : Storage::url($statisticBg->value)) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80';
    @endphp
    <section id="guru" class="relative py-20 overflow-hidden bg-cover bg-center bg-fixed bg-no-repeat" style="background-image: linear-gradient(to bottom, rgba(254, 243, 199, 0.88), rgba(254, 243, 199, 0.88)){{ $bgImageUrl ? ", url('" . $bgImageUrl . "')" : "" }};">
        <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white to-transparent pointer-events-none z-0"></div>
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-white to-transparent pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">GURU & TENAGA PENDIDIK</h2>

            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $displayTeachers = [];
                    if (isset($teachers) && !$teachers->isEmpty()) {
                        foreach ($teachers as $item) {
                            if ($item->teacher) {
                                $displayTeachers[] = [
                                    'name' => $item->teacher->full_name,
                                    'photo' => $item->teacher->photo ? (Str::startsWith($item->teacher->photo, 'http') ? $item->teacher->photo : asset('storage/' . $item->teacher->photo)) : 'https://images.unsplash.com/photo-1546961342-ea5f62d7e57f?auto=format&fit=crop&w=400&q=80',
                                ];
                            }
                        }
                    }
                @endphp
                @if(!empty($displayTeachers))
                @foreach ($displayTeachers as $idx => $g)
                    <div class="unit-teacher-card reveal" style="transition-delay: {{ $idx * 70 }}ms">
                        <div class="unit-teacher-photo">
                            <img src="{{ $g['photo'] }}" alt="{{ $g['name'] }}">
                        </div>
                        <div class="unit-teacher-info">
                            <h3>{{ $g['name'] }}</h3>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════════════
         EKSTRAKURIKULER
         ════════════════════════════════════════════ --}}
    <section id="ekstrakurikuler" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">EKSTRAKURIKULER</h2>

            </div>
            <div class="w-full">
                @php
                    $displayEkskuls = [];
                    if (isset($ekskuls) && !$ekskuls->isEmpty()) {
                        foreach ($ekskuls as $ekskul) {
                            $displayEkskuls[] = [
                                'icon' => $ekskul->icon ? $ekskul->icon : 'activity',
                                'title' => $ekskul->title,
                                'img' => $ekskul->image ? (Str::startsWith($ekskul->image, 'http') ? $ekskul->image : asset('storage/' . $ekskul->image)) : 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80',
                                'desc' => $ekskul->description,
                            ];
                        }
                    }

                    // Partitioning into rows
                    $rowsCount = 2;
                    if (count($displayEkskuls) >= 9) {
                        $rowsCount = 3;
                    }

                    $rows = array_fill(0, $rowsCount, []);
                    foreach ($displayEkskuls as $idx => $e) {
                        $rows[$idx % $rowsCount][] = $e;
                    }

                    // Repeat rows for smooth scrolling
                    $repeatedRows = [];
                    foreach ($rows as $rIdx => $rowItems) {
                        if (empty($rowItems)) continue;
                        $baseRow = $rowItems;
                        while (count($baseRow) < 8) {
                            $baseRow = array_merge($baseRow, $rowItems);
                        }
                        $repeatedRows[$rIdx] = array_merge($baseRow, $baseRow);
                    }
                @endphp

                @if(!empty($repeatedRows))
                <style>
                    .marquee-wrapper {
                        mask-image: linear-gradient(to right, transparent, white 80px, white calc(100% - 80px), transparent);
                        -webkit-mask-image: linear-gradient(to right, transparent, white 80px, white calc(100% - 80px), transparent);
                    }
                    
                    @keyframes marquee-to-left {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-50%); }
                    }
                    
                    @keyframes marquee-to-right {
                        0% { transform: translateX(-50%); }
                        100% { transform: translateX(0); }
                    }
                    
                    .animate-marquee-to-left {
                        animation: marquee-to-left 40s linear infinite;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        width: max-content !important;
                        flex-shrink: 0 !important;
                    }
                    
                    .animate-marquee-to-right {
                        animation: marquee-to-right 40s linear infinite;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        width: max-content !important;
                        flex-shrink: 0 !important;
                    }
                    
                    .ekskul-marquee-row:hover .animate-marquee-to-left,
                    .ekskul-marquee-row:hover .animate-marquee-to-right {
                        animation-play-state: paused;
                    }
                </style>

                <div class="w-full flex flex-col gap-6 relative z-10 marquee-wrapper overflow-hidden py-6">
                    @foreach($repeatedRows as $rIdx => $rowItems)
                        <div class="ekskul-marquee-row w-full overflow-hidden select-none">
                            <div class="flex flex-nowrap gap-6 {{ $rIdx % 2 == 0 ? 'animate-marquee-to-left' : 'animate-marquee-to-right' }}">
                                @foreach($rowItems as $e)
                                    <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 w-[260px] sm:w-[300px] h-[180px] sm:h-[210px] flex-shrink-0 hover:scale-105 cursor-pointer">
                                        <img src="{{ $e['img'] }}" alt="{{ $e['title'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 transition-opacity duration-300"
                                            style="background: linear-gradient(to top, rgba(2,44,34,0.92) 0%, rgba(2,44,34,0.28) 55%, transparent 100%);">
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
                                            <div class="w-8 h-8 rounded-lg mb-2 flex items-center justify-center bg-[#ea580c]/20 text-[#6ee7b7] border border-[#ea580c]/30">
                                                <i data-lucide="{{ $e['icon'] }}" class="w-3.5 h-3.5"></i>
                                            </div>
                                            <h3 class="font-bold text-white text-sm sm:text-base mb-1">{{ $e['title'] }}</h3>
                                            <p class="text-xs text-slate-300 leading-snug max-h-0 group-hover:max-h-16 overflow-hidden transition-all duration-500">
                                                {{ $e['desc'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         FASILITAS SECTION
         ════════════════════════════════════════════ --}}
    <section id="fasilitas" class="py-20 bg-slate-50 border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="section-title">FASILITAS</h2>
                <p class="unit-section-desc">Fasilitas penunjang kegiatan belajar mengajar yang lengkap dan memadai untuk mendukung tumbuh kembang siswa.</p>
            </div>

            @php
                $displayFacilities = [];
                if (isset($facilities) && !$facilities->isEmpty()) {
                    foreach ($facilities as $fac) {
                        $displayFacilities[] = [
                            'icon' => $fac->icon ? $fac->icon : 'check',
                            'title' => $fac->title,
                        ];
                    }
                }
            @endphp
            @if(!empty($displayFacilities))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto reveal reveal-up">
                @foreach ($displayFacilities as $idx => $f)
                    <div class="group flex items-center gap-4 bg-white hover:bg-slate-50 border border-slate-200/60 rounded-full p-2.5 pr-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md hover:border-orange-200" style="transition-delay: {{ $idx * 50 }}ms;">
                        <div class="w-12 h-12 rounded-full bg-white border-2 border-orange-500 flex items-center justify-center text-orange-500 shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                            <i data-lucide="{{ $f['icon'] }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-sm font-bold uppercase tracking-wider text-slate-700">{{ $f['title'] }}</span>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PRESTASI SECTION — satu section, timeline modern
         ════════════════════════════════════════════ --}}
    <section id="prestasi" class="py-20 bg-white overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 reveal">
                <h2 class="section-title">PRESTASI</h2>

            </div>

            <div class="relative tl-container">

                {{-- Vertical line --}}
                <div class="tl-line absolute top-0 bottom-0 w-px left-[10px] md:left-1/2 md:-translate-x-px"></div>

                @php
                    $displayAchievements = [];
                    if (isset($achievements) && !$achievements->isEmpty()) {
                        foreach ($achievements as $ach) {
                            $displayAchievements[] = [
                                'year' => $ach->year,
                                'title' => $ach->title,
                                'desc' => $ach->description,
                                'level' => $ach->level,
                                'side' => $ach->side ? $ach->side : 'left',
                            ];
                        }
                    }

                    $lvlStyle = [
                        'Internasional' => 'background:rgba(220,38,38,.10);  color:#dc2626;',
                        'Nasional'      => 'background:rgba(249,115,22,.10); color:#ea580c;',
                        'Provinsi'      => 'background:rgba(59,130,246,.10); color:#2563eb;',
                        'Kabupaten'     => 'background:rgba(234, 88, 12,.10); color:#ea580c;',
                        'Kecamatan'     => 'background:rgba(100,116,139,.10);color:#475569;',
                    ];
                @endphp
                @if(!empty($displayAchievements))

                @foreach ($displayAchievements as $idx => $p)
                    @php
                        $isLeft = $p['side'] === 'left';
                        $delay  = $idx * 120;
                        $ls     = $lvlStyle[$p['level']] ?? $lvlStyle['Kecamatan'];
                    @endphp

                    <div class="relative flex items-start mb-9 last:mb-0 reveal reveal-repeat pl-8 md:pl-0 md:{{ $isLeft ? 'flex-row' : 'flex-row-reverse' }}"
                        style="transition-delay: {{ $delay }}ms;">

                        {{-- Card --}}
                        <div class="w-full md:w-[calc(50%-28px)] {{ $isLeft ? 'md:pr-8' : 'md:pl-8' }}">
                            <div class="tl-card group bg-white border border-slate-100 rounded-[20px] p-5
                                        shadow-sm transition-all duration-300 ease-out
                                        hover:-translate-y-1 hover:shadow-lg hover:border-orange-300">

                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-bold rounded-full"
                                        style="background:rgba(234, 88, 12,.10); color:#ea580c;">
                                        {{ $p['year'] }}
                                    </span>
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full"
                                        style="{{ $ls }}">
                                        {{ $p['level'] }}
                                    </span>
                                </div>

                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5"
                                        style="background: linear-gradient(135deg,#f97316,#ea580c);">
                                        <i data-lucide="trophy" class="w-4 h-4 text-white"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800 leading-snug">{{ $p['title'] }}</h3>
                                </div>

                                <p class="text-xs text-slate-500 leading-relaxed pl-11">{{ $p['desc'] }}</p>
                            </div>
                        </div>

                        {{-- Dot --}}
                        <div class="tl-dot-wrap absolute left-[10px] md:left-1/2 -translate-x-1/2 flex items-center justify-center z-10"
                            style="top: 1.1rem;">
                            <span class="tl-dot-glow absolute w-7 h-7 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                style="background:rgba(234, 88, 12,.15);"></span>
                            <span class="tl-dot relative w-[14px] h-[14px] rounded-full border-[2.5px] border-white"
                                style="background: linear-gradient(135deg,#fb923c,#ea580c);
                                       box-shadow: 0 0 0 3px rgba(234, 88, 12,.28), 0 0 10px rgba(234, 88, 12,.25);">
                            </span>
                        </div>

                        {{-- Spacer --}}
                        <div class="hidden md:block md:w-[calc(50%-28px)]"></div>
                    </div>
                @endforeach
                @endif

            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            /* ── Reveal: masuk saat scroll turun, KELUAR saat scroll naik ── */
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    } else if (entry.target.classList.contains('reveal-repeat')) {
                        entry.target.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

            /* ── Timeline line grow/shrink ── */
            const tlLine = document.querySelector('.tl-line');
            if (tlLine) {
                new IntersectionObserver(([e]) => {
                    if (e.isIntersecting) {
                        tlLine.classList.add('visible');
                    } else {
                        tlLine.classList.remove('visible');
                    }
                }, { threshold: 0.05 }).observe(tlLine);
            }
        </script>
    @endpush

</div>
@endsection
