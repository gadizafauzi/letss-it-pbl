{{-- FOOTER --}}
<footer class="public-footer relative !bg-[#002244]" style="padding-left: 0; padding-right: 0;">
    {{-- Wavy Top Divider --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none transform -translate-y-full z-10 pointer-events-none">
        <svg class="relative block w-full h-[30px] md:h-[50px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <!-- Yellow Accent Wave -->
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-[#ffc629]"></path>
            <!-- Main Blue Wave -->
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="fill-[#002244]"></path>
        </svg>
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-20">
        <div class="footer-grid">

            {{-- BRAND --}}
            <div class="footer-brand">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo_jsit.png') }}" alt="Logo JSIT" class="w-10 h-10 rounded-xl object-contain bg-white p-1">
                    <img src="{{ asset('images/logomq.jpg') }}" alt="Logo Mutiara Qur'an" class="w-10 h-10 rounded-xl object-contain bg-white p-1">
                    <h3>SIT Mutiara Qur'an</h3>
                </div>
                <p class="mb-5 leading-relaxed text-sm text-slate-400">Mendidik generasi Qur'ani yang berakhlak mulia, cerdas, berprestasi, dan berdaya saing global dengan pendekatan kurikulum Islam Terpadu yang seimbang.</p>
                
                <div class="flex items-center gap-3 mt-4">
                    <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 border border-slate-800 text-slate-300 flex items-center justify-center hover:bg-slate-700 hover:border-slate-800 hover:text-white transition-all duration-300 shadow-sm" title="Instagram">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    <a href="{{ $settings['youtube'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 border border-slate-800 text-slate-300 flex items-center justify-center hover:bg-red-500 hover:border-red-500 hover:text-white transition-all duration-300 shadow-sm" title="YouTube">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>
                    </a>
                    <a href="{{ $settings['facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-white/5 border border-slate-800 text-slate-300 flex items-center justify-center hover:bg-slate-700 hover:border-slate-800 hover:text-white transition-all duration-300 shadow-sm" title="Facebook">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                </div>
            </div>

            {{-- NAVIGASI --}}
            <div class="footer-col">
                <h4>Navigasi</h4>
                <a href="{{ route('public.home') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-slate-700"></i> Beranda</a>
                <a href="{{ route('public.profil.index') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-slate-700"></i> Profil Sekolah</a>
                <a href="{{ route('public.berita.index') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-slate-700"></i> Berita & Kegiatan</a>
            </div>

            {{-- INFORMASI --}}
            <div class="footer-col">
                <h4>Informasi PPDB</h4>
                <a href="{{ route('public.ppdb.index') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-amber-500"></i> PPDB Online</a>
                <a href="{{ route('public.ppdb.syarat') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-amber-500"></i> Syarat Pendaftaran</a>
                <a href="{{ route('public.ppdb.faq') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-amber-500"></i> FAQ</a>
                <a href="{{ route('public.ppdb.form-kontak') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-amber-500"></i> Kontak Kami</a>
                <a href="{{ route('login') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-amber-500"></i> Login Portal</a>
            </div>

            {{-- KONTAK --}}
            <div class="footer-col">
                <h4>Kontak & Lokasi</h4>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">
                    <i data-lucide="map-pin" class="w-4 h-4 text-slate-700 inline mr-2"></i>{!! nl2br(e($settings['address'] ?? "Karasak, Jorong Pasar Baru,\nNagari Cupak, Kec. Gunung Talang,\nKabupaten Solok, Sumatera Barat")) !!}
                </p>
                <p class="text-sm text-slate-400 leading-relaxed mb-2">
                    <a href="tel:{{ str_replace(' ', '', $settings['phone'] ?? '+6282286204878') }}" class="hover:text-amber-400 smooth-transition">
                        <i data-lucide="phone" class="w-4 h-4 text-slate-700 inline mr-2"></i>{{ $settings['phone'] ?? '+62 822-8620-4878' }}
                    </a>
                </p>
                <p class="text-sm text-slate-400 leading-relaxed">
                    <a href="mailto:{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}" class="hover:text-amber-400 smooth-transition">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-700 inline mr-2"></i>{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}
                    </a>
                </p>
                
                <h5 class="text-xs font-bold text-white uppercase mt-4 mb-2 tracking-wider">Jam Operasional</h5>
                <p class="text-xs text-slate-500 leading-relaxed">
                    {!! nl2br(e($settings['operational_hours'] ?? "Senin - Jum'at: 07.15 - 15.30 WIB\nSabtu - Minggu: Libur")) !!}
                </p>
            </div>

        </div>

        <div class="footer-bottom text-amber-400/80">
            &copy; {{ date('Y') }} SIT Mutiara Qur'an. All rights reserved.
        </div>
    </div>
</footer>

