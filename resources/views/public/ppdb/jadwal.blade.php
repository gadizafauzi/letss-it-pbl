@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">Jadwal</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Jadwal PPDB</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Timeline lengkap penerimaan peserta didik baru SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }}.</p>
        </div>
    </div>

    {{-- SUB NAV (2 tab) --}}
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link {{ request()->routeIs('public.ppdb.index') ? 'active' : '' }}">Informasi</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link {{ request()->routeIs('public.ppdb.jadwal') ? 'active' : '' }}">Jadwal & Timeline</a>
        </div>
    </div>

    <section class="public-section">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16 fade-up">
                <span class="section-badge"><i data-lucide="calendar-days" class="w-4 h-4"></i> Timeline PPDB</span>
                <h2 class="section-title mx-auto">Timeline Pendaftaran</h2>
                <p class="section-subtitle mx-auto text-center">Ikuti setiap tahap seleksi sesuai jadwal yang telah ditetapkan.</p>
            </div>

            {{-- TIMELINE ALTERNATING --}}
            @php
                $jadwal = [
                    [
                        'tahun'   => date('Y'),
                        'judul'   => 'Tahap Pendaftaran',
                        'desc'    => 'Pendaftaran Tim dan Submit Proposal',
                        'tanggal' => 'April — 13 Juni ' . date('Y'),
                        'status'  => 'Dibuka',
                    ],
                    [
                        'tahun'   => date('Y'),
                        'judul'   => 'Babak Penyisihan I',
                        'desc'    => 'Babak Penyisihan Pertama',
                        'tanggal' => '26 — 27 Juni ' . date('Y'),
                        'status'  => 'Segera',
                    ],
                    [
                        'tahun'   => date('Y'),
                        'judul'   => 'Babak Penyisihan II',
                        'desc'    => 'Seleksi lanjutan untuk mencari finalis.',
                        'tanggal' => '27 Juli — 8 Agustus ' . date('Y'),
                        'status'  => 'Menunggu',
                    ],
                    [
                        'tahun'   => date('Y'),
                        'judul'   => 'Pengumuman Finalis',
                        'desc'    => 'Tim yang lolos menuju tahap akhir.',
                        'tanggal' => '10 Agustus ' . date('Y'),
                        'status'  => 'Menunggu',
                    ],
                    [
                        'tahun'   => date('Y'),
                        'judul'   => 'Daftar Ulang',
                        'desc'    => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.',
                        'tanggal' => '16 — 30 Agustus ' . date('Y'),
                        'status'  => 'Menunggu',
                    ],
                ];
            @endphp

            <div class="ppdb-timeline fade-up">
                @foreach($jadwal as $j)
                <div class="ppdb-timeline-item">
                    {{-- DOT di tengah --}}
                    <div class="ppdb-timeline-dot-wrapper">
                        <div class="ppdb-timeline-dot">{{ date('Y') }}</div>
                    </div>

                    {{-- KONTEN kiri/kanan otomatis via CSS nth-child --}}
                    <div class="ppdb-timeline-content">
                        <span class="ppdb-timeline-date-badge">{{ strtoupper($j['tanggal']) }}</span>
                        <h3>{{ $j['judul'] }}</h3>
                        <p>{{ $j['desc'] }}</p>
                        <div class="mt-3">
                            @if($j['status'] === 'Dibuka')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">🟢 {{ $j['status'] }}</span>
                            @elseif($j['status'] === 'Selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">✓ {{ $j['status'] }}</span>
                            @elseif($j['status'] === 'Segera')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">⏳ {{ $j['status'] }}</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600">🔵 {{ $j['status'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
