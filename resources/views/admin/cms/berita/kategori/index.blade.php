@extends('layouts.admin')

@section('content')
<div class="space-y-5">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
        <div>
            <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">Kategori Berita</h1>
            <p class="text-sm text-slate-400 dark:text-slate-500">Kelola kategori untuk konten berita & kegiatan.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.berita.posts.index') }}"
                class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                       bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm no-underline">
                <i data-lucide="newspaper" class="w-4 h-4 text-slate-400"></i>Kelola Berita
            </a>
            <button type="button" onclick="openModal('modal-tambah')"
                class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                       bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 transition-all cursor-pointer">
                <i data-lucide="plus" class="w-4 h-4"></i>Tambah Kategori
            </button>
        </div>
    </div>

    {{-- TOAST --}}

    {{-- TABLE --}}
    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] border-collapse">
                <thead>
                    <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                        <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 w-8">No</th>
                        <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Nama Kategori</th>
                        <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Slug</th>
                        <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Icon</th>
                        <th class="px-5 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Warna</th>
                        <th class="px-5 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Artikel</th>
                        <th class="px-5 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                    <tr class="border-b border-slate-100 dark:border-slate-700/50 hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-5 py-3.5 text-xs text-slate-400 font-semibold">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                @if($cat->color)
                                <div class="w-2.5 h-2.5 rounded-full bg-{{ $cat->color }}-500 flex-shrink-0"></div>
                                @endif
                                <span class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $cat->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            <code class="text-[12px] text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 px-2 py-0.5 rounded">{{ $cat->slug }}</code>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($cat->icon)
                            <div class="flex items-center gap-1.5">
                                <i data-lucide="{{ $cat->icon }}" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                                <span class="text-[12px] text-slate-400">{{ $cat->icon }}</span>
                            </div>
                            @else
                            <span class="text-[12px] text-slate-300 dark:text-slate-600">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            @if($cat->color)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-{{ $cat->color }}-100 text-{{ $cat->color }}-700 dark:bg-{{ $cat->color }}-500/20 dark:text-{{ $cat->color }}-400">
                                {{ $cat->color }}
                            </span>
                            @else
                            <span class="text-[12px] text-slate-300 dark:text-slate-600">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            <span class="text-[13px] font-bold text-slate-700 dark:text-slate-300">{{ $cat->posts_count }}</span>
                            <span class="text-[11px] text-slate-400 ml-0.5">artikel</span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex justify-center gap-1.5">
                                {{-- Edit --}}
                                <button type="button"
                                    onclick="openEditModal({{ json_encode(['id'=>$cat->id,'name'=>$cat->name,'slug'=>$cat->slug,'icon'=>$cat->icon,'color'=>$cat->color]) }})"
                                    class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                                           hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800
                                           text-blue-500 dark:text-blue-400 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer"
                                    title="Edit">
                                    <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                </button>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.berita.kategori.destroy', $cat->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                                               hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800
                                               text-red-500 dark:text-red-400 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <div class="w-20 h-20 bg-sky-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                                    <i data-lucide="tag" class="w-9 h-9 text-sky-300 dark:text-sky-700"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Kategori</h3>
                                <p class="text-sm text-slate-400 mb-4">Tambahkan kategori pertama untuk mulai mengelola berita.</p>
                                <button type="button" onclick="openModal('modal-tambah')"
                                    class="inline-flex items-center gap-2 h-[38px] px-4 rounded-xl text-[13px] font-bold text-white
                                           bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md transition-all cursor-pointer">
                                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah Kategori
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modal-tambah" class="hidden fixed inset-0 z-50 items-center justify-center p-4"
    style="background:rgba(15,23,42,0.45);backdrop-filter:blur(4px);" onclick="closeModal('modal-tambah')">
    <div onclick="event.stopPropagation()" class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-700">
            <span class="text-[17px] font-extrabold text-slate-800 dark:text-slate-100">Tambah Kategori</span>
            <button onclick="closeModal('modal-tambah')" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center hover:bg-red-100 hover:text-red-500 transition-all border-none cursor-pointer">
                &#x2715;
            </button>
        </div>
        <form action="{{ route('admin.berita.kategori.store') }}" method="POST">
            @csrf
            <div class="px-6 py-5 flex flex-col gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="tambah_name" required placeholder="cth: Tahfidz, Prestasi..."
                        oninput="autoSlug('tambah_name','tambah_slug')"
                        class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-sky-100 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Slug</label>
                    <input type="text" name="slug" id="tambah_slug" placeholder="otomatis dari nama..."
                        class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-500 dark:text-slate-400 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-sky-100 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Icon (Pilih dari daftar)</label>
                        <select name="icon"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 transition-all">
                            <option value="book-open">📖 book-open (Perpustakaan / Belajar)</option>
                            <option value="graduation-cap">🎓 graduation-cap (Kelulusan / Akademik)</option>
                            <option value="users">👥 users (Siswa / Guru)</option>
                            <option value="heart">❤️ heart (Hati / Sosial)</option>
                            <option value="trophy">🏆 trophy (Piala / Prestasi)</option>
                            <option value="award">🏅 award (Medali / Penghargaan)</option>
                            <option value="activity">⚡ activity (Aktivitas / Kegiatan)</option>
                            <option value="compass">🧭 compass (Visi Misi)</option>
                            <option value="globe">🌐 globe (Dunia / Bahasa)</option>
                            <option value="languages">🗣️ languages (Bahasa / Komunikasi)</option>
                            <option value="code">💻 code (Teknologi / Digital)</option>
                            <option value="calendar">📅 calendar (Kegiatan / Agenda)</option>
                            <option value="megaphone" selected>📢 megaphone (Megafon / Pengumuman)</option>
                            <option value="shield">🛡️ shield (Keamanan)</option>
                            <option value="tent">⛺ tent (Pramuka / Outbound)</option>
                            <option value="palette">🎨 palette (Seni / Kaligrafi)</option>
                            <option value="mic">🎤 mic (Public Speaking)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Warna (Tailwind)</label>
                        <select name="color"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 transition-all">
                            <option value="">— Pilih Warna —</option>
                            @foreach(['emerald','blue','amber','violet','cyan','rose','indigo','teal','orange','pink'] as $c)
                            <option value="{{ $c }}">{{ ucfirst($c) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-5 flex justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-tambah')"
                    class="h-10 px-5 border-[1.5px] border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 rounded-xl text-[13px] font-semibold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="h-10 px-5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] border-none rounded-xl text-[13px] font-bold text-white flex items-center gap-1.5 cursor-pointer shadow-sm hover:opacity-90 transition-all">
                    <i data-lucide="save" class="w-[14px] h-[14px]"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modal-edit" class="hidden fixed inset-0 z-50 items-center justify-center p-4"
    style="background:rgba(15,23,42,0.45);backdrop-filter:blur(4px);" onclick="closeModal('modal-edit')">
    <div onclick="event.stopPropagation()" class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-700">
            <span class="text-[17px] font-extrabold text-slate-800 dark:text-slate-100">Edit Kategori</span>
            <button onclick="closeModal('modal-edit')" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 flex items-center justify-center hover:bg-red-100 hover:text-red-500 transition-all border-none cursor-pointer">
                &#x2715;
            </button>
        </div>
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <div class="px-6 py-5 flex flex-col gap-4">
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="edit_name" required
                        class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-sky-100 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Slug</label>
                    <input type="text" name="slug" id="edit_slug"
                        class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-500 dark:text-slate-400 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-sky-100 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Icon (Pilih dari daftar)</label>
                        <select name="icon" id="edit_icon"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 transition-all">
                            <option value="book-open">📖 book-open (Perpustakaan / Belajar)</option>
                            <option value="graduation-cap">🎓 graduation-cap (Kelulusan / Akademik)</option>
                            <option value="users">👥 users (Siswa / Guru)</option>
                            <option value="heart">❤️ heart (Hati / Sosial)</option>
                            <option value="trophy">🏆 trophy (Piala / Prestasi)</option>
                            <option value="award">🏅 award (Medali / Penghargaan)</option>
                            <option value="activity">⚡ activity (Aktivitas / Kegiatan)</option>
                            <option value="compass">🧭 compass (Visi Misi)</option>
                            <option value="globe">🌐 globe (Dunia / Bahasa)</option>
                            <option value="languages">🗣️ languages (Bahasa / Komunikasi)</option>
                            <option value="code">💻 code (Teknologi / Digital)</option>
                            <option value="calendar">📅 calendar (Kegiatan / Agenda)</option>
                            <option value="megaphone">📢 megaphone (Megafon / Pengumuman)</option>
                            <option value="shield">🛡️ shield (Keamanan)</option>
                            <option value="tent">⛺ tent (Pramuka / Outbound)</option>
                            <option value="palette">🎨 palette (Seni / Kaligrafi)</option>
                            <option value="mic">🎤 mic (Public Speaking)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-[.04em] mb-1.5">Warna</label>
                        <select name="color" id="edit_color"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-[13px] text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-700 transition-all">
                            <option value="">— Pilih Warna —</option>
                            @foreach(['emerald','blue','amber','violet','cyan','rose','indigo','teal','orange','pink'] as $c)
                            <option value="{{ $c }}">{{ ucfirst($c) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-5 flex justify-end gap-2.5">
                <button type="button" onclick="closeModal('modal-edit')"
                    class="h-10 px-5 border-[1.5px] border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 rounded-xl text-[13px] font-semibold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                    class="h-10 px-5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] border-none rounded-xl text-[13px] font-bold text-white flex items-center gap-1.5 cursor-pointer shadow-sm hover:opacity-90 transition-all">
                    <i data-lucide="save" class="w-[14px] h-[14px]"></i>Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openModal(id) {
        const el = document.getElementById(id);
        el.classList.remove('hidden');
        el.classList.add('flex');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }
    function autoSlug(nameId, slugId) {
        const name = document.getElementById(nameId).value;
        document.getElementById(slugId).value = name
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    }
    function openEditModal(cat) {
        document.getElementById('form-edit').action = `/admin/cms/berita/kategori/${cat.id}`;
        document.getElementById('edit_name').value  = cat.name  ?? '';
        document.getElementById('edit_slug').value  = cat.slug  ?? '';
        document.getElementById('edit_icon').value  = cat.icon  ?? '';
        document.getElementById('edit_color').value = cat.color ?? '';
        openModal('modal-edit');
        setTimeout(() => lucide.createIcons(), 50);
    }
</script>
@endpush
