@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">FAQ</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Pertanyaan Umum (FAQ)</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link active">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="help-circle" class="w-4 h-4"></i> FAQ</span>
                <h2 class="section-title mx-auto">Pertanyaan yang Sering Diajukan</h2>
            </div>
            <div class="space-y-4">
                @php $faqs = [
                    ['q'=>'Kapan pendaftaran PPDB dibuka?','a'=>'Pendaftaran PPDB dibuka mulai bulan Maret hingga Juni setiap tahunnya. Untuk informasi terbaru, silakan cek halaman Jadwal PPDB.'],
                    ['q'=>'Apakah ada tes masuk untuk calon siswa?','a'=>'Ya, calon siswa akan mengikuti tes seleksi yang meliputi tes baca tulis, wawancara, dan tes kemampuan Al-Quran sesuai jenjang.'],
                    ['q'=>'Berapa biaya pendaftaran?','a'=>'Biaya formulir pendaftaran sebesar Rp 150.000. Informasi biaya pendidikan lengkap akan disampaikan saat daftar ulang.'],
                    ['q'=>'Apakah tersedia program beasiswa?','a'=>'Ya, kami menyediakan program beasiswa untuk siswa berprestasi dan siswa dari keluarga kurang mampu. Hubungi kami untuk informasi lebih lanjut.'],
                    ['q'=>'Bagaimana sistem pembelajaran di SIT Mutiara Quran?','a'=>'Kami menggunakan Kurikulum Merdeka yang diintegrasikan dengan kurikulum keislaman. Pembelajaran berlangsung dari pukul 07.00 hingga 15.30 WIB (fullday school).'],
                    ['q'=>'Apakah ada program tahfidz?','a'=>'Ya, program tahfidz merupakan program unggulan kami. Target hafalan: TK (Juz 30), SD (5 Juz), SMP (10 Juz).'],
                    ['q'=>'Bagaimana cara mendaftar?','a'=>'Anda bisa mendaftar secara online melalui website atau datang langsung ke sekolah. Lihat halaman Alur Pendaftaran untuk detail langkah-langkahnya.'],
                ]; @endphp
                @foreach($faqs as $i => $faq)
                <div class="faq-item feature-card fade-up cursor-pointer" onclick="this.classList.toggle('faq-open')">
                    <div class="flex items-center justify-between gap-4">
                        <h3 class="text-base font-bold text-slate-800">{{ $faq['q'] }}</h3>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 flex-shrink-0 faq-chevron transition-transform duration-300"></i>
                    </div>
                    <div class="faq-answer mt-0 max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-sm text-slate-500 leading-relaxed pt-3">{{ $faq['a'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
