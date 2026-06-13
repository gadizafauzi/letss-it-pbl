<div id="tab-program" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Program Khusus</h2>
            <p class="text-sm text-slate-500">Kelola Program Keislaman, Akademik, dan Karakter.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-program')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Program
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Ikon</th>
                    <th class="px-4 py-3 font-semibold">Judul Program</th>
                    <th class="px-4 py-3 font-semibold">Kategori</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($programs as $program)
                <tr>
                    <td class="px-4 py-3">{{ $program->order }}</td>
                    <td class="px-4 py-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i data-lucide="{{ $program->icon }}" class="w-5 h-5"></i>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-200">
                        {{ $program->title }}
                        <div class="text-xs text-slate-500 mt-0.5 line-clamp-1" title="{{ $program->description }}">{{ Str::limit($program->description, 50) }}</div>
                    </td>
                    <td class="px-4 py-3 capitalize">{{ $program->category }}</td>
                    <td class="px-4 py-3">
                        @if($program->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" onclick="editProgram({{ json_encode($program) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.beranda.program.destroy', $program->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus program ini?')">
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
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data program.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH PROGRAM --}}
<div id="modal-add-program" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Program</h3>
            <button type="button" onclick="closeModal('modal-add-program')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.beranda.program.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Program</label>
                    <input type="text" name="title" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Detail (Opsional)</label>
                    <input type="text" name="detail" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="ex: 30 Juz, Mutqin">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select name="category" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="keislaman">Keislaman</option>
                            <option value="akademik">Akademik</option>
                            <option value="karakter">Karakter</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="order" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon name)</label>
                    <input type="text" name="icon" value="book" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="program_active_add" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="program_active_add" class="text-sm text-slate-700">Aktifkan Program</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-program')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT PROGRAM --}}
<div id="modal-edit-program" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Program</h3>
            <button type="button" onclick="closeModal('modal-edit-program')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-program" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Program</label>
                    <input type="text" name="title" id="edit_prog_title" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="edit_prog_desc" rows="2" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Detail (Opsional)</label>
                    <input type="text" name="detail" id="edit_prog_detail" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select name="category" id="edit_prog_category" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="keislaman">Keislaman</option>
                            <option value="akademik">Akademik</option>
                            <option value="karakter">Karakter</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                        <input type="number" name="order" id="edit_prog_order" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon name)</label>
                    <input type="text" name="icon" id="edit_prog_icon" class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_prog_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_prog_active" class="text-sm text-slate-700">Aktifkan Program</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-program')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editProgram(prog) {
        let form = document.getElementById('form-edit-program');
        form.action = `/admin/cms/beranda/program/${prog.id}`;
        
        document.getElementById('edit_prog_title').value = prog.title;
        document.getElementById('edit_prog_desc').value = prog.description;
        document.getElementById('edit_prog_detail').value = prog.detail || '';
        document.getElementById('edit_prog_category').value = prog.category;
        document.getElementById('edit_prog_order').value = prog.order;
        document.getElementById('edit_prog_icon').value = prog.icon;
        document.getElementById('edit_prog_active').checked = prog.is_active == 1;
        
        openModal('modal-edit-program');
    }
</script>
@endpush
