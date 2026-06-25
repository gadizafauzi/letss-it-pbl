@extends('layouts.admin')

@section('title', 'Kelola Konten Unit: ' . $unit->unit_name)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.unit-cms.index') }}" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:text-blue-500 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-white">CMS Unit: {{ $unit->unit_name }}</h1>
                <p class="text-sm text-slate-500 mt-1">Kelola konten dan informasi spesifik untuk unit pendidikan ini.</p>
            </div>
        </div>
        
        @php
            $publicUrl = '';
            if(stripos($unit->unit_name, 'tk') !== false) $publicUrl = url('/unit/tk');
            elseif(stripos($unit->unit_name, 'sd') !== false) $publicUrl = url('/unit/sd');
            elseif(stripos($unit->unit_name, 'smp') !== false) $publicUrl = url('/unit/smp');
        @endphp
        @if($publicUrl)
        <a href="{{ $publicUrl }}" target="_blank" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-medium hover:bg-blue-100 transition-colors flex items-center gap-2 border border-blue-200">
            <i data-lucide="external-link" class="w-4 h-4"></i>
            Lihat Halaman Publik
        </a>
        @endif
    </div>

    {{-- Tabs Configuration --}}
    @php
        $tabs = [
            ['id' => 'hero', 'label' => 'Hero Section', 'icon' => 'image'],
            ['id' => 'detail', 'label' => 'Detail Unit', 'icon' => 'info'],
            ['id' => 'fasilitas', 'label' => 'Fasilitas', 'icon' => 'building'],
            ['id' => 'ekskul', 'label' => 'Ekstrakurikuler', 'icon' => 'activity'],
            ['id' => 'guru', 'label' => 'Guru Pengajar', 'icon' => 'users'],
            ['id' => 'prestasi', 'label' => 'Prestasi', 'icon' => 'award'],
        ];
    @endphp

    <div x-data="{ activeTab: '{{ session('active_tab', 'hero') }}' }" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden flex flex-col">
        
        {{-- Horizontal Tabs --}}
        <div class="px-2 overflow-x-auto hide-scrollbar border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-800/50">
            <nav class="flex min-w-max">
                @foreach($tabs as $tab)
                    <button 
                        @click="activeTab = '{{ $tab['id'] }}'"
                        :class="{
                            'text-blue-600 dark:text-blue-400 border-[#8DAEF5] font-bold': activeTab === '{{ $tab['id'] }}',
                            'text-slate-500 dark:text-slate-400 border-transparent hover:text-slate-800 dark:hover:text-white hover:border-slate-200 dark:hover:border-slate-600': activeTab !== '{{ $tab['id'] }}'
                        }"
                        class="flex items-center px-6 py-4 border-b-[3px] transition-all duration-200 text-[13px] font-medium group whitespace-nowrap">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </nav>
        </div>

        {{-- Content Area --}}
        <div class="w-full space-y-6">
            {{-- Alert --}}

            @if($errors->any())
            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-600">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <p class="font-bold">Terjadi Kesalahan:</p>
                </div>
                <ul class="list-disc list-inside ml-8 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Tabs Content --}}
            <div x-show="activeTab === 'hero'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.hero')
            </div>

            <div x-cloak x-show="activeTab === 'detail'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.detail')
            </div>

            <div x-cloak x-show="activeTab === 'fasilitas'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.fasilitas')
            </div>

            <div x-cloak x-show="activeTab === 'ekskul'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.ekskul')
            </div>

            <div x-cloak x-show="activeTab === 'guru'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.guru')
            </div>

            <div x-cloak x-show="activeTab === 'prestasi'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @include('admin.cms.unit.tabs.prestasi')
            </div>
        </div>

    </div>
</div>
@endsection
