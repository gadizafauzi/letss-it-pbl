@extends('layouts.admin')

@section('content')
<div class="space-y-6 w-full">

    {{-- PAGE TITLE --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.guru.index') }}"
            class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition">
            <i data-lucide="arrow-left" class="w-4 h-4 text-slate-600"></i>
        </a>
        <h1 class="text-[28px] font-bold text-slate-800">Import Guru</h1>
    </div>

    {{-- CARD --}}
    <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

        {{-- PETUNJUK --}}
        <div class="p-6 border-b border-slate-100">
            <h2 class="font-bold text-slate-800 mb-3">Petunjuk Singkat</h2>
            <p class="text-sm text-slate-600 mb-4">
                Penginputan data guru bisa dilakukan dengan mengcopy data dari file Ms. Excel.
                Format file harus sesuai kebutuhan aplikasi.
                <a href="{{ route('admin.guru.import.template') }}"
                    class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold ml-1 transition">
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
                    Jenis kelamin diisi dengan <strong>male</strong> (Laki-laki)
                    atau <strong>female</strong> (Perempuan)
                </li>
                <li>
                    Status kepegawaian diisi dengan: <strong>pegawai_tetap</strong>
                    atau <strong>pegawai_tidak_tetap</strong>
                </li>
                <li>
                    Status diisi dengan: <strong>active</strong> atau <strong>inactive</strong>
                </li>
                <li>
                    Kolom <strong>Unit</strong> dan <strong>Jabatan</strong> diisi sesuai nama yang
                    sudah terdaftar di sistem (jika tidak ditemukan akan dikosongkan)
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
                        Masukkan File (.csv)
                    </label>
                    <input type="file"
                           name="file"
                           accept=".csv"
                           class="block w-full text-sm text-slate-600
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-xl file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100 cursor-pointer">
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="h-11 px-6 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold inline-flex items-center justify-center shadow-lg shadow-blue-100 transition-all">
                        Import
                    </button>
                    <a href="{{ route('admin.guru.index') }}"
                        class="h-11 px-6 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                        Kembali
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
