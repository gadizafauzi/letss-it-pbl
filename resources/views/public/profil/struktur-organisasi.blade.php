@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Struktur Organisasi</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Struktur Organisasi</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Susunan kepengurusan dan pimpinan SIT Mutiara Qur'an.</p>
        </div>
    </div>

    {{-- PIMPINAN --}}
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="network" class="w-4 h-4"></i> Pimpinan Sekolah</span>
                <h2 class="section-title mx-auto">Jajaran Pimpinan</h2>
            </div>

            {{-- KEPALA SEKOLAH --}}
            <div class="max-w-sm mx-auto mb-12 fade-up">
                <div class="feature-card text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-lg shadow-emerald-200">
                        <i data-lucide="user" class="w-10 h-10 text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Ustadz Ahmad Fauzi, S.Pd.I, M.Pd</h3>
                    <p class="text-sm text-emerald-600 font-semibold mt-1">Kepala Sekolah</p>
                </div>
            </div>

            {{-- WAKIL --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $pimpinan = [
                        ['nama' => 'Ustadzah Siti Aisyah, S.Pd', 'jabatan' => 'Wakil Kurikulum'],
                        ['nama' => 'Ustadz Rizki Ramadhan, S.Pd', 'jabatan' => 'Wakil Kesiswaan'],
                        ['nama' => 'Ustadzah Nur Hidayah, S.E', 'jabatan' => 'Kepala Tata Usaha'],
                        ['nama' => 'Ustadz Muhammad Hasan, S.Pd.I', 'jabatan' => 'Koordinator Tahfidz'],
                        ['nama' => 'Ustadzah Fatimah, S.Pd', 'jabatan' => 'Kepala Unit TK'],
                        ['nama' => 'Ustadz Yusuf Hakim, S.Pd', 'jabatan' => 'Kepala Unit SD'],
                        ['nama' => 'Ustadzah Khadijah, M.Pd', 'jabatan' => 'Kepala Unit SMP'],
                        ['nama' => 'Ustadz Bilal Firdaus, S.Kom', 'jabatan' => 'Koordinator IT'],
                    ];
                @endphp
                @foreach($pimpinan as $p)
                    <div class="feature-card text-center fade-up">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center mx-auto mb-3">
                            <i data-lucide="user" class="w-7 h-7 text-slate-400"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800 leading-snug">{{ $p['nama'] }}</h4>
                        <p class="text-xs text-slate-400 font-semibold mt-1">{{ $p['jabatan'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
