@extends('layouts.teacher')

@section('content')

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-5 relative overflow-hidden shadow-sm mb-6 flex items-center justify-between bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-[var(--bg-card)] opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Profil Guru</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Informasi data diri guru</p>
    </div>
    <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" class="relative z-10 h-10 px-4 rounded-xl bg-[var(--bg-card)]/20 hover:bg-[var(--bg-card)]/30 border border-white/30 text-white text-sm font-bold inline-flex items-center gap-2 transition-all shrink-0">
        <i data-lucide="edit-3" class="w-4 h-4"></i>
        Edit Profil
    </button>
</div>

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden mb-6 p-0 text-[var(--text-main)]">
    <div class="h-28 bg-[var(--theme-bg-light)]"></div>
    <div class="px-6 pb-6 -mt-10 flex items-end gap-5">
        <div class="w-24 h-24 rounded-2xl bg-[var(--bg-card)] border border-[var(--border-color)] shadow-lg flex items-center justify-center text-[var(--text-secondary)] overflow-hidden">
            @if($teacher->photo && $teacher->photo !== 'default.png' && $teacher->photo !== 'default.jpg' && $teacher->photo !== 'default_user.png')
                <img src="{{ asset('storage/photos/' . $teacher->photo) }}" alt="Foto Profil" class="w-full h-full object-cover">
            @else
                <i data-lucide="user-round" class="w-12 h-12"></i>
            @endif
        </div>

        <div class="pb-2">
            <h2 class="text-xl font-extrabold text-[var(--text-main)]">
                {{ $teacher->full_name }}
            </h2>

            <p class="text-sm text-[var(--text-secondary)] mt-1">
                @if($homeroomClass)
                    Guru Mata Pelajaran & Wali Kelas {{ $homeroomClass->class_name }}
                @else
                    Guru Mata Pelajaran
                @endif
            </p>

            <div class="flex items-center gap-2 mt-2">
                <span class="bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-bold">
                    {{ strtoupper($teacher->status === 'active' ? 'Aktif' : 'Non-Aktif') }}
                </span>

                @php
                    $tagColors = [
                        ['bg' => 'bg-pink-100', 'text' => 'text-pink-600'],
                        ['bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                        ['bg' => 'bg-purple-100 dark:bg-purple-500/20', 'text' => 'text-purple-600 dark:text-purple-400'],
                        ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-600'],
                    ];
                @endphp
                @foreach ($subjects as $index => $subject)
                    @php
                        $color = $tagColors[$index % count($tagColors)];
                    @endphp
                    <span class="{{ $color['bg'] }} {{ $color['text'] }} px-3 py-1 rounded-full text-xs font-bold">
                        {{ $subject->subject_name }}
                    </span>
                @endforeach

                @if($homeroomClass)
                    <span class="bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 px-3 py-1 rounded-full text-xs font-bold">
                        Wali Kelas
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden mb-6 p-0 text-[var(--text-main)]">

    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)] text-[var(--text-main)]">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base">Data Pribadi</h2>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">Nama Lengkap</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $teacher->full_name }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                <i data-lucide="badge-check" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">NIP</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $teacher->nip }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">Pendidikan Terakhir</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $teacher->last_education ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="book-open" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">Mata Pelajaran Diampu</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $subjects->pluck('subject_name')->implode(', ') ?: '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                <i data-lucide="mail" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">Email</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $teacher->user->email ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i data-lucide="phone" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-[var(--text-secondary)] font-semibold">Telepon</p>
                <p class="text-sm font-bold text-[var(--text-main)]">
                    {{ $teacher->phone ?? '-' }}
                </p>
            </div>
        </div>

        </div>
    </div>
