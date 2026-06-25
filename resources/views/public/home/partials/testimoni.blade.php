@if(isset($testimonials) && !$testimonials->isEmpty())
    {{-- TESTIMONI WALI MURID --}}
    <section class="public-section bg-slate-50 relative overflow-hidden py-16 md:py-24">
        <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-12 flex flex-col items-center">
                <div class="inline-block relative mb-4">
                    <h2 class="section-title reveal reveal-zoom after:hidden" style="transition-delay: 150ms;">Apa Kata Orang Tua Wali Murid?</h2>
                    <svg class="absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            @php
                $displayTestimonial = [];
                foreach ($testimonials as $t) {
                    $displayTestimonial[] = [
                        'quote' => $t->quote,
                        'name' => $t->name,
                        'role' => $t->role,
                        'avatar' => $t->avatar ? (str_starts_with($t->avatar, 'http') ? $t->avatar : asset('storage/' . $t->avatar)) : null
                    ];
                }
            @endphp

            {{-- Premium Testimonial Slider --}}
            <div class="max-w-5xl mx-auto relative px-4 sm:px-8">
                <div class="relative w-full rounded-[40px] bg-gradient-to-br from-[#002244] to-[#001224] p-8 sm:p-12 md:p-16 shadow-2xl overflow-hidden reveal reveal-carousel" style="transition-delay: 300ms; transition-duration: 800ms;">
                    
                    <!-- Decorative Background Elements -->
                    <div class="absolute -top-10 -right-6 text-white/[0.03] pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="280" height="280" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1.5.5 1.5 1.714C5.5 18 3 18 3 18zm14 0c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1.5.5 1.5 1.714C19.5 18 17 18 17 18z"/></svg>
                    </div>
                    <div class="absolute top-0 left-0 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl pointer-events-none -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-400/10 rounded-full blur-3xl pointer-events-none translate-x-1/4 translate-y-1/4"></div>

                    {{-- Carousel Viewport --}}
                    <div class="overflow-hidden w-full relative z-10">
                        {{-- Slider Track --}}
                        <div class="flex transition-transform duration-500 ease-in-out" id="testiSliderTrack" style="width: {{ count($displayTestimonial) * 100 }}%; transform: translateX(0%);">
                            @foreach($displayTestimonial as $index => $t)
                                <div class="w-full flex-shrink-0 text-center px-4 md:px-16 flex flex-col items-center" style="width: {{ 100 / count($displayTestimonial) }}%">
                                    
                                    <!-- Avatar -->
                                    <div class="relative mb-8">
                                        <div class="absolute inset-0 bg-amber-400 rounded-full blur-md opacity-50"></div>
                                        <img src="{{ $t['avatar'] ?? 'https://ui-avatars.com/api/?name='.urlencode($t['name']).'&background=random' }}" alt="{{ $t['name'] }}" class="relative w-20 h-20 md:w-24 md:h-24 rounded-full object-cover border-4 border-[#002244] ring-2 ring-amber-400 shadow-2xl transition-all duration-500 hover:scale-110">
                                    </div>
                                    
                                    <!-- Quote -->
                                    <div class="testi-quote text-lg md:text-2xl italic font-light mb-10 text-slate-100 leading-relaxed max-w-3xl mx-auto">
                                        "{{ $t['quote'] }}"
                                    </div>
                                    
                                    <!-- Author -->
                                    <div class="mt-auto">
                                        <h4 class="text-lg md:text-xl font-black text-amber-400 tracking-wide">{{ $t['name'] }}</h4>
                                        <p class="text-sm md:text-base text-slate-400 font-medium mt-1.5">{{ $t['role'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Navigation Controls --}}
                    <button onclick="prevSlide()" class="absolute left-3 md:left-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 hover:bg-amber-400 border border-white/20 hover:border-amber-400 text-white hover:text-[#002244] flex items-center justify-center transition-all duration-300 shadow-lg z-20 hover:scale-110 backdrop-blur-sm" aria-label="Previous slide">
                        <i data-lucide="chevron-left" class="w-5 h-5 md:w-6 md:h-6"></i>
                    </button>
                    <button onclick="nextSlide()" class="absolute right-3 md:right-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 hover:bg-amber-400 border border-white/20 hover:border-amber-400 text-white hover:text-[#002244] flex items-center justify-center transition-all duration-300 shadow-lg z-20 hover:scale-110 backdrop-blur-sm" aria-label="Next slide">
                        <i data-lucide="chevron-right" class="w-5 h-5 md:w-6 md:h-6"></i>
                    </button>
                </div>

                {{-- Dots Indicator --}}
                <div class="flex justify-center gap-3 mt-8">
                    @foreach($displayTestimonial as $index => $t)
                        <button onclick="goToSlide({{ $index }})" class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-amber-400 w-8' : 'bg-slate-300 hover:bg-slate-400' }} slider-dot" aria-label="Go to slide {{ $index+1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

