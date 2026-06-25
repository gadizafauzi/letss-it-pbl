<div id="tab-sejarah" class="tab-content hidden">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Sejarah Sekolah</h2>
            <p class="text-sm text-slate-500">Kelola timeline sejarah perjalanan sekolah.</p>
        </div>
        <button onclick="openModal('modal-add-sejarah')" class="px-4 py-2 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-sm font-medium rounded-lg shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Sejarah
        </button>
    </div>

    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold w-24 text-center">Tahun</th>
                        <th class="px-6 py-4 font-semibold">Judul / Peristiwa</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi</th>
                        <th class="px-6 py-4 font-semibold w-20 text-center">Urutan</th>
                        <th class="px-6 py-4 font-semibold w-24 text-center">Status</th>
                        <th class="px-6 py-4 font-semibold w-24 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($sejarah as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 text-center font-bold text-slate-700 dark:text-slate-300">{{ $item->year }}</td>
                            <td class="px-6 py-4 font-medium text-slate-800 dark:text-slate-200">
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::limit($item->description, 80) }}
                            </td>
                            <td class="px-6 py-4 text-center">{{ $item->order }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="editSejarah({{ json_encode($item) }})" class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </button>
                                    <form action="{{ route('admin.profil.sejarah.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center justify-center">
                                    <i data-lucide="inbox" class="w-12 h-12 mb-3 text-slate-300 dark:text-slate-600"></i>
                                    <p>Belum ada data sejarah sekolah</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL ADD SEJARAH --}}
<div id="modal-add-sejarah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl shadow-xl overflow-hidden" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Tambah Sejarah</h3>
            <button onclick="closeModal('modal-add-sejarah')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.profil.sejarah.store') }}" method="POST" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                    <input type="text" name="year" placeholder="Misal: 1990" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                    <input type="number" name="order" value="{{ $sejarah->count() + 1 }}" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Judul Peristiwa</label>
                <input type="text" name="title" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" value="1" checked id="add_sejarah_active" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <label for="add_sejarah_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">Aktifkan</label>
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-sejarah')" class="px-4 py-2 text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-lg shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT SEJARAH --}}
<div id="modal-edit-sejarah" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl shadow-xl overflow-hidden" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Edit Sejarah</h3>
            <button onclick="closeModal('modal-edit-sejarah')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-sejarah" method="POST" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                    <input type="text" name="year" id="edit_sejarah_year" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                    <input type="number" name="order" id="edit_sejarah_order" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Judul Peristiwa</label>
                <input type="text" name="title" id="edit_sejarah_title" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                <textarea name="description" id="edit_sejarah_description" rows="4" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" value="1" id="edit_sejarah_active" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <label for="edit_sejarah_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">Aktifkan</label>
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-sejarah')" class="px-4 py-2 text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-lg shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
