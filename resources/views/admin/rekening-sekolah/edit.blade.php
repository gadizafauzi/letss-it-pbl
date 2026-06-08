@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-3xl">

        {{-- PAGE HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Edit Rekening</h1>
            <p class="text-sm text-slate-500">Perbarui data rekening sekolah.</p>
        </div>

        {{-- FORM --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <form action="{{ route('admin.rekening-sekolah.update', $schoolAccount->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Bank</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $schoolAccount->bank_name) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                    @error('bank_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Rekening</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $schoolAccount->account_number) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                    @error('account_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Atas Nama</label>
                    <input type="text" name="account_name" value="{{ old('account_name', $schoolAccount->account_name) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                    @error('account_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="w-4 h-4 text-emerald-500 rounded border-slate-300 focus:ring-emerald-500" {{ $schoolAccount->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm font-medium text-slate-700">Aktifkan Rekening Ini</label>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <a href="{{ route('admin.rekening-sekolah.index') }}"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-emerald-500 hover:bg-emerald-600 shadow-sm shadow-emerald-500/20 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
