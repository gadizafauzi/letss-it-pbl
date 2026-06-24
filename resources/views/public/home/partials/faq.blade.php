@if(isset($faqs) && !$faqs->isEmpty())
{{-- QUICK FAQ --}}
    <section class="public-section bg-slate-50 relative overflow-hidden pt-0 md:pt-4">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-12 flex flex-col items-center">
                <h2 class="section-title reveal reveal-zoom mb-2" style="transition-delay: 150ms;">Pertanyaan Umum (FAQ)</h2>


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
                    <div class="faq-item-interactive bg-white border border-slate-200 rounded-2xl p-5 md:p-6 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-700 ease-out hover:-translate-y-1 hover:border-slate-400 hover:bg-slate-50/30 hover:shadow-lg hover:shadow-slate-100/50 group reveal reveal-up" 
                         style="transition-delay: {{ $delay }}ms;"
                         onclick="toggleInteractiveFaq(this)">
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-slate-100 group-hover:text-[#003f88] group-hover:border-slate-200 transition-colors faq-icon-box">
                                <span class="text-sm font-bold">{{ $i + 1 }}</span>
                            </div>
                            <div class="flex-grow pt-1 w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <h3 class="text-base md:text-lg font-bold text-[#003f88] group-hover:text-[#003f88] transition-colors">{{ $faq['question'] }}</h3>
                                    <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-slate-100 transition-colors faq-chevron-wrapper">
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-[#003f88] transition-transform duration-300 faq-chevron-icon"></i>
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
    <section id="cta-ppdb" class="py-12 md:py-16 bg-gradient-to-br from-amber-50 via-yellow-50/50 to-amber-100/80 relative overflow-hidden">
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(0,0,0,0.04) 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-2xl mx-auto text-center">
                <span class="reveal reveal-zoom inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-700 text-xs font-bold mb-4 hover:bg-amber-500/20 transition-all duration-300 cursor-default">
                    <i data-lucide="megaphone" class="w-3.5 h-3.5 text-amber-600"></i> Pendaftaran Dibuka
                </span>
                <h2 class="reveal reveal-up delay-100 text-2xl sm:text-3xl font-black text-[#002244] leading-tight mb-3">
                    Penerimaan Peserta Didik Baru<br>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
                </h2>
                <p class="reveal reveal-up delay-200 text-slate-600 text-xs sm:text-sm mb-6 max-w-md mx-auto leading-relaxed">
                    Segera amankan kuota pendaftaran putra-putri Anda di SIT Mutiara Qur'an dan berikan mereka pondasi agama serta akademis terbaik.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('public.ppdb.index') }}"
                        class="reveal reveal-left delay-300 group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#002244] text-white font-extrabold text-sm shadow-lg shadow-blue-900/20 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(0,34,68,0.3)] transition-all duration-300">
                        <i data-lucide="file-text" class="w-4 h-4"></i> Informasi Pendaftaran (PPDB)
                    </a>
                    <a href="{{ route('public.ppdb.form-kontak') }}"
                        class="reveal reveal-right delay-400 group inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/60 backdrop-blur-sm border border-amber-200 text-slate-700 font-bold text-sm hover:bg-white hover:border-amber-300 hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                        <i data-lucide="phone" class="w-4 h-4"></i> Hubungi Panitia
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- INLINE FAQ & SLIDER & FILTER JAVASCRIPT --}}
    <style>
        /* Custom styles for FAQ interactive */
        .faq-item-interactive.is-active {
            border-color: #ffc629; 
            background-color: #fffdf5; 
            box-shadow: 0 10px 25px -5px rgba(255, 170, 0, 0.15), 0 8px 10px -6px rgba(255, 170, 0, 0.1);
            border-left: 4px solid #ffaa00; 
        }
        
        .faq-item-interactive.is-active .faq-icon-box {
            background-color: #ffaa00; 
            color: #002244;
            border-color: #ffaa00;
        }

        .faq-item-interactive.is-active h3 {
            color: #002244; 
        }

        .faq-item-interactive.is-active .faq-chevron-wrapper {
            background-color: #ffedb3; 
        }
        
        .faq-item-interactive.is-active .faq-chevron-icon {
            transform: rotate(180deg);
            color: #cc8800; 
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
