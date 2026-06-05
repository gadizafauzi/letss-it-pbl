@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">Berita & Kegiatan</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Berita & Kegiatan</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Informasi terbaru seputar kegiatan dan pencapaian SIT Mutiara Qur'an.</p>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            @php
                $beritaList = [
                    ['judul'=>'Wisuda Tahfidz Angkatan ke-8','tanggal'=>'10 Mei 2026','kategori'=>'Tahfidz','excerpt'=>'Sebanyak 45 siswa berhasil menyelesaikan target hafalan Al-Quran dan diwisuda dalam acara yang penuh kebanggaan.','color'=>'emerald','img'=>'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80'],
                    ['judul'=>'Juara Olimpiade Sains Tingkat Kota','tanggal'=>'28 April 2026','kategori'=>'Prestasi','excerpt'=>'Tim olimpiade sains SIT Mutiara Quran berhasil meraih juara 1 dan 3 dalam Olimpiade Sains tingkat Kota Kabupaten Solok.','color'=>'blue','img'=>'https://images.unsplash.com/photo-1518152006812-edab29b069ac?auto=format&fit=crop&w=600&q=80'],
                    ['judul'=>'Pembukaan PPDB 2026/2027','tanggal'=>'15 April 2026','kategori'=>'Pengumuman','excerpt'=>'Pendaftaran peserta didik baru tahun ajaran 2026/2027 resmi dibuka untuk jenjang TK, SD, dan SMP Islam Terpadu.','color'=>'amber','img'=>'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80'],
                    ['judul'=>'Field Trip ke Museum Geologi','tanggal'=>'5 April 2026','kategori'=>'Kegiatan','excerpt'=>'Siswa kelas 4-6 melaksanakan field trip edukatif ke Museum Geologi sebagai bagian dari pembelajaran IPA yang menyenangkan.','color'=>'violet','img'=>'https://images.unsplash.com/photo-1544531586-fde5298cdd40?auto=format&fit=crop&w=600&q=80'],
                    ['judul'=>'Pelatihan Guru Kurikulum Merdeka','tanggal'=>'22 Maret 2026','kategori'=>'Akademik','excerpt'=>'Seluruh guru mengikuti pelatihan implementasi Kurikulum Merdeka yang diintegrasikan dengan nilai-nilai keislaman.','color'=>'cyan','img'=>'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?auto=format&fit=crop&w=600&q=80'],
                    ['judul'=>'Lomba Kaligrafi & MTQ Internal','tanggal'=>'10 Maret 2026','kategori'=>'Kegiatan','excerpt'=>'Ajang tahunan lomba kaligrafi dan musabaqah tilawatil Quran yang diikuti seluruh siswa dengan penuh semangat.','color'=>'rose','img'=>'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=600&q=80'],
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritaList as $berita)
                <div class="news-card fade-up group">
                    <div class="news-card-img relative overflow-hidden">
                        <img src="{{ $berita['img'] }}" alt="{{ $berita['judul'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 text-xs font-bold text-white bg-{{ $berita['color'] }}-500/90 backdrop-blur-sm px-2.5 py-1 rounded-full">{{ $berita['kategori'] }}</span>
                    </div>
                    <div class="news-card-body">
                        <span class="text-xs text-slate-400 block mb-2">{{ $berita['tanggal'] }}</span>
                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-2 leading-snug">{{ $berita['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ $berita['excerpt'] }}</p>
                        <a href="{{ route('public.berita.detail') }}" class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm hover:underline mt-2">
                            Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
