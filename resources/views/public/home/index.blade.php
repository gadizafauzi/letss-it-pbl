@extends('layouts.public')

@section('content')

    {{-- RUNNING MARQUEE --}}
    <div class="announcement-marquee">
        <div class="marquee-container">
            <span class="marquee-badge">Pengumuman</span>
            <div class="marquee-track">
                <span class="marquee-item">📢 Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }} Resmi Dibuka! Gelombang 1 Dapatkan Diskon Dana Pembangunan.</span>
                <span class="marquee-item">🏆 Alhamdulillah, Siswa SMP IT Mutiara Qur'an Meraih Medali Emas & Perak pada Olimpiade Sains Nasional Tingkat Kabupaten Solok!</span>
                <span class="marquee-item">🕌 Wisuda Tahfidz Qur'an Angkatan ke-8 Sukses Diselenggarakan, Melahirkan 45 Hafizh Cilik yang Siap Berbakti.</span>
                <!-- Repeat for infinite scroll continuity -->
                <span class="marquee-item">📢 Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }} Resmi Dibuka! Gelombang 1 Dapatkan Diskon Dana Pembangunan.</span>
                <span class="marquee-item">🏆 Alhamdulillah, Siswa SMP IT Mutiara Qur'an Meraih Medali Emas & Perak pada Olimpiade Sains Nasional Tingkat Kabupaten Solok!</span>
                <span class="marquee-item">🕌 Wisuda Tahfidz Qur'an Angkatan ke-8 Sukses Diselenggarakan, Melahirkan 45 Hafizh Cilik yang Siap Berbakti.</span>
            </div>
        </div>
    </div>

    {{-- HERO --}}
    <section class="hero-section relative overflow-hidden flex items-center">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        <div class="glow-emerald top-20 left-10"></div>
        <div class="glow-amber bottom-20 right-10"></div>

        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 pt-6 pb-20 sm:pt-8 sm:pb-28 lg:pt-10 lg:pb-36">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center -translate-y-6 lg:-translate-y-16">
                
                {{-- Left Text --}}
                <div class="lg:col-span-7 max-w-3xl text-left">
                    
                    {{-- Accreditation stamp --}}
                    <div class="accreditation-stamp mb-6 hero-animate-left">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                        <div class="accreditation-text">
                            <h5>Terakreditasi A</h5>
                            <p>BAN-PDM PROVINSI SUMATERA BARAT</p>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-sm font-semibold mb-6 hero-animate-right">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                        Sekolah Islam Terpadu (JSIT)
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight hero-animate-2">
                        Mendidik Generasi
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-amber-300">Qur'ani</span>
                        yang Berakhlak Mulia & Berprestasi
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-emerald-100/80 leading-relaxed max-w-xl hero-animate-3">
                        SIT Mutiara Qur'an hadir di Nagari Cupak untuk membentuk generasi robbani yang mandiri, berkarakter mulia, cerdas akademis, serta mencintai Al-Qur'an.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-8 hero-animate-4">
                        <a href="{{ route('public.ppdb.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-950 font-extrabold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                            Daftar PPDB Online
                        </a>
                        <a href="{{ route('public.profil.visi-misi') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                            Profil Sekolah
                        </a>
                    </div>
                </div>

                {{-- Right Visual representation --}}
                <div class="lg:col-span-5 hidden lg:block fade-up">
                    <div class="relative">
                        {{-- Decorative float card --}}
                        <div class="absolute top-4 -left-4 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-xs font-black text-slate-800">Target Hafalan Mapan</h6>
                                <p class="text-[10px] text-slate-500">Up to 10 Juz Mutqin</p>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -right-4 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 5s;">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-xs font-black text-slate-800">Pembinaan Akhlak</h6>
                                <p class="text-[10px] text-slate-500">Mentoring Harian & Mabit</p>
                            </div>
                        </div>

                        <div class="w-full aspect-[4/5] rounded-[36px] bg-gradient-to-br from-emerald-800/80 to-emerald-950/80 border-4 border-white/10 shadow-2xl overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&q=80&w=800" alt="Siswa SIT Mutiara Qur'an" class="w-full h-full object-cover mix-blend-overlay opacity-65">
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-transparent to-transparent"></div>
                            
                            <div class="absolute bottom-8 left-8 right-8 z-10 text-left">
                                <p class="text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-2">Pendaftaran Sekolah</p>
                                <h3 class="text-xl font-bold text-white leading-snug">Berikan Pendidikan Agama dan Akademis Terbaik Bagi Putra-Putri Anda</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Animated Wave Divider (Bottom of Hero) -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none">
            <svg class="relative block w-[200%] h-[80px] sm:h-[120px] md:h-[160px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 160" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="heroWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#0d9488" />
                        <stop offset="100%" stop-color="#059669" />
                    </linearGradient>
                </defs>
                <!-- Back wave (Green/Teal Transparent) -->
                <path class="anim-wave-back" d="M0,70 Q150,10 300,70 T600,70 Q750,10 900,70 T1200,70 V160 H0 Z" fill="url(#heroWaveGradient)" opacity="0.4"></path>
                <!-- Middle wave (Soft Yellow Accent) -->
                <path class="anim-wave-mid" d="M0,80 Q150,140 300,80 T600,80 Q750,140 900,80 T1200,80 V160 H0 Z" fill="#fbbf24" opacity="0.8"></path>
                <!-- Front wave (Solid White) -->
                <path class="anim-wave-front" d="M0,90 Q150,30 300,90 T600,90 Q750,30 900,90 T1200,90 V160 H0 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>


    {{-- STATS --}}
    <section class="bg-white py-16 md:py-24 relative z-20">
        <div class="w-full px-4 max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Card 1: Siswa Aktif (Amber) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 group fade-up flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="users" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="500" data-suffix="+">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Siswa Aktif</p>
                </div>
                
                <!-- Card 2: Tenaga Pendidik (Emerald) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-emerald-500 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 group fade-up flex flex-col items-center text-center" style="transition-delay: 100ms;">
                    <div class="w-20 h-20 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="graduation-cap" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="35" data-suffix="+">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Tenaga Pendidik</p>
                </div>

                <!-- Card 3: Rombel Kelas (Teal) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-teal-500 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 group fade-up flex flex-col items-center text-center" style="transition-delay: 200ms;">
                    <div class="w-20 h-20 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="book-open" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="18">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Rombel Kelas</p>
                </div>

                <!-- Card 4: Tahun Berdiri (Amber) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 group fade-up flex flex-col items-center text-center" style="transition-delay: 300ms;">
                    <div class="w-20 h-20 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="building" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="15" data-suffix=" Tahun">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes waveTranslateX {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }
        .anim-wave-front {
            animation: waveTranslateX 20s ease-in-out infinite alternate;
        }
        .anim-wave-mid {
            animation: waveTranslateX 12s ease-in-out infinite alternate;
        }
        .anim-wave-back {
            animation: waveTranslateX 10s ease-in-out infinite alternate;
        }

        @keyframes heroEntrance {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroEntranceLeft {
            0% {
                opacity: 0;
                transform: translateX(-40px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes heroEntranceRight {
            0% {
                opacity: 0;
                transform: translateX(40px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-animate-left {
            opacity: 0;
            animation: heroEntranceLeft 0.8s ease-out forwards;
            animation-delay: 0s;
        }

        .hero-animate-right {
            opacity: 0;
            animation: heroEntranceRight 0.8s ease-out forwards;
            animation-delay: 0s;
        }

        .hero-animate-2 {
            opacity: 0;
            animation: heroEntrance 0.8s ease-out forwards;
            animation-delay: 0.4s;
        }

        .hero-animate-3 {
            opacity: 0;
            animation: heroEntrance 0.8s ease-out forwards;
            animation-delay: 0.8s;
        }

        .hero-animate-4 {
            opacity: 0;
            animation: heroEntrance 0.8s ease-out forwards;
            animation-delay: 1.2s;
        }

        @keyframes titleEntrance {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.92);
            }
            60% {
                opacity: 1;
                transform: translateY(0) scale(1.03);
            }
            80% {
                transform: scale(0.99) rotate(0.5deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }
        
        .title-anim {
            opacity: 0;
            transform: translateY(20px) scale(0.92);
        }
        
        .fade-up.title-anim.visible {
            animation: titleEntrance 1s ease-out forwards;
            transition: none;
        }
    </style>

    {{-- SAMBUTAN KEPALA SEKOLAH --}}
    <section class="public-section bg-white relative overflow-hidden islamic-pattern-bg">
        <div class="glow-emerald top-10 left-10"></div>
        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                {{-- Avatar Column --}}
                <div class="lg:col-span-5 flex justify-center fade-up">
                    <div class="sambutan-wrapper max-w-sm w-full">
                        <div class="sambutan-avatar-container">
                            <div class="sambutan-avatar-bg"></div>
                            <div class="sambutan-image-frame relative overflow-hidden rounded-[24px] group transition-all duration-400 hover:shadow-[0_10px_40px_-10px_rgba(5,150,105,0.3)] bg-white">
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600" alt="Kepala Sekolah SIT Mutiara Qur'an" class="w-full h-96 object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.08]">
                                <div class="sambutan-badge transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:bg-emerald-600 group-hover:text-white">Kepala Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Content Column --}}
                <div class="lg:col-span-7 text-left">
                    <span class="section-badge fade-up"><i data-lucide="quote" class="w-4 h-4"></i> Kata Sambutan</span>
                    <h2 class="section-title text-left mb-6 fade-up title-anim" style="transition-delay: 200ms;">Membentuk Generasi Rabbanî yang Unggul & Berkarakter</h2>
                    
                    <div class="space-y-4 text-slate-600 leading-relaxed text-sm sm:text-base">
                        <p class="font-bold text-slate-800 text-lg fade-up" style="transition-delay: 300ms;">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                        <p class="fade-up" style="transition-delay: 500ms;">
                            Segala puji bagi Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad SAW. Selamat datang di portal resmi <strong>SIT Mutiara Qur'an Nagari Cupak</strong>.
                        </p>
                        <p class="fade-up" style="transition-delay: 700ms;">
                            Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur'an yang seimbang secara spiritual, intelektual, dan moral. Kami meyakini bahwa setiap anak memiliki potensi terbaiknya, dan tugas kamilah di sekolah untuk menuntun serta mengasah potensi tersebut dengan berlandaskan nilai-nilai Al-Qur'an dan Sunnah.
                        </p>
                        <p class="fade-up" style="transition-delay: 900ms;">
                            Dengan dukungan asatidzah yang berkompeten, fasilitas yang kondusif, serta lingkungan yang islami, kami siap berkolaborasi erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon pemimpin umat masa depan yang berakhlak mulia.
                        </p>
                    </div>
                    
                    <div class="mt-8 border-t border-slate-100 pt-6 fade-up" style="transition-delay: 1100ms;">
                        <h4 class="text-base font-extrabold text-slate-800">Ustadz Ahmad Fauzi, S.Pd.I, M.Pd</h4>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mt-1">Pimpinan & Kepala Sekolah SIT Mutiara Qur'an</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    {{-- PROGRAM UNGGULAN --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="glow-amber bottom-10 right-10"></div>
        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 fade-up">
                <span class="section-badge"><i data-lucide="sparkles" class="w-4 h-4"></i> Program Unggulan</span>
                <h2 class="section-title mx-auto">Program Khusus Keislaman & Akademik</h2>
                <p class="section-subtitle mx-auto text-center">Kurikulum keagamaan dan akademik yang dirancang secara matang untuk menyeimbangkan kecerdasan intelektual dan spiritual.</p>
            </div>
            
            {{-- Program Filter Tabs --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12 fade-up">
                <button onclick="filterPrograms('all', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-emerald-600 text-white shadow-md shadow-emerald-200 transition-all duration-300 filter-btn">Semua Program</button>
                <button onclick="filterPrograms('keislaman', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-300 filter-btn">Keislaman</button>
                <button onclick="filterPrograms('akademik', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-300 filter-btn">Akademik & IT</button>
                <button onclick="filterPrograms('karakter', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-300 filter-btn">Karakter & Pemimpin</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $programs = [
                        [
                            'icon' => 'book-open',
                            'title' => 'Tahfidz Qur\'an Mutqin',
                            'desc' => 'Program menghafal Al-Qur\'an terstruktur dengan metode talaqqi dan murojaah intensif untuk menjaga kualitas hafalan siswa (target mutqin).',
                            'detail' => 'Target: TK Juz 30, SD 5 Juz, SMP 10 Juz',
                            'category' => 'keislaman'
                        ],
                        [
                            'icon' => 'heart',
                            'title' => 'Pembiasaan Akhlakul Karimah',
                            'desc' => 'Internalisasi adab islami harian melalui Sholat Dhuha, Mabit (Malam Bina Iman dan Taqwa), Dzikir Pagi-Petang, serta pengawasan ibadah mandiri.',
                            'detail' => 'Karakter islami terintegrasi dalam keseharian',
                            'category' => 'keislaman'
                        ],
                        [
                            'icon' => 'languages',
                            'title' => 'Bilingual Environment',
                            'desc' => 'Peningkatan kapasitas bahasa asing (Arab & Inggris) yang digunakan dalam komunikasi harian ringan, doa, dan materi ajar tertentu.',
                            'detail' => 'Daily Arabic & English Conversation',
                            'category' => 'akademik'
                        ],
                        [
                            'icon' => 'code',
                            'title' => 'Digital Literacy & Coding',
                            'desc' => 'Khusus untuk tingkat SMP, dibekali dasar pemrograman komputer, logika digital, dan etika penggunaan teknologi informasi.',
                            'detail' => 'Kesiapan menghadapi era revolusi industri 4.0',
                            'category' => 'akademik'
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Mentoring & Halaqah',
                            'desc' => 'Kelompok bimbingan rohani khusus (liqo/mentoring) dengan rasio asatidzah kecil untuk memantau perkembangan emosional dan spiritual siswa.',
                            'detail' => 'Konseling terpadu yang penuh perhatian',
                            'category' => 'karakter'
                        ],
                        [
                            'icon' => 'compass',
                            'title' => 'Leadership & Outbound',
                            'desc' => 'Pelatihan kepemimpinan dasar, pramuka IT, kemah ukhuwah, dan kegiatan outbound untuk melatih kemandirian, keberanian, dan kerjasama tim.',
                            'detail' => 'Mencetak calon pemimpin umat masa depan',
                            'category' => 'karakter'
                        ]
                    ];
                @endphp
                @foreach($programs as $p)
                    <div class="program-card fade-up program-item transition-all duration-300" data-category="{{ $p['category'] }}">
                        <div class="program-icon-wrapper">
                            <i data-lucide="{{ $p['icon'] }}" class="w-7 h-7"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">{{ $p['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $p['desc'] }}</p>
                        <div class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-2 rounded-xl inline-block">
                            {{ $p['detail'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN TAMBAHAN --}}
    <section class="public-section bg-white">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="award" class="w-4 h-4"></i> Keunggulan Kami</span>
                <h2 class="section-title mx-auto">Mengapa Memilih Mutiara Qur'an?</h2>
                <p class="section-subtitle mx-auto text-center">Fasilitas yang modern dan lingkungan yang aman bersinergi melahirkan kenyamanan belajar penuh berkah.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $keunggulan = [
                        ['icon' => 'book-marked', 'bg' => 'amber', 'title' => 'Kurikulum Merdeka + JSIT', 'desc' => 'Mengintegrasikan kurikulum nasional Kurikulum Merdeka dengan kurikulum kekhasan JSIT.'],
                        ['icon' => 'monitor', 'bg' => 'emerald', 'title' => 'Laboratorium Komputer', 'desc' => 'Fasilitas komputer modern penunjang praktikum TIK dan pemrograman dasar sejak usia dini.'],
                        ['icon' => 'users-2', 'bg' => 'blue', 'title' => 'Tenaga Pendidik Berdedikasi', 'desc' => 'Asatidzah lulusan perguruan tinggi terkemuka, bersertifikat pendidik, dan hafizh/hafizhah.'],
                        ['icon' => 'home', 'bg' => 'violet', 'title' => 'Fasilitas Kelas Kondusif', 'desc' => 'Ruang kelas yang ber-AC, proyektor LCD interaktif, serta lingkungan asri yang jauh dari kebisingan.'],
                        ['icon' => 'shield-check', 'bg' => 'rose', 'title' => 'Lingkungan Aman & Ramah Anak', 'desc' => 'Keamanan terpadu 24 jam dengan sistem sekolah bebas bullying dan penuh kehangatan ukhuwah.'],
                        ['icon' => 'activity', 'bg' => 'cyan', 'title' => 'Ekstrakurikuler Variatif', 'desc' => 'Panahan, berkuda, karate, robotik, seni kaligrafi, tilawah, sepak bola, dan pramuka.'],
                    ];
                @endphp
                @foreach($keunggulan as $item)
                    <div class="feature-card fade-up">
                        <div class="feature-icon bg-{{ $item['bg'] }}-50 text-{{ $item['bg'] }}-600">
                            <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-lg font-bold text-[var(--theme-primary)] mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- UNIT PENDIDIKAN PREVIEW --}}
    <section class="public-section bg-slate-50">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="layers-3" class="w-4 h-4"></i> Unit Pendidikan</span>
                <h2 class="section-title mx-auto">Jenjang Pendidikan Kami</h2>
                <p class="section-subtitle mx-auto text-center">Menyediakan jenjang pendidikan berkesinambungan dari usia emas anak hingga pra-remaja.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $units = [
                        ['logo' => asset('images/tk.jpeg'),  'color' => 'sky',    'title' => 'TK Islam Terpadu',  'desc' => 'Pembelajaran bermain sambil belajar yang bermakna dengan fokus pengenalan huruf hijaiyah, adab dasar, dan hafalan surah pendek.', 'route' => 'public.unit.tk.profil'],
                        ['logo' => asset('images/sd.jpeg'),  'color' => 'amber',  'title' => 'SD Islam Terpadu',  'desc' => 'Pembentukan pondasi keilmuan akademis umum, penguatan hafalan Al-Qur\'an hingga 5 juz, pembiasaan ibadah mandiri, dan kemandirian.', 'route' => 'public.unit.sd.profil'],
                        ['logo' => asset('images/smp.jpeg'), 'color' => 'indigo', 'title' => 'SMP Islam Terpadu', 'desc' => 'Pengembangan kemampuan analisis akademis, penguasaan literasi digital, hafalan Al-Qur\'an hingga 10 juz, dan pelatihan kepemimpinan.', 'route' => 'public.unit.smp.profil'],
                    ];
                @endphp
                @foreach($units as $unit)
                    <div class="feature-card text-center fade-up group">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-{{ $unit['color'] }}-50 to-{{ $unit['color'] }}-100/80 flex items-center justify-center mx-auto mb-5 border border-{{ $unit['color'] }}-100/50 overflow-hidden">
                            <img src="{{ $unit['logo'] }}" alt="Logo {{ $unit['title'] }}"
                                 class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <h3 class="text-xl font-bold text-[var(--theme-primary)] mb-2">{{ $unit['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-5">{{ $unit['desc'] }}</p>
                        <a href="{{ route($unit['route']) }}" class="text-{{ $unit['color'] === 'sky' ? 'sky-600' : ($unit['color'] === 'amber' ? 'amber-600' : 'indigo-600') }} text-sm font-bold hover:underline inline-flex items-center gap-1">Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONI WALI MURID --}}
    <section class="public-section bg-white relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-up">
                <span class="section-badge"><i data-lucide="message-square" class="w-4 h-4"></i> Testimoni</span>
                <h2 class="section-title mx-auto">Apa Kata Orang Tua Wali Murid?</h2>
                <p class="section-subtitle mx-auto text-center">Kepercayaan dan kebanggaan para orang tua atas perkembangan akademis dan karakter islami putra-putrinya di SIT Mutiara Qur'an.</p>
            </div>
            
            @php
                $testimonials = [
                    [
                        'quote' => 'Alhamdulillah, semenjak bersekolah di SD IT Mutiara Qur\'an, anak saya menjadi sangat rajin sholat tepat waktu bahkan sering berinisiatif Sholat Dhuha sendiri. Hafalannya juga berkembang pesat. Guru-gurunya sangat sabar dan komunikatif.',
                        'name' => 'dr. H. Hendra Syahputra, Sp.A',
                        'role' => 'Wali Murid Kelas 4 SD IT / Dokter Anak',
                        'avatar' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&q=80&w=200'
                    ],
                    [
                        'quote' => 'Perpaduan materi akademis umum dan pendidikan akhlak di SMP IT Mutiara Qur\'an sangat berimbang. Anak saya tidak hanya mahir secara akademis, tapi juga memiliki pemahaman agama yang mendalam dan adab yang sopan dalam keluarga.',
                        'name' => 'Prof. Dr. Ir. Hj. Mulyani, M.T',
                        'role' => 'Wali Murid Kelas 8 SMP IT / Dosen Perguruan Tinggi',
                        'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=200'
                    ],
                    [
                        'quote' => 'Metode pembelajaran di TK IT Mutiara Qur\'an sangat menyenangkan. Anak kami pulang dengan wajah ceria setiap hari, dan luar biasa di usia 5 tahun sudah lancar melafalkan doa harian serta hafal surah-surah pendek Juz 30. Terima kasih asatidzah!',
                        'name' => 'Ronaldi, S.E',
                        'role' => 'Wali Murid TK IT / Wiraswasta',
                        'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200'
                    ]
                ];
            @endphp

            {{-- Testimonial Slider --}}
            <div class="max-w-4xl mx-auto relative overflow-hidden px-4 fade-up">
                <div class="relative w-full overflow-hidden rounded-[32px] border border-slate-100 bg-white p-8 sm:p-12 shadow-xl shadow-slate-100/50">
                    <div class="glow-emerald top-0 left-0"></div>
                    
                    {{-- Slider Track --}}
                    <div class="flex transition-transform duration-500 ease-out" id="testiSliderTrack" style="width: 300%; transform: translateX(0%);">
                        @foreach($testimonials as $index => $t)
                            <div class="w-1/3 flex-shrink-0 text-center px-4 md:px-12">
                                <div class="testi-quote text-base sm:text-lg md:text-xl font-medium mb-8 text-slate-700 leading-relaxed">{{ $t['quote'] }}</div>
                                
                                <div class="flex flex-col items-center justify-center">
                                    <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="w-16 h-16 rounded-full object-cover border-4 border-emerald-100 shadow-md mb-3">
                                    <h4 class="text-base sm:text-lg font-extrabold text-slate-800">{{ $t['name'] }}</h4>
                                    <p class="text-xs sm:text-sm text-emerald-600 font-semibold mt-1">{{ $t['role'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Navigation Controls --}}
                    <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-md text-slate-500 z-10" aria-label="Previous slide">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-md text-slate-500 z-10" aria-label="Next slide">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>

                {{-- Dots Indicator --}}
                <div class="flex justify-center gap-2 mt-6">
                    @foreach($testimonials as $index => $t)
                        <button onclick="goToSlide({{ $index }})" class="w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-emerald-600 w-6' : 'bg-slate-300' }} slider-dot" aria-label="Go to slide {{ $index+1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK FAQ --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-16 fade-up">
                <span class="section-badge"><i data-lucide="help-circle" class="w-4 h-4"></i> FAQ</span>
                <h2 class="section-title mx-auto">Pertanyaan Umum (FAQ)</h2>
                <p class="section-subtitle mx-auto text-center">Menjawab keraguan dan pertanyaan paling umum seputar pendaftaran serta pola ajar di SIT Mutiara Qur'an.</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                @php
                    $faqs = [
                        [
                            'question' => 'Kapan pendaftaran PPDB SIT Mutiara Qur\'an dibuka?',
                            'answer' => 'Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur\'an dibuka mulai tanggal 15 Oktober hingga kuota terpenuhi untuk setiap gelombang. Kami menyarankan untuk melakukan pendaftaran lebih awal dikarenakan keterbatasan kuota kelas (rombel) demi menjaga kenyamanan belajar mengajar.'
                        ],
                        [
                            'question' => 'Bagaimana sistem kurikulum yang diterapkan di sekolah?',
                            'answer' => 'SIT Mutiara Qur\'an mengintegrasikan Kurikulum Nasional (Kurikulum Merdeka) dengan Kurikulum JSIT (Jaringan Sekolah Islam Terpadu) yang menitikberatkan pada pembiasaan ibadah islami, pembelajaran Al-Qur\'an metode khusus, serta penguatan adab dan karakter mulia sehari-hari.'
                        ],
                        [
                            'question' => 'Apakah ada fasilitas antar-jemput dan katering untuk siswa?',
                            'answer' => 'Ya, kami menyediakan layanan antar-jemput berjadwal dengan armada yang aman bagi siswa di area sekitar Kabupaten Solok, serta katering makan siang sehat bersertifikasi halal khusus untuk siswa jenjang SD dan SMP yang mengikuti program full-day school.'
                        ],
                        [
                            'question' => 'Berapa target hafalan Al-Qur\'an untuk masing-masing jenjang?',
                            'answer' => 'Target hafalan mutqin kami adalah: Jenjang TK (Juz 30), Jenjang SD IT (Minimal 5 Juz), dan Jenjang SMP IT (Minimal 10 Juz) selama masa studi penuh, didukung dengan program karantina tahfidz tahunan khusus.'
                        ]
                    ];
                @endphp
                <div class="space-y-4">
                    @foreach($faqs as $index => $faq)
                        <div class="premium-faq-item fade-up">
                            <button class="premium-faq-trigger" onclick="toggleFaq(this)">
                                <span class="premium-faq-title">{{ $faq['question'] }}</span>
                                <i data-lucide="chevron-down" class="premium-faq-icon"></i>
                            </button>
                            <div class="premium-faq-content">
                                <div class="premium-faq-inner">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA PPDB --}}
    <section class="public-section bg-gradient-to-br from-emerald-800 to-emerald-950 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="max-w-3xl mx-auto text-center relative z-10 fade-up">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-amber-300 text-sm font-bold mb-6">
                <i data-lucide="megaphone" class="w-4 h-4 text-amber-300 animate-pulse"></i> Pendaftaran Dibuka
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-4">
                Penerimaan Peserta Didik Baru<br>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
            </h2>
            <p class="text-emerald-100/70 text-sm sm:text-base mb-10 max-w-lg mx-auto leading-relaxed">
                Segera amankan kuota pendaftaran putra-putri Anda di SIT Mutiara Qur'an dan berikan mereka pondasi agama serta akademis terbaik.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('public.ppdb.index') }}"
                    class="inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-amber-400 text-emerald-950 font-extrabold text-base shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                    <i data-lucide="file-text" class="w-5 h-5"></i> Informasi Pendaftaran (PPDB)
                </a>
                <a href="{{ route('public.ppdb.form-kontak') }}"
                    class="inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-base hover:bg-white/20 transition-all duration-300">
                    <i data-lucide="phone" class="w-5 h-5"></i> Hubungi Panitia
                </a>
            </div>
        </div>
    </section>

    {{-- INLINE FAQ & SLIDER & FILTER JAVASCRIPT --}}
    <script>
        /* FAQ ACCORDION TOGGLE */
        function toggleFaq(btn) {
            const item = btn.parentElement;
            const content = btn.nextElementSibling;
            
            const isOpen = item.classList.contains('faq-open');
            
            // Close all FAQ items
            document.querySelectorAll('.premium-faq-item').forEach(el => {
                el.classList.remove('faq-open');
                el.querySelector('.premium-faq-content').style.maxHeight = null;
            });
            
            if (!isOpen) {
                item.classList.add('faq-open');
                content.style.maxHeight = content.scrollHeight + "px";
            } else {
                item.classList.remove('faq-open');
                content.style.maxHeight = null;
            }
        }

        /* DYNAMIC PROGRAM FILTERING */
        function filterPrograms(category, btn) {
            // Update active button styling
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            btn.classList.add('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');

            // Filter cards with scale animation
            document.querySelectorAll('.program-item').forEach(card => {
                const cardCat = card.getAttribute('data-category');
                if (category === 'all' || cardCat === category) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }

        /* TESTIMONIAL SLIDER CONTROLLER */
        let currentSlide = 0;
        const totalSlides = 3;
        const track = document.getElementById('testiSliderTrack');
        const dots = document.querySelectorAll('.slider-dot');

        function updateSlider() {
            if (track) {
                track.style.transform = `translateX(-${currentSlide * 33.333}%)`;
                dots.forEach((dot, idx) => {
                    if (idx === currentSlide) {
                        dot.classList.remove('bg-slate-300');
                        dot.classList.add('bg-emerald-600', 'w-6');
                    } else {
                        dot.classList.remove('bg-emerald-600', 'w-6');
                        dot.classList.add('bg-slate-300');
                    }
                });
            }
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        function goToSlide(slideIdx) {
            currentSlide = slideIdx;
            updateSlider();
        }

        // Auto play testimonial slider every 8 seconds
        let sliderInterval = setInterval(nextSlide, 8000);

        // Reset auto play timer on manual navigation
        function resetSliderTimer() {
            clearInterval(sliderInterval);
            sliderInterval = setInterval(nextSlide, 8000);
        }
        
        // Wrap controls in timer resets
        const originalNext = nextSlide;
        nextSlide = function() {
            originalNext();
            resetSliderTimer();
        }
        const originalPrev = prevSlide;
        prevSlide = function() {
            originalPrev();
            resetSliderTimer();
        }
        const originalGoTo = goToSlide;
        goToSlide = function(idx) {
            originalGoTo(idx);
            resetSliderTimer();
        }

        // PPDB Popup Logic
        document.addEventListener('DOMContentLoaded', () => {
            const ppdbPopup = document.getElementById('ppdbPopup');
            const ppdbOverlay = document.getElementById('ppdbOverlay');
            const ppdbContent = document.getElementById('ppdbModalContent');
            const btnClose = document.getElementById('closePpdbBtn');
            const btnCloseFooter = document.getElementById('closePpdbFooterBtn');
            
            if (ppdbPopup && !sessionStorage.getItem('ppdbPopupClosed')) {
                // Show modal after slight delay
                setTimeout(() => {
                    ppdbPopup.classList.remove('hidden');
                    ppdbPopup.classList.add('flex');
                    
                    // Trigger animation frame
                    setTimeout(() => {
                        ppdbOverlay.classList.remove('opacity-0');
                        ppdbOverlay.classList.add('opacity-100');
                        ppdbContent.classList.remove('opacity-0', 'scale-95');
                        ppdbContent.classList.add('opacity-100', 'scale-100');
                    }, 50);
                }, 1500); // 1.5s delay before showing
                
                const closePopup = () => {
                    ppdbOverlay.classList.remove('opacity-100');
                    ppdbOverlay.classList.add('opacity-0');
                    ppdbContent.classList.remove('opacity-100', 'scale-100');
                    ppdbContent.classList.add('opacity-0', 'scale-95');
                    
                    setTimeout(() => {
                        ppdbPopup.classList.add('hidden');
                        ppdbPopup.classList.remove('flex');
                        sessionStorage.setItem('ppdbPopupClosed', 'true');
                    }, 300);
                };
                
                if (btnClose) btnClose.addEventListener('click', closePopup);
                if (btnCloseFooter) btnCloseFooter.addEventListener('click', closePopup);
                if (ppdbOverlay) ppdbOverlay.addEventListener('click', closePopup);
            }
        });
    </script>

    {{-- PPDB POPUP MODAL --}}
    <div id="ppdbPopup" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="ppdbOverlay"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-2xl bg-white rounded-[32px] shadow-2xl p-6 md:p-10 transform scale-95 opacity-0 transition-all duration-300" id="ppdbModalContent">
            <!-- Close Button -->
            <button id="closePpdbBtn" class="absolute top-4 right-4 md:top-6 md:right-6 w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            
            <div class="text-center mb-8 pr-8 md:pr-0">
                <span class="inline-block px-4 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-bold uppercase tracking-wider mb-4">Informasi PPDB 2026/2027</span>
                <h3 class="text-2xl md:text-3xl font-black text-slate-800 mb-3">Pendaftaran Telah Dibuka!</h3>
                <p class="text-slate-500 text-sm md:text-base leading-relaxed">Pendaftaran peserta didik baru SIT Mutiara Qur'an telah dibuka. Pilih brosur berikut untuk melihat informasi syarat, biaya, dan alur pendaftaran.</p>
            </div>
            
            <!-- Grid Brosur -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                <a href="{{ asset('images/syarat-tksd.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Syarat PPDB TK/SD</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat persyaratan</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/biaya-tksd.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-amber-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Biaya PPDB TK/SD</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat rincian biaya</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/syarat-smp.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Syarat PPDB SMP</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat persyaratan</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/biaya-smp.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-amber-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Biaya PPDB SMP</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat rincian biaya</p>
                    </div>
                </a>
            </div>
            
            <div class="text-center">
                <button id="closePpdbFooterBtn" class="px-8 py-3 rounded-xl bg-slate-100 text-slate-600 font-bold hover:bg-slate-200 transition-colors text-sm">Tutup</button>
            </div>
        </div>
    </div>

@endsection
