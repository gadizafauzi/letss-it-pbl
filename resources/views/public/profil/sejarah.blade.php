@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Sejarah</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Sejarah Sekolah</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Perjalanan SIT Mutiara Qur'an dari awal pendirian hingga saat ini.</p>
        </div>
    </div>

    {{-- TIMELINE --}}
    <section class="public-section">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="clock" class="w-4 h-4"></i> Sejarah</span>
                <h2 class="section-title mx-auto">Perjalanan Kami</h2>
            </div>

            @php
                $sejarah = [
                    ['tahun' => '2010', 'judul' => 'Pendirian Sekolah', 'desc' => 'SIT Mutiara Quran didirikan oleh yayasan dengan 2 kelas pertama dan 30 siswa. Visi awal adalah menciptakan pendidikan Islam yang memadukan ilmu dunia dan akhirat.'],
                    ['tahun' => '2012', 'judul' => 'Pembukaan PAUD/TK', 'desc' => 'Membuka jenjang PAUD/TK Islam Terpadu untuk memulai pendidikan Qur\'ani sejak usia dini.'],
                    ['tahun' => '2014', 'judul' => 'Akreditasi A', 'desc' => 'Meraih akreditasi A dari BAN-S/M untuk jenjang SD Islam Terpadu, membuktikan kualitas pendidikan yang unggul.'],
                    ['tahun' => '2016', 'judul' => 'Wisuda Tahfidz Pertama', 'desc' => 'Angkatan pertama program tahfidz berhasil menyelesaikan target hafalan, menandai keberhasilan program unggulan.'],
                    ['tahun' => '2018', 'judul' => 'Pembukaan SMP IT', 'desc' => 'Membuka jenjang SMP Islam Terpadu untuk melanjutkan misi pendidikan ke tingkat yang lebih tinggi.'],
                    ['tahun' => '2021', 'judul' => 'Prestasi Nasional', 'desc' => 'Siswa berhasil meraih prestasi di tingkat nasional dalam bidang tahfidz dan olimpiade sains.'],
                    ['tahun' => '2023', 'judul' => 'Kampus Baru', 'desc' => 'Pindah ke kampus baru dengan fasilitas modern termasuk laboratorium, perpustakaan digital, dan area bermain yang luas.'],
                    ['tahun' => '2025', 'judul' => 'Era Digital', 'desc' => 'Meluncurkan sistem informasi akademik terintegrasi dan portal pembelajaran digital untuk seluruh jenjang.'],
                ];
            @endphp

            <div class="space-y-0">
                @foreach($sejarah as $item)
                    <div class="timeline-item fade-up">
                        <div class="timeline-dot">{{ substr($item['tahun'], -2) }}</div>
                        <div class="pt-1">
                            <p class="text-sm font-bold text-emerald-600 mb-1">{{ $item['tahun'] }}</p>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $item['judul'] }}</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
