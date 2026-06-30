<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Ekstrakurikuler</h2>
            <p class="text-sm text-slate-500">Kelola daftar kegiatan ekstrakurikuler yang ada pada unit ini.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-ekskul').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Ekskul
        </button>
    </div>

    @if($ekskuls->isEmpty())
        <div class="text-center py-10 bg-slate-50 dark:bg-slate-800/50 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700">
            <i data-lucide="activity" class="w-10 h-10 text-slate-400 mx-auto mb-3"></i>
            <h3 class="text-slate-600 dark:text-slate-300 font-medium">Belum ada data ekstrakurikuler.</h3>
            <p class="text-sm text-slate-500 mt-1">Klik tombol "Tambah Ekskul" untuk memasukkan data baru.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ekskuls as $item)
                <div class="border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden bg-white dark:bg-slate-800 hover:border-blue-500 transition-colors group relative flex flex-col">
                    @if($item->image)
                        <div class="h-40 w-full overflow-hidden bg-slate-100">
                            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-40 w-full bg-slate-100 flex items-center justify-center text-slate-400">
                            <i data-lucide="image" class="w-10 h-10"></i>
                        </div>
                    @endif
                    
                    <div class="p-4 flex-grow flex flex-col">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h4 class="font-bold text-slate-800 dark:text-white">{{ $item->title }}</h4>
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="{{ $item->icon ?: 'activity' }}" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 line-clamp-2 mb-4 flex-grow">{{ $item->description }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="inline-block px-2 py-0.5 rounded-md text-xs font-medium {{ $item->is_active ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                    
                    {{-- Actions --}}
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 backdrop-blur-sm p-1 rounded-lg">
                        <button type="button" onclick="editEkskul({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ $item->icon }}', '{{ addslashes($item->description) }}', {{ $item->order }}, {{ $item->is_active ? 1 : 0 }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.unit-cms.ekskul.destroy', ['id' => $unit->id, 'ekskulId' => $item->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL ADD EKSKUL --}}
<div id="modal-add-ekskul" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden my-auto">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
            <h3 class="font-bold text-slate-800 dark:text-white">Tambah Ekstrakurikuler</h3>
            <button type="button" onclick="document.getElementById('modal-add-ekskul').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.unit-cms.ekskul.store', $unit->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Ekstrakurikuler</label>
                    <input type="text" name="title" required placeholder="Contoh: Pramuka" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Deskripsi singkat kegiatan..." class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Foto Kegiatan (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ikon (Pilih dari daftar)</label>
                        <select name="icon" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="book-open">📖 book-open (Tahfidz / Club / Akademik)</option>
                            <option value="trophy" selected>🏆 trophy (Futsal / Olahraga / Kompetisi)</option>
                            <option value="award">🏅 award (Karate / Beladiri / Penghargaan)</option>
                            <option value="activity">⚡ activity (Olahraga / Aktivitas Fisik)</option>
                            <option value="tent">⛺ tent (Pramuka / Pecinta Alam)</option>
                            <option value="crosshair">🎯 crosshair (Panahan / Fokus)</option>
                            <option value="flask-conical">🧪 flask-conical (Olimpiade Sains / Lab)</option>
                            <option value="palette">🎨 palette (Seni / Lukis / Kaligrafi)</option>
                            <option value="mic">🎤 mic (Public Speaking / Pidato / Debat)</option>
                            <option value="languages">🗣️ languages (Klub Bahasa / Debat)</option>
                            <option value="code">💻 code (Coding / Robotik / Komputer)</option>
                            <option value="music">🎵 music (Paduan Suara / Seni Musik)</option>
                            <option value="globe">🌐 globe (Klub Geografi / Astronomi)</option>
                            <option value="heart">❤️ heart (PMR / Kemanusiaan / Karakter)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" value="0" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="is_active" id="ekskul_active_add" value="1" checked class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="ekskul_active_add" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                <button type="button" onclick="document.getElementById('modal-add-ekskul').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 rounded-xl font-medium text-sm shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">Simpan Ekskul</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT EKSKUL --}}
<div id="modal-edit-ekskul" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden my-auto">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800 sticky top-0 z-10">
            <h3 class="font-bold text-slate-800 dark:text-white">Edit Ekstrakurikuler</h3>
            <button type="button" onclick="document.getElementById('modal-edit-ekskul').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-ekskul" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Ekstrakurikuler</label>
                    <input type="text" name="title" id="edit_e_title" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="description" id="edit_e_desc" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Foto Kegiatan (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ikon (Pilih dari daftar)</label>
                        <select name="icon" id="edit_e_icon" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="book-open">📖 book-open (Tahfidz / Club / Akademik)</option>
                            <option value="trophy">🏆 trophy (Futsal / Olahraga / Kompetisi)</option>
                            <option value="award">🏅 award (Karate / Beladiri / Penghargaan)</option>
                            <option value="activity">⚡ activity (Olahraga / Aktivitas Fisik)</option>
                            <option value="tent">⛺ tent (Pramuka / Pecinta Alam)</option>
                            <option value="crosshair">🎯 crosshair (Panahan / Fokus)</option>
                            <option value="flask-conical">🧪 flask-conical (Olimpiade Sains / Lab)</option>
                            <option value="palette">🎨 palette (Seni / Lukis / Kaligrafi)</option>
                            <option value="mic">🎤 mic (Public Speaking / Pidato / Debat)</option>
                            <option value="languages">🗣️ languages (Klub Bahasa / Debat)</option>
                            <option value="code">💻 code (Coding / Robotik / Komputer)</option>
                            <option value="music">🎵 music (Paduan Suara / Seni Musik)</option>
                            <option value="globe">🌐 globe (Klub Geografi / Astronomi)</option>
                            <option value="heart">❤️ heart (PMR / Kemanusiaan / Karakter)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan</label>
                        <input type="number" name="order" id="edit_e_order" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="is_active" id="edit_e_active" value="1" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="edit_e_active" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-4">
                <button type="button" onclick="document.getElementById('modal-edit-ekskul').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 rounded-xl font-medium text-sm shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editEkskul(id, title, icon, description, order, is_active) {
        document.getElementById('form-edit-ekskul').action = `/admin/unit-cms/{{ $unit->id }}/ekskul/${id}`;
        document.getElementById('edit_e_title').value = title;
        document.getElementById('edit_e_icon').value = icon;
        document.getElementById('edit_e_desc').value = description;
        document.getElementById('edit_e_order').value = order;
        document.getElementById('edit_e_active').checked = is_active ? true : false;
        
        document.getElementById('modal-edit-ekskul').classList.remove('hidden');
    }
</script>
