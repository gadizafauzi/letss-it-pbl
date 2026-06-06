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

