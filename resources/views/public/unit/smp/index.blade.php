@extends('layouts.unit')

@section('navbar')
    <x-public.unit-navbar unitLogo="images/smp.jpeg" unitName="SMP Islam Terpadu" />
@endsection

@section('footer')
    <x-public.unit-footer unitName="SMP Islam Terpadu" />
@endsection

@section('content')
<div class="theme-smp">
    <style>
        :root {
            --unit-accent: #3b82f6;
            --unit-accent-lt: #93c5fd;
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
            background: rgba(37, 99, 235, 0.10);
            border: 1px solid rgba(37, 99, 235, 0.22);
            color: #2563eb;
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
            background: rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.3);
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
            border-color: #3b82f6;
            box-shadow: 0 6px 24px rgba(37, 99, 235, 0.10);
            transform: translateY(-3px);
        }

        .unit-curriculum-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(37, 99, 235, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #3b82f6;
            transition: background 0.3s;
        }

        .unit-curriculum-card:hover .unit-curriculum-icon {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
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
            border-color: #93c5fd;
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
            color: #3b82f6;
        }

        /* ── Timeline dot ─────────────────────────── */
        .unit-timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3b82f6;
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
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
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-16px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-floating {
            animation: float 6s ease-in-out infinite;
        }

        /* ── Timeline line ────────────────────────── */
        .tl-line {
            background: linear-gradient(to bottom, #60a5fa, #3b82f6, #2563eb);
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

            0%,
            100% {
                box-shadow: 0 0 0 3px rgba(37, 99, 235, .28), 0 0 10px rgba(37, 99, 235, .22);
            }

            50% {
                box-shadow: 0 0 0 5px rgba(37, 99, 235, .15), 0 0 18px rgba(37, 99, 235, .40);
            }
        }
    </style>

    {{-- ════════════════════════════════════════════
         HERO SECTION
         ════════════════════════════════════════════ --}}
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden"
        style="background: linear-gradient(135deg, #172554 0%, #1e3a8a 60%, #1d4ed8 100%);">

        <div class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(rgba(37, 99, 235,0.6) 1px, transparent 1px); background-size: 32px 32px;">
        </div>

        <div class="absolute top-1/4 left-0 w-72 h-72 rounded-full opacity-20"
            style="background: radial-gradient(circle, #3b82f6, transparent 70%); filter: blur(40px);"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full opacity-10"
            style="background: radial-gradient(circle, #60a5fa, transparent 70%); filter: blur(60px);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-28 pb-20 w-full">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-3 mb-6 md:mb-10 text-[0.95rem] reveal reveal-left">
                <a href="{{ route('public.home') }}" class="text-blue-100/80 hover:text-white font-medium transition-colors duration-300">Beranda</a>
                <span class="text-blue-100/40">/</span>
                <span class="text-blue-300 font-semibold tracking-wide drop-shadow-md">SMP Islam Terpadu</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Left text --}}
                <div class="reveal reveal-left">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-none tracking-tighter mt-2 mb-6">
                        @if($hero && $hero->title)
                            {{ $hero->title }}
                        @else
                            SMP ISLAM<br>
                            <span style="background: linear-gradient(90deg, #3b82f6, #60a5fa); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TERPADU</span>
                        @endif
                    </h1>

                    <p class="text-base text-slate-400 leading-relaxed mb-8 max-w-md">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : 'Membangun generasi remaja yang unggul secara akademik, berkarakter islami kuat, dan siap menghadapi tantangan era global.' }}
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil' }}" style="background: linear-gradient(135deg, #3b82f6, #2563eb); color: white;"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:-translate-y-1 hover:shadow-blue-500/30 transition-all duration-300">
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
                        <div class="absolute inset-0 bg-blue-500 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                        <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : asset('images/smp_dummy.png') }}" alt="SMP Islam Terpadu SIT Mutiara Qur'an"
                            class="relative w-full h-full object-contain mix-blend-screen drop-shadow-2xl">
                    </div>
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
                <h2 class="section-title">DESKRIPSI SMP</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal reveal-left p-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl transform -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-slate-100 flex items-center justify-center min-h-[300px]">
                            <img src="{{ $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/logomq.jpg') }}" alt="Logo SIT"
                                class="w-40 h-40 object-contain animate-floating">
                        </div>
                    </div>
                </div>

                <div class="reveal reveal-right">
                    <h3 class="text-xl font-bold text-slate-800 mb-5">{{ $detail && $detail->description_title ? $detail->description_title : 'Pendidikan Menengah Berkualitas & Berkarakter' }}</h3>
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
    <section id="guru" class="py-20" style="background: #f8fafc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    $displayEkskuls = [];
                    if (isset($ekskuls) && !$ekskuls->isEmpty()) {
                        foreach ($ekskuls as $ekskul) {
                            $displayEkskuls[] = [
                                'icon' => $ekskul->icon ? $ekskul->icon : 'activity',
                                'title' => $ekskul->title,
                                'img' => $ekskul->image ? (Str::startsWith($ekskul->image, 'http') ? $ekskul->image : asset('storage/' . $ekskul->image)) : 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80',
                                'desc' => $ekskul->description,
                            ];
                        }
                    }
                @endphp
                @if(!empty($displayEkskuls))
                @foreach ($displayEkskuls as $idx => $e)
                    <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 reveal"
                        style="transition-delay: {{ ($idx % 3) * 90 }}ms; aspect-ratio: 4/3;">
                        <img src="{{ $e['img'] }}" alt="{{ $e['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 transition-opacity duration-300"
                            style="background: linear-gradient(to top, rgba(2,44,34,0.92) 0%, rgba(2,44,34,0.28) 55%, transparent 100%);">
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="w-8 h-8 rounded-lg mb-2 flex items-center justify-center"
                                style="background: rgba(37, 99, 235,0.18); color:#6ee7b7; border:1px solid rgba(37, 99, 235,0.3);">
                                <i data-lucide="{{ $e['icon'] }}" class="w-3.5 h-3.5"></i>
                            </div>
                            <h3 class="font-semibold text-white text-sm mb-1">{{ $e['title'] }}</h3>
                            <p class="text-xs text-slate-300 leading-snug max-h-0 group-hover:max-h-16 overflow-hidden transition-all duration-500">
                                {{ $e['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         FASILITAS SECTION
         ════════════════════════════════════════════ --}}
    <section id="fasilitas" class="py-20" style="background: linear-gradient(135deg, #172554 0%, #1e3a8a 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title light">FASILITAS</h2>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-7 mb-8">
                <div class="grid grid-cols-2 gap-3 reveal reveal-left">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=400&q=80"
                        class="rounded-xl object-cover w-full" style="height:180px;" alt="Ruang Kelas">
                    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=400&q=80"
                        class="rounded-xl object-cover w-full" style="height:180px;" alt="Perpustakaan">
                    <img src="https://images.unsplash.com/photo-1629752187687-3d3c7ea3a21b?auto=format&fit=crop&w=400&q=80"
                        class="rounded-xl object-cover w-full col-span-2" style="height:180px;" alt="Laboratorium">
                </div>
                <div class="reveal reveal-right">
                    <div class="grid grid-cols-2 gap-3">
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
                            if (empty($displayFacilities)) {
                                $displayFacilities = [
                                    ['monitor',     'Ruang Kelas Nyaman'],
                                    ['laptop',      'Laboratorium Komputer'],
                                    ['library',     'Perpustakaan'],
                                    ['moon',        'Musholla Luas'],
                                    ['activity',    'Lapangan Olahraga'],
                                    ['stethoscope', 'Klinik / UKS'],
                                    ['coffee',      'Kantin Sehat'],
                                    ['cctv',        'Keamanan CCTV'],
                                ];
                            }
                        @endphp
                        @if(!empty($displayFacilities))
                        @foreach ($displayFacilities as $f)
                            <div class="flex items-center gap-2.5 p-3 rounded-xl transition-colors duration-300 hover:bg-white/5"
                                style="border: 1px solid rgba(255,255,255,0.06);">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                                    style="background: rgba(37, 99, 235,0.12); color: #3b82f6;">
                                    <i data-lucide="{{ $f['icon'] ?? $f[0] }}" class="w-3.5 h-3.5"></i>
                                </div>
                                <span class="text-xs font-semibold text-slate-300">{{ $f['title'] ?? $f[1] }}</span>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
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
                        'Kabupaten'     => 'background:rgba(37, 99, 235,.10); color:#2563eb;',
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
                                        hover:-translate-y-1 hover:shadow-lg hover:border-blue-300">

                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-bold rounded-full"
                                        style="background:rgba(37, 99, 235,.10); color:#2563eb;">
                                        {{ $p['year'] }}
                                    </span>
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full"
                                        style="{{ $ls }}">
                                        {{ $p['level'] }}
                                    </span>
                                </div>

                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5"
                                        style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
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
                            <span
                                class="tl-dot-glow absolute w-7 h-7 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                style="background:rgba(37, 99, 235,.15);"></span>
                            <span class="tl-dot relative w-[14px] h-[14px] rounded-full border-[2.5px] border-white"
                                style="background: linear-gradient(135deg,#60a5fa,#2563eb);
                                       box-shadow: 0 0 0 3px rgba(37, 99, 235,.28), 0 0 10px rgba(37, 99, 235,.25);">
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
                }, {
                    threshold: 0.05
                }).observe(tlLine);
            }
        </script>
    @endpush
</div>
@endsection
