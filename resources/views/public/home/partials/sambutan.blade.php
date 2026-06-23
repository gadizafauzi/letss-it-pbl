@if($welcomeMessage)
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
                                <img src="{{ $welcomeMessage->kepsek_photo ? (Str::startsWith($welcomeMessage->kepsek_photo, 'http') ? $welcomeMessage->kepsek_photo : asset('storage/' . $welcomeMessage->kepsek_photo)) : '' }}" alt="Kepala Sekolah SIT Mutiara Qur'an" class="w-full h-96 object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.08]">
                                <div class="sambutan-badge transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:bg-emerald-600 group-hover:text-white reveal reveal-pop" style="transition-property: all !important; transition-delay: 150ms;">Kepala Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Column --}}
                <div class="lg:col-span-7 text-left">
                    <h2 class="section-title text-left mb-6 reveal reveal-sambutan-title" style="transition-delay: 200ms;">{{ $welcomeMessage->title }}</h2>
                    <div class="space-y-4 text-slate-600 leading-relaxed text-sm sm:text-base">
                        <p class="font-bold text-slate-800 text-lg reveal reveal-up" style="transition-delay: 350ms;">{{ $welcomeMessage->greeting }}</p>
                        
                        @if ($welcomeMessage->paragraphs)
                            @php
                                $paragraphs = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                            @endphp
                            @foreach ($paragraphs ?? [] as $index => $paragraph)
                                <p class="reveal reveal-up" style="transition-delay: {{ 500 + ($index * 150) }}ms;">
                                    {!! $paragraph !!}
                                </p>
                            @endforeach
                        @endif
                    </div>
                    <div class="mt-8 pt-6 relative fade-up" style="transition-delay: 1100ms;">
                        <div class="absolute top-0 left-0 h-[1px] bg-slate-200 w-full"></div>
                        <h4 class="text-base font-extrabold text-slate-800">{{ $welcomeMessage->kepsek_name }}</h4>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mt-1">{{ $welcomeMessage->kepsek_title }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif

