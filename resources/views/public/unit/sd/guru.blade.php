@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.sd.profil') }}">SD</a><span>/</span><span class="current">Guru</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Guru SD Islam Terpadu</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.sd.profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Profil</a>
            <a href="{{ route('public.unit.sd.guru') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap bg-amber-500 text-white">Guru</a>
            <a href="{{ route('public.unit.sd.ekskul') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.sd.fasilitas') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Fasilitas</a>
            <a href="{{ route('public.unit.sd.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="users" class="w-4 h-4"></i> Tenaga Pendidik</span>
                <h2 class="section-title mx-auto">Guru SD Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $guru = [['nama'=>'Ustadz Yusuf Hakim, S.Pd','mapel'=>'Kepala Unit SD'],['nama'=>'Ustadzah Laila, S.Pd','mapel'=>'Wali Kelas 1'],['nama'=>'Ustadz Faris, S.Pd','mapel'=>'Wali Kelas 2'],['nama'=>'Ustadzah Nisa, S.Pd','mapel'=>'Wali Kelas 3'],['nama'=>'Ustadz Hamzah, S.Pd','mapel'=>'Matematika'],['nama'=>'Ustadzah Salma, S.Pd','mapel'=>'Bahasa Inggris'],['nama'=>'Ustadz Khalid, S.Pd.I','mapel'=>'Tahfidz'],['nama'=>'Ustadzah Rania, S.Pd','mapel'=>'IPA']]; @endphp
                @foreach($guru as $g)
                <div class="feature-card text-center fade-up">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center mx-auto mb-3"><i data-lucide="user" class="w-7 h-7 text-amber-500"></i></div>
                    <h4 class="text-sm font-bold text-slate-800">{{ $g['nama'] }}</h4>
                    <p class="text-xs text-slate-400 mt-1">{{ $g['mapel'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
