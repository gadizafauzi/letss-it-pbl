@if(isset($testimonials) && !$testimonials->isEmpty())
{{-- TESTIMONI WALI MURID --}}
    <section class="public-section bg-white relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Apa Kata Orang Tua Wali Murid?</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Kepercayaan dan kebanggaan para orang tua atas perkembangan akademis dan karakter islami putra-putrinya di SIT Mutiara Qur'an.</p>
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
                                        <img src="{{ $t['avatar'] ?? 'https://ui-avatars.com/api/?name='.urlencode($t['name']).'&background=random' }}" alt="{{ $t['name'] }}" class="w-16 h-16 rounded-full object-cover border-4 border-emerald-100 shadow-md mb-3 transition-all duration-300 hover:scale-110 hover:shadow-[0_0_15px_rgba(16,185,129,0.5)]">
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
@endif

