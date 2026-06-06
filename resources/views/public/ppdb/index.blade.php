@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">PPDB</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Penerimaan Peserta Didik Baru</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Informasi lengkap pendaftaran siswa baru SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }}.</p>
        </div>
    </div>

    @include('components.public.ppdb-subnav')

    {{-- ===== INFORMASI UNIT ===== --}}
    <section class="public-section pb-10">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="info" class="w-4 h-4"></i> PPDB {{ date('Y') }}/{{ date('Y')+1 }}</span>
                <h2 class="section-title mx-auto">Pendaftaran Siswa Baru</h2>
                <p class="section-subtitle mx-auto text-center">Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 fade-up">
                @php
                    $units = [
                        ['logo' => asset('images/tk.jpeg'),  'color' => 'sky',    'title' => 'TK Islam Terpadu',  'usia' => 'Usia 4-6 tahun',  'kuota' => '60 siswa'],
                        ['logo' => asset('images/sd.jpeg'),  'color' => 'amber',   'title' => 'SD Islam Terpadu',  'usia' => 'Usia 6-7 tahun',  'kuota' => '90 siswa'],
                        ['logo' => asset('images/smp.jpeg'), 'color' => 'indigo',  'title' => 'SMP Islam Terpadu', 'usia' => 'Lulusan SD/MI',   'kuota' => '60 siswa'],
                    ];
                @endphp
                @foreach($units as $u)
                <div class="feature-card text-center">
                    <div class="w-16 h-16 rounded-2xl bg-{{ $u['color'] }}-50 flex items-center justify-center mx-auto mb-4 p-2.5 border border-{{ $u['color'] }}-100/50">
                        <img src="{{ $u['logo'] }}" alt="Logo" class="w-full h-full object-contain drop-shadow-sm">
                    </div>
                    <h3 class="text-lg font-bold text-[var(--theme-primary)] mb-2">{{ $u['title'] }}</h3>
                    <p class="text-sm text-slate-500">{{ $u['usia'] }}</p>
                    <p class="text-sm font-bold text-{{ $u['color'] === 'sky' ? 'sky-600' : ($u['color'] === 'amber' ? 'amber-600' : 'indigo-600') }} mt-2">Kuota: {{ $u['kuota'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== ALUR PENDAFTARAN ===== --}}
    <section id="alur" class="public-section py-16">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12 fade-up">
                <span class="section-badge"><i data-lucide="route" class="w-4 h-4"></i> Alur Pendaftaran</span>
                <h2 class="section-title mx-auto">Langkah Mudah Mendaftar</h2>
            </div>
            @php
                $alur = [
                    ['no' => '1', 'icon' => 'file-edit',     'judul' => 'Mengisi Formulir',  'desc' => 'Isi formulir pendaftaran online atau datang langsung ke sekolah.'],
                    ['no' => '2', 'icon' => 'folder-check',  'judul' => 'Melengkapi Berkas', 'desc' => 'Siapkan dan serahkan berkas persyaratan yang diperlukan.'],
                    ['no' => '3', 'icon' => 'clipboard-pen', 'judul' => 'Tes Seleksi',       'desc' => 'Calon siswa mengikuti tes baca tulis, wawancara, dan tes Al-Quran.'],
                    ['no' => '4', 'icon' => 'megaphone',     'judul' => 'Pengumuman',         'desc' => 'Hasil seleksi diumumkan melalui website dan WhatsApp.'],
                    ['no' => '5', 'icon' => 'badge-check',   'judul' => 'Daftar Ulang',       'desc' => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.'],
                ];
            @endphp
            <div class="space-y-0">
                @foreach($alur as $step)
                <div class="timeline-item fade-up">
                    <div class="timeline-dot">{{ $step['no'] }}</div>
                    <div class="pt-1">
                        <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $step['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== SYARAT PENDAFTARAN ===== --}}
    <section id="syarat" class="public-section py-16 bg-slate-50/50">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 fade-up">
                <span class="section-badge"><i data-lucide="clipboard-list" class="w-4 h-4"></i> Persyaratan</span>
                <h2 class="section-title mx-auto">Syarat Pendaftaran</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $syaratData = [
                        ['logo' => asset('images/tk.jpeg'),  'color' => 'sky',    'title' => 'TK', 'items' => ['Usia minimal 4 tahun','Fotokopi akta kelahiran','Fotokopi KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']],
                        ['logo' => asset('images/sd.jpeg'),  'color' => 'amber',  'title' => 'SD', 'items' => ['Usia minimal 6 tahun','Ijazah / surat keterangan TK','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']],
                        ['logo' => asset('images/smp.jpeg'), 'color' => 'indigo', 'title' => 'SMP','items' => ['Ijazah / SKL SD','Rapor kelas 4, 5, 6','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']],
                    ];
                @endphp
                @foreach($syaratData as $s)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-{{ $s['color'] }}-50 text-{{ $s['color'] }}-500 p-2.5 border border-{{ $s['color'] }}-100/50">
                        <img src="{{ $s['logo'] }}" alt="Logo" class="w-full h-full object-contain drop-shadow-sm">
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-4">{{ $s['title'] }} Islam Terpadu</h3>
                    <ul class="space-y-3 text-sm text-slate-500">
                        @foreach($s['items'] as $item)
                        <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-{{ $s['color'] }}-500 mt-0.5 flex-shrink-0"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== FAQ ===== --}}
    <section id="faq" class="public-section py-20 bg-white relative overflow-hidden">
        {{-- Dekorasi background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-emerald-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-3xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <span class="section-badge faq-badge opacity-0 scale-90 transition-all duration-700 ease-out inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 font-bold text-sm mb-4">
                    <i data-lucide="help-circle" class="w-4 h-4"></i> FAQ
                </span>
                <h2 class="section-title mx-auto faq-title opacity-0 scale-95 transition-all duration-700 delay-150 ease-out text-3xl md:text-4xl font-extrabold text-slate-800 mb-4">Pertanyaan yang Sering Diajukan</h2>
                <p class="section-subtitle mx-auto text-center text-slate-500 faq-subtitle opacity-0 translate-y-4 transition-all duration-700 delay-300 ease-out max-w-xl">
                    Temukan jawaban untuk pertanyaan umum seputar Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an.
                </p>
            </div>

            <div class="space-y-4 faq-container">
                @php
                    $faqs = [
                        ['q' => 'Kapan pendaftaran PPDB dibuka?',                       'a' => 'Pendaftaran PPDB dibuka mulai bulan Maret hingga Juni setiap tahunnya. Untuk informasi terbaru, silakan cek halaman Jadwal & Timeline.'],
                        ['q' => 'Apakah ada tes masuk untuk calon siswa?',               'a' => 'Ya, calon siswa akan mengikuti tes seleksi yang meliputi tes baca tulis, wawancara, dan tes kemampuan Al-Quran sesuai jenjang.'],
                        ['q' => 'Berapa biaya pendaftaran?',                             'a' => 'Biaya formulir pendaftaran sebesar Rp 150.000. Informasi biaya pendidikan lengkap akan disampaikan saat daftar ulang.'],
                        ['q' => 'Apakah tersedia program beasiswa?',                    'a' => 'Ya, kami menyediakan program beasiswa untuk siswa berprestasi dan siswa dari keluarga kurang mampu. Hubungi kami untuk informasi lebih lanjut.'],
                        ['q' => 'Bagaimana sistem pembelajaran di SIT Mutiara Quran?', 'a' => 'Kami menggunakan Kurikulum Merdeka yang diintegrasikan dengan kurikulum keislaman. Pembelajaran berlangsung dari pukul 07.00 hingga 15.30 WIB (fullday school).'],
                        ['q' => 'Apakah ada program tahfidz?',                          'a' => 'Ya, program tahfidz merupakan program unggulan kami. Target hafalan: TK (Juz 30), SD (5 Juz), SMP (10 Juz).'],
                        ['q' => 'Bagaimana cara mendaftar?',                            'a' => 'Anda bisa mendaftar secara online melalui website atau datang langsung ke sekolah. Lihat bagian Alur Pendaftaran di atas untuk detail langkah-langkahnya.'],
                    ];
                @endphp

                @foreach($faqs as $i => $faq)
                @php
                    // Alternate slide directions: left, right, left, right
                    $translateClass = $i % 2 === 0 ? '-translate-x-8' : 'translate-x-8';
                    $delay = 400 + ($i * 120); // 0.12s increments
                @endphp
                <div class="faq-item-interactive bg-white border border-slate-200 rounded-2xl p-5 md:p-6 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-700 ease-out hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50/30 hover:shadow-lg hover:shadow-emerald-100/50 group" 
                     style="transition-delay: {{ $delay }}ms;"
                     onclick="toggleInteractiveFaq(this)">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 group-hover:text-emerald-600 group-hover:border-emerald-200 transition-colors faq-icon-box">
                            <span class="text-sm font-bold">{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-grow pt-1 w-full">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-base md:text-lg font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $faq['q'] }}</h3>
                                <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 transition-colors faq-chevron-wrapper">
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-transform duration-300 faq-chevron-icon"></i>
                                </div>
                            </div>
                            <div class="faq-answer-interactive grid transition-all duration-300 ease-in-out opacity-0" style="grid-template-rows: 0fr;">
                                <div class="overflow-hidden">
                                    <p class="text-sm md:text-base text-slate-600 leading-relaxed pt-4 pb-1 pr-8 border-t border-slate-100 mt-4">
                                        {{ $faq['a'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* Custom styles for FAQ interactive */
        .faq-item-interactive.is-active {
            border-color: #34d399; /* emerald-400 */
            background-color: #f0fdf4; /* emerald-50 */
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.1), 0 8px 10px -6px rgba(16, 185, 129, 0.1);
            border-left: 4px solid #10b981; /* Aksen hijau di kiri */
        }
        
        .faq-item-interactive.is-active .faq-icon-box {
            background-color: #10b981; /* emerald-500 */
            color: white;
            border-color: #10b981;
        }

        .faq-item-interactive.is-active h3 {
            color: #047857; /* emerald-700 */
        }

        .faq-item-interactive.is-active .faq-chevron-wrapper {
            background-color: #d1fae5; /* emerald-100 */
        }
        
        .faq-item-interactive.is-active .faq-chevron-icon {
            transform: rotate(180deg);
            color: #059669; /* emerald-600 */
        }

        .faq-item-interactive.is-active .faq-answer-interactive {
            grid-template-rows: 1fr !important;
            opacity: 1;
        }

        /* Animation visible states */
        .faq-badge.is-visible { opacity: 1; transform: scale(1); }
        .faq-title.is-visible { opacity: 1; transform: scale(1); }
        .faq-subtitle.is-visible { opacity: 1; transform: translateY(0); }
        .faq-item-interactive.is-visible { opacity: 1; transform: translateX(0) translateY(0); }
    </style>

    <script>
        // Toggle FAQ Accordion
        function toggleInteractiveFaq(clickedItem) {
            const isActive = clickedItem.classList.contains('is-active');
            
            // Auto close others
            document.querySelectorAll('.faq-item-interactive').forEach(item => {
                item.classList.remove('is-active');
            });

            // If it wasn't active before, open it
            if (!isActive) {
                clickedItem.classList.add('is-active');
            }
        }

        // Intersection Observer for FAQ animations
        document.addEventListener('DOMContentLoaded', () => {
            const faqSection = document.getElementById('faq');
            if (!faqSection) return;

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const faqObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Animate badge
                        const badge = entry.target.querySelector('.faq-badge');
                        if(badge) badge.classList.add('is-visible');

                        // Animate title
                        const title = entry.target.querySelector('.faq-title');
                        if(title) title.classList.add('is-visible');

                        // Animate subtitle
                        const subtitle = entry.target.querySelector('.faq-subtitle');
                        if(subtitle) subtitle.classList.add('is-visible');

                        // Animate items
                        const items = entry.target.querySelectorAll('.faq-item-interactive');
                        items.forEach(item => {
                            item.classList.add('is-visible');
                            // Reset transition delay after animation so hover effect is snappy
                            setTimeout(() => {
                                item.style.transitionDelay = '0ms';
                            }, parseInt(item.style.transitionDelay) + 700);
                        });

                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            faqObserver.observe(faqSection);
        });
    </script>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== BROSUR PPDB ===== --}}
    <section id="brosur" class="public-section py-16 bg-white">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 fade-up">
                <span class="section-badge"><i data-lucide="file-down" class="w-4 h-4"></i> Brosur PPDB</span>
                <h2 class="section-title mx-auto">Download Brosur Lengkap</h2>
                <p class="section-subtitle mx-auto text-center max-w-2xl">Unduh brosur resmi untuk melihat informasi lengkap mengenai jadwal pendaftaran, timeline, syarat, biaya pendidikan, program unggulan, fasilitas sekolah, dan informasi penting lainnya.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $brosurs = [
                        ['title' => 'Syarat PPDB TK/SD', 'desc' => 'Lihat persyaratan pendaftaran tingkat TK dan SD', 'file' => 'syarat-tksd.jpeg', 'delay' => '100ms'],
                        ['title' => 'Biaya PPDB TK/SD', 'desc' => 'Lihat rincian biaya pendaftaran tingkat TK dan SD', 'file' => 'biaya-tksd.jpeg', 'delay' => '200ms'],
                        ['title' => 'Syarat PPDB SMP', 'desc' => 'Lihat persyaratan pendaftaran tingkat SMP', 'file' => 'syarat-smp.jpeg', 'delay' => '300ms'],
                        ['title' => 'Biaya PPDB SMP', 'desc' => 'Lihat rincian biaya pendaftaran tingkat SMP', 'file' => 'biaya-smp.jpeg', 'delay' => '400ms'],
                    ];
                @endphp
                @foreach($brosurs as $brosur)
                <div class="bg-white rounded-[20px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 flex flex-col group fade-up" style="transition-delay: {{ $brosur['delay'] }};">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $brosur['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">{{ $brosur['desc'] }}</p>
                    <div class="flex flex-col xl:flex-row gap-2 mt-auto">
                        <a href="{{ asset('images/' . $brosur['file']) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-emerald-100 text-emerald-600 font-bold text-xs hover:bg-emerald-50 hover:border-emerald-200 transition-all duration-300">
                            <i data-lucide="eye" class="w-4 h-4"></i> Lihat
                        </a>
                        <a href="{{ asset('images/' . $brosur['file']) }}" download class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 text-white font-bold text-xs shadow-md shadow-emerald-200 hover:bg-emerald-600 transition-all duration-300">
                            <i data-lucide="download" class="w-4 h-4"></i> Unduh
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="text-center mt-16 pt-10 border-t border-slate-100 fade-up" style="transition-delay: 500ms;">
                <p class="text-slate-500 mb-4">Masih ada pertanyaan atau butuh bantuan pendaftaran?</p>
                <a href="https://wa.me/6282286204878" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold shadow-lg shadow-emerald-200 hover:-translate-y-1 transition-all duration-300">
                    <i data-lucide="message-circle" class="w-5 h-5"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== LOKASI SEKOLAH (MAPS) & HUBUNGI KAMI ===== --}}
    <section id="kontak" class="public-section py-16 bg-slate-50/50">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 fade-up">
                <span class="section-badge"><i data-lucide="phone" class="w-4 h-4"></i> Hubungi Kami</span>
                <h2 class="section-title mx-auto">Kontak & Lokasi</h2>
                <p class="section-subtitle mx-auto text-center">Kunjungi kami atau kirimkan pesan untuk pertanyaan seputar PPDB SIT Mutiara Qur'an.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                {{-- INFO & MAPS --}}
                <div class="lg:col-span-6 flex flex-col gap-6 fade-up">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Alamat</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Karasak, Jorong Pasar Baru,<br>Cupak, Gunung Talang, Solok
                            </p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Telepon / WA</h3>
                            <p class="text-xs text-slate-500">+62 822-8620-4878</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Email</h3>
                            <p class="text-xs text-slate-500">info@sitmutiaraquran.sch.id</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center mb-3">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Jam Layanan</h3>
                            <p class="text-xs text-slate-500">Senin – Jum'at: 08.00 – 14.00 WIB</p>
                        </div>
                    </div>
                    
                    {{-- Google Maps Frame --}}
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-lg flex-1" style="min-height: 280px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31914.641419208794!2d100.598466!3d-0.8962703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1780587530868!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0; display:block;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi SIT Mutiara Qur'an Nagari Cupak">
                        </iframe>
                    </div>
                </div>

                {{-- FORMULIR KONTAK --}}
                <div class="lg:col-span-6 bg-white p-8 rounded-3xl border border-slate-200/60 shadow-lg flex flex-col justify-between fade-up">
                    <div>
                        <span class="section-badge mb-4"><i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan</span>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-6">Formulir Kontak</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" class="contact-input" placeholder="Masukkan nama lengkap Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                                <input type="email" class="contact-input" placeholder="contoh@email.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subjek</label>
                                <input type="text" class="contact-input" placeholder="Perihal pesan Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pesan</label>
                                <textarea class="contact-input" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                                <i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
