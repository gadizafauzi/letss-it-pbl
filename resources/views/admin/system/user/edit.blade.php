@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.user.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/60 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 shadow-sm transition-all" title="Kembali">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Edit User</h1>
        </div>
        @if($user->role !== 'admin')
        <p class="text-[13px] text-slate-500 mt-3 ml-[52px]">
            Mengedit kredensial untuk role: <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">{{ $user->role }}</span>. Biodata lengkap diedit di menu Data {{ ucfirst($user->role) }}.
        </p>
        @endif
    </div>

    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[24px] p-8 shadow-sm">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <i data-lucide="user" class="w-4 h-4 text-blue-500"></i> Informasi Dasar
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required {{ $user->role !== 'admin' ? 'readonly' : '' }}
                               class="w-full h-11 px-4 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl text-sm outline-none transition-all 
                               {{ $user->role !== 'admin' ? 'bg-slate-50 dark:bg-slate-900/50 text-slate-500 cursor-not-allowed shadow-inner' : 'bg-white dark:bg-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                        @error('name')<span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required {{ $user->role !== 'admin' ? 'readonly' : '' }}
                               class="w-full h-11 px-4 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl text-sm outline-none transition-all 
                               {{ $user->role !== 'admin' ? 'bg-slate-50 dark:bg-slate-900/50 text-slate-500 cursor-not-allowed shadow-inner' : 'bg-white dark:bg-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                        @error('username')<span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" {{ $user->role !== 'admin' ? 'readonly' : '' }}
                               class="w-full h-11 px-4 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl text-sm outline-none transition-all 
                               {{ $user->role !== 'admin' ? 'bg-slate-50 dark:bg-slate-900/50 text-slate-500 cursor-not-allowed shadow-inner' : 'bg-white dark:bg-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                        @error('email')<span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Status Akun</label>
                        <div class="relative">
                            <select name="status" class="w-full h-11 pl-4 pr-10 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 cursor-pointer appearance-none transition-all">
                                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Tidak Aktif (Suspend)</option>
                            </select>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-4">
                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2 border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <i data-lucide="lock" class="w-4 h-4 text-emerald-500"></i> Keamanan
                </h3>
                
                <div class="bg-slate-50/50 dark:bg-slate-900/30 border border-slate-200/60 dark:border-slate-700/50 rounded-2xl p-5">
                    <p class="text-[12px] text-slate-500 dark:text-slate-400 mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-slate-400"></i> Kosongkan kolom password jika tidak ingin mengubah sandi.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Password Baru</label>
                            <input type="password" name="password" placeholder="••••••••"
                                   class="w-full h-11 px-4 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-300">
                            @error('password')<span class="text-xs text-red-500 mt-1.5 block font-medium">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                   class="w-full h-11 px-4 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-300">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 mt-2 border-t border-slate-100 dark:border-slate-700/60 flex justify-end">
                <button type="submit" class="h-11 px-8 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-[14px] font-bold rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


