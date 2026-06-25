<div id="tab-testimoni" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Testimoni</h2>
            <p class="text-sm text-slate-500">Kelola testimoni dari alumni atau orang tua siswa.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-testimoni')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Testimoni
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Avatar</th>
                    <th class="px-4 py-3 font-semibold">Nama & Peran</th>
                    <th class="px-4 py-3 font-semibold">Kutipan</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($testimonials as $testimoni)
                <tr>
                    <td class="px-4 py-3">{{ $testimoni->order }}</td>
                    <td class="px-4 py-3">
                        @if($testimoni->avatar)
                            <img src="{{ str_starts_with($testimoni->avatar, 'http') ? $testimoni->avatar : Storage::url($testimoni->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                        @else
                            <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-800 dark:text-slate-200">{{ $testimoni->name }}</div>
                        <div class="text-xs text-slate-500">{{ $testimoni->role }}</div>
                    </td>
                    <td class="px-4 py-3 text-slate-600">
                        <div class="line-clamp-2" title="{{ $testimoni->quote }}">{{ Str::limit($testimoni->quote, 50) }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @if($testimoni->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" onclick="editTestimoni({{ json_encode($testimoni) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.beranda.testimoni.destroy', $testimoni->id) }}" method="POST" class="inline-block">
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
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data testimoni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH TESTIMONI --}}
<div id="modal-add-testimoni" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Testimoni</h3>
            <button type="button" onclick="closeModal('modal-add-testimoni')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.beranda.testimoni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                    <input type="text" name="name" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Peran (Misal: Alumni, Orang Tua Siswa)</label>
                    <input type="text" name="role" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kutipan / Isi Testimoni</label>
                    <textarea name="quote" rows="3" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Avatar / Foto</label>
                        <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="order" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="testi_active_add" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="testi_active_add" class="text-sm text-slate-700">Aktifkan Testimoni</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-testimoni')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT TESTIMONI --}}
<div id="modal-edit-testimoni" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Testimoni</h3>
            <button type="button" onclick="closeModal('modal-edit-testimoni')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-testimoni" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                    <input type="text" name="name" id="edit_testi_name" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Peran</label>
                    <input type="text" name="role" id="edit_testi_role" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kutipan / Isi Testimoni</label>
                    <textarea name="quote" id="edit_testi_quote" rows="3" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Avatar / Foto Baru (Opsional)</label>
                        <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="order" id="edit_testi_order" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_testi_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_testi_active" class="text-sm text-slate-700">Aktifkan Testimoni</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-testimoni')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editTestimoni(testi) {
        let form = document.getElementById('form-edit-testimoni');
        form.action = `/admin/cms/beranda/testimoni/${testi.id}`;
        
        document.getElementById('edit_testi_name').value = testi.name;
        document.getElementById('edit_testi_role').value = testi.role || '';
        document.getElementById('edit_testi_quote').value = testi.quote;
        document.getElementById('edit_testi_order').value = testi.order;
        document.getElementById('edit_testi_active').checked = testi.is_active == 1;
        
        openModal('modal-edit-testimoni');
    }
</script>
@endpush
