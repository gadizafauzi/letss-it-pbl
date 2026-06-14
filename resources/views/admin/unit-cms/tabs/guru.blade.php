<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Guru Pengajar</h2>
            <p class="text-sm text-slate-500">Pilih guru yang akan ditampilkan di halaman profil unit sekolah ini.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-add-guru').classList.remove('hidden')" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2 text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Guru
        </button>
    </div>

    @if($teachers->isEmpty())
        <div class="text-center py-10 bg-slate-50 dark:bg-slate-800/50 rounded-xl border-2 border-dashed border-slate-200 dark:border-slate-700">
            <i data-lucide="users" class="w-10 h-10 text-slate-400 mx-auto mb-3"></i>
            <h3 class="text-slate-600 dark:text-slate-300 font-medium">Belum ada data guru pengajar yang ditampilkan.</h3>
            <p class="text-sm text-slate-500 mt-1">Klik tombol "Tambah Guru" untuk memilih guru dari daftar.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($teachers as $item)
                @php
                    $teacher = $item->teacher;
                    $photoUrl = $teacher && $teacher->photo 
                                ? asset('storage/' . $teacher->photo) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($teacher->full_name ?? ($teacher->user->name ?? 'User')).'&background=2563eb&color=fff';
                @endphp
                <div class="border border-slate-200 dark:border-slate-700 rounded-2xl p-4 bg-white dark:bg-slate-800 flex flex-col items-center text-center relative group">
                    <img src="{{ $photoUrl }}" alt="Foto Guru" class="w-20 h-20 rounded-full object-cover mb-3 border-4 border-blue-50">
                    <h4 class="font-bold text-slate-800 dark:text-white text-sm line-clamp-1" title="{{ $teacher->full_name ?? ($teacher->user->name ?? 'Unknown') }}">{{ $teacher->full_name ?? ($teacher->user->name ?? 'Unknown') }}</h4>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $teacher->nip ?? '-' }}</p>
                    
                    <div class="mt-3">
                        <span class="inline-block px-2 py-0.5 rounded-md text-xs font-medium {{ $item->is_active ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $item->is_active ? 'Tampil' : 'Sembunyi' }}
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button type="button" onclick="editGuru({{ $item->id }}, {{ $item->teacher_id }}, {{ $item->order }}, {{ $item->is_active ? 1 : 0 }})" class="p-1.5 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.unit-cms.guru.destroy', ['id' => $unit->id, 'guruId' => $item->id]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini dari daftar?')">
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

{{-- MODAL ADD GURU --}}
<div id="modal-add-guru" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-white">Tambah Guru Pengajar</h3>
            <button type="button" onclick="document.getElementById('modal-add-guru').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.unit-cms.guru.store', $unit->id) }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Pilih Guru</label>
                    <select name="teacher_id" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($availableTeachers as $t)
                            <option value="{{ $t->id }}">{{ $t->full_name ?? ($t->user->name ?? 'Unknown') }} (NIP: {{ $t->nip ?? '-' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan Tampil</label>
                        <input type="number" name="order" value="0" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="flex items-center gap-2 mt-8">
                        <input type="checkbox" name="is_active" id="guru_active_add" value="1" checked class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                        <label for="guru_active_add" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-add-guru').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-medium text-sm transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT GURU --}}
<div id="modal-edit-guru" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50 dark:bg-slate-800">
            <h3 class="font-bold text-slate-800 dark:text-white">Edit Guru Pengajar</h3>
            <button type="button" onclick="document.getElementById('modal-edit-guru').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-guru" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Pilih Guru</label>
                    <select name="teacher_id" id="edit_g_teacher_id" required class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                        @foreach($availableTeachers as $t)
                            <option value="{{ $t->id }}">{{ $t->full_name ?? ($t->user->name ?? 'Unknown') }} (NIP: {{ $t->nip ?? '-' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan Tampil</label>
                        <input type="number" name="order" id="edit_g_order" class="w-full px-4 py-2 border border-slate-300 rounded-xl bg-white focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div class="flex items-center gap-2 mt-8">
                        <input type="checkbox" name="is_active" id="edit_g_active" value="1" class="w-4 h-4 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                        <label for="edit_g_active" class="text-sm font-medium text-slate-700 cursor-pointer">Tampilkan</label>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modal-edit-guru').classList.add('hidden')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium text-sm transition-colors">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-xl font-medium text-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editGuru(id, teacherId, order, is_active) {
        document.getElementById('form-edit-guru').action = `/admin/unit-cms/{{ $unit->id }}/guru/${id}`;
        document.getElementById('edit_g_teacher_id').value = teacherId;
        document.getElementById('edit_g_order').value = order;
        document.getElementById('edit_g_active').checked = is_active ? true : false;
        
        document.getElementById('modal-edit-guru').classList.remove('hidden');
    }
</script>
