@extends('layouts.teacher')

@section('content')

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-5 relative overflow-hidden shadow-sm mb-6 flex items-center justify-between bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Profil Guru</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Informasi data diri guru</p>
    </div>
    <button class="relative z-10 h-10 px-4 rounded-xl bg-white/20 hover:bg-white/30 border border-white/30 text-white text-sm font-bold inline-flex items-center gap-2 transition-all shrink-0">
        <i data-lucide="edit-3" class="w-4 h-4"></i>
        Edit Profil
    </button>
</div>

<div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden mb-6 p-0">
    <div class="h-28 bg-[var(--theme-bg-light)]"></div>
    <div class="px-6 pb-6 -mt-10 flex items-end gap-5">
        <div class="w-24 h-24 rounded-2xl bg-white border border-slate-200 shadow-lg flex items-center justify-center text-slate-400">
            <i data-lucide="user-round" class="w-12 h-12"></i>
        </div>

        <div class="pb-2">
            <h2 class="text-xl font-extrabold text-slate-900">
                {{ $teacher->full_name }}
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                @if($homeroomClass)
                    Guru Mata Pelajaran & Wali Kelas {{ $homeroomClass->class_name }}
                @else
                    Guru Mata Pelajaran
                @endif
            </p>

            <div class="flex items-center gap-2 mt-2">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                    {{ strtoupper($teacher->status === 'active' ? 'Aktif' : 'Non-Aktif') }}
                </span>

                @php
                    $tagColors = [
                        ['bg' => 'bg-pink-100', 'text' => 'text-pink-600'],
                        ['bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                        ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
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
                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold">
                        Wali Kelas
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden mb-6 p-0">

    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-slate-100 flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-white">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base">Data Pribadi</h2>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Nama Lengkap</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->full_name }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="badge-check" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">NIP</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->nip }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Pendidikan Terakhir</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->last_education ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="book-open" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Mata Pelajaran Diampu</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $subjects->pluck('subject_name')->implode(', ') ?: '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                <i data-lucide="mail" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Email</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->user->email ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i data-lucide="phone" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Telepon</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->phone ?? '-' }}
                </p>
            </div>
        </div>

        </div>
    </div>
</div>

<div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden p-0 mb-6">

    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-slate-100 flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-white">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base flex items-center gap-2">
            <i data-lucide="lock-keyhole" class="w-5 h-5 text-red-500"></i>
            Keamanan Akun
        </h2>
    </div>

    <div class="p-6">
        <div class="space-y-4">

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Password Lama
            </label>
            <div class="relative">
                <input type="password" id="oldPassword"
                    placeholder="Masukkan password lama"
                    class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]">
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
                <input type="password" id="newPassword"
                    placeholder="Masukkan password baru"
                    class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]">
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
                <input type="password" id="confirmPassword"
                    placeholder="Konfirmasi password baru"
                    class="w-full h-11 rounded-xl border border-slate-200 px-4 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)]">
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

            <button type="button" class="w-full md:flex-1 h-11 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] shadow-sm hover:shadow-md text-white font-bold transition-all">
                Ubah Password
            </button>
        </div>

    </div>
        </div>
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

@endsection
