@extends('layouts.admin')

@section('content')
<div class="space-y-6 w-full">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('admin.guru.index') }}"
            class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
            Import Guru
        </h1>
    </div>

    {{-- CARD --}}
    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] overflow-hidden shadow-sm">

        {{-- PETUNJUK --}}
        <div class="p-6 border-b border-slate-100">
            <h2 class="font-bold text-[var(--theme-primary)] mb-3">Petunjuk Singkat</h2>
            <p class="text-sm text-slate-600 mb-4">
                Penginputan data guru bisa dilakukan dengan mengcopy data dari file Ms. Excel.
                Format file harus sesuai kebutuhan aplikasi.
                <a href="{{ route('admin.guru.import.template') }}"
                    class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] text-white text-xs font-semibold ml-1 transition no-underline hover:opacity-90">
                    <i data-lucide="download" class="w-3 h-3"></i>
                    Download Template
                </a>
            </p>

            <p class="text-sm font-bold text-slate-700 mb-2">CATATAN :</p>
            <ol class="text-sm text-slate-600 space-y-1 list-decimal list-inside">
                <li>
                    Pengisian jenis data <strong>TANGGAL</strong> diisi dengan format
                    <strong>YYYY-MM-DD</strong> Contoh <strong>1985-01-01</strong><br>
                    <span class="text-slate-400 ml-4">
                        Cara ubah: blok semua tanggal, pilih format cell di excel,
                        ganti dengan format date pilih yang tahunnya di depan
                    </span>
                </li>
                <li>
                    Jenis kelamin diisi dengan <strong>L</strong> (Laki-laki)
                    atau <strong>P</strong> (Perempuan)
                </li>
                <li>
                    Status kepegawaian diisi dengan: <strong>pegawai_tetap</strong>
                    atau <strong>pegawai_tidak_tetap</strong>
                </li>
                <li>
                    Status diisi dengan: <strong>active</strong> atau <strong>inactive</strong>
                </li>
                <li>
                    Kolom <strong>ID Unit</strong> dan <strong>ID Jabatan</strong> diisi dengan <strong>Angka ID</strong> yang
                    sesuai di sistem (misal: 1, 2, 3). Kosongkan jika belum diketahui.
                </li>
            </ol>
        </div>

        {{-- FORM UPLOAD --}}
        <div class="p-6">
            <form action="{{ route('admin.guru.import.post') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="mb-5 px-5 py-4 rounded-2xl bg-red-50 border border-red-200 text-sm text-red-700">
                        {{ $errors->first('file') }}
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">
                    Masukkan File (.xlsx)
                    </label>
                    <input type="file"
                           name="file"
                           accept=".xlsx, .xls"
                           class="block w-full text-sm text-slate-600
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-xl file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100 cursor-pointer">
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="h-[42px] px-6 rounded-xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 inline-flex items-center justify-center transition-all border-none cursor-pointer">
                        Import
                    </button>
                    <a href="{{ route('admin.guru.index') }}"
                        class="h-[42px] px-6 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                        Kembali
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
