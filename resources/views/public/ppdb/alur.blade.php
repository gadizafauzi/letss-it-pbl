@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">Alur</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Alur Pendaftaran</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link active">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="route" class="w-4 h-4"></i> Alur Pendaftaran</span>
                <h2 class="section-title mx-auto">Langkah Mudah Mendaftar</h2>
            </div>
            @php $alur = [['no'=>'1','judul'=>'Mengisi Formulir','desc'=>'Isi formulir pendaftaran online atau datang langsung ke sekolah.'],['no'=>'2','judul'=>'Melengkapi Berkas','desc'=>'Siapkan dan serahkan berkas persyaratan yang diperlukan.'],['no'=>'3','judul'=>'Tes Seleksi','desc'=>'Calon siswa mengikuti tes baca tulis, wawancara, dan tes Al-Quran.'],['no'=>'4','judul'=>'Pengumuman','desc'=>'Hasil seleksi diumumkan melalui website dan WhatsApp.'],['no'=>'5','judul'=>'Daftar Ulang','desc'=>'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.']]; @endphp
            <div class="space-y-0">
                @foreach($alur as $step)
                <div class="timeline-item fade-up">
                    <div class="timeline-dot">{{ $step['no'] }}</div>
                    <div class="pt-1">
                        <h3 class="text-lg font-bold text-[var(--theme-primary)] mb-1">{{ $step['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
