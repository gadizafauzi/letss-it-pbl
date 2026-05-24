@extends('layouts.student')

@section('content')
<div class="flex flex-col lg:flex-row gap-6 font-sans">

    <!-- LEFT SIDEBAR PANEL: Foto & Ringkasan Akademik -->
    <div class="w-full lg:w-[320px] shrink-0 space-y-6">
        
        <!-- Foto Profil Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 text-center shadow-sm relative overflow-hidden">
            <div class="w-28 h-28 mx-auto rounded-full border-4 border-emerald-50/50 overflow-hidden shadow-md flex items-center justify-center bg-slate-100 mb-4 relative group">
                @if($student->photo)
                    <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" id="avatarPreview" class="object-cover w-full h-full">
                @else
                    <div class="text-emerald-500 text-4xl font-extrabold">
                        {{ strtoupper(substr($student->full_name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <h3 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $student->full_name }}</h3>
            <p class="text-xs text-slate-400 font-mono mt-1">{{ $student->nis }}</p>

            <span class="inline-block bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-extrabold mt-3 uppercase tracking-wider">
                {{ $student->registration_status ?? 'Aktif / Terdaftar' }}
            </span>

            <form action="{{ route('student.profil.update') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                @csrf
                <label class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs h-10 rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer shadow-md shadow-emerald-500/10">
                    <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                    <span>Ganti Foto</span>
                    <input type="file" name="photo" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        </div>

        <!-- Ringkasan Informasi Akademik Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm">
            <h4 class="font-extrabold text-slate-800 text-sm border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="book-open" class="w-4 h-4 text-emerald-500"></i>
                <span>Informasi Akademik</span>
            </h4>

            <div class="space-y-4 font-sans text-xs">
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5 uppercase tracking-wide">Nama</span>
                    <span class="font-bold text-slate-700 block leading-tight">{{ $student->full_name }}</span>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5 uppercase tracking-wide">NISN</span>
                    <span class="font-bold text-slate-700 block leading-tight">{{ $student->nisn ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5 uppercase tracking-wide">Gender</span>
                    <span class="font-bold text-slate-700 block leading-tight">{{ $student->gender ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5 uppercase tracking-wide">Alamat</span>
                    <span class="font-bold text-slate-700 block leading-tight">{{ $student->address ?? '-' }}</span>
                </div>
            </div>
        </div>

    </div>

    <!-- RIGHT CONTENT PANEL: Tabs & Detailed Data -->
    <div class="flex-1 space-y-6">

        <!-- TAB NAVIGATION -->
        <div class="bg-white rounded-2xl border border-slate-200/80 p-2 flex gap-1 shadow-sm">
            <button type="button" data-tab-target="pribadi" class="tab-btn flex-1 py-3 px-4 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all bg-emerald-600 text-white shadow-md">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span>Pribadi</span>
            </button>
            <button type="button" data-tab-target="akademik" class="tab-btn flex-1 py-3 px-4 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all text-slate-500 hover:bg-slate-50">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                <span>Akademik</span>
            </button>
            <button type="button" data-tab-target="keluarga" class="tab-btn flex-1 py-3 px-4 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all text-slate-500 hover:bg-slate-50">
                <i data-lucide="users-2" class="w-4 h-4"></i>
                <span>Keluarga</span>
            </button>
        </div>

        <!-- TAB CONTENT BOX -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-7 shadow-sm">

            <!-- TAB: PRIBADI -->
            <div id="tab-content-pribadi" class="tab-pane space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-slate-800 text-base">Biodata Pribadi</h3>
                    <button type="button" onclick="bukaModalEdit()" class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all flex items-center gap-2 shadow-md shadow-amber-500/10">
                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                        <span>Ubah Data</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Informasi Kelahiran</span>
                        <span class="font-bold text-slate-700 block mt-1">
                            {{ $student->birth_place ?? '-' }}, {{ $student->birth_date ? $student->birth_date->format('d F Y') : '-' }}
                        </span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Jenis Kelamin</span>
                        <span class="inline-block bg-rose-50 text-rose-600 border border-rose-100 px-3 py-1 rounded-full text-xs font-bold mt-1">
                            {{ $student->gender ?? '-' }}
                        </span>
                    </div>
                    <div class="py-2 border-b border-slate-50 md:col-span-2">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Alamat Lengkap</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->address ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Kontak Pribadi</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->phone ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Hobi</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->hobby ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- TAB: AKADEMIK -->
            <div id="tab-content-akademik" class="tab-pane space-y-6 hidden">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-slate-800 text-base">Detail Akademik</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama</span>
                        <span class="font-bold text-slate-700 block mt-1">Siswa 1</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Kelas</span>
                        <span class="font-bold text-slate-700 block mt-1">Kelas {{ $student->class->class_name ?? 'N/A' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Status Registrasi</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->registration_status ?? 'Terdaftar' }}</span>
                    </div>
                </div>
            </div>

            <!-- TAB: KELUARGA -->
            <div id="tab-content-keluarga" class="tab-pane space-y-6 hidden">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-slate-800 text-base">Informasi Keluarga</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama Ayah</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->father_name ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama Ibu</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->mother_name ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50 md:col-span-2">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">No. Telepon Orang Tua / Wali</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->parent_phone ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- EDIT PROFILE MODAL -->
<div id="editProfileModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/45 backdrop-blur-sm animate-[fadeIn_0.2s_ease]">
    <div class="bg-white w-[500px] max-w-[92vw] rounded-3xl p-7 shadow-2xl relative">
        <h3 class="text-lg font-extrabold text-slate-800 mb-5 flex items-center gap-2">
            <i data-lucide="edit-3" class="w-5 h-5 text-emerald-500"></i>
            <span>Edit Biodata</span>
        </h3>

        <form action="{{ route('student.profil.update') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="w-full rounded-2xl border border-slate-200 p-3.5 focus:outline-none focus:border-emerald-500 transition-all font-sans text-sm" required>{{ $student->address }}</textarea>
                </div>
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Kontak Pribadi (No. HP)</label>
                    <input type="text" name="phone" value="{{ $student->phone }}" class="w-full h-12 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:border-emerald-500 transition-all font-sans text-sm" required>
                </div>
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Hobi</label>
                    <input type="text" name="hobby" value="{{ $student->hobby }}" class="w-full h-12 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:border-emerald-500 transition-all font-sans text-sm">
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="button" onclick="tutupModalEdit()" class="flex-1 h-12 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 h-12 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-all shadow-md shadow-emerald-500/10">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab switching logic
    document.addEventListener('DOMContentLoaded', function () {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const target = btn.dataset.tabTarget;

                // Deactivate all buttons
                tabBtns.forEach(b => {
                    b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md');
                    b.classList.add('text-slate-500', 'hover:bg-slate-50');
                });

                // Activate clicked button
                btn.classList.add('bg-emerald-600', 'text-white', 'shadow-md');
                btn.classList.remove('text-slate-500', 'hover:bg-slate-50');

                // Hide all panes
                tabPanes.forEach(pane => pane.classList.add('hidden'));

                // Show target pane
                document.getElementById('tab-content-' + target).classList.remove('hidden');
            });
        });
    });

    function bukaModalEdit() {
        const modal = document.getElementById('editProfileModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function tutupModalEdit() {
        const modal = document.getElementById('editProfileModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
