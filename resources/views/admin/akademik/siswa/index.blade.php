@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- PAGE HEADER --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
            <div>
                <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">
                    Data Siswa
                </h1>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.siswa.import') }}"
                    class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                           bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline shadow-sm">
                    <i data-lucide="upload" class="w-4 h-4 text-slate-400 dark:text-slate-500"></i>Import
                </a>
                <button type="button" onclick="openExportModal()"
                    class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                           bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm cursor-pointer">
                    <i data-lucide="download" class="w-4 h-4 text-slate-400 dark:text-slate-500"></i>Export
                </button>
                <a href="{{ route('admin.siswa.create') }}"
                    class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                           bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah Siswa
                </a>
            </div>
        </div>


        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.siswa.index') }}" method="GET"
                class="flex flex-col sm:flex-row sm:items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px] w-full">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, NIS, NISN..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                              bg-sky-50 dark:bg-slate-900/50 text-[13px] text-slate-700 dark:text-slate-200 outline-none
                              focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all">
                </div>

                {{-- Group dropdowns side-by-side on mobile --}}
                <div class="grid grid-cols-3 gap-2 w-full sm:flex sm:items-center sm:gap-2.5 sm:w-auto sm:flex-initial">
                    {{-- Unit --}}
                    <select id="unitFilter" name="unit_id"
                        class="h-[42px] px-2 sm:px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                               bg-sky-50 dark:bg-slate-900/50 text-[11px] sm:text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-0 sm:min-w-[140px]
                               focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all cursor-pointer">
                        <option value="">Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Kelas --}}
                    <select id="classFilter" name="class_id"
                        class="h-[42px] px-2 sm:px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                               bg-sky-50 dark:bg-slate-900/50 text-[11px] sm:text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-0 sm:min-w-[130px]
                               focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all cursor-pointer">
                        <option value="">Kelas</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Status --}}
                    <select name="status"
                        class="h-[42px] px-2 sm:px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                               bg-sky-50 dark:bg-slate-900/50 text-[11px] sm:text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-0 sm:min-w-[130px]
                               focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all cursor-pointer">
                        <option value="">Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Tamat</option>
                        <option value="transfer" {{ request('status') == 'transfer' ? 'selected' : '' }}>Pindah</option>
                        <option value="dropout" {{ request('status') == 'dropout' ? 'selected' : '' }}>DO</option>
                    </select>
                </div>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-center w-10">
                                <input type="checkbox" id="checkAll" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                            </th>
                            @foreach (['No', 'NIS', 'NISN', 'Nama Siswa', 'Unit', 'Kelas', 'Nama Ortu', 'WA Ortu', 'Alamat', 'Status'] as $h)
                                <th
                                    class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th
                                class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">
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
                                    'active' => 'bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 border-sky-200 dark:border-sky-500/20',
                                    'inactive' => 'bg-slate-50 dark:bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-slate-500/20',
                                    'graduated' => 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-200 dark:border-indigo-500/20',
                                    'transfer' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-500/20',
                                    'dropout' => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 border-red-200 dark:border-red-500/20',
                                    default => 'bg-slate-50 dark:bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-slate-500/20',
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
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $student->id }}" class="row-checkbox rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                                </td>
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $students->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="text-xs font-bold text-slate-800 dark:text-slate-200 bg-sky-50 dark:bg-slate-700/50 px-2.5 py-1 rounded-lg inline-block">
                                        {{ $student->nis ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $student->nisn ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $student->full_name }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $student->unit->unit_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $activeClass?->schoolClass?->class_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $student->father_name ?? ($student->mother_name ?? '-') }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $student->parent_phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 max-w-[150px]">
                                    <span class="text-[13px] text-slate-500 dark:text-slate-400 block truncate">
                                        {{ $student->address ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusCls }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }} flex-shrink-0"></span>
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.siswa.show', $student->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                              hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-500 dark:text-slate-400 
                                              hover:text-slate-700 dark:hover:text-slate-200 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Detail">
                                            <i data-lucide="eye" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <a href="{{ route('admin.siswa.edit', $student->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                              hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 
                                              hover:text-blue-600 dark:hover:text-blue-300 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Edit">
                                            <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <form id="delete-form-{{ $student->id }}" action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="openDeleteModal('{{ $student->id }}')"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                                  hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800 text-red-500 dark:text-red-400 
                                                  hover:text-red-600 dark:hover:text-red-300 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
                                    <div class="flex flex-col items-center justify-center py-20 text-center">
                                        <div class="mb-6 relative">
                                            <div class="absolute inset-0 bg-sky-200 dark:bg-sky-900 blur-[32px] opacity-30 rounded-full"></div>
                                            <div class="w-28 h-28 bg-sky-50 dark:bg-slate-800/80 rounded-[2rem] border border-white/60 dark:border-slate-700 shadow-xl flex items-center justify-center relative z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                                                <i data-lucide="folder-search-2" class="w-12 h-12 text-sky-400 dark:text-sky-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum Ada Data Siswa</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Sepertinya data siswa masih kosong atau pencarian Anda tidak menemukan hasil yang cocok. Coba ubah filter atau tambahkan data baru.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BOTTOM BAR (PER PAGE & PAGINATION) --}}
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                
                {{-- Per Page --}}
                <div class="flex items-center gap-2">
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">Tampilkan</span>
                    <select name="per_page" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                        class="h-[36px] px-2 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-lg
                               bg-sky-50 dark:bg-slate-900/50 text-[13px] font-bold text-slate-700 dark:text-slate-200 outline-none
                               focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition-all cursor-pointer">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">data</span>
                </div>

                {{-- Pagination Links --}}
                @if ($students->hasPages())
                    <div class="w-full sm:w-auto overflow-x-auto">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- MODAL HAPUS --}}
    <div id="deleteModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px] transition-opacity">
        <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 w-full max-w-sm shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-500/20 text-red-500 flex items-center justify-center mx-auto mb-5">
                <i data-lucide="alert-triangle" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Hapus Data Siswa?</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
                Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
            </p>
            <div class="flex gap-3 justify-center">
                <button type="button" onclick="closeDeleteModal()"
                    class="h-11 px-6 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold transition-all">
                    Batal
                </button>
                <button type="button" onclick="confirmDelete()"
                    class="h-11 px-6 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30 transition-all">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let formToSubmit = null;
        function openDeleteModal(studentId) {
            formToSubmit = document.getElementById('delete-form-' + studentId);
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            formToSubmit = null;
        }
        function confirmDelete() {
            if(formToSubmit) formToSubmit.submit();
        }
    </script>

    {{-- MODAL EXPORT --}}
    <div id="exportModal" onclick="closeExportModal()" class="fixed inset-0 z-[60] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px] transition-opacity">
        <div onclick="event.stopPropagation()" class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-2xl border border-white/50 dark:border-slate-700/50 rounded-[2rem] shadow-2xl w-full max-w-md overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-700/50">
                <span class="text-[17px] font-extrabold text-slate-800 dark:text-slate-100">Export Data Siswa</span>
                <button type="button" onclick="closeExportModal()"
                    class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 flex items-center justify-center
                           hover:bg-red-100 dark:hover:bg-red-500/20 hover:text-red-500 dark:hover:text-red-400 transition-all border-none cursor-pointer text-base">
                    &#x2715;
                </button>
            </div>

            <form action="{{ route('admin.siswa.export') }}" method="GET">
                <div class="px-6 py-5 flex flex-col gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">
                            Unit Sekolah
                        </label>
                        <select id="unitSelect" name="unit_id"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50
                                   text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800
                                   focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all">
                            <option value="">Semua Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">
                            Kelas
                        </label>
                        <select id="classSelect" name="class_id"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50
                                   text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800
                                   focus:ring-2 focus:ring-sky-100 dark:focus:ring-blue-900/30 transition-all">
                            <option value="">Semua Kelas</option>
                        </select>
                    </div>

                    <div class="flex gap-2.5 items-start bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 rounded-xl px-4 py-3.5">
                        <i data-lucide="info" class="w-4 h-4 text-sky-400 dark:text-sky-300 flex-shrink-0 mt-0.5"></i>
                        <span class="text-[12px] text-slate-500 dark:text-slate-400">
                            Data akan diexport dalam format <strong class="text-slate-700 dark:text-slate-200">Excel (XLSX)</strong>
                            dan dapat dibuka menggunakan Microsoft Excel.
                        </span>
                    </div>
                </div>

                <div class="px-6 pb-5 flex justify-end gap-2.5">
                    <button type="button" onclick="closeExportModal()"
                        class="h-10 px-5 border-[1.5px] border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 rounded-xl
                               text-[13px] font-semibold text-slate-500 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-600 transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                        class="h-10 px-5 bg-blue-500 hover:bg-blue-600 border-none rounded-xl
                               text-[13px] font-bold text-white flex items-center gap-1.5 cursor-pointer
                               shadow-sm hover:shadow-blue-200 dark:hover:shadow-blue-900/50 hover:shadow-md transition-all">
                        <i data-lucide="download" class="w-[14px] h-[14px]"></i>Export Excel
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- FLOATING ACTION BAR FOR BULK ACTIONS --}}
    <div id="bulkActionBar" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-40 hidden items-center gap-4 px-6 py-4 rounded-full shadow-2xl shadow-blue-500/20 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 transform transition-all translate-y-full opacity-0 duration-500">
        <div class="flex items-center gap-3 pr-4 border-r border-slate-200 dark:border-slate-700">
            <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm" id="bulkCount">
                0
            </div>
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 whitespace-nowrap">Data Terpilih</span>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="openBulkDeleteModal()"
                class="px-4 h-10 rounded-xl bg-red-50 dark:bg-red-500/10 hover:bg-red-100 dark:hover:bg-red-500/20 text-red-600 dark:text-red-400 font-bold text-sm flex items-center gap-2 transition-all whitespace-nowrap">
                <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus Massal
            </button>
            <button type="button" onclick="cancelBulkAction()"
                class="px-4 h-10 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-400 font-bold text-sm flex items-center transition-all whitespace-nowrap">
                Batal
            </button>
        </div>
    </div>

    {{-- MODAL BULK HAPUS --}}
    <div id="bulkDeleteModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px] transition-opacity">
        <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 w-full max-w-sm shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-500/20 text-red-500 flex items-center justify-center mx-auto mb-5">
                <i data-lucide="alert-octagon" class="w-8 h-8"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Hapus <span id="bulkModalCount">0</span> Data?</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
                Anda akan menghapus data yang dipilih secara permanen. Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="bulkDeleteForm" action="{{ route('admin.siswa.bulk-destroy') }}" method="POST">
                @csrf
                <div id="bulkDeleteInputs"></div>
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeBulkDeleteModal()"
                        class="h-11 px-6 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="h-11 px-6 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30 transition-all">
                        Ya, Hapus Semua
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExportModal() {
            const modal = document.getElementById('exportModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeExportModal() {
            const modal = document.getElementById('exportModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('DOMContentLoaded', function() {

            // Bulk Actions Logic
            const checkAll = document.getElementById('checkAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkActionBar = document.getElementById('bulkActionBar');
            const bulkCount = document.getElementById('bulkCount');
            const bulkModalCount = document.getElementById('bulkModalCount');
            const bulkDeleteInputs = document.getElementById('bulkDeleteInputs');

            function updateBulkActionBar() {
                if(!bulkActionBar) return;
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
                if(bulkCount) bulkCount.textContent = checkedCount;
                if(bulkModalCount) bulkModalCount.textContent = checkedCount;
                
                if (checkedCount > 0) {
                    bulkActionBar.classList.remove('hidden');
                    setTimeout(() => {
                        bulkActionBar.classList.remove('translate-y-full', 'opacity-0');
                        bulkActionBar.classList.add('translate-y-0', 'opacity-100', 'flex');
                    }, 10);
                } else {
                    bulkActionBar.classList.remove('translate-y-0', 'opacity-100');
                    bulkActionBar.classList.add('translate-y-full', 'opacity-0');
                    setTimeout(() => {
                        bulkActionBar.classList.add('hidden');
                        bulkActionBar.classList.remove('flex');
                    }, 500);
                    if(checkAll) checkAll.checked = false;
                }
            }

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    rowCheckboxes.forEach(cb => cb.checked = this.checked);
                    updateBulkActionBar();
                });
            }

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const allChecked = Array.from(rowCheckboxes).every(c => c.checked);
                    if(checkAll) checkAll.checked = allChecked;
                    updateBulkActionBar();
                });
            });

            window.cancelBulkAction = function() {
                if(checkAll) checkAll.checked = false;
                rowCheckboxes.forEach(cb => cb.checked = false);
                updateBulkActionBar();
            };

            window.openBulkDeleteModal = function() {
                const checkedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
                bulkDeleteInputs.innerHTML = '';
                checkedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = id;
                    bulkDeleteInputs.appendChild(input);
                });
                const modal = document.getElementById('bulkDeleteModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            window.closeBulkDeleteModal = function() {
                const modal = document.getElementById('bulkDeleteModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };

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
                        const placeholder = window.innerWidth < 640 ? 'Kelas' : 'Semua Kelas';
                        classFilter.innerHTML = `<option value="">${placeholder}</option>`;
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


