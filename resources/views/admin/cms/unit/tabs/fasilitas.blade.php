<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Fasilitas Pendidikan</h2>
            <p class="text-sm text-slate-500">Kelola daftar fasilitas unggulan yang tersedia untuk unit ini.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-fasilitas').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Fasilitas
        </button>
    </div>

    @if($facilities->isEmpty())
        <div class="text-center py-10 bg-slate-50 dark:bg-slate-800/50 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700">
            <i data-lucide="building" class="w-10 h-10 text-slate-400 mx-auto mb-3"></i>
            <h3 class="text-slate-600 dark:text-slate-300 font-medium">Belum ada data fasilitas.</h3>
            <p class="text-sm text-slate-500 mt-1">Klik tombol "Tambah Fasilitas" untuk memasukkan data baru.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($facilities as $item)
                <div class="border border-slate-200 dark:border-slate-700 rounded-xl p-4 bg-white dark:bg-slate-800 flex items-start gap-4 hover:border-blue-500 transition-colors group relative">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $item->icon ?: 'check-circle' }}" class="w-6 h-6"></i>
                    </div>
                    <div class="flex-grow">
                        <h4 class="font-bold text-slate-800 dark:text-white text-sm mb-1">{{ $item->title }}</h4>
                        <span class="inline-block px-2 py-0.5 rounded-md text-xs font-medium {{ $item->is_active ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    
                    {{-- Actions --}}
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" onclick="editFasilitas({{ $item->id }}, '{{ $item->icon }}', '{{ addslashes($item->title) }}', {{ $item->order }}, {{ $item->is_active ? 1 : 0 }})" class="p-1.5 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.unit-cms.fasilitas.destroy', ['id' => $unit->id, 'facilityId' => $item->id]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-600 bg-red-50 rounded-lg hover:bg-red-100">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL ADD FASILITAS --}}
<div id="modal-add-fasilitas" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-white">Tambah Fasilitas</h3>
            <button type="button" onclick="document.getElementById('modal-add-fasilitas').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.unit-cms.fasilitas.store', $unit->id) }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Fasilitas</label>
                    <input type="text" name="title" required placeholder="Contoh: Lab Komputer" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ikon (Lucide)</label>
                    <input type="text" name="icon" required placeholder="monitor" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    <p class="text-xs text-slate-500 mt-1">Cari ikon di <a href="https://lucide.dev/icons" target="_blank" class="text-blue-500 hover:underline">lucide.dev</a></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" value="0" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="flex items-center gap-2 mt-8">
                        <input type="checkbox" name="is_active" id="fasilitas_active_add" value="1" checked class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                        <label for="fasilitas_active_add" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-add-fasilitas').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 rounded-xl font-medium text-sm shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">Simpan Fasilitas</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT FASILITAS --}}
<div id="modal-edit-fasilitas" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-white">Edit Fasilitas</h3>
            <button type="button" onclick="document.getElementById('modal-edit-fasilitas').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-fasilitas" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Fasilitas</label>
                    <input type="text" name="title" id="edit_f_title" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ikon (Lucide)</label>
                    <input type="text" name="icon" id="edit_f_icon" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" id="edit_f_order" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="flex items-center gap-2 mt-8">
                        <input type="checkbox" name="is_active" id="edit_f_active" value="1" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                        <label for="edit_f_active" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-edit-fasilitas').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 rounded-xl font-medium text-sm shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editFasilitas(id, icon, title, order, is_active) {
        document.getElementById('form-edit-fasilitas').action = `/admin/unit-cms/{{ $unit->id }}/fasilitas/${id}`;
        document.getElementById('edit_f_title').value = title;
        document.getElementById('edit_f_icon').value = icon;
        document.getElementById('edit_f_order').value = order;
        document.getElementById('edit_f_active').checked = is_active ? true : false;
        
        document.getElementById('modal-edit-fasilitas').classList.remove('hidden');
    }
</script>
