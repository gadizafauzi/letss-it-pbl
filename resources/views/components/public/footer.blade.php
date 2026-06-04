{{-- FOOTER --}}
<footer class="public-footer">

    <div class="footer-grid">

        {{-- BRAND --}}
        <div class="footer-brand">
            <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('images/logo_jsit.png') }}" alt="Logo JSIT" class="w-10 h-10 rounded-xl object-contain bg-white p-1">
                <h3>SIT Mutiara Qur'an</h3>
            </div>
            <p class="mb-5 leading-relaxed text-sm text-slate-400">Mendidik generasi Qur'ani yang berakhlak mulia, cerdas, berprestasi, dan berdaya saing global dengan pendekatan kurikulum Islam Terpadu yang seimbang.</p>
            
            {{-- SOSIAL MEDIA --}}
            <div class="flex items-center gap-3 mt-4">
                <a href="#" class="w-9 h-9 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300" title="Instagram">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300" title="YouTube">
                    <i data-lucide="youtube" class="w-4 h-4"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-xl bg-slate-800 text-slate-300 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all duration-300" title="Facebook">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        {{-- NAVIGASI --}}
        <div class="footer-col">
            <h4>Navigasi</h4>
            <a href="{{ route('public.home') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-emerald-500"></i> Beranda</a>
            <a href="{{ route('public.profil.visi-misi') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-emerald-500"></i> Visi & Misi</a>
            <a href="{{ route('public.profil.sejarah') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-emerald-500"></i> Sejarah</a>
            <a href="{{ route('public.unit.index') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-emerald-500"></i> Unit Pendidikan</a>
            <a href="{{ route('public.berita.index') }}"><i data-lucide="chevron-right" class="w-3.5 h-3.5 inline mr-1 text-emerald-500"></i> Berita & Kegiatan</a>
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
                <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500 inline mr-2"></i>Karasak, Jorong Pasar Baru,<br>
                Nagari Cupak, Kec. Gunung Talang,<br>
                Kabupaten Solok, Sumatera Barat
            </p>
            <p class="text-sm text-slate-400 leading-relaxed mb-2">
                <i data-lucide="phone" class="w-4 h-4 text-emerald-500 inline mr-2"></i>+62 822-8620-4878
            </p>
            <p class="text-sm text-slate-400 leading-relaxed">
                <i data-lucide="mail" class="w-4 h-4 text-emerald-500 inline mr-2"></i>info@sitmutiaraquran.sch.id
            </p>
            
            <h5 class="text-xs font-bold text-white uppercase mt-4 mb-2 tracking-wider">Jam Operasional</h5>
            <p class="text-xs text-slate-500 leading-relaxed">
                Senin - Jum'at: 07.15 - 15.30 WIB<br>
                Sabtu - Minggu: Libur
            </p>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; {{ date('Y') }} SIT Mutiara Qur'an. All rights reserved.
    </div>

</footer>

