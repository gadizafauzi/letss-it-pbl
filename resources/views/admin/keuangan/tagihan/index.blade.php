@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Data Tagihan</h1>
            </div>
            <div class="flex items-center gap-3">

                <!-- 1. Tombol Form Broadcast (berada di bagian header sejajar dengan Generate Tagihan) -->
                <form id="broadcastWaForm" action="{{ route('admin.tagihan.broadcast-wa') }}" method="POST">
                    @csrf
                    <button type="button" onclick="openBroadcastWaModal()"
                        class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-gradient-to-br from-green-400 to-green-600 hover:opacity-90 text-white text-sm font-semibold shadow-md shadow-green-500/30 hover:shadow-lg hover:shadow-green-500/40 transition-all">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Broadcast WA
                    </button>
                </form>

                <a href="{{ route('admin.tagihan.create') }}"
                    class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-sm font-semibold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Generate Tagihan
                </a>
            </div>
        </div>


        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.tagihan.index') }}" method="GET" class="flex flex-col sm:flex-row sm:items-center gap-2.5">
                
                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau NIS siswa..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                              bg-sky-50 text-[13px] text-slate-700 outline-none
                              focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                </div>

                {{-- Group Side-by-Side on Mobile --}}
                <div class="flex flex-1 gap-2 w-full sm:w-auto sm:flex-initial">
                    {{-- Unit --}}
                    <select name="unit_id" onchange="this.form.submit()"
                        class="flex-1 sm:flex-initial h-[42px] px-2 sm:px-3 border-[1.5px] border-sky-100 rounded-[10px]
                               bg-sky-50 text-[11px] sm:text-[13px] text-slate-700 outline-none min-w-0 sm:min-w-[140px]
                               focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer">
                        <option value="">Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Status --}}
                    <select name="status" onchange="this.form.submit()"
                        class="flex-1 sm:flex-initial h-[42px] px-2 sm:px-3 border-[1.5px] border-sky-100 rounded-[10px]
                               bg-sky-50 text-[11px] sm:text-[13px] text-slate-700 outline-none min-w-0 sm:min-w-[140px]
                               focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer">
                        <option value="">Status</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-center w-10">
                                <input type="checkbox" id="checkAll" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                            </th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">No</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Siswa</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Unit</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Total Tagihan</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Status</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Total Tunggakan</th>
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-center">
                                    <input type="checkbox" value="{{ $student->id }}" class="row-checkbox rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 cursor-pointer w-4 h-4">
                                </td>
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $loop->iteration + $students->firstItem() - 1 }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $student->full_name }}</div>
                                    <div class="text-[11px] text-slate-400 dark:text-slate-500 font-mono">{{ $student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600 dark:text-slate-400 font-medium">
                                    {{ $student->unit->unit_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-[13px] font-bold text-slate-700 dark:text-slate-300">
                                        {{ $student->total_invoices }} Tagihan
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($student->unpaid_count > 0)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 border-red-200 dark:border-red-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            {{ $student->unpaid_count }} Belum Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Semua Lunas
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-[13px] font-bold {{ ($student->total_tunggakan ?? 0) > 0 ? 'text-red-500 dark:text-red-400' : 'text-slate-400 dark:text-slate-500' }}">
                                        Rp {{ number_format($student->total_tunggakan ?? 0, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.tagihan.student', $student->id) }}"
                                            class="h-8 px-3 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition-all inline-flex items-center justify-center shadow-sm no-underline text-xs font-bold gap-1.5"
                                            title="Detail Tagihan">
                                            <i data-lucide="eye" class="w-[13px] h-[13px]"></i> Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="flex flex-col items-center justify-center py-20 text-center">
                                        <div class="mb-6 relative">
                                            <div class="absolute inset-0 bg-emerald-200 dark:bg-emerald-900 blur-[32px] opacity-30 rounded-full"></div>
                                            <div class="w-28 h-28 bg-emerald-50 dark:bg-slate-800/80 rounded-[2rem] border border-white/60 dark:border-slate-700 shadow-xl flex items-center justify-center relative z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                                                <i data-lucide="receipt" class="w-12 h-12 text-emerald-400 dark:text-emerald-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum Ada Data Tagihan</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Data tagihan belum tersedia atau pencarian tidak cocok.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BOTTOM BAR --}}
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">Tampilkan</span>
                    <select name="per_page" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                        class="h-[36px] px-2 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-lg bg-sky-50 dark:bg-slate-900/50 text-[13px] font-bold text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 transition-all cursor-pointer">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">data</span>
                </div>
                @if ($students->hasPages())
                    <div class="w-full sm:w-auto overflow-x-auto">
                        {{ $students->links() }}
                    </div>
                @endif
            </div>
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
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Hapus <span id="bulkModalCount">0</span> Siswa?</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
                Anda akan menghapus semua tagihan yang BELUM LUNAS pada siswa-siswa yang dipilih. Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="bulkDeleteForm" action="{{ route('admin.tagihan.bulk-destroy') }}" method="POST">
                @csrf
                <div id="bulkDeleteInputs"></div>
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeBulkDeleteModal()"
                        class="h-11 px-6 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="h-11 px-6 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30 transition-all">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
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


<!-- 2. Modal Konfirmasi & Script -->
<div id="broadcastWaModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px] transition-opacity">
    <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 w-full max-w-sm shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all text-center">
        <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-500/20 text-green-500 flex items-center justify-center mx-auto mb-5">
            <i data-lucide="send" class="w-8 h-8"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Kirim Broadcast WA?</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
            Apakah Anda yakin ingin mengirim pesan broadcast tagihan ke SEMUA orang tua siswa yang belum lunas? Tindakan ini akan memakan waktu beberapa saat.
        </p>
        <div class="flex gap-3 justify-center">
            <button type="button" onclick="closeBroadcastWaModal()"
                class="h-11 px-6 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold transition-all">
                Batal
            </button>
            <button type="button" onclick="confirmBroadcastWa()"
                class="h-11 px-6 rounded-2xl bg-green-600 hover:bg-green-700 text-white font-bold shadow-md shadow-green-500/20 hover:shadow-lg hover:shadow-green-500/30 transition-all">
                Ya, Kirim
            </button>
        </div>
    </div>
</div>
<script>
    function openBroadcastWaModal() {
        const modal = document.getElementById('broadcastWaModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeBroadcastWaModal() {
        const modal = document.getElementById('broadcastWaModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    function confirmBroadcastWa() {
        document.getElementById('broadcastWaForm').submit();
    }
</script>

@endsection


