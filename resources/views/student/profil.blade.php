@extends('layouts.student')

@section('content')
<div class="flex flex-col lg:flex-row gap-6 font-sans">

    <!-- LEFT SIDEBAR PANEL: Foto & Ringkasan Akademik -->
    <div class="w-full lg:w-[320px] shrink-0 space-y-6">
        
        <!-- Foto Profil Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 md:p-6 text-center shadow-sm relative overflow-hidden">
            <div class="w-28 h-28 mx-auto rounded-full border-4 border-blue-50/50 overflow-hidden shadow-md flex items-center justify-center bg-slate-100 mb-4 relative group">
                @if($student->photo)
                    <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" id="avatarPreview" class="object-cover w-full h-full">
                @else
                    <div class="text-blue-700 text-4xl font-extrabold">
                        {{ strtoupper(substr($student->full_name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <h3 class="font-extrabold text-[var(--theme-primary)] text-lg leading-tight">{{ $student->full_name }}</h3>
            <p class="text-xs text-slate-400 font-mono mt-1">{{ $student->nis }}</p>

            <span class="inline-block bg-[var(--theme-bg-light)] text-[var(--theme-text-light)] px-3 py-1 rounded-full text-[10px] font-extrabold mt-3 uppercase tracking-wider">
                {{ $student->status === 'active' ? 'Aktif' : ucfirst($student->status) }}
            </span>

            <form action="{{ route('student.profil.update') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                @csrf
                <label class="w-full bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold text-xs h-10 rounded-xl transition-all flex items-center justify-center gap-2 cursor-pointer shadow-md shadow-[var(--theme-primary)]/10">
                    <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                    <span>Ganti Foto</span>
                    <input type="file" name="photo" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        </div>

        <!-- Ringkasan Informasi Akademik Card -->
        <div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden">
            <div class="px-5 md:px-6 py-4 md:py-5 border-b border-slate-100 flex items-center gap-3 bg-[var(--theme-bg-light)]">
                <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
                <h4 class="font-extrabold text-[var(--theme-primary)] text-base">Informasi Akademik</h4>
            </div>

            <div class="p-5 md:p-6 space-y-4 font-sans text-xs">
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
                    <span class="font-bold text-slate-700 block leading-tight">{{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}</span>
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
        <div class="bg-white rounded-2xl border border-slate-200/80 p-2 flex gap-1 shadow-sm overflow-x-auto hide-scrollbar">
            <button type="button" data-tab-target="pribadi" class="tab-btn min-w-[120px] flex-1 py-2.5 md:py-3 px-4 rounded-xl text-xs md:text-sm font-bold flex items-center justify-center gap-2 transition-all bg-[var(--theme-primary)] text-white shadow-md">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span>Pribadi</span>
            </button>
            <button type="button" data-tab-target="akademik" class="tab-btn min-w-[120px] flex-1 py-2.5 md:py-3 px-4 rounded-xl text-xs md:text-sm font-bold flex items-center justify-center gap-2 transition-all text-slate-500 hover:bg-slate-50">
                <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                <span>Akademik</span>
            </button>
            <button type="button" data-tab-target="keluarga" class="tab-btn min-w-[120px] flex-1 py-2.5 md:py-3 px-4 rounded-xl text-xs md:text-sm font-bold flex items-center justify-center gap-2 transition-all text-slate-500 hover:bg-slate-50">
                <i data-lucide="users-2" class="w-4 h-4"></i>
                <span>Keluarga</span>
            </button>
        </div>

        <!-- TAB CONTENT BOX -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-5 md:p-7 shadow-sm">

            <!-- TAB: PRIBADI -->
            <div id="tab-content-pribadi" class="tab-pane space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 pt-4 px-5 md:px-7 -mx-5 md:-mx-7 -mt-5 md:-mt-7 bg-[var(--theme-bg-light)] rounded-t-[24px] mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
                        <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Biodata Pribadi</h3>
                    </div>
                    <button type="button" onclick="bukaModalEdit()" class="bg-[var(--theme-primary)] hover:bg-[var(--theme-accent-hover)] text-white font-bold text-xs px-4 py-2 rounded-xl transition-all flex items-center gap-2 shadow-sm">
                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                        <span>Ubah Data</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Informasi Kelahiran</span>
                        <span class="font-bold text-slate-700 block mt-1">
                            {{ $student->birth_place ?? '-' }}, {{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d F Y') : '-' }}
                        </span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Jenis Kelamin</span>
                        <span class="inline-block bg-rose-50 text-rose-600 border border-rose-100 px-3 py-1 rounded-full text-xs font-bold mt-1">
                            {{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}
                        </span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">NIK</span>
                        <span class="font-bold text-slate-700 block mt-1 font-mono tracking-wide">{{ $student->nik ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Kontak Pribadi</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->phone ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50 md:col-span-2">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Alamat Lengkap</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->address ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Hobi</span>
                        <span class="font-bold text-slate-700 block mt-1">{{ $student->hobby ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- TAB: AKADEMIK -->
            <div id="tab-content-akademik" class="tab-pane hidden bg-white space-y-6">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Detail Akademik</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans mt-4">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->full_name }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Kelas</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->currentClass->schoolClass->class_name ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Status Registrasi</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->status === 'active' ? 'Aktif' : ucfirst($student->status) }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">NIS</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->nis ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">NISN</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->nisn ?? '-' }}</span>
                    </div>
                    @if($student->unit)
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Unit Pendidikan</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->unit->unit_name }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- TAB: KELUARGA -->
            <div id="tab-content-keluarga" class="tab-pane hidden bg-white space-y-6">
                <div class="border-b border-slate-100 pb-3">
                    <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Informasi Keluarga</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm font-sans mt-4">
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama Ayah</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->father_name ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">Nama Ibu</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->mother_name ?? '-' }}</span>
                    </div>
                    <div class="py-2 border-b border-slate-50 md:col-span-2">
                        <span class="text-slate-400 text-xs font-semibold block uppercase">No. Telepon Orang Tua / Wali</span>
                        <span class="font-bold text-slate-800 block mt-1">{{ $student->parent_phone ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- SECURITY CARD -->
<div class="bg-white rounded-3xl border border-slate-200/80 p-5 md:p-7 shadow-sm mt-6 font-sans">
    <h2 class="font-extrabold text-[var(--theme-primary)] text-lg mb-5 flex items-center gap-2">
        <i data-lucide="lock-keyhole" class="w-5 h-5 text-red-500"></i>
        Keamanan Akun
    </h2>

    <form action="{{ route('student.profil.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">
                    Password Lama
                </label>
                <div class="relative">
                    <input type="password" id="oldPassword" name="old_password"
                        placeholder="Masukkan password lama"
                        class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]" required>
                    <button type="button" onclick="togglePassword('oldPassword', 'iconOldPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" id="iconOldPassword" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">
                    Password Baru
                </label>
                <div class="relative">
                    <input type="password" id="newPassword" name="new_password"
                        placeholder="Masukkan password baru"
                        class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]" required minlength="8">
                    <button type="button" onclick="togglePassword('newPassword', 'iconNewPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" id="iconNewPassword" class="w-5 h-5"></i>
                    </button>
                </div>
                <p class="text-xs text-slate-400 mt-2">Password minimal 8 karakter dan sebaiknya mengandung huruf besar, huruf kecil, serta angka.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-2">
                    Konfirmasi Password Baru
                </label>
                <div class="relative">
                    <input type="password" id="confirmPassword" name="new_password_confirmation"
                        placeholder="Konfirmasi password baru"
                        class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]" required minlength="8">
                    <button type="button" onclick="togglePassword('confirmPassword', 'iconConfirmPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
                        <i data-lucide="eye" id="iconConfirmPassword" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <div class="rounded-xl bg-yellow-50 border border-yellow-100 px-4 py-3 text-sm text-yellow-700">
                <span class="font-bold">Perhatian:</span>
                Setelah mengubah password, Anda akan logout otomatis dan harus login kembali.
            </div>

            <div class="flex flex-col-reverse md:flex-row items-stretch md:items-center gap-3 pt-2">
                <button type="button" onclick="clearPasswords()" class="w-full md:flex-1 h-11 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-colors">
                    Batal
                </button>

                <button type="submit" class="w-full md:flex-1 h-11 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold transition-colors shadow-md shadow-[var(--theme-primary)]/10">
                    Ubah Password
                </button>
            </div>
        </div>
    </form>
</div>

<!-- EDIT PROFILE MODAL -->
<div id="editProfileModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/45 backdrop-blur-sm animate-[fadeIn_0.2s_ease]">
    <div class="bg-white w-[500px] max-w-[92vw] rounded-3xl p-7 shadow-2xl relative">
        <h3 class="text-lg font-extrabold text-[var(--theme-primary)] mb-5 flex items-center gap-2">
            <i data-lucide="edit-3" class="w-5 h-5 text-blue-700"></i>
            <span>Edit Biodata</span>
        </h3>

        <form action="{{ route('student.profil.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="w-full rounded-2xl border border-slate-200 p-3.5 focus:outline-none focus:border-blue-700 transition-all font-sans text-sm" required>{{ $student->address }}</textarea>
                </div>
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Kontak Pribadi (No. HP)</label>
                    <input type="text" name="phone" value="{{ $student->phone }}" class="w-full h-12 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:border-blue-700 transition-all font-sans text-sm" required>
                </div>
                <div>
                    <label class="text-xs text-slate-400 font-bold uppercase block mb-1">Hobi</label>
                    <input type="text" name="hobby" value="{{ $student->hobby }}" class="w-full h-12 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:border-[var(--theme-primary)] transition-all font-sans text-sm">
                </div>
            </div>

            <div class="flex gap-4 mt-8">
                <button type="button" onclick="tutupModalEdit()" class="flex-1 h-12 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 h-12 rounded-2xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-semibold transition-all shadow-md shadow-[var(--theme-primary)]/10">
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
                    b.classList.remove('bg-[var(--theme-primary)]', 'text-white', 'shadow-md');
                    b.classList.add('text-slate-500', 'hover:bg-slate-50');
                });

                // Activate clicked button
                btn.classList.add('bg-[var(--theme-primary)]', 'text-white', 'shadow-md');
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

    // Toggle Password Visibility Logic
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }

    // Clear Password Inputs Logic
    function clearPasswords() {
        document.getElementById('oldPassword').value = '';
        document.getElementById('newPassword').value = '';
        document.getElementById('confirmPassword').value = '';
        
        // Reset type to password if currently text
        ['oldPassword', 'newPassword', 'confirmPassword'].forEach(id => {
            const input = document.getElementById(id);
            if(input.type === 'text') {
                togglePassword(id, 'icon' + id.charAt(0).toUpperCase() + id.slice(1));
            }
        });
    }
</script>
@endsection
