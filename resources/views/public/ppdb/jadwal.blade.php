@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.ppdb.index') }}">PPDB</a><span>/</span><span class="current">Jadwal</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Jadwal PPDB</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.ppdb.index') }}" class="subnav-link">Informasi</a>
            <a href="{{ route('public.ppdb.alur') }}" class="subnav-link">Alur</a>
            <a href="{{ route('public.ppdb.syarat') }}" class="subnav-link">Syarat</a>
            <a href="{{ route('public.ppdb.jadwal') }}" class="subnav-link active">Jadwal</a>
            <a href="{{ route('public.ppdb.faq') }}" class="subnav-link">FAQ</a>
            <a href="{{ route('public.ppdb.form-kontak') }}" class="subnav-link">Kontak</a>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-14 fade-up"><span class="section-badge"><i data-lucide="calendar-days" class="w-4 h-4"></i> Jadwal</span><h2 class="section-title mx-auto">Timeline PPDB</h2></div>
            <div class="feature-card overflow-hidden fade-up">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="bg-emerald-600 text-white"><th class="px-6 py-4 text-left font-bold">Kegiatan</th><th class="px-6 py-4 text-left font-bold">Tanggal</th><th class="px-6 py-4 text-center font-bold">Status</th></tr></thead>
                        <tbody>
                            @php $jadwal = [['kegiatan'=>'Pendaftaran Online','tanggal'=>'1 Maret — 30 Juni '.date('Y'),'status'=>'Dibuka'],['kegiatan'=>'Tes Seleksi Gelombang 1','tanggal'=>'5 — 6 April '.date('Y'),'status'=>'Selesai'],['kegiatan'=>'Tes Seleksi Gelombang 2','tanggal'=>'7 — 8 Juni '.date('Y'),'status'=>'Segera'],['kegiatan'=>'Pengumuman Hasil','tanggal'=>'15 Juni '.date('Y'),'status'=>'Menunggu'],['kegiatan'=>'Daftar Ulang','tanggal'=>'16 — 30 Juni '.date('Y'),'status'=>'Menunggu']]; @endphp
                            @foreach($jadwal as $j)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-semibold text-slate-700">{{ $j['kegiatan'] }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $j['tanggal'] }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($j['status']==='Dibuka')<span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">{{ $j['status'] }}</span>
                                    @elseif($j['status']==='Selesai')<span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">{{ $j['status'] }}</span>
                                    @elseif($j['status']==='Segera')<span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">{{ $j['status'] }}</span>
                                    @else<span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600">{{ $j['status'] }}</span>@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
