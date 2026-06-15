@extends('layouts.admin')

@section('title', 'CMS Unit Sekolah')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">CMS Unit Pendidikan</h1>
            <p class="text-sm text-slate-500 mt-1">Pilih unit sekolah untuk mengelola konten spesifik seperti hero, detail, fasilitas, ekstrakurikuler, dan guru.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($units as $u)
            @php
                $color = 'blue';
                $icon = 'school';
                if(stripos($u->unit_name, 'tk') !== false) { $color = 'pink'; $icon = 'toy-brick'; }
                elseif(stripos($u->unit_name, 'sd') !== false) { $color = 'red'; $icon = 'backpack'; }
                elseif(stripos($u->unit_name, 'smp') !== false) { $color = 'blue'; $icon = 'book-open'; }
            @endphp
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-{{ $color }}-500 transition-all duration-300 group flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-full bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 text-{{ $color }}-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="{{ $icon }}" class="w-10 h-10"></i>
                </div>
                
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">{{ $u->unit_name }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 flex-grow">
                    Kelola gambar hero, deskripsi unit, daftar fasilitas, ekskul, data guru, dan prestasi.
                </p>
                
                <a href="{{ route('admin.unit-cms.show', $u->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-{{ $color }}-500 text-slate-700 hover:text-white font-medium transition-colors">
                    Kelola Konten Unit
                    <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
