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
            <form id="bulkDeleteForm" action="{{ route('admin.guru.bulk-destroy') }}" method="POST">
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
        });
    </script>

@endsection


