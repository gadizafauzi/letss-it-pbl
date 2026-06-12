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
                $displayTestimonial = [];
                if (isset($testimonials) && !$testimonials->isEmpty()) {
                    foreach ($testimonials as $t) {
                        $displayTestimonial[] = [
                            'quote' => $t->quote,
                            'name' => $t->name,
                            'role' => $t->role,
                            'avatar' => $t->avatar
                        ];
                    }
                } else {
                    $displayTestimonial = [
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
                }
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
                            @foreach($displayTestimonial as $index => $t)
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
                    @foreach($displayTestimonial as $index => $t)
                        <button onclick="goToSlide({{ $index }})" class="w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-emerald-600 w-6 animate-pulse' : 'bg-slate-300' }} slider-dot reveal reveal-fade" style="transition-delay: {{ 850 + ($index * 100) }}ms;" aria-label="Go to slide {{ $index+1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

