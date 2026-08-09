@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
        CMS Profil Sekolah
    </h1>
    <p class="text-sm text-slate-400 mt-1">Kelola konten halaman profil sekolah website.</p>
</div>

@if ($errors->any())
<div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600">
    <div class="flex items-center gap-3 mb-2">
        <i data-lucide="alert-circle" class="w-5 h-5"></i>
        <p class="text-sm font-bold">Terjadi Kesalahan</p>
    </div>
    <ul class="list-disc ml-8 text-sm">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
    
    {{-- TABS NAVIGATION --}}
    <div class="flex overflow-x-auto border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
        <button onclick="openTab('tab-hero')" id="btn-tab-hero" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-blue-500 text-blue-600 bg-white dark:bg-slate-800">
            Hero Section
        </button>
        <button onclick="openTab('tab-profil-singkat')" id="btn-tab-profil-singkat" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Profil Singkat & Sambutan
        </button>
        <button onclick="openTab('tab-visi')" id="btn-tab-visi" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Visi
        </button>
        <button onclick="openTab('tab-misi')" id="btn-tab-misi" class="tab-btn px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Misi
        </button>
        <button onclick="openTab('tab-sejarah')" id="btn-tab-sejarah" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Sejarah
        </button>
        <button onclick="openTab('tab-struktur')" id="btn-tab-struktur" class="tab-btn whitespace-nowrap px-6 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300">
            Struktur Organisasi
        </button>
    </div>

    <div class="p-6">
        {{-- TAB HERO --}}
        @include('admin.cms.profil.tabs.hero')

        {{-- TAB PROFIL SINGKAT --}}
        @include('admin.cms.profil.tabs.profil_singkat')

        {{-- TAB VISI --}}
        @include('admin.cms.profil.tabs.visi')

        {{-- TAB MISI --}}
        @include('admin.cms.profil.tabs.misi')

        {{-- TAB SEJARAH --}}
        @include('admin.cms.profil.tabs.sejarah')

        {{-- TAB STRUKTUR --}}
        @include('admin.cms.profil.tabs.struktur')
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
        localStorage.setItem('active_cms_profil_tab', tabId);
    }

    document.addEventListener('DOMContentLoaded', () => {
        let activeTab = localStorage.getItem('active_cms_profil_tab');
        if(activeTab && document.getElementById(activeTab)) {
            openTab(activeTab);
        } else {
            // Default tab
            openTab('tab-hero');
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

    function editMisi(item) {
        let form = document.getElementById('form-edit-misi');
        form.action = `/admin/cms/profil/misi/${item.id}`;
        
        document.getElementById('edit_misi_text').value = item.text;
        document.getElementById('edit_misi_order').value = item.order;
        document.getElementById('edit_misi_active').checked = item.is_active == 1;
        
        openModal('modal-edit-misi');
    }

    function editSejarah(item) {
        let form = document.getElementById('form-edit-sejarah');
        form.action = `/admin/cms/profil/sejarah/${item.id}`;
        
        document.getElementById('edit_sejarah_year').value = item.year;
        document.getElementById('edit_sejarah_title').value = item.title;
        document.getElementById('edit_sejarah_description').value = item.description;
        document.getElementById('edit_sejarah_order').value = item.order;
        document.getElementById('edit_sejarah_active').checked = item.is_active == 1;
        
        openModal('modal-edit-sejarah');
    }

</script>
@endpush
