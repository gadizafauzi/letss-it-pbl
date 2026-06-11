@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- PAGE HEADER --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
            <div>
                <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">
                    Data Guru
                </h1>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.guru.import') }}"
                    class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                           bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm no-underline">
                    <i data-lucide="upload" class="w-4 h-4 text-slate-400 dark:text-slate-500"></i>Import
                </a>
                <button type="button" onclick="openExportModal()"
                    class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                           bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm cursor-pointer">
                    <i data-lucide="download" class="w-4 h-4 text-slate-400 dark:text-slate-500"></i>Export
                </button>
                <a href="{{ route('admin.guru.create') }}"
                    class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                           bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah Guru
                </a>
            </div>
        </div>

        {{-- TOAST NOTIFICATION --}}
        @if (session('success'))
            <div id="toast-success"
                class="fixed bottom-8 right-8 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl shadow-green-500/20
                      bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-white/80 dark:border-slate-700/60
                      transform transition-all duration-500 translate-y-0 opacity-100">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 flex-shrink-0">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                </div>
                <div class="mr-4">
                    <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">Berhasil!</h4>
                    <p class="text-[13px] text-slate-600 dark:text-slate-400 mt-0.5">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="closeToast()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <i data-lucide="x" class="w-[18px] h-[18px]"></i>
                </button>
            </div>
            <script>
                function closeToast() {
                    const toast = document.getElementById('toast-success');
                    if(toast) {
                        toast.classList.remove('translate-y-0', 'opacity-100');
                        toast.classList.add('translate-y-full', 'opacity-0');
                        setTimeout(() => toast.style.display = 'none', 500);
                    }
                }
                setTimeout(closeToast, 4000);
            </script>
        @endif

        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.guru.index') }}" method="GET"
                class="flex flex-wrap items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama guru atau NIP..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                              bg-sky-50 text-[13px] text-slate-700 outline-none
                              focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                </div>

                {{-- Unit --}}
                <select name="unit" onchange="this.form.submit()"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[140px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    <option value="">Semua Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ request('unit') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>

                {{-- Jabatan --}}
                <select name="position" onchange="this.form.submit()"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[140px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    <option value="">Semua Jabatan</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}"
                            {{ request('position') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1200px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-center w-10">
                                <input type="checkbox" id="checkAll" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                            </th>
                            @foreach (['No', 'NIP', 'Nama Guru', 'Unit', 'Jabatan', 'Status Kepegawaian', 'No. Telepon', 'Alamat', 'Status'] as $h)
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
                        @forelse ($teachers as $teacher)
                            @php
                                $status = $teacher->status;
                                $statusLabel = $status == 'active' ? 'Aktif' : 'Nonaktif';
                                $statusCls = $status == 'active' ? 'bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-400 border-sky-200 dark:border-sky-500/30' : 'bg-slate-100 text-slate-500 dark:bg-slate-500/20 dark:text-slate-400 border-slate-200 dark:border-slate-500/30';
                                $statusDot = $status == 'active' ? 'bg-sky-500' : 'bg-slate-400';
                            @endphp
                            <tr class="border-b border-slate-100 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-4 py-3.5 text-center">
                                    <input type="checkbox" value="{{ $teacher->id }}" class="row-checkbox rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                                </td>
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-[13px] font-bold text-slate-700 dark:text-slate-300">{{ $teacher->nip ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $teacher->full_name }}</div>
                                    <div class="text-[11px] text-slate-400 dark:text-slate-500">{{ $teacher->email ?? '' }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $teacher->unit->unit_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $teacher->position->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    @if ($teacher->employment_status == 'pegawai_tetap')
                                        Pegawai Tetap
                                    @elseif($teacher->employment_status == 'pegawai_tidak_tetap')
                                        Pegawai Tidak Tetap
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $teacher->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5 max-w-[150px]">
                                    <span class="text-[13px] text-slate-500 dark:text-slate-400 block truncate">
                                        {{ $teacher->address ?? '-' }}
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
                                        <a href="{{ route('admin.guru.show', $teacher->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                              hover:bg-slate-50 dark:hover:bg-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-500 dark:text-slate-400 
                                              hover:text-slate-700 dark:hover:text-slate-200 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Detail">
                                            <i data-lucide="eye" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <a href="{{ route('admin.guru.edit', $teacher->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                              hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 
                                              hover:text-blue-600 dark:hover:text-blue-300 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Edit">
                                            <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <form action="{{ route('admin.guru.destroy', $teacher->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Hapus data guru ini? Tindakan ini tidak dapat dibatalkan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                                  hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800 text-red-500 dark:text-red-400 
                                                  hover:text-red-600 dark:hover:text-red-300 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer border-none"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">
                                    <div class="flex flex-col items-center justify-center py-20 text-center">
                                        <div class="mb-6 relative">
                                            <div class="absolute inset-0 bg-sky-200 dark:bg-sky-900 blur-[32px] opacity-30 rounded-full"></div>
                                            <div class="w-28 h-28 bg-sky-50 dark:bg-slate-800/80 rounded-[2rem] border border-white/60 dark:border-slate-700 shadow-xl flex items-center justify-center relative z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                                                <i data-lucide="users" class="w-12 h-12 text-sky-400 dark:text-sky-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum Ada Data Guru</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Sepertinya data guru masih kosong atau pencarian Anda tidak menemukan hasil yang cocok. Coba ubah filter atau tambahkan data baru.
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
                @if ($teachers->hasPages())
                    <div class="w-full sm:w-auto overflow-x-auto">
                        {{ $teachers->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- MODAL EXPORT --}}
    <div id="exportModal" onclick="closeExportModal()" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background:rgba(15,23,42,0.45);backdrop-filter:blur(4px);display:none!important;">
        <div onclick="event.stopPropagation()" class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <span class="text-[17px] font-extrabold text-slate-800">Export Data Guru</span>
                <button type="button" onclick="closeExportModal()"
                    class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center
                           hover:bg-red-100 hover:text-red-500 transition-all border-none cursor-pointer text-base">
                    &#x2715;
                </button>
            </div>

            <form action="{{ route('admin.guru.export') }}" method="GET">
                <div class="px-6 py-5 flex flex-col gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">
                            Unit Sekolah
                        </label>
                        <select name="unit_id"
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
                            Jabatan
                        </label>
                        <select name="position_id"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 rounded-xl bg-slate-50
                                   text-[13px] text-slate-700 outline-none focus:border-sky-400 focus:bg-white
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                            <option value="">Semua Jabatan</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">
                            Status
                        </label>
                        <select name="status"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 rounded-xl bg-slate-50
                                   text-[13px] text-slate-700 outline-none focus:border-sky-400 focus:bg-white
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
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
            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');
            let debounce;

            if (searchInput && filterForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounce);
                    debounce = setTimeout(() => filterForm.submit(), 500);
                });
            }
        });
    </script>

@endsection
