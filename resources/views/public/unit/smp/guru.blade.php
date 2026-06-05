@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.smp.profil') }}">SMP</a><span>/</span><span class="current">Guru</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Guru SMP Islam Terpadu</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'smp', 'active' => 'guru'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="users" class="w-4 h-4"></i> Tenaga Pendidik</span>
                <h2 class="section-title mx-auto">Guru SMP Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php $guru = [['nama'=>'Ustadzah Khadijah, M.Pd','mapel'=>'Kepala Unit SMP'],['nama'=>'Ustadz Rahman, S.Pd','mapel'=>'Matematika'],['nama'=>'Ustadzah Diana, S.Pd','mapel'=>'B. Indonesia'],['nama'=>'Ustadz Irfan, S.Pd','mapel'=>'IPA'],['nama'=>'Ustadzah Maya, S.Pd','mapel'=>'B. Inggris'],['nama'=>'Ustadz Fadhil, S.Pd.I','mapel'=>'Tahfidz'],['nama'=>'Ustadzah Lina, S.Pd','mapel'=>'IPS'],['nama'=>'Ustadz Zaki, S.Kom','mapel'=>'TIK']]; @endphp
                @foreach($guru as $g)
                <div class="feature-card text-center fade-up">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center mx-auto mb-3"><i data-lucide="user" class="w-7 h-7 text-indigo-600"></i></div>
                    <h4 class="text-sm font-bold text-slate-800">{{ $g['nama'] }}</h4>
                    <p class="text-xs text-slate-400 mt-1">{{ $g['mapel'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