</div>

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden p-0 mb-6 text-[var(--text-main)]">
    <form action="{{ route('profile.password.update') }}" method="POST">
    @csrf
    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)] text-[var(--text-main)]">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base flex items-center gap-2">
            <i data-lucide="lock-keyhole" class="w-5 h-5 text-red-500 dark:text-red-400"></i>
            Keamanan Akun
        </h2>
    </div>

    <div class="p-6">
        <div class="space-y-4">

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Password Lama
            </label>
            <div class="relative">
                <input type="password" id="oldPassword" name="password_lama" required
                    placeholder="Masukkan password lama"
                    class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <button type="button" onclick="togglePassword('oldPassword', 'iconOldPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[var(--text-secondary)] hover:text-[var(--text-secondary)]">
                    <i data-lucide="eye" id="iconOldPassword" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Password Baru
            </label>
            <div class="relative">
                <input type="password" id="newPassword" name="password_baru" required minlength="8"
                    placeholder="Masukkan password baru"
                    class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <button type="button" onclick="togglePassword('newPassword', 'iconNewPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[var(--text-secondary)] hover:text-[var(--text-secondary)]">
                    <i data-lucide="eye" id="iconNewPassword" class="w-5 h-5"></i>
                </button>
            </div>
            <p class="text-xs text-[var(--text-secondary)] mt-2">Password minimal 8 karakter dan sebaiknya mengandung huruf besar, huruf kecil, serta angka.</p>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Konfirmasi Password Baru
            </label>
            <div class="relative">
                <input type="password" id="confirmPassword" name="konfirmasi_password" required minlength="8"
                    placeholder="Konfirmasi password baru"
                    class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <button type="button" onclick="togglePassword('confirmPassword', 'iconConfirmPassword')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-[var(--text-secondary)] hover:text-[var(--text-secondary)]">
                    <i data-lucide="eye" id="iconConfirmPassword" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <div class="rounded-xl bg-yellow-50 border border-yellow-100 px-4 py-3 text-sm text-yellow-700">
            <span class="font-bold">Perhatian:</span>
            Setelah mengubah password, Anda akan logout otomatis dan harus login kembali.
        </div>

        <div class="flex flex-col-reverse md:flex-row items-stretch md:items-center gap-3 pt-2">
            <button type="button" onclick="clearPasswords()" class="w-full md:flex-1 h-11 rounded-xl border border-[var(--border-color)] text-[var(--text-secondary)] font-bold hover:bg-[var(--theme-bg-light)] transition-colors">
                Batal
            </button>

            <button type="submit" class="w-full md:flex-1 h-11 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] shadow-sm hover:shadow-md text-white font-bold transition-all">
                Ubah Password
            </button>
        </div>

    </div>
        </form>
</div>

<script>
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

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-[var(--bg-card)] w-full max-w-lg rounded-2xl shadow-xl border border-[var(--border-color)] overflow-hidden flex flex-col max-h-[90vh]">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-[var(--border-color)] flex justify-between items-center bg-[var(--theme-bg-light)]">
            <h3 class="font-extrabold text-[var(--theme-primary)] text-lg">Edit Profil</h3>
            <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="text-[var(--text-secondary)] hover:text-red-500 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6 overflow-y-auto">
            <form id="editProfileForm" action="{{ route('teacher.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ $teacher->full_name }}" required
                        class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ $teacher->phone }}"
                        class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Pendidikan Terakhir</label>
                    <input type="text" name="last_education" value="{{ $teacher->last_education }}"
                        class="w-full h-11 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Foto Profil (Opsional)</label>
                    <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg"
                        class="w-full rounded-xl border border-[var(--border-color)] text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]
                        file:mr-4 file:py-2.5 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-[var(--theme-bg-light)] file:text-[var(--theme-primary)] hover:file:bg-[var(--theme-primary)] hover:file:text-white file:transition-colors">
                    <p class="text-[11px] text-[var(--text-secondary)] mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-[var(--border-color)] bg-[var(--bg-card)] flex justify-end gap-3">
            <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" type="button" class="px-5 py-2.5 rounded-xl border border-[var(--border-color)] text-[var(--text-secondary)] font-bold hover:bg-[var(--theme-bg-light)] transition-colors">
                Batal
            </button>
            <button onclick="document.getElementById('editProfileForm').submit()" type="button" class="px-5 py-2.5 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold transition-all shadow-sm">
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

@endsection
