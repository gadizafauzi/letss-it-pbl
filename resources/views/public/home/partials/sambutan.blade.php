@if($welcomeMessage)
{{-- SAMBUTAN KEPALA SEKOLAH --}}
    <section class="public-section bg-white relative overflow-hidden py-16 md:py-24">
        
        <!-- Subtle decorative background element -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50/50 -skew-x-12 transform origin-top hidden lg:block"></div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                {{-- Avatar Column --}}
                <div class="lg:col-span-5 flex justify-center relative">
                    <!-- Offset background blobs -->
                    <div class="absolute inset-0 bg-amber-400/20 rounded-[32px] transform translate-x-4 translate-y-4 -z-10 rotate-3 transition-transform duration-500 hover:rotate-6"></div>
                    <div class="absolute inset-0 bg-[#002244]/10 rounded-[32px] transform -translate-x-3 -translate-y-3 -z-10 -rotate-2"></div>
                    
                    <div class="sambutan-wrapper w-full max-w-sm reveal reveal-photo" style="transition-delay: 0ms;">
                        <div class="relative overflow-hidden rounded-[32px] border-[6px] border-white shadow-xl group">
                            <img src="{{ $welcomeMessage->kepsek_photo ? (Str::startsWith($welcomeMessage->kepsek_photo, 'http') ? $welcomeMessage->kepsek_photo : asset('storage/' . $welcomeMessage->kepsek_photo)) : '' }}" alt="Kepala Sekolah SIT Mutiara Qur'an" class="w-full h-[320px] md:h-[450px] object-cover object-top group-hover:scale-105 transition-transform duration-700 ease-out">
                            
                            <!-- Floating Badge -->
                            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-white/95 backdrop-blur-md px-6 py-2.5 rounded-xl shadow-[0_10px_20px_rgba(0,34,68,0.1)] border border-slate-100 whitespace-nowrap text-[#002244] font-black text-sm tracking-wide">
                                Kepala Sekolah
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Column --}}
                <div class="lg:col-span-7 text-left relative z-10">
                    <!-- Giant Quote Watermark -->
                    <div class="absolute -top-12 -left-8 text-slate-100 pointer-events-none z-[-1]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1.5.5 1.5 1.714C5.5 18 3 18 3 18zm14 0c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1.5.5 1.5 1.714C19.5 18 17 18 17 18z"/></svg>
                    </div>

                    <h2 class="section-title text-left mb-4 text-3xl md:text-4xl reveal reveal-sambutan-title" style="transition-delay: 200ms;">
                        {{ $welcomeMessage->title }}
                    </h2>
                    
                    <div class="space-y-3 text-slate-600 leading-relaxed text-sm md:text-base">
                        <p class="font-bold text-amber-500 text-lg md:text-xl reveal reveal-up" style="transition-delay: 350ms;">
                            {{ $welcomeMessage->greeting }}
                        </p>
                        
                        @if ($welcomeMessage->paragraphs)
                            @php
                                $paragraphs = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                            @endphp
                            @foreach ($paragraphs ?? [] as $index => $paragraph)
                                <p class="reveal reveal-up font-medium" style="transition-delay: {{ 500 + ($index * 150) }}ms;">
                                    {!! $paragraph !!}
                                </p>
                            @endforeach
                        @endif
                    </div>

                    <div class="mt-6 pt-6 border-t-2 border-amber-400 flex items-center gap-4 reveal reveal-up" style="transition-delay: 1100ms;">
                        <div class="w-12 h-12 rounded-2xl bg-amber-400/20 flex items-center justify-center text-amber-600 shrink-0">
                            <i data-lucide="pen-tool" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-[#002244]">{{ $welcomeMessage->kepsek_name }}</h4>
                            <p class="text-[13px] font-semibold text-slate-400 tracking-wider mt-0.5">{{ $welcomeMessage->kepsek_title }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif

