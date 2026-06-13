        <div id="tab-statistik" class="tab-content hidden">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Statistik</h2>
                    <p class="text-sm text-slate-500">Angka pencapaian atau jumlah data (misal: 100+ Guru, 500+ Siswa).</p>
                </div>
                <button type="button" onclick="openModal('modal-add-statistic')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Statistik
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl font-semibold">Urutan</th>
                            <th class="px-4 py-3 font-semibold">Angka</th>
                            <th class="px-4 py-3 font-semibold">Label</th>
                            <th class="px-4 py-3 font-semibold">Ikon (Lucide)</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse($statistics as $stat)
                        <tr>
                            <td class="px-4 py-3">{{ $stat->order }}</td>
                            <td class="px-4 py-3 font-bold text-blue-600">{{ $stat->number }}</td>
                            <td class="px-4 py-3">{{ $stat->label }}</td>
                            <td class="px-4 py-3"><i data-lucide="{{ $stat->icon }}" class="w-5 h-5"></i></td>
                            <td class="px-4 py-3">
                                @if($stat->is_active)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button type="button" onclick="editStatistic({{ json_encode($stat) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.beranda.statistic.destroy', $stat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus statistik ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data statistik.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

{{-- MODAL TAMBAH STATISTIK --}}
<div id="modal-add-statistic" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Statistik</h3>
            <button type="button" onclick="closeModal('modal-add-statistic')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.beranda.statistic.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Angka (ex: 100+)</label>
                    <input type="text" name="number" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label (ex: Guru & Karyawan)</label>
                    <input type="text" name="label" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon name)</label>
                    <input type="text" name="icon" value="users" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Cari ikon di <a href="https://lucide.dev" target="_blank" class="text-blue-500">lucide.dev</a></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="stat_active_add" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="stat_active_add" class="text-sm text-slate-700">Aktifkan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-statistic')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT STATISTIK --}}
<div id="modal-edit-statistic" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Statistik</h3>
            <button type="button" onclick="closeModal('modal-edit-statistic')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-statistic" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Angka (ex: 100+)</label>
                    <input type="text" name="number" id="edit_stat_number" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Label</label>
                    <input type="text" name="label" id="edit_stat_label" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon name)</label>
                    <input type="text" name="icon" id="edit_stat_icon" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_stat_order" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_stat_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_stat_active" class="text-sm text-slate-700">Aktifkan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-statistic')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
