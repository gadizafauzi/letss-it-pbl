<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Daftar Prestasi</h2>
            <p class="text-sm text-slate-500">Kelola riwayat pencapaian dan prestasi unit pendidikan ini.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-prestasi').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Prestasi
        </button>
    </div>

    @if($achievements->isEmpty())
        <div class="text-center py-10 bg-slate-50 dark:bg-slate-800/50 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700">
            <i data-lucide="award" class="w-10 h-10 text-slate-400 mx-auto mb-3"></i>
            <h3 class="text-slate-600 dark:text-slate-300 font-medium">Belum ada data prestasi.</h3>
            <p class="text-sm text-slate-500 mt-1">Klik tombol "Tambah Prestasi" untuk merekam pencapaian baru.</p>
        </div>
    @else
        <div class="overflow-x-auto border border-slate-200 dark:border-slate-700 rounded-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300">Tahun</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300">Tipe</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300">Judul Prestasi</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300">Tingkat</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300 text-center">Status</th>
                        <th class="px-4 py-3 text-sm font-semibold text-slate-600 dark:text-slate-300 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($achievements as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-4 py-3 text-sm text-slate-800 dark:text-slate-200 font-medium">{{ $item->year }}</td>
                        <td class="px-4 py-3 text-sm text-slate-500">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium {{ 
                                $item->type == 'school' || $item->type == 'unit' ? 'bg-blue-100 text-blue-700' : 
                                ($item->type == 'teacher' ? 'bg-indigo-100 text-indigo-700' : 'bg-purple-100 text-purple-700') 
                            }}">
                                {{ $item->type == 'school' || $item->type == 'unit' ? 'Sekolah' : ($item->type == 'teacher' ? 'Guru' : 'Siswa') }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm font-medium text-slate-800 dark:text-slate-200">{{ $item->title }}</p>
                            <p class="text-xs text-slate-500 line-clamp-1">{{ $item->description }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-500">{{ $item->level ?: '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($item->is_active)
                                <i data-lucide="check-circle" class="w-5 h-5 text-blue-500 mx-auto"></i>
                            @else
                                <i data-lucide="x-circle" class="w-5 h-5 text-slate-300 mx-auto"></i>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="editPrestasi({{ $item->id }}, '{{ $item->type }}', {{ $item->year }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->description) }}', '{{ addslashes($item->level) }}', '{{ $item->side }}', {{ $item->order }}, {{ $item->is_active ? 1 : 0 }})" class="p-1.5 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.unit-cms.prestasi.destroy', ['id' => $unit->id, 'prestasiId' => $item->id]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- MODAL ADD PRESTASI --}}
<div id="modal-add-prestasi" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden my-auto">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
            <h3 class="font-bold text-slate-800 dark:text-white">Tambah Prestasi</h3>
            <button type="button" onclick="document.getElementById('modal-add-prestasi').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.unit-cms.prestasi.store', $unit->id) }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tipe Prestasi</label>
                        <select name="type" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="school">Sekolah</option>
                            <option value="teacher">Guru</option>
                            <option value="student">Siswa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                        <input type="number" name="year" required value="{{ date('Y') }}" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Prestasi</label>
                    <input type="text" name="title" required placeholder="Juara 1 Lomba Cerdas Cermat..." class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tingkat</label>
                    <input type="text" name="level" placeholder="Nasional / Provinsi / Kabupaten" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Posisi Tampilan Timeline</label>
                        <select name="side" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="left">Kiri</option>
                            <option value="right">Kanan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan (Opsional)</label>
                        <input type="number" name="order" value="0" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="is_active" id="prestasi_active_add" value="1" checked class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="prestasi_active_add" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-prestasi').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-medium text-sm transition-colors">Simpan Prestasi</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT PRESTASI --}}
<div id="modal-edit-prestasi" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden my-auto">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
            <h3 class="font-bold text-slate-800 dark:text-white">Edit Prestasi</h3>
            <button type="button" onclick="document.getElementById('modal-edit-prestasi').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-prestasi" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tipe Prestasi</label>
                        <select name="type" id="edit_p_type" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="school">Sekolah</option>
                            <option value="teacher">Guru</option>
                            <option value="student">Siswa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun</label>
                        <input type="number" name="year" id="edit_p_year" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Prestasi</label>
                    <input type="text" name="title" id="edit_p_title" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tingkat</label>
                    <input type="text" name="level" id="edit_p_level" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="description" id="edit_p_desc" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Posisi Tampilan Timeline</label>
                        <select name="side" id="edit_p_side" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="left">Kiri</option>
                            <option value="right">Kanan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan (Opsional)</label>
                        <input type="number" name="order" id="edit_p_order" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="is_active" id="edit_p_active" value="1" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="edit_p_active" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit-prestasi').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-medium text-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editPrestasi(id, type, year, title, description, level, side, order, is_active) {
        document.getElementById('form-edit-prestasi').action = `/admin/unit-cms/{{ $unit->id }}/prestasi/${id}`;
        document.getElementById('edit_p_type').value = type;
        document.getElementById('edit_p_year').value = year;
        document.getElementById('edit_p_title').value = title;
        document.getElementById('edit_p_desc').value = description;
        document.getElementById('edit_p_level').value = level;
        document.getElementById('edit_p_side').value = side;
        document.getElementById('edit_p_order').value = order;
        document.getElementById('edit_p_active').checked = is_active ? true : false;
        
        document.getElementById('modal-edit-prestasi').classList.remove('hidden');
    }
</script>
