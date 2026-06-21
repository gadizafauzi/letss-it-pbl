@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">
            Profil Saya
        </h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- BAGIAN KIRI: FOTO PROFIL (OPSIONAL/VISUAL SAJA JIKA TIDAK ADA FITUR UPLOAD) --}}
        <div class="col-span-1">
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-3xl font-bold mb-4 shadow-lg">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $user->name }}</h2>
                <span class="inline-block mt-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[11px] font-bold uppercase tracking-wider">
                    {{ $user->role }}
                </span>
                <p class="text-[13px] text-slate-500 mt-4">Bergabung sejak: {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        {{-- BAGIAN KANAN: FORM EDIT & PASSWORD --}}
        <div class="col-span-1 lg:col-span-2 space-y-6">
            
            {{-- FORM INFORMASI PRIBADI --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 border-b border-slate-100 dark:border-slate-700 pb-3 mb-5">Informasi Pribadi</h3>
                
                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                        @error('name')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                        @error('username')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                        @error('email')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="h-[40px] px-6 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-[13px] font-bold rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                            <i data-lucide="save" class="w-3.5 h-3.5"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- FORM UBAH PASSWORD --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 border-b border-slate-100 dark:border-slate-700 pb-3 mb-5">Ubah Password</h3>
                
                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                        @error('current_password')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password Baru</label>
                        <input type="password" name="password" required
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                        @error('password')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="h-[40px] px-6 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-[13px] font-bold rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                            <i data-lucide="lock" class="w-3.5 h-3.5"></i> Perbarui Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection


