@if(isset($faqs) && !$faqs->isEmpty())
{{-- QUICK FAQ --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Pertanyaan Umum (FAQ)</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Menjawab keraguan dan pertanyaan paling umum seputar pendaftaran serta pola ajar di SIT Mutiara Qur'an.</p>
            </div>

            <div class="max-w-3xl mx-auto">
                @php
                    $displayFaqs = [];
                    foreach ($faqs as $f) {
                        $displayFaqs[] = [
                            'question' => $f->question,
                            'answer' => $f->answer
                        ];
                    }
                @endphp
                <div class="space-y-4">
                    @foreach($displayFaqs as $i => $faq)
                    @php
                        // Alternate slide directions: left, right, left, right
                        $translateClass = $i % 2 === 0 ? '-translate-x-8' : 'translate-x-8';
                        $delay = 400 + ($i * 120); // 0.12s increments
                    @endphp
                    <div class="faq-item-interactive bg-white border border-slate-200 rounded-2xl p-5 md:p-6 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-700 ease-out hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50/30 hover:shadow-lg hover:shadow-emerald-100/50 group reveal reveal-up" 
                         style="transition-delay: {{ $delay }}ms;"
                         onclick="toggleInteractiveFaq(this)">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 group-hover:text-emerald-600 group-hover:border-emerald-200 transition-colors faq-icon-box">
                                <span class="text-sm font-bold">{{ $i + 1 }}</span>
                            </div>
                            <div class="flex-grow pt-1 w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="text-base md:text-lg font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $faq['question'] }}</h3>
                                    <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 transition-colors faq-chevron-wrapper">
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-transform duration-300 faq-chevron-icon"></i>
                                    </div>
                                </div>
                                <div class="faq-answer-interactive grid transition-all duration-300 ease-in-out opacity-0" style="grid-template-rows: 0fr;">
                                    <div class="overflow-hidden">
                                        <p class="text-sm md:text-base text-slate-600 leading-relaxed pt-4 pb-1 pr-8 border-t border-slate-100 mt-4">
                                            {{ $faq['answer'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

    {{-- CTA PPDB --}}
    <section id="cta-ppdb" class="public-section bg-gradient-to-br from-emerald-800 to-emerald-950 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <span class="reveal reveal-zoom inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-amber-300 text-sm font-bold mb-6 hover:shadow-[0_0_15px_rgba(252,211,77,0.3)] hover:bg-white/15 transition-all duration-300 cursor-default ">
                    <i data-lucide="megaphone" class="w-4 h-4 text-amber-300"></i> Pendaftaran Dibuka
                </span>
                <h2 class="reveal reveal-up delay-100 text-3xl sm:text-4xl font-black text-white leading-tight mb-4 ">
                    Penerimaan Peserta Didik Baru<br>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
                </h2>
                <p class="reveal reveal-up delay-200 text-emerald-100/70 text-sm sm:text-base mb-10 max-w-lg mx-auto leading-relaxed ">
                    Segera amankan kuota pendaftaran putra-putri Anda di SIT Mutiara Qur'an dan berikan mereka pondasi agama serta akademis terbaik.
                </p>
                <div class="flex flex-wrap justify-center gap-4 py-2">
                    <a href="{{ route('public.ppdb.index') }}"
                        class="reveal reveal-left delay-300 group inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-amber-400 text-emerald-950 font-extrabold text-base shadow-lg shadow-amber-500/20 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_rgba(251,191,36,0.4)] transition-all duration-300 ">
                        <i data-lucide="file-text" class="w-5 h-5"></i> Informasi Pendaftaran (PPDB)
                    </a>
                    <a href="{{ route('public.ppdb.form-kontak') }}"
                        class="reveal reveal-right delay-400 group inline-flex items-center gap-3 px-10 py-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/20 text-white font-bold text-base hover:bg-white/10 hover:border-white/40 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_rgba(255,255,255,0.1)] transition-all duration-300 ">
                        <i data-lucide="phone" class="w-5 h-5"></i> Hubungi Panitia
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- INLINE FAQ & SLIDER & FILTER JAVASCRIPT --}}
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
        .faq-item-interactive.is-visible { opacity: 1; transform: translateX(0) translateY(0); }
    </style>

    <script>
        // Toggle FAQ Accordion for Home
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
        
        // Ensure reveal on scroll applies to faq items properly
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        obs.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.faq-item-interactive').forEach(el => observer.observe(el));
        });
    </script>
