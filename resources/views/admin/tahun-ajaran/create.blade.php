@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.tahun-ajaran.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Tambah Tahun Ajaran</h1>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-9">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6 space-y-6">

                        {{-- TAHUN AJARAN --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tahun Ajaran</label>
                            <input type="text" name="year" value="{{ old('year') }}" placeholder="Contoh: 2025/2026"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                            @error('year')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- SEMESTER AKTIF --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Semester Aktif</label>
                            <select name="active_semester"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Semester</option>
                                <option value="odd" {{ old('active_semester') == 'odd' ? 'selected' : '' }}>Ganjil</option>
                                <option value="even" {{ old('active_semester') == 'even' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('active_semester')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- DIVIDER --}}
                        <div class="border-t border-slate-100 dark:border-slate-700/50 pt-5">
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4">Semester Ganjil</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm text-slate-600 dark:text-slate-400 mb-2">Tanggal Mulai</label>
                                    <input type="date" name="start_odd" value="{{ old('start_odd') }}"
                                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    @error('start_odd')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm text-slate-600 dark:text-slate-400 mb-2">Tanggal Selesai</label>
                                    <input type="date" name="end_odd" value="{{ old('end_odd') }}"
                                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    @error('end_odd')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 dark:border-slate-700/50 pt-5">
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4">Semester Genap</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm text-slate-600 dark:text-slate-400 mb-2">Tanggal Mulai</label>
                                    <input type="date" name="start_even" value="{{ old('start_even') }}"
                                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    @error('start_even')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm text-slate-600 dark:text-slate-400 mb-2">Tanggal Selesai</label>
                                    <input type="date" name="end_even" value="{{ old('end_even') }}"
                                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    @error('end_even')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-3xl shadow-sm p-5 space-y-3 sticky top-6">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                            Simpan
                        </button>
                        <a href="{{ route('admin.tahun-ajaran.index') }}"
                            class="w-full h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                            Batal
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
