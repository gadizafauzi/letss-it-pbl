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

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-6 pb-20 sm:pt-8 sm:pb-28 lg:pt-10 lg:pb-36">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center -translate-y-6 lg:-translate-y-16">
                {{-- Left Text --}}
                <div class="lg:col-span-7 max-w-3xl text-left">

                    {{-- Accreditation stamp --}}
                    <div class="accreditation-stamp mb-6 reveal reveal-left">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                        <div class="accreditation-text">
                            <h5>Terakreditasi A</h5>
                            <p>BAN-PDM PROVINSI SUMATERA BARAT</p>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-sm font-semibold mb-6 reveal reveal-right">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                        Sekolah Islam Terpadu (JSIT)
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight reveal reveal-up">
                        Mendidik Generasi
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-amber-300">Qur'ani</span>
                        yang Berakhlak Mulia & Berprestasi
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-emerald-100/80 leading-relaxed max-w-xl reveal reveal-up">
                        SIT Mutiara Qur'an hadir di Nagari Cupak untuk membentuk generasi robbani yang mandiri, berkarakter mulia, cerdas akademis, serta mencintai Al-Qur'an.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-8 reveal reveal-up">
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
                <div class="lg:col-span-5 hidden lg:block reveal reveal-up">
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
                <!-- Back wave (Soft Yellow Accent) -->
                <path class="anim-wave-back" d="M0,65 Q150,120 300,65 T600,65 Q750,120 900,65 T1200,65 V160 H0 Z" fill="#fbbf24" opacity="0.4"></path>
                <!-- Middle wave (Green/Teal Transparent) -->
                <path class="anim-wave-mid" d="M0,75 Q150,15 300,75 T600,75 Q750,15 900,75 T1200,75 V160 H0 Z" fill="url(#heroWaveGradient)" opacity="0.95"></path>
                <!-- Front wave (Solid White) -->
                <path class="anim-wave-front" d="M0,90 Q150,30 300,90 T600,90 Q750,30 900,90 T1200,90 V160 H0 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>


    {{-- STATS --}}
    <section class="bg-white py-16 md:py-24 relative z-20">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <!-- Card 1: Siswa Aktif (Amber) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 0ms;">
                    <div class="w-20 h-20 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="users" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="500" data-suffix="+">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Siswa Aktif</p>
                </div>
                
                <!-- Card 2: Tenaga Pendidik (Emerald) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-emerald-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 120ms;">
                    <div class="w-20 h-20 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="graduation-cap" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="35" data-suffix="+">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Tenaga Pendidik</p>
                </div>

                <!-- Card 3: Rombel Kelas (Teal) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-teal-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 240ms;">
                    <div class="w-20 h-20 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="book-open" class="w-10 h-10"></i>
                    </div>
                    <p class="text-4xl md:text-5xl font-black text-slate-800 mb-2 tracking-tight stat-number" data-count="18">0</p>
                    <p class="text-slate-500 font-bold tracking-wider uppercase text-sm">Rombel Kelas</p>
                </div>

                <!-- Card 4: Tahun Berdiri (Amber) -->
                <div class="bg-white rounded-[24px] p-8 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 360ms;">
                    <div class="w-20 h-20 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
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
            animation: waveTranslateX 8s ease-in-out infinite alternate;
        }
        .anim-wave-mid {
            animation: waveTranslateX 6s ease-in-out infinite alternate;
        }
        .anim-wave-back {
            animation: waveTranslateX 14s ease-in-out infinite alternate;
        }

        /* ROBUST REVEAL ANIMATION SYSTEM */
        body:not(.js-reveal-ready) .reveal {
            opacity: 1 !important;
            transform: none !important;
        }

        body.js-reveal-ready .reveal {
            opacity: 0;
            transition-duration: 0.9s; /* Slower and smooth exit */
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); /* Smooth ease */
            transition-property: opacity, transform;
            will-change: opacity, transform;
        }

        body.js-reveal-ready .reveal-up { transform: translateY(40px); }
        body.js-reveal-ready .reveal-left { transform: translateX(-40px); }
        body.js-reveal-ready .reveal-right { transform: translateX(40px); }
        body.js-reveal-ready .reveal-zoom { transform: scale(0.92); }
        body.js-reveal-ready .reveal-fade { transform: none; }
        body.js-reveal-ready .reveal-expand { transform: scaleX(0); transform-origin: center; }
        body.js-reveal-ready .reveal-stat { transform: translateY(20px) scale(0.94); }
        body.js-reveal-ready .reveal-photo { transform: translateX(-40px) scale(0.96); }
        body.js-reveal-ready .reveal-pop { transform: scale(0.85); }
        body.js-reveal-ready .reveal-bottom-left { transform: translate(-40px, 40px); }
        body.js-reveal-ready .reveal-top { transform: translateY(-40px); }
        body.js-reveal-ready .reveal-top-zoom { transform: translateY(-40px) scale(0.92); }
        body.js-reveal-ready .reveal-bottom-right { transform: translate(40px, 40px); }
        body.js-reveal-ready .reveal-carousel { transform: scale(0.96); }

        body.js-reveal-ready .reveal.is-visible {
            opacity: 1;
            transform: translate(0) scale(1);
            transition-duration: 0.7s; /* Smooth bouncy entrance */
            transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body.js-reveal-ready .reveal-stat.is-visible {
            transition-duration: 0.7s;
            transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
        }

        body.js-reveal-ready .reveal-program.is-visible {
            transition-duration: 0.85s;
            transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes floatEffect {
            0%, 100% { transform: translateY(0) rotate(180deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
        }
        .animate-float { animation: floatEffect 4s ease-in-out infinite; }

        @keyframes shine {
            100% { left: 125%; }
        }
        .shine-effect {
            position: absolute;
            top: 0; left: -100%;
            width: 50%; height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.6) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-20deg);
            z-index: 20;
            pointer-events: none;
        }
        .group:hover .shine-effect {
            animation: shine 0.7s ease-out forwards;
        }
    </style>

    {{-- SAMBUTAN KEPALA SEKOLAH --}}
    <section class="public-section bg-white relative overflow-hidden islamic-pattern-bg">
        <div class="glow-emerald top-10 left-10"></div>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Avatar Column --}}
                <div class="lg:col-span-5 flex justify-center">
                    <div class="sambutan-wrapper max-w-sm w-full reveal reveal-photo" style="transition-delay: 0ms;">
                        <div class="sambutan-avatar-container">
                            <div class="sambutan-avatar-bg"></div>
                            <div class="sambutan-image-frame relative overflow-hidden rounded-[24px] group transition-all duration-400 hover:shadow-[0_10px_40px_-10px_rgba(5,150,105,0.3)] bg-white">
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600" alt="Kepala Sekolah SIT Mutiara Qur'an" class="w-full h-96 object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.08]">
                                <div class="sambutan-badge transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:bg-emerald-600 group-hover:text-white reveal reveal-pop" style="transition-property: all !important; transition-delay: 150ms;">Kepala Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Column --}}
                <div class="lg:col-span-7 text-left">
                    <span class="section-badge fade-up"><i data-lucide="quote" class="w-4 h-4"></i> Kata Sambutan</span>
                    <h2 class="section-title text-left mb-6 fade-up title-anim" style="transition-delay: 200ms;">Membentuk Generasi Rabbanî yang Unggul & Berkarakter</h2>
                    <div class="space-y-4 text-slate-600 leading-relaxed text-sm sm:text-base">
                        <p class="font-bold text-slate-800 text-lg reveal reveal-up" style="transition-delay: 350ms;">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                        <p class="reveal reveal-up" style="transition-delay: 500ms;">
                            Segala puji bagi Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad SAW. Selamat datang di portal resmi <strong>SIT Mutiara Qur'an Nagari Cupak</strong>.
                        </p>
                        <p class="reveal reveal-up" style="transition-delay: 650ms;">
                            Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur'an yang seimbang secara spiritual, intelektual, dan moral. Kami meyakini bahwa setiap anak memiliki potensi terbaiknya, dan tugas kamilah di sekolah untuk menuntun serta mengasah potensi tersebut dengan berlandaskan nilai-nilai Al-Qur'an dan Sunnah.
                        </p>
                        <p class="reveal reveal-up" style="transition-delay: 800ms;">
                            Dengan dukungan asatidzah yang berkompeten, fasilitas yang kondusif, serta lingkungan yang islami, kami siap berkolaborasi erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon pemimpin umat masa depan yang berakhlak mulia.
                        </p>
                    </div>
                    <div class="mt-8 pt-6 relative fade-up" style="transition-delay: 1100ms;">
                        <div class="absolute top-0 left-0 h-[1px] bg-slate-200 w-full"></div>
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
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="sparkles" class="w-4 h-4"></i> Program Unggulan</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Program Khusus Keislaman & Akademik</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Kurikulum keagamaan dan akademik yang dirancang secara matang untuk menyeimbangkan kecerdasan intelektual dan spiritual.</p>
            </div>

            {{-- Program Filter Tabs --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button onclick="filterPrograms('all', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-emerald-600 text-white shadow-md shadow-emerald-200 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 300ms;">Semua Program</button>
                <button onclick="filterPrograms('keislaman', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 450ms;">Keislaman</button>
                <button onclick="filterPrograms('akademik', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 600ms;">Akademik & IT</button>
                <button onclick="filterPrograms('karakter', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 750ms;">Karakter & Pemimpin</button>
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
                @php
                    $animClasses = ['reveal-bottom-left', 'reveal-top', 'reveal-bottom-right', 'reveal-left', 'reveal-zoom', 'reveal-right'];
                @endphp
                @foreach($programs as $idx => $p)
                    <div tabindex="0" class="bg-white rounded-2xl p-6 min-h-[320px] md:min-h-[340px] flex flex-col border border-slate-100 shadow-sm hover:shadow-[0_20px_40px_-12px_rgba(52,211,153,0.25)] hover:scale-[1.03] hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group reveal reveal-program program-item {{ $animClasses[$idx % 6] }} focus:outline-none" data-category="{{ $p['category'] }}" style="transition-delay: {{ 120 + ($idx * 150) }}ms;">
                        
                        <!-- Top Accent Bar -->
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-400 to-amber-400"></div>

                        <!-- Shine Effect -->
                        <div class="shine-effect"></div>

                        <!-- Background Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-amber-50/50 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <!-- Default View (Icon + Title + Badge) -->
                        <div class="relative z-10 flex flex-col h-full transform transition-transform duration-500 group-hover:-translate-y-4 focus:-translate-y-4 flex-grow">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100/60 text-emerald-600 flex items-center justify-center mb-6 shadow-inner group-hover:-translate-y-1 group-hover:rotate-12 group-hover:scale-110 focus:-translate-y-1 focus:rotate-12 focus:scale-110 transition-transform duration-300">
                                <i data-lucide="{{ $p['icon'] }}" class="w-7 h-7"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-emerald-700 focus:text-emerald-700 transition-colors">{{ $p['title'] }}</h3>
                            <div class="mt-auto">
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-2 rounded-xl inline-block border border-emerald-100">
                                    {{ $p['detail'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Mobile Hint Indicator -->
                        <div class="absolute bottom-6 right-6 z-10 flex items-center gap-2 opacity-100 group-hover:opacity-0 focus:opacity-0 transition-opacity duration-300">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider md:hidden">Tap detail</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 animate-pulse">
                                <i data-lucide="mouse-pointer-click" class="w-4 h-4"></i>
                            </div>
                        </div>

                        <!-- Overlay Detail View -->
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 to-emerald-800/95 p-6 md:p-8 flex flex-col justify-center overflow-y-auto translate-y-full group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 ease-[cubic-bezier(0.2,0.8,0.2,1)] z-20 opacity-0 group-hover:opacity-100 focus:opacity-100 custom-scrollbar">
                            
                            <!-- Staggered Entry Elements -->
                            <div class="text-amber-400 mb-4 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-100 flex-shrink-0">
                                <i data-lucide="{{ $p['icon'] }}" class="w-10 h-10"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-3 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-150 flex-shrink-0">{{ $p['title'] }}</h3>
                            
                            <p class="text-emerald-50 text-sm leading-relaxed transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-200 mb-auto">{{ $p['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN TAMBAHAN --}}
    <section class="public-section relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-emerald-50/40">
        <!-- Floating Particles / Decorative Shapes -->
        <div class="absolute top-10 left-10 w-64 h-64 bg-emerald-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-amber-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 bg-cyan-200/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Small animated particles -->
        <div class="absolute bottom-1/4 left-10 w-4 h-4 bg-emerald-300 rounded-full opacity-40 pointer-events-none animate-ping" style="animation-duration: 3s;"></div>
        <div class="absolute top-1/4 right-20 w-3 h-3 bg-amber-300 rounded-full opacity-50 pointer-events-none animate-pulse" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-10 left-1/2 w-5 h-5 bg-blue-300 rounded-full opacity-30 pointer-events-none animate-bounce" style="animation-duration: 5s;"></div>
        
        <!-- Added particles -->
        <div class="absolute top-20 left-1/4 w-3 h-3 bg-teal-300 rounded-full opacity-40 pointer-events-none animate-ping" style="animation-duration: 4.5s; animation-delay: 1s;"></div>
        <div class="absolute bottom-1/3 right-1/4 w-6 h-6 bg-rose-200 rounded-full opacity-30 pointer-events-none animate-bounce" style="animation-duration: 6s; animation-delay: 0.5s;"></div>
        <div class="absolute top-1/2 right-10 w-4 h-4 bg-violet-300 rounded-full opacity-40 pointer-events-none animate-pulse" style="animation-duration: 3.5s; animation-delay: 1.5s;"></div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="award" class="w-4 h-4"></i> Keunggulan Kami</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Mengapa Memilih Mutiara Qur'an?</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Fasilitas yang modern dan lingkungan yang aman bersinergi melahirkan kenyamanan belajar penuh berkah.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $keunggulan = [
                        ['icon' => 'book-marked', 'bg' => 'amber', 'anim' => 'reveal-bottom-left', 'delay' => '150ms', 'title' => 'Kurikulum Merdeka + JSIT', 'desc' => 'Mengintegrasikan kurikulum nasional Kurikulum Merdeka dengan kurikulum kekhasan JSIT.'],
                        ['icon' => 'monitor', 'bg' => 'emerald', 'anim' => 'reveal-top-zoom', 'delay' => '300ms', 'title' => 'Laboratorium Komputer', 'desc' => 'Fasilitas komputer modern penunjang praktikum TIK dan pemrograman dasar sejak dini.'],
                        ['icon' => 'users-2', 'bg' => 'blue', 'anim' => 'reveal-bottom-right', 'delay' => '450ms', 'title' => 'Tenaga Pendidik Berdedikasi', 'desc' => 'Asatidzah lulusan perguruan tinggi terkemuka, bersertifikat pendidik, dan hafizh.'],
                        ['icon' => 'home', 'bg' => 'violet', 'anim' => 'reveal-left', 'delay' => '600ms', 'title' => 'Fasilitas Kelas Kondusif', 'desc' => 'Ruang kelas ber-AC, proyektor LCD, serta lingkungan asri yang jauh dari kebisingan.'],
                        ['icon' => 'shield-check', 'bg' => 'rose', 'anim' => 'reveal-zoom', 'delay' => '750ms', 'title' => 'Lingkungan Aman & Ramah', 'desc' => 'Keamanan terpadu 24 jam dengan sistem sekolah bebas bullying dan hangat.'],
                        ['icon' => 'activity', 'bg' => 'cyan', 'anim' => 'reveal-right', 'delay' => '900ms', 'title' => 'Ekstrakurikuler Variatif', 'desc' => 'Panahan, berkuda, karate, robotik, seni kaligrafi, tilawah, sepak bola, dan pramuka.'],
                    ];
                @endphp
                @foreach($keunggulan as $item)
                    <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] hover:border-{{ $item['bg'] }}-300 transition-all duration-300 relative overflow-hidden group reveal reveal-program {{ $item['anim'] }}" style="transition-delay: {{ $item['delay'] }};">
                        
                        <!-- Shine effect passing across the card -->
                        <div class="shine-effect"></div>

                        <!-- Top soft glow on hover -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-{{ $item['bg'] }}-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Background abstract glint -->
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-gradient-to-br from-{{ $item['bg'] }}-100 to-white rounded-full opacity-40 group-hover:scale-[2.5] group-hover:opacity-70 transition-all duration-700 ease-out z-0 blur-2xl"></div>

                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-{{ $item['bg'] }}-50 to-{{ $item['bg'] }}-100/60 text-{{ $item['bg'] }}-600 flex items-center justify-center mb-6 shadow-inner group-hover:-translate-y-2 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="{{ $item['icon'] }}" class="w-7 h-7"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-{{ $item['bg'] }}-600 transition-colors duration-300">{{ $item['title'] }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- UNIT PENDIDIKAN PREVIEW --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <!-- Floating background blobs -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-sky-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="layers-3" class="w-4 h-4"></i> Unit Pendidikan</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Jenjang Pendidikan Kami</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Menyediakan jenjang pendidikan berkesinambungan dari usia emas anak hingga pra-remaja.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4 lg:px-0">
                @php
                    $units = [

                        [
                            'logo' => asset('images/tk.jpeg'),
                            'title' => 'TK Islam Terpadu',
                            'desc' => 'Pembelajaran bermain sambil belajar yang bermakna dengan fokus pengenalan huruf hijaiyah, adab dasar, dan hafalan surah pendek.',
                            'route' => 'public.unit.tk.index',
                            'anim' => 'anim-bottom-left',
                            'delay' => '0ms',
                            'borderHover' => 'hover:border-sky-300',
                            'shadowHover' => 'group-hover:shadow-sky-200/50',
                            'bgGlow' => 'from-sky-50/0 to-sky-100/60',
                            'innerGlow' => 'bg-sky-100/50',
                            'textHover' => 'group-hover:text-sky-700',
                            'btnHover' => 'text-sky-600 group-hover:bg-sky-600 group-hover:text-white group-hover:shadow-sky-600/30',
                        ],
                        [
                            'logo' => asset('images/sd.jpeg'),
                            'title' => 'SD Islam Terpadu',
                            'desc' => 'Pembentukan pondasi keilmuan akademis umum, penguatan hafalan Al-Qur\'an hingga 5 juz, pembiasaan ibadah mandiri, dan kemandirian.',
                            'route' => 'public.unit.sd.index',
                            'anim' => 'anim-zoom',
                            'delay' => '150ms',
                            'borderHover' => 'hover:border-amber-300',
                            'shadowHover' => 'group-hover:shadow-amber-200/50',
                            'bgGlow' => 'from-amber-50/0 to-amber-100/60',
                            'innerGlow' => 'bg-amber-100/50',
                            'textHover' => 'group-hover:text-amber-700',
                            'btnHover' => 'text-amber-600 group-hover:bg-amber-500 group-hover:text-white group-hover:shadow-amber-500/30',
                        ],
                        [
                            'logo' => asset('images/smp.jpeg'),
                            'title' => 'SMP Islam Terpadu',
                            'desc' => 'Pengembangan kemampuan analisis akademis, penguasaan literasi digital, hafalan Al-Qur\'an hingga 10 juz, dan pelatihan kepemimpinan.',
                            'route' => 'public.unit.smp.index',
                            'anim' => 'anim-bottom-right',
                            'delay' => '300ms',
                            'borderHover' => 'hover:border-indigo-300',
                            'shadowHover' => 'group-hover:shadow-indigo-200/50',
                            'bgGlow' => 'from-indigo-50/0 to-indigo-100/60',
                            'innerGlow' => 'bg-indigo-100/50',
                            'textHover' => 'group-hover:text-indigo-700',
                            'btnHover' => 'text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:shadow-indigo-600/30',
                        ],
                        ],
                    ];
                @endphp
                @foreach($units as $unit)
                    <div class="bg-white rounded-[32px] p-8 text-center reveal reveal-up group border border-slate-100 shadow-sm relative overflow-hidden transition-all duration-500 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.1)] {{ $unit['borderHover'] }} {{ $unit['anim'] }} flex flex-col h-full" style="transition-delay: {{ $unit['delay'] }};">
                        
                        <!-- Glow Background on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-b {{ $unit['bgGlow'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col flex-grow">
                            <!-- Logo Container -->
                            <div class="w-24 h-24 rounded-2xl bg-white flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100 overflow-hidden {{ $unit['shadowHover'] }} transition-all duration-500 relative">
                                <!-- Inner glow for logo -->
                                <div class="absolute inset-0 {{ $unit['innerGlow'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <img src="{{ $unit['logo'] }}" alt="Logo {{ $unit['title'] }}"
                                     class="w-full h-full object-contain p-2 relative z-10 transition-transform duration-500 group-hover:scale-[1.15] group-hover:rotate-[4deg]">
                            </div>
                            
                            <h3 class="text-2xl font-black text-slate-800 mb-3 {{ $unit['textHover'] }} transition-colors duration-300">{{ $unit['title'] }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8 flex-grow group-hover:text-slate-600 transition-colors duration-300">{{ $unit['desc'] }}</p>
                            
                            <!-- Button Link -->
                            <div class="mt-auto">
                                <a href="{{ route($unit['route']) }}" class="inline-flex items-center justify-center w-full py-3.5 rounded-xl bg-slate-50 {{ $unit['btnHover'] }} font-bold transition-all duration-300 overflow-hidden relative">
                                    <span class="relative z-10 flex items-center gap-2 transform transition-transform duration-300 group-hover:translate-x-1.5 text-sm">
                                        Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONI WALI MURID --}}
    <section class="public-section bg-white relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="message-square" class="w-4 h-4"></i> Testimoni</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Apa Kata Orang Tua Wali Murid?</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Kepercayaan dan kebanggaan para orang tua atas perkembangan akademis dan karakter islami putra-putrinya di SIT Mutiara Qur'an.</p>
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
            <div class="max-w-4xl mx-auto relative px-4">
                <div class="relative w-full rounded-[32px] border border-slate-100 bg-white p-8 sm:p-12 shadow-xl shadow-slate-100/50 reveal reveal-carousel" style="transition-delay: 600ms; transition-duration: 800ms;">
                    
                    <!-- Decorative Quote Icon -->
                    <div class="absolute top-6 right-8 text-emerald-50 opacity-60">
                        <i data-lucide="quote" class="w-24 h-24"></i>
                    </div>

                    <div class="glow-emerald top-0 left-0"></div>

                    
                    {{-- Carousel Viewport --}}
                    <div class="overflow-hidden w-full relative z-10">
                        {{-- Slider Track --}}
                        <div class="flex transition-transform duration-500 ease-out" id="testiSliderTrack" style="width: 300%; transform: translateX(0%);">
                            @foreach($testimonials as $index => $t)
                                <div class="w-1/3 flex-shrink-0 text-center px-4 md:px-12">
                                    <div class="testi-quote text-base sm:text-lg md:text-xl font-medium mb-8 text-slate-700 leading-relaxed">{{ $t['quote'] }}</div>
                                    
                                    <div class="flex flex-col items-center justify-center">
                                        <!-- Image -->
                                        <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="w-16 h-16 rounded-full object-cover border-4 border-emerald-100 shadow-md mb-3 transition-all duration-300 hover:scale-110 hover:shadow-[0_0_15px_rgba(16,185,129,0.5)]">
                                        <!-- Name & Role -->
                                        <div>
                                            <h4 class="text-base sm:text-lg font-extrabold text-slate-800">{{ $t['name'] }}</h4>
                                            <p class="text-xs sm:text-sm text-emerald-600 font-semibold mt-1">{{ $t['role'] }}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Navigation Controls --}}
                    <button onclick="prevSlide()" class="absolute left-4 top-0 bottom-0 my-auto w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-md text-slate-500 z-20 hover:scale-110 reveal reveal-zoom" style="transition-delay: 750ms;" aria-label="Previous slide">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button onclick="nextSlide()" class="absolute right-4 top-0 bottom-0 my-auto w-10 h-10 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300 shadow-md text-slate-500 z-20 hover:scale-110 reveal reveal-zoom" style="transition-delay: 750ms;" aria-label="Next slide">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>

                {{-- Dots Indicator --}}
                <div class="flex justify-center gap-2 mt-6">
                    @foreach($testimonials as $index => $t)
                        <button onclick="goToSlide({{ $index }})" class="w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-emerald-600 w-6 animate-pulse' : 'bg-slate-300' }} slider-dot reveal reveal-fade" style="transition-delay: {{ 850 + ($index * 100) }}ms;" aria-label="Go to slide {{ $index+1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK FAQ --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="help-circle" class="w-4 h-4"></i> FAQ</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Pertanyaan Umum (FAQ)</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Menjawab keraguan dan pertanyaan paling umum seputar pendaftaran serta pola ajar di SIT Mutiara Qur'an.</p>
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
                        <div class="premium-faq-item reveal reveal-up">
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
    <section id="cta-ppdb" class="public-section bg-gradient-to-br from-emerald-800 to-emerald-950 relative overflow-hidden">
        <div class="absolute inset-0 cta-bg-pattern" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="max-w-3xl mx-auto text-center cta-container">
                <span class="cta-badge reveal reveal-zoom inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-amber-300 text-sm font-bold mb-6 hover:shadow-[0_0_15px_rgba(252,211,77,0.3)] hover:bg-white/15 transition-all duration-300 cursor-default ">
                    <i data-lucide="megaphone" class="w-4 h-4 text-amber-300 animate-pulse"></i> Pendaftaran Dibuka
                </span>
                <h2 class="cta-title reveal reveal-up text-3xl sm:text-4xl font-black text-white leading-tight mb-4 ">
                    Penerimaan Peserta Didik Baru<br>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
                </h2>
                <p class="cta-desc reveal reveal-up text-emerald-100/70 text-sm sm:text-base mb-10 max-w-lg mx-auto leading-relaxed ">
                    Segera amankan kuota pendaftaran putra-putri Anda di SIT Mutiara Qur'an dan berikan mereka pondasi agama serta akademis terbaik.
                </p>
                <div class="flex flex-wrap justify-center gap-4 overflow-hidden py-2">
                    <a href="{{ route('public.ppdb.index') }}"
                        class="cta-btn-primary reveal reveal-left group inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-amber-400 text-emerald-950 font-extrabold text-base shadow-lg shadow-amber-500/20 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_rgba(251,191,36,0.4)] transition-all duration-300 ">
                        <i data-lucide="file-text" class="w-5 h-5 transition-transform duration-300 group-hover:rotate-6 group-hover:scale-110"></i> Informasi Pendaftaran (PPDB)
                    </a>
                    <a href="{{ route('public.ppdb.form-kontak') }}"
                        class="cta-btn-outline reveal reveal-right group inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/20 text-white font-bold text-base hover:bg-white/10 hover:border-white/40 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_rgba(255,255,255,0.1)] transition-all duration-300 ">
                        <i data-lucide="phone" class="w-5 h-5 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110"></i> Hubungi Panitia
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* CTA Animations */
        @keyframes ctaPatternFloat {
            0% { background-position: 0px 0px; }
            100% { background-position: 24px 24px; }
        }
        .cta-bg-pattern {
            animation: ctaPatternFloat 6s linear infinite;
        }

        /* Entry states via classes */
        .cta-badge.is-visible {
            animation: ctaBadgeBounce 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        .cta-title.is-visible {
            animation: ctaTitleZoom 0.9s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            animation-delay: 0.2s;
        }
        .cta-desc.is-visible {
            animation: ctaFadeUp 0.8s ease-out forwards;
            animation-delay: 0.45s;
        }
        .cta-btn-primary.is-visible {
            animation: ctaSlideRight 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            animation-delay: 0.7s;
        }
        .cta-btn-outline.is-visible {
            animation: ctaSlideLeft 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            animation-delay: 0.85s;
        }

        /* Keyframes */
        @keyframes ctaBadgeBounce {
            0% { opacity: 0; transform: scale(0.5) translateY(20px); }
            70% { opacity: 1; transform: scale(1.05) translateY(-5px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes ctaTitleZoom {
            0% { opacity: 0; transform: scale(0.85); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes ctaFadeUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes ctaSlideRight {
            0% { opacity: 0; transform: translateX(-50px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        @keyframes ctaSlideLeft {
            0% { opacity: 0; transform: translateX(50px); }
            100% { opacity: 1; transform: translateX(0); }
        }
    </style>

    {{-- INLINE FAQ & SLIDER & FILTER JAVASCRIPT --}}
    <script>
        /* ROBUST REVEAL OBSERVER */
        document.addEventListener('DOMContentLoaded', () => {
            // Add ready class to body to enable opacity: 0
            document.body.classList.add('js-reveal-ready');

            const revealElements = document.querySelectorAll('.reveal');
            
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    } else {
                        entry.target.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.05,
                rootMargin: "-10% 0px -25% 0px"
            });

            revealElements.forEach(el => revealObserver.observe(el));
        });

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

        /* DYNAMIC PROGRAM FILTERING WITH STAGGERED RE-ENTRY */
        function filterPrograms(category, btn) {
            // Update active button styling
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            btn.classList.add('bg-emerald-600', 'text-white', 'shadow-md', 'shadow-emerald-200');

            // Hide all cards first simultaneously
            const cards = document.querySelectorAll('.program-item');
            cards.forEach(card => {
                card.style.transitionDelay = '0ms'; // reset delay for quick exit
                card.classList.remove('is-visible'); // triggers exit animation
            });

            // Wait for exit animation to almost finish, then re-layout
            setTimeout(() => {
                let visibleCount = 0;
                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (category === 'all' || cardCat === category) {
                        card.style.display = 'block';
                        // Re-trigger entrance animation with staggered delay
                        setTimeout(() => {
                            card.style.transitionDelay = (120 + (visibleCount * 150)) + 'ms';
                            card.classList.add('is-visible');
                            visibleCount++;
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 500); // 500ms allows the exit to feel fluid before re-layout
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
                        dot.classList.add('bg-emerald-600', 'w-6', 'animate-pulse');
                    } else {
                        dot.classList.remove('bg-emerald-600', 'w-6', 'animate-pulse');
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
