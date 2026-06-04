@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">Syarat</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Syarat Pendaftaran</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link active">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up"><span class="section-badge"><i data-lucide="clipboard-list" class="w-4 h-4"></i> Persyaratan</span><h2 class="section-title mx-auto">Syarat Pendaftaran</h2></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php $syaratData = [['icon'=>'baby','color'=>'pink','title'=>'TK','items'=>['Usia minimal 4 tahun','Fotokopi akta kelahiran','Fotokopi KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']],['icon'=>'school','color'=>'emerald','title'=>'SD','items'=>['Usia minimal 6 tahun','Ijazah / surat keterangan TK','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']],['icon'=>'graduation-cap','color'=>'blue','title'=>'SMP','items'=>['Ijazah / SKL SD','Rapor kelas 4, 5, 6','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat']]]; @endphp
                @foreach($syaratData as $s)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-{{ $s['color'] }}-50 text-{{ $s['color'] }}-500"><i data-lucide="{{ $s['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-[var(--theme-primary)] mb-4">{{ $s['title'] }} Islam Terpadu</h3>
                    <ul class="space-y-3 text-sm text-slate-500">
                        @foreach($s['items'] as $item)
                        <li class="flex items-start gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-{{ $s['color'] }}-500 mt-0.5 flex-shrink-0"></i> {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
