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
                                <img src="{{ $welcomeMessage && $welcomeMessage->kepsek_photo ? (Str::startsWith($welcomeMessage->kepsek_photo, 'http') ? $welcomeMessage->kepsek_photo : asset('storage/' . $welcomeMessage->kepsek_photo)) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600' }}" alt="Kepala Sekolah SIT Mutiara Qur'an" class="w-full h-96 object-cover object-top transition-transform duration-500 ease-out group-hover:scale-[1.08]">
                                <div class="sambutan-badge transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:bg-emerald-600 group-hover:text-white reveal reveal-pop" style="transition-property: all !important; transition-delay: 150ms;">Kepala Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Column --}}
                <div class="lg:col-span-7 text-left">
                    <span class="section-badge reveal reveal-sambutan-title" style="transition-delay: 50ms;"><i data-lucide="quote" class="w-4 h-4"></i> Kata Sambutan</span>
                    <h2 class="section-title text-left mb-6 reveal reveal-sambutan-title" style="transition-delay: 200ms;">{{ $welcomeMessage && $welcomeMessage->title ? $welcomeMessage->title : 'Membentuk Generasi Rabbanî yang Unggul & Berkarakter' }}</h2>
                    <div class="space-y-4 text-slate-600 leading-relaxed text-sm sm:text-base">
                        <p class="font-bold text-slate-800 text-lg reveal reveal-up" style="transition-delay: 350ms;">{{ $welcomeMessage && $welcomeMessage->greeting ? $welcomeMessage->greeting : "Assalamu'alaikum Warahmatullahi Wabarakatuh," }}</p>
                        
                        @if ($welcomeMessage && $welcomeMessage->paragraphs)
                            @php
                                $paragraphs = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                            @endphp
                            @foreach ($paragraphs ?? [] as $index => $paragraph)
                                <p class="reveal reveal-up" style="transition-delay: {{ 500 + ($index * 150) }}ms;">
                                    {!! $paragraph !!}
                                </p>
                            @endforeach
                        @else
                            <p class="reveal reveal-up" style="transition-delay: 500ms;">
                                Segala puji bagi Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad SAW. Selamat datang di portal resmi <strong>SIT Mutiara Qur'an Nagari Cupak</strong>.
                            </p>
                            <p class="reveal reveal-up" style="transition-delay: 650ms;">
                                Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur'an yang seimbang secara spiritual, intelektual, dan moral. Kami meyakini bahwa setiap child memiliki potensi terbaiknya, dan tugas kamilah di sekolah untuk menuntun serta mengasah potensi tersebut dengan berlandaskan nilai-nilai Al-Qur'an dan Sunnah.
                            </p>
                            <p class="reveal reveal-up" style="transition-delay: 800ms;">
                                Dengan dukungan asatidzah yang berkompeten, fasilitas yang kondusif, serta lingkungan yang islami, kami siap berkolaborasi erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon pemimpin umat masa depan yang berakhlak mulia.
                            </p>
                        @endif
                    </div>
                    <div class="mt-8 pt-6 relative fade-up" style="transition-delay: 1100ms;">
                        <div class="absolute top-0 left-0 h-[1px] bg-slate-200 w-full"></div>
                        <h4 class="text-base font-extrabold text-slate-800">{{ $welcomeMessage && $welcomeMessage->kepsek_name ? $welcomeMessage->kepsek_name : 'Ustadz Ahmad Fauzi, S.Pd.I, M.Pd' }}</h4>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mt-1">{{ $welcomeMessage && $welcomeMessage->kepsek_title ? $welcomeMessage->kepsek_title : 'Pimpinan & Kepala Sekolah SIT Mutiara Qur\'an' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

