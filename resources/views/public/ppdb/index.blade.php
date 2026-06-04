@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">PPDB</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Penerimaan Peserta Didik Baru</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Informasi lengkap pendaftaran siswa baru SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }}.</p>
        </div>
    </div>
    {{-- SUB NAV --}}
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link {{ request()->routeIs('public.ppdb.index') ? 'active' : '' }}">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link {{ request()->routeIs('public.ppdb.alur') ? 'active' : '' }}">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link {{ request()->routeIs('public.ppdb.syarat') ? 'active' : '' }}">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link {{ request()->routeIs('public.ppdb.jadwal') ? 'active' : '' }}">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link {{ request()->routeIs('public.ppdb.faq') ? 'active' : '' }}">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link {{ request()->routeIs('public.ppdb.form-kontak') ? 'active' : '' }}">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="info" class="w-4 h-4"></i> PPDB {{ date('Y') }}/{{ date('Y')+1 }}</span>
                <h2 class="section-title mx-auto">Pendaftaran Siswa Baru</h2>
                <p class="section-subtitle mx-auto text-center">Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 fade-up">
                @php $units = [['icon'=>'baby','color'=>'pink','title'=>'TK Islam Terpadu','usia'=>'Usia 4-6 tahun','kuota'=>'60 siswa'],['icon'=>'school','color'=>'emerald','title'=>'SD Islam Terpadu','usia'=>'Usia 6-7 tahun','kuota'=>'90 siswa'],['icon'=>'graduation-cap','color'=>'blue','title'=>'SMP Islam Terpadu','usia'=>'Lulusan SD/MI','kuota'=>'60 siswa']]; @endphp
                @foreach($units as $u)
                <div class="feature-card text-center">
                    <div class="w-16 h-16 rounded-2xl bg-{{ $u['color'] }}-50 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="{{ $u['icon'] }}" class="w-7 h-7 text-{{ $u['color'] }}-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[var(--theme-primary)] mb-2">{{ $u['title'] }}</h3>
                    <p class="text-sm text-slate-500">{{ $u['usia'] }}</p>
                    <p class="text-sm font-bold text-emerald-600 mt-2">Kuota: {{ $u['kuota'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12 fade-up">
                <a href="{{ route('public.ppdb.alur') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold shadow-lg shadow-emerald-200 hover:-translate-y-1 transition-all duration-300">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i> Lihat Alur Pendaftaran
                </a>
            </div>
        </div>
    </section>
@endsection
