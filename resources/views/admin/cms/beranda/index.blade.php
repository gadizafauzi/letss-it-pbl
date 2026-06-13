@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
        CMS Beranda
    </h1>
    <p class="text-sm text-slate-400 mt-1">Kelola konten halaman utama (Beranda) website.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-600 flex items-center gap-3">
    <i data-lucide="check-circle" class="w-5 h-5"></i>
    <p class="text-sm font-medium">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
    
    {{-- TABS NAVIGATION --}}
    <div class="flex overflow-x-auto border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
        <button onclick="openTab('tab-hero')" id="btn-tab-hero" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 bg-white dark:bg-slate-800">
            Hero Section
        </button>
        <button onclick="openTab('tab-welcome')" id="btn-tab-welcome" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Welcome Message
        </button>
        <button onclick="openTab('tab-statistik')" id="btn-tab-statistik" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Statistik
        </button>
        <button onclick="openTab('tab-program')" id="btn-tab-program" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Program
        </button>
        <button onclick="openTab('tab-keunggulan')" id="btn-tab-keunggulan" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Keunggulan
        </button>
        <button onclick="openTab('tab-testimoni')" id="btn-tab-testimoni" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Testimoni
        </button>
        <button onclick="openTab('tab-faq')" id="btn-tab-faq" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            FAQ Home
        </button>
    </div>

    <div class="p-6">
        {{-- TAB HERO --}}
        @include('admin.cms.beranda.tabs.hero')

        {{-- TAB WELCOME --}}
        @include('admin.cms.beranda.tabs.welcome')

        {{-- TAB STATISTIK --}}
        @include('admin.cms.beranda.tabs.statistik')

        {{-- TAB PROGRAM --}}
        @include('admin.cms.beranda.tabs.program')

        {{-- TAB KEUNGGULAN --}}
        @include('admin.cms.beranda.tabs.keunggulan')

        {{-- TAB TESTIMONI --}}
        @include('admin.cms.beranda.tabs.testimoni')

        {{-- TAB FAQ --}}
        @include('admin.cms.beranda.tabs.faq')
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('border-blue-500', 'text-blue-600', 'bg-white', 'dark:bg-slate-800');
            el.classList.add('border-transparent', 'text-slate-500');
        });

        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById(tabId).classList.add('block');
        
        let btn = document.getElementById('btn-' + tabId);
        btn.classList.remove('border-transparent', 'text-slate-500');
        btn.classList.add('border-blue-500', 'text-blue-600', 'bg-white', 'dark:bg-slate-800');

        // Simpan ke local storage
        localStorage.setItem('active_cms_beranda_tab', tabId);
    }

    document.addEventListener('DOMContentLoaded', () => {
        let activeTab = localStorage.getItem('active_cms_beranda_tab');
        if(activeTab && document.getElementById(activeTab)) {
            openTab(activeTab);
        }
    });

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }

    function editStatistic(stat) {
        let form = document.getElementById('form-edit-statistic');
        form.action = `/admin/cms/beranda/statistic/${stat.id}`;
        
        document.getElementById('edit_stat_number').value = stat.number;
        document.getElementById('edit_stat_label').value = stat.label;
        document.getElementById('edit_stat_icon').value = stat.icon;
        document.getElementById('edit_stat_order').value = stat.order;
        document.getElementById('edit_stat_active').checked = stat.is_active == 1;
        
        openModal('modal-edit-statistic');
    }
</script>
@endpush
