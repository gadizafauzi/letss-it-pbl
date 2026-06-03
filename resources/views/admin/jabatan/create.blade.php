@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-[28px] font-bold text-slate-800">Tambah Jabatan</h1>

            <a href="{{ route('admin.jabatan.index') }}"
                class="h-11 px-6 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                Kembali
            </a>
        </div>

        <div class="max-w-xl">
            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">

                <form action="{{ route('admin.jabatan.store') }}" method="POST">
                    @csrf

                    <div class="space-y-5">

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nama Jabatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Contoh: Wali Kelas, Kepala Sekolah..."
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm transition-all
                                @error('name') border-red-400 @enderror">

                            @error('name')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit"
                                class="h-12 px-8 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold shadow-lg shadow-blue-100 transition-all">
                                Simpan
                            </button>

                            <a href="{{ route('admin.jabatan.index') }}"
                                class="h-12 px-8 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                                Batal
                            </a>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
