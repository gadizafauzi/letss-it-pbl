{{-- FOOTER --}}
<footer class="public-footer">

    <div class="footer-grid">

            {{-- BRAND --}}
            <div class="footer-brand">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-xl object-cover">
                    <h3>SIT Mutiara Qur'an</h3>
                </div>
                <p>Mendidik generasi Qur'ani yang berakhlak mulia, berprestasi, dan berwawasan global dengan pendekatan Islam Terpadu.</p>
            </div>

            {{-- NAVIGASI --}}
            <div class="footer-col">
                <h4>Navigasi</h4>
                <a href="{{ route('public.home') }}">Beranda</a>
                <a href="{{ route('public.profil.visi-misi') }}">Visi & Misi</a>
                <a href="{{ route('public.profil.sejarah') }}">Sejarah</a>
                <a href="{{ route('public.unit.index') }}">Unit Pendidikan</a>
                <a href="{{ route('public.berita.index') }}">Berita</a>
            </div>

            {{-- INFORMASI --}}
            <div class="footer-col">
                <h4>Informasi</h4>
                <a href="{{ route('public.ppdb.index') }}">PPDB</a>
                <a href="{{ route('public.ppdb.syarat') }}">Syarat Pendaftaran</a>
                <a href="{{ route('public.ppdb.faq') }}">FAQ</a>
                <a href="{{ route('public.ppdb.form-kontak') }}">Kontak</a>
                <a href="{{ route('login') }}">Login Portal</a>
            </div>

            {{-- KONTAK --}}
            <div class="footer-col">
                <h4>Kontak</h4>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Jl. Pendidikan No. 123<br>
                    Kota Bandung, Jawa Barat<br><br>
                    <span class="text-slate-400">Telp:</span> (022) 1234-5678<br>
                    <span class="text-slate-400">Email:</span> info@sitmutiaraquran.sch.id
                </p>
            </div>

        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} SIT Mutiara Qur'an. All rights reserved.
        </div>

</footer>
