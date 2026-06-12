@extends('layouts.public')

@section('content')
    {{-- HERO SECTION --}}
    @vite(['resources/css/public-ppdb.css', 'resources/js/public-ppdb.js'])
    <section class="page-hero relative overflow-hidden flex items-center min-h-[480px]">
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-8 pb-16">
            <div class="breadcrumb mb-8"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span
                    class="current">Profil</span></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Kiri: Teks --}}
                <div class="text-left reveal reveal-left delay-100">
                    <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-4">
                        {{ $hero && $hero->title ? $hero->title : "Profil SIT Mutiara Qur'an" }}
                    </h1>
                    <p class="text-emerald-100/80 text-lg mb-8 max-w-lg">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : "Membangun generasi Qur'ani yang berkarakter, berprestasi, dan berwawasan global." }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil-singkat' }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-400 text-emerald-950 font-bold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Jelajahi Profil' }}
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                <div class="hidden lg:block relative reveal reveal-right delay-200">
                    <div class="w-full aspect-[4/3] rounded-[32px] overflow-hidden border-4 border-white/10 shadow-2xl">
                        <img src="{{ $hero && $hero->image ? $hero->image : 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&q=80&w=800' }}"
                            alt="Gedung Sekolah" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-emerald-900/20"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.public.profil-subnav')

    {{-- SECTION PROFIL SINGKAT --}}
    <section id="profil-singkat" class="public-section py-16 scroll-mt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 reveal reveal-up">
                <span class="section-badge"><i data-lucide="info" class="w-4 h-4"></i> Tentang Kami</span>
                <h2 class="section-title mx-auto">Profil Singkat Sekolah</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 reveal reveal-left delay-100">
                    <div
                        class="relative rounded-[32px] overflow-hidden border-4 border-emerald-50 shadow-2xl aspect-[4/5] max-w-md mx-auto">
                        <img src="{{ $welcomeMessage && $welcomeMessage->kepsek_photo ? $welcomeMessage->kepsek_photo : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600' }}"
                            alt="Sambutan Kepala Sekolah" class="w-full h-auto object-cover">
                    </div>
                    <div class="mt-6 text-center">
                        <h4 class="text-base font-extrabold text-slate-800">{{ $welcomeMessage && $welcomeMessage->kepsek_name ? $welcomeMessage->kepsek_name : 'Ustadz Ahmad Fauzi, S.Pd.I, M.Pd' }}</h4>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mt-1">{{ $welcomeMessage && $welcomeMessage->kepsek_title ? $welcomeMessage->kepsek_title : 'Kepala Sekolah SIT Mutiara Qur\'an' }}</p>
                    </div>
                </div>

                <div
                    class="lg:col-span-7 space-y-6 text-slate-600 leading-relaxed reveal reveal-right delay-200 feature-card bg-slate-50/50">
                    <p class="font-bold text-slate-800 text-lg">Bismillahirrahmanirrahim,</p>
                    @if ($welcomeMessage && $welcomeMessage->paragraphs)
                        @php
                            $paragraphs = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                        @endphp
                        @foreach ($paragraphs ?? [] as $paragraph)
                            <p>{!! $paragraph !!}</p>
                        @endforeach
                    @else
                        <p>
                            Puji syukur kepada Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad
                            SAW. Selamat datang di portal resmi <strong>SIT Mutiara Qur'an Nagari Cupak</strong>.
                        </p>
                        <p>
                            Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur'an yang
                            seimbang secara spiritual, intelektual, dan moral. Kami berupaya menghadirkan lingkungan belajar
                            yang kondusif, kurikulum terintegrasi antara ilmu pengetahuan umum dan keislaman, serta pembinaan
                            akhlak yang berkelanjutan.
                        </p>
                        <p>
                            Dengan dukungan asatidzah yang berkompeten dan fasilitas yang representatif, kami siap berkolaborasi
                            erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon
                            pemimpin umat yang berakhlak mulia.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION VISI & MISI --}}
    <section id="visi-misi" class="public-section py-16 scroll-mt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 reveal reveal-up">
                <span class="section-badge"><i data-lucide="target" class="w-4 h-4"></i> Visi & Misi</span>
                <h2 class="section-title mx-auto">Arah & Tujuan Pendidikan</h2>
                <p class="section-subtitle mx-auto text-center">
                    Berikut adalah Visi dan Misi SIT Mutiara Qur'an yang menjadi landasan penyelenggaraan pendidikan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                {{-- Kiri: Accordion --}}
                <div class="space-y-3 reveal reveal-left delay-100" x-data="{ open: null }">

                    {{-- VISI --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white cursor-pointer hover:border-slate-300 transition-all duration-200"
                        style="" :style="open === 'visi' ? 'border-left: 4px solid #10b981;' : ''"
                        @click="open = open === 'visi' ? null : 'visi'">

                        <div class="flex items-center justify-between px-5 py-4 gap-4">
                            <span class="font-semibold text-sm transition-colors duration-200"
                                :class="open === 'visi' ? 'text-emerald-600' : 'text-slate-700'">
                                Visi SIT Mutiara Qur'an
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 flex-shrink-0 transition-transform duration-300 text-slate-400"
                                :class="open === 'visi' ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>

                        <div x-show="open === 'visi'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="px-5 pb-5">
                            <p class="text-sm text-slate-600 leading-relaxed">
                                {{ $visi && $visi->text ? $visi->text : "Menjadi lembaga pendidikan Islam terpadu yang unggul dalam membentuk generasi Qur'ani, berakhlak mulia, cerdas, dan berdaya saing global." }}
                            </p>
                        </div>
                    </div>

                    {{-- MISI --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden bg-white cursor-pointer hover:border-slate-300 transition-all duration-200"
                         :style="open === 'misi' ? 'border-left: 4px solid #10b981;' : ''"
                         @click="open = open === 'misi' ? null : 'misi'">

                        <div class="flex items-center justify-between px-5 py-4 gap-4">
                            <span class="font-semibold text-sm transition-colors duration-200"
                                  :class="open === 'misi' ? 'text-emerald-600' : 'text-slate-700'">
                                Misi SIT Mutiara Qur'an
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 flex-shrink-0 transition-transform duration-300 text-slate-400"
                                 :class="open === 'misi' ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>

                        <div x-show="open === 'misi'" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0" class="px-5 pb-5">
                            @php
                                $displayMisi = [];
                                if (isset($misiItems) && !$misiItems->isEmpty()) {
                                    foreach ($misiItems as $item) {
                                        $displayMisi[] = $item->text;
                                    }
                                } else {
                                    $displayMisi = [
                                        'Menyelenggarakan pendidikan yang mengintegrasikan kurikulum nasional dan keislaman.',
                                        'Menumbuhkan kecintaan terhadap Al-Quran melalui program tahfidz.',
                                        'Membina akhlak mulia dan karakter islami pada seluruh peserta didik.',
                                        'Mengembangkan potensi akademik, minat, dan bakat siswa secara optimal.',
                                        'Menciptakan lingkungan belajar yang aman, nyaman, dan kondusif.',
                                        'Membangun kerjasama yang baik antara sekolah, orang tua, dan masyarakat.',
                                    ];
                                }
                            @endphp
                            <ol class="space-y-2 list-decimal list-inside">
                                @foreach ($displayMisi as $item)
                                    <li class="text-sm text-slate-600 leading-relaxed">{{ $item }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                </div>

                {{-- Kanan: Ilustrasi --}}
                <div class="hidden lg:flex justify-center items-center reveal reveal-right delay-200">
                    <img src="https://illustrations.popsy.co/amber/education.svg" alt="Ilustrasi Visi Misi"
                        class="w-full max-w-md drop-shadow-xl"
                        onerror="this.src='https://illustrations.popsy.co/emerald/student-going-to-school.svg'">
                </div>

            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION SEJARAH (Timeline) --}}
    <section id="sejarah" class="public-section py-16 bg-slate-50/50 scroll-mt-32">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal reveal-up">
                <span class="section-badge"><i data-lucide="clock" class="w-4 h-4"></i> Sejarah</span>
                <h2 class="section-title mx-auto">Perjalanan Kami</h2>
                <p class="section-subtitle mx-auto text-center">Rekam jejak perkembangan SIT Mutiara Qur'an dari masa ke
                    masa.</p>
            </div>

            @php
                $displaySejarah = [];
                if (isset($sejarahItems) && !$sejarahItems->isEmpty()) {
                    foreach ($sejarahItems as $item) {
                        $displaySejarah[] = [
                            'tahun' => $item->year,
                            'judul' => $item->title,
                            'desc' => $item->description
                        ];
                    }
                } else {
                    $displaySejarah = [
                        [
                            'tahun' => '2010',
                            'judul' => 'Pendirian Sekolah',
                            'desc' => 'SIT Mutiara Quran didirikan oleh yayasan dengan 2 kelas pertama dan 30 siswa. Visi awal adalah menciptakan pendidikan Islam yang memadukan ilmu dunia dan akhirat.',
                        ],
                        [
                            'tahun' => '2012',
                            'judul' => 'Pembukaan PAUD/TK',
                            'desc' => 'Membuka jenjang PAUD/TK Islam Terpadu untuk memulai pendidikan Qur\'ani sejak usia dini.',
                        ],
                        [
                            'tahun' => '2014',
                            'judul' => 'Akreditasi A',
                            'desc' => 'Meraih akreditasi A dari BAN-S/M untuk jenjang SD Islam Terpadu, membuktikan kualitas pendidikan yang unggul.',
                        ],
                        [
                            'tahun' => '2016',
                            'judul' => 'Wisuda Tahfidz Pertama',
                            'desc' => 'Angkatan pertama program tahfidz berhasil menyelesaikan target hafalan, menandai keberhasilan program unggulan.',
                        ],
                        [
                            'tahun' => '2018',
                            'judul' => 'Pembukaan SMP IT',
                            'desc' => 'Membuka jenjang SMP Islam Terpadu untuk melanjutkan misi pendidikan ke tingkat yang lebih tinggi.',
                        ],
                        [
                            'tahun' => '2023',
                            'judul' => 'Kampus Baru',
                            'desc' => 'Pindah ke kampus baru dengan fasilitas modern termasuk laboratorium, perpustakaan digital, dan area bermain yang luas.',
                        ],
                    ];
                }
            @endphp

            <div class="ppdb-timeline">
                @foreach ($displaySejarah as $i => $s)
                    @php
                        $revealClass = $i % 2 === 0 ? 'reveal-left' : 'reveal-right';
                        $delay = 'delay-' . (($i % 4) + 1) * 100;
                    @endphp
                    <div class="ppdb-timeline-item reveal {{ $revealClass }} {{ $delay }}">
                        <div class="ppdb-timeline-dot-wrapper">
                            <div class="ppdb-timeline-dot">
                                <i data-lucide="check" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                        </div>
                        <div class="ppdb-timeline-content">
                            <span class="ppdb-timeline-date-badge">{{ $s['tahun'] }}</span>
                            <h3>{{ $s['judul'] }}</h3>
                            <p>{{ $s['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION STRUKTUR ORGANISASI --}}
    <section id="struktur-organisasi" class="public-section py-16 scroll-mt-32">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-12 reveal reveal-up">
                <span class="section-badge"><i data-lucide="network" class="w-4 h-4"></i> Organisasi</span>
                <h2 class="section-title mx-auto">Struktur Organisasi</h2>
                <p class="section-subtitle mx-auto text-center">Susunan kepengurusan dan pimpinan SIT Mutiara Qur'an.</p>
            </div>

            <div
                class="bg-white p-4 sm:p-8 rounded-[32px] shadow-lg shadow-slate-200/50 border border-slate-100 reveal reveal-zoom delay-100 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-100/50 cursor-pointer group">
                <img src="{{ asset('images/struktur.png') }}" alt="Struktur Organisasi"
                    class="w-full h-auto rounded-2xl group-hover:scale-[1.01] transition-transform duration-500">
            </div>
        </div>
    </section>
@endsection
