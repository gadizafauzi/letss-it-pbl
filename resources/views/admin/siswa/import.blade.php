@extends('layouts.admin')

@section('content')
<div class="space-y-6 w-full">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('admin.siswa.index') }}"
            class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
            Import Siswa
        </h1>
    </div>

    {{-- CARD --}}
    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm overflow-hidden">

        {{-- PETUNJUK --}}
        <div class="p-6 border-b border-slate-200 dark:border-slate-700/50">
            <h2 class="text-base font-bold text-[var(--theme-primary)] dark:text-blue-400 mb-3">Petunjuk Singkat</h2>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 leading-relaxed">
                Penginputan data siswa bisa dilakukan secara massal dengan mengunggah file Ms. Excel (.xlsx).
                Pastikan format file sesuai dengan template yang disediakan oleh sistem.
                <a href="{{ route('admin.siswa.import.template') }}"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold ml-1 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all no-underline">
                    <i data-lucide="download" class="w-3.5 h-3.5"></i>Download Template
                </a>
            </p>

            <p class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 mt-6">CATATAN PENTING :</p>
            <ol class="text-sm text-slate-600 dark:text-slate-400 space-y-3 list-decimal list-inside bg-slate-50/50 dark:bg-slate-900/30 p-5 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                <li>
                    Pengisian jenis data <strong class="text-slate-800 dark:text-slate-200">TANGGAL</strong> harus menggunakan format
                    <strong class="text-blue-600 dark:text-blue-400">YYYY-MM-DD</strong> (Contoh: <strong class="text-slate-800 dark:text-slate-200">2017-12-21</strong>).
                    <p class="text-[13px] text-slate-500 dark:text-slate-500 ml-5 mt-1">
                        Tips: Blok kolom tanggal di Excel > klik kanan Format Cells > Pilih Date > Sesuaikan format agar tahun berada di depan.
                    </p>
                </li>
                <li>
                    Kolom <strong class="text-slate-800 dark:text-slate-200">NIK</strong> maksimal <strong class="text-blue-600 dark:text-blue-400">16 digit</strong> (opsional/boleh dikosongkan).
                </li>
                <li>
                    Jenis Kelamin cukup diisi dengan huruf <strong class="text-blue-600 dark:text-blue-400">L</strong> (Laki-laki)
                    atau <strong class="text-blue-600 dark:text-blue-400">P</strong> (Perempuan).
                </li>
                <li>
                    Status akademik diisi dengan salah satu opsi berikut: <strong class="text-slate-800 dark:text-slate-200">active, inactive, graduated, transfer, dropout</strong>.
                </li>
            </ol>
        </div>

        {{-- FORM UPLOAD --}}
        <div class="p-6">
            <form action="{{ route('admin.siswa.import.post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="mb-5 px-5 py-4 rounded-2xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-sm text-red-700 dark:text-red-400 flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                        <div>{{ $errors->first('file') }}</div>
                    </div>
                @endif

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">
                        Pilih File Data Siswa (.xlsx, .xls)
                    </label>
                    <input type="file" name="file" accept=".xlsx, .xls"
                        class="block w-full text-sm text-slate-500 dark:text-slate-400
                        file:mr-4 file:py-2.5 file:px-5
                        file:rounded-xl file:border-0
                        file:text-sm file:font-bold
                        file:bg-blue-50 dark:file:bg-blue-500/10 file:text-blue-600 dark:file:text-blue-400
                        hover:file:bg-blue-100 dark:hover:file:bg-blue-500/20 cursor-pointer
                        border border-slate-200 dark:border-slate-700 rounded-2xl bg-slate-50 dark:bg-slate-900/50 p-2">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="h-11 px-8 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold inline-flex items-center justify-center shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all">
                        <i data-lucide="upload-cloud" class="w-4 h-4 mr-2"></i> Proses Import
                    </button>
                    <a href="{{ route('admin.siswa.index') }}"
                        class="h-11 px-8 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
