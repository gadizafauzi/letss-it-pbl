@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.user.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/60 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 shadow-sm transition-all" title="Kembali">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Tambah Admin</h1>
        </div>
    </div>

    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm">
        <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                @error('name')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Username (Unik)</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                @error('username')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email (Opsional)</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                @error('email')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" required
                       class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
                @error('password')<span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full h-[42px] px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-900/50 text-sm outline-none focus:border-sky-400">
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                <button type="submit" class="w-full h-[42px] bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Admin Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


