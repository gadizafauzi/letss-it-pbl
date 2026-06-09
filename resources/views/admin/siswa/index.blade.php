@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- PAGE HEADER --}}
        <div class="relative overflow-hidden rounded-2xl px-7 py-6"
            style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 55%, #60a5fa 100%);">
            <div class="absolute -top-12 -right-12 w-44 h-44 bg-white/[.08] rounded-full"></div>
            <div class="absolute -bottom-16 left-8 w-56 h-56 bg-white/[.05] rounded-full"></div>
            <div class="relative z-10 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-white/60 mb-1">
                        Manajemen Akademik
                    </p>
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Data Siswa</h1>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.siswa.import') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-semibold text-white
                          bg-white/15 border border-white/30 hover:bg-white/25 hover:border-white/50 transition-all no-underline">
                        <i data-lucide="upload" class="w-[14px] h-[14px]"></i>Import
                    </a>
                    <button type="button" onclick="openExportModal()"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-semibold text-white
                               bg-white/15 border border-white/30 hover:bg-white/25 hover:border-white/50 transition-all cursor-pointer">
                        <i data-lucide="download" class="w-[14px] h-[14px]"></i>Export
                    </button>
                    <a href="{{ route('admin.siswa.create') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-bold
                          bg-white text-sky-500 hover:bg-sky-50 shadow-md hover:shadow-lg transition-all no-underline">
                        <i data-lucide="plus" class="w-[14px] h-[14px]"></i>Tambah Siswa
                    </a>
                </div>
            </div>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium
                    bg-sky-100 border border-sky-200 text-sky-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER --}}
        <div class="bg-white border border-sky-100 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.siswa.index') }}" method="GET"
                class="flex flex-wrap items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, NIS, NISN..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                              bg-sky-50 text-[13px] text-slate-700 outline-none
                              focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                </div>

                {{-- Unit --}}
                <select id="unitFilter" name="unit_id"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[140px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    <option value="">Semua Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>

                {{-- Kelas --}}
                <select id="classFilter" name="class_id"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[130px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    <option value="">Semua Kelas</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }}
                        </option>
                    @endforeach
                </select>

                {{-- Status --}}
                <select name="status"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[130px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Tamat</option>
                    <option value="transfer" {{ request('status') == 'transfer' ? 'selected' : '' }}>Pindah</option>
                    <option value="dropout" {{ request('status') == 'dropout' ? 'selected' : '' }}>DO</option>
                </select>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-sky-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50 border-b-[1.5px] border-sky-100">
                            @foreach (['No', 'NIS', 'NISN', 'Nama Siswa', 'Unit', 'Kelas', 'Nama Ortu', 'WA Ortu', 'Alamat', 'Status'] as $h)
                                <th
                                    class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th
                                class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            @php
                                $activeClass = $student->studentClasses->first();
                                $status = $student->status;
                                $statusLabel = match ($status) {
                                    'active' => 'Aktif',
                                    'inactive' => 'Tidak Aktif',
                                    'graduated' => 'Tamat',
                                    'transfer' => 'Pindah',
                                    'dropout' => 'DO',
                                    default => '-',
                                };
                                $statusCls = match ($status) {
                                    // samakan warna biru dengan palette "sky" di halaman ini
                                    'active' => 'bg-sky-100 text-sky-700',
                                    'inactive' => 'bg-slate-100 text-slate-500',
                                    'graduated' => 'bg-sky-100 text-sky-700',
                                    'transfer' => 'bg-amber-100 text-amber-700',
                                    'dropout' => 'bg-red-100 text-red-700',
                                    default => 'bg-slate-100 text-slate-500',
                                };
                                $statusDot = match ($status) {
                                    'active' => 'bg-sky-500',
                                    'inactive' => 'bg-slate-400',
                                    'graduated' => 'bg-sky-500',
                                    'transfer' => 'bg-amber-400',
                                    'dropout' => 'bg-red-500',
                                    default => 'bg-slate-400',
                                };
                            @endphp
                            <tr class="border-b border-sky-50 hover:bg-sky-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $students->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="text-xs font-bold text-slate-800 bg-sky-50 px-2.5 py-1 rounded-lg inline-block">
                                        {{ $student->nis ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $student->nisn ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $student->full_name }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $student->unit->unit_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $activeClass?->schoolClass?->class_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $student->father_name ?? ($student->mother_name ?? '-') }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $student->parent_phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 max-w-[150px]">
                                    <span class="text-[13px] text-slate-500 block truncate">
                                        {{ $student->address ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $statusCls }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }} flex-shrink-0"></span>
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.siswa.show', $student->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-slate-100 text-slate-500
                                              hover:bg-slate-200 hover:text-slate-700 transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Detail">
                                            <i data-lucide="eye" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        <a href="{{ route('admin.siswa.edit', $student->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-sky-100 text-sky-500
                                              hover:bg-sky-500 hover:text-white transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Edit">
                                            <i data-lucide="square-pen" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data siswa ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-[30px] h-[30px] rounded-lg bg-red-100 text-red-400
                                                       hover:bg-red-500 hover:text-white transition-all
                                                       inline-flex items-center justify-center cursor-pointer border-none"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[13px] h-[13px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div
                                            class="w-14 h-14 bg-sky-50 rounded-2xl inline-flex items-center justify-center mb-4 text-sky-300">
                                            <i data-lucide="users" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada data siswa</p>
                                        <p class="text-[13px] text-slate-400">Data siswa belum tersedia atau pencarian
                                            tidak cocok.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            {{-- PAGINATION --}}
            @if ($students->hasPages())
                {{ $students->links() }}
            @endif
        </div>

    </div>

    {{-- MODAL EXPORT --}}
    <div id="exportModal" onclick="closeExportModal()" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background:rgba(15,23,42,0.45);backdrop-filter:blur(4px);display:none!important;">
        <div onclick="event.stopPropagation()" class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <span class="text-[17px] font-extrabold text-slate-800">Export Data Siswa</span>
                <button type="button" onclick="closeExportModal()"
                    class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center
                           hover:bg-red-100 hover:text-red-500 transition-all border-none cursor-pointer text-base">
                    &#x2715;
                </button>
            </div>

            <form action="{{ route('admin.siswa.export') }}" method="GET">
                <div class="px-6 py-5 flex flex-col gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">
                            Unit Sekolah
                        </label>
                        <select id="unitSelect" name="unit_id"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 rounded-xl bg-slate-50
                                   text-[13px] text-slate-700 outline-none focus:border-sky-400 focus:bg-white
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                            <option value="">Semua Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">
                            Kelas
                        </label>
                        <select id="classSelect" name="class_id"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 rounded-xl bg-slate-50
                                   text-[13px] text-slate-700 outline-none focus:border-sky-400 focus:bg-white
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                            <option value="">Semua Kelas</option>
                        </select>
                    </div>

                    <div class="flex gap-2.5 items-start bg-sky-50 border border-sky-100 rounded-xl px-4 py-3.5">
                        <i data-lucide="info" class="w-4 h-4 text-sky-400 flex-shrink-0 mt-0.5"></i>
                        <span class="text-[12px] text-slate-500">
                            Data akan diexport dalam format <strong class="text-slate-700">Excel (XLSX)</strong>
                            dan dapat dibuka menggunakan Microsoft Excel.
                        </span>
                    </div>
                </div>

                <div class="px-6 pb-5 flex justify-end gap-2.5">
                    <button type="button" onclick="closeExportModal()"
                        class="h-10 px-5 border-[1.5px] border-slate-200 bg-white rounded-xl
                               text-[13px] font-semibold text-slate-500 hover:bg-slate-50 transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="h-10 px-5 bg-sky-500 hover:bg-sky-600 border-none rounded-xl
                               text-[13px] font-bold text-white flex items-center gap-1.5 cursor-pointer
                               shadow-sm hover:shadow-sky-200 hover:shadow-md transition-all">
                        <i data-lucide="download" class="w-[14px] h-[14px]"></i>Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExportModal() {
            document.getElementById('exportModal').style.cssText = 'display:flex!important;';
        }

        function closeExportModal() {
            document.getElementById('exportModal').style.cssText = 'display:none!important;';
        }

        document.addEventListener('DOMContentLoaded', function() {

            // Export modal: unit → kelas
            const unitSelect = document.getElementById('unitSelect');
            const classSelect = document.getElementById('classSelect');
            if (unitSelect && classSelect) {
                unitSelect.addEventListener('change', function() {
                    const unitId = this.value;
                    classSelect.innerHTML = '<option value="">Semua Kelas</option>';
                    if (!unitId) return;
                    fetch(`/admin/siswa/classes-by-unit/${unitId}`)
                        .then(r => r.json())
                        .then(classes => {
                            classes.forEach(item => {
                                classSelect.innerHTML +=
                                    `<option value="${item.id}">${item.class_name}</option>`;
                            });
                        })
                        .catch(err => console.error(err));
                });
            }

            // Debounce search
            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');
            let debounce;
            if (searchInput && filterForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounce);
                    debounce = setTimeout(() => filterForm.submit(), 500);
                });
            }

            // Filter otomatis (tanpa tombol Cari): setiap perubahan select langsung submit.
            const unitFilter = document.getElementById('unitFilter');
            const classFilter = document.getElementById('classFilter');
            const statusFilter = document.querySelector('select[name="status"]');

            function submitForm() {
                const form = document.getElementById('filterForm');
                if (form) form.submit();
            }

            if (unitFilter) {
                unitFilter.addEventListener('change', function() {
                    const unitId = this.value;
                    if (classFilter) {
                        classFilter.innerHTML = '<option value="">Semua Kelas</option>';
                    }

                    if (unitId && classFilter) {
                        fetch(`/admin/siswa/classes-by-unit/${unitId}`)
                            .then(r => r.json())
                            .then(classes => {
                                classes.forEach(item => {
                                    classFilter.innerHTML +=
                                        `<option value="${item.id}">${item.class_name}</option>`;
                                });
                                submitForm();
                            })
                            .catch(err => console.error(err));
                    } else {
                        submitForm();
                    }
                });
            }

            if (classFilter) {
                classFilter.addEventListener('change', submitForm);
            }
            if (statusFilter) {
                statusFilter.addEventListener('change', submitForm);
            }
        });
    </script>
@endsection
