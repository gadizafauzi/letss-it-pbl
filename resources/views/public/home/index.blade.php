@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>

        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">

                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-emerald-200 text-sm font-semibold mb-8">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    Sekolah Islam Terpadu
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight">
                    Mendidik Generasi
                    <span class="text-emerald-300">Qur'ani</span>
                    yang Berakhlak Mulia
                </h1>

                <p class="mt-6 text-lg text-emerald-100/80 leading-relaxed max-w-lg">
                    SIT Mutiara Qur'an hadir untuk membentuk generasi unggul yang beriman, berilmu, dan berprestasi dengan kurikulum Islam Terpadu.
                </p>

                <div class="flex flex-wrap gap-4 mt-10">
                    <a href="{{ route('public.ppdb.index') }}"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white text-emerald-700 font-bold text-sm shadow-lg shadow-emerald-900/30 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        Daftar PPDB
                    </a>
                    <a href="{{ route('public.profil.visi-misi') }}"
                        class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 text-white font-bold text-sm hover:bg-white/20 transition-all duration-300">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                        Profil Sekolah
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="bg-gradient-to-r from-emerald-600 to-emerald-700 py-6">
        <div class="w-full px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="stat-item">
                    <p class="stat-number" data-count="500" data-suffix="+">0</p>
                    <p class="stat-label">Siswa Aktif</p>
                </div>
                <div class="stat-item">
                    <p class="stat-number" data-count="35" data-suffix="+">0</p>
                    <p class="stat-label">Tenaga Pendidik</p>
                </div>
                <div class="stat-item">
                    <p class="stat-number" data-count="18">0</p>
                    <p class="stat-label">Rombel Kelas</p>
                </div>
                <div class="stat-item">
                    <p class="stat-number" data-count="15" data-suffix=" Thn">0</p>
                    <p class="stat-label">Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="public-section bg-slate-50">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="award" class="w-4 h-4"></i> Keunggulan Kami</span>
                <h2 class="section-title mx-auto">Mengapa Memilih SIT Mutiara Qur'an?</h2>
                <p class="section-subtitle mx-auto text-center">Kami mengintegrasikan pendidikan akademik berkualitas dengan nilai-nilai Islam dalam setiap aspek pembelajaran.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $keunggulan = [
                        ['icon' => 'book-open', 'bg' => 'emerald', 'title' => 'Kurikulum Terpadu', 'desc' => 'Memadukan kurikulum nasional dengan kurikulum keislaman untuk pembelajaran yang komprehensif.'],
                        ['icon' => 'book-marked', 'bg' => 'amber', 'title' => 'Program Tahfidz', 'desc' => 'Program unggulan menghafal Al-Qur\'an dengan metode yang menyenangkan dan target yang terukur.'],
                        ['icon' => 'users', 'bg' => 'blue', 'title' => 'Guru Profesional', 'desc' => 'Tenaga pendidik berpengalaman dan bersertifikat dengan dedikasi tinggi terhadap pendidikan Islam.'],
                        ['icon' => 'trophy', 'bg' => 'violet', 'title' => 'Prestasi Gemilang', 'desc' => 'Siswa berprestasi di berbagai lomba akademik, tahfidz, dan kegiatan ekstrakurikuler tingkat regional.'],
                        ['icon' => 'heart-handshake', 'bg' => 'rose', 'title' => 'Pembinaan Akhlak', 'desc' => 'Pendidikan karakter islami yang membentuk akhlak mulia dalam kehidupan sehari-hari siswa.'],
                        ['icon' => 'monitor', 'bg' => 'cyan', 'title' => 'Fasilitas Modern', 'desc' => 'Ruang kelas ber-AC, laboratorium komputer, perpustakaan, dan area bermain yang aman dan nyaman.'],
                    ];
                @endphp
                @foreach($keunggulan as $item)
                    <div class="feature-card fade-up">
                        <div class="feature-icon bg-{{ $item['bg'] }}-50 text-{{ $item['bg'] }}-600">
                            <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- UNIT PENDIDIKAN PREVIEW --}}
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="layers-3" class="w-4 h-4"></i> Unit Pendidikan</span>
                <h2 class="section-title mx-auto">Jenjang Pendidikan Kami</h2>
                <p class="section-subtitle mx-auto text-center">Menyediakan pendidikan islami berkualitas dari jenjang PAUD hingga SMP.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $units = [
                        ['icon' => 'baby', 'color' => 'pink', 'title' => 'PAUD / TK', 'desc' => 'Pembelajaran menyenangkan untuk usia dini dengan pendekatan bermain dan mengenal Al-Qur\'an.', 'route' => 'public.unit.tk.profil'],
                        ['icon' => 'school', 'color' => 'emerald', 'title' => 'SD Islam Terpadu', 'desc' => 'Fondasi akademik dan keislaman yang kuat untuk mempersiapkan generasi berkarakter.', 'route' => 'public.unit.sd.profil'],
                        ['icon' => 'graduation-cap', 'color' => 'blue', 'title' => 'SMP Islam Terpadu', 'desc' => 'Pendidikan menengah yang mempersiapkan siswa unggul secara akademik dan spiritual.', 'route' => 'public.unit.smp.profil'],
                    ];
                @endphp
                @foreach($units as $unit)
                    <div class="feature-card text-center fade-up">
                        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-{{ $unit['color'] }}-100 to-{{ $unit['color'] }}-200 flex items-center justify-center mx-auto mb-5">
                            <i data-lucide="{{ $unit['icon'] }}" class="w-9 h-9 text-{{ $unit['color'] }}-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">{{ $unit['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-5">{{ $unit['desc'] }}</p>
                        <a href="{{ route($unit['route']) }}" class="text-emerald-600 text-sm font-bold hover:underline">Selengkapnya &rarr;</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA PPDB --}}
    <section class="public-section bg-gradient-to-br from-emerald-700 to-emerald-900 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-3xl mx-auto text-center relative z-10 fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-emerald-200 text-sm font-bold mb-6">
                <i data-lucide="megaphone" class="w-4 h-4"></i> Pendaftaran Dibuka
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">
                Penerimaan Peserta Didik Baru<br>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
            </h2>
            <p class="text-emerald-100/70 text-base mb-10 max-w-lg mx-auto">
                Daftarkan putra-putri Anda di SIT Mutiara Qur'an dan berikan mereka pendidikan terbaik.
            </p>
            <a href="{{ route('public.ppdb.index') }}"
                class="inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-white text-emerald-700 font-bold text-base shadow-lg shadow-emerald-900/40 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                <i data-lucide="file-text" class="w-5 h-5"></i> Informasi PPDB
            </a>
        </div>
    </section>

@endsection
