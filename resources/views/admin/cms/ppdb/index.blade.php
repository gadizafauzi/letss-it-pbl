@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
        CMS Informasi PPDB
    </h1>
    <p class="text-sm text-slate-400 mt-1">Kelola konten halaman PPDB (Penerimaan Peserta Didik Baru) website.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-600 flex items-center gap-3">
    <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
    <p class="text-sm font-medium">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">

    {{-- TABS NAVIGATION --}}
    <div class="flex overflow-x-auto border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
        <button onclick="openTab('tab-hero')" id="btn-tab-hero"
            class="tab-btn px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-blue-500 text-blue-600 bg-white dark:bg-slate-800">
            Hero PPDB
        </button>
        <button onclick="openTab('tab-timeline')" id="btn-tab-timeline"
            class="tab-btn px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Timeline
        </button>
        <button onclick="openTab('tab-alur')" id="btn-tab-alur"
            class="tab-btn px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Alur Pendaftaran
        </button>
        <button onclick="openTab('tab-brosur')" id="btn-tab-brosur"
            class="tab-btn px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Brosur
        </button>
        <button onclick="openTab('tab-faq')" id="btn-tab-faq"
            class="tab-btn px-6 py-4 text-sm font-medium whitespace-nowrap border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            FAQ PPDB
        </button>
    </div>

    <div class="p-6">
        {{-- TAB HERO --}}
        @include('admin.cms.ppdb.tabs.hero')

        {{-- TAB TIMELINE --}}
        @include('admin.cms.ppdb.tabs.timeline')

        {{-- TAB ALUR --}}
        @include('admin.cms.ppdb.tabs.alur')

        {{-- TAB BROSUR --}}
        @include('admin.cms.ppdb.tabs.brosur')

        {{-- TAB FAQ --}}
        @include('admin.cms.ppdb.tabs.faq')
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

        localStorage.setItem('active_cms_ppdb_tab', tabId);
    }

    document.addEventListener('DOMContentLoaded', () => {
        let activeTab = localStorage.getItem('active_cms_ppdb_tab');
        if (activeTab && document.getElementById(activeTab)) {
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
</script>
@endpush
