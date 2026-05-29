@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">Kontak</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Hubungi Kami</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Kami siap membantu menjawab pertanyaan Anda seputar SIT Mutiara Qur'an.</p>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link active">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- INFO KONTAK --}}
                <div class="fade-up">
                    <span class="section-badge"><i data-lucide="map-pin" class="w-4 h-4"></i> Informasi Kontak</span>
                    <h2 class="section-title mb-8">Temui Kami</h2>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center flex-shrink-0"><i data-lucide="map-pin" class="w-5 h-5 text-emerald-600"></i></div>
                            <div><h4 class="font-bold text-slate-800 mb-1">Alamat</h4><p class="text-sm text-slate-500 leading-relaxed">Karasak Jorong Pasar Baru, Cupak,<br>Kecamatan Gunung Talang, Kabupaten Solok, Sumatera Barat</p></div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0"><i data-lucide="phone" class="w-5 h-5 text-blue-600"></i></div>
                            <div><h4 class="font-bold text-slate-800 mb-1">Telepon</h4><p class="text-sm text-slate-500">(022) 1234-5678</p><p class="text-sm text-slate-500">0812-3456-7890 (WhatsApp)</p></div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center flex-shrink-0"><i data-lucide="mail" class="w-5 h-5 text-amber-600"></i></div>
                            <div><h4 class="font-bold text-slate-800 mb-1">Email</h4><p class="text-sm text-slate-500">info@sitmutiaraquran.sch.id</p></div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center flex-shrink-0"><i data-lucide="clock" class="w-5 h-5 text-violet-600"></i></div>
                            <div><h4 class="font-bold text-slate-800 mb-1">Jam Operasional</h4><p class="text-sm text-slate-500">Senin — Jumat: 07.00 — 16.00 WIB</p><p class="text-sm text-slate-500">Sabtu: 08.00 — 12.00 WIB</p></div>
                        </div>
                    </div>
                    <div class="mt-8 rounded-2xl overflow-hidden border border-slate-200">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.354392667407!2d100.64404567395886!3d-0.8737564991177756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1779246320026!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                {{-- FORM --}}
                <div class="fade-up">
                    <span class="section-badge"><i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan</span>
                    <h2 class="section-title mb-8">Formulir Kontak</h2>
                    <form class="space-y-5">
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label><input type="text" class="contact-input" placeholder="Masukkan nama lengkap Anda"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Email</label><input type="email" class="contact-input" placeholder="contoh@email.com"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Subjek</label><input type="text" class="contact-input" placeholder="Perihal pesan Anda"></div>
                        <div><label class="block text-sm font-semibold text-slate-700 mb-2">Pesan</label><textarea class="contact-input" rows="5" placeholder="Tulis pesan Anda di sini..."></textarea></div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="send" class="w-5 h-5"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
