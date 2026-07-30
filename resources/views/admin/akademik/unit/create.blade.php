@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.unit.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Tambah Unit Pendidikan</h1>
        </div>

        <div class="max-w-xl">
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6">
                <form action="{{ route('admin.unit.store') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                Nama Unit <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="unit_name" value="{{ old('unit_name') }}"
                                placeholder="Contoh: SD Islam, SMP Terpadu..."
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all @error('unit_name') border-red-400 @enderror">
                            @error('unit_name')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <button type="submit"
                                class="w-full sm:w-auto h-12 px-8 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 transition-all border-none cursor-pointer">
                                Simpan
                            </button>
                            <a href="{{ route('admin.unit.index') }}"
                                class="w-full sm:w-auto h-12 px-8 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


