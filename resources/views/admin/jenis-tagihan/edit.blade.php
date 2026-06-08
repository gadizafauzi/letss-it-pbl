@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-3xl">

        {{-- PAGE HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Edit Jenis Tagihan</h1>
            <p class="text-sm text-slate-500">Perbarui komponen tagihan.</p>
        </div>

        {{-- FORM --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <form action="{{ route('admin.jenis-tagihan.update', $paymentType->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Tagihan</label>
                    <input type="text" name="name" value="{{ old('name', $paymentType->name) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Berlaku Untuk Unit</label>
                    <select name="unit_id"
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        <option value="">Semua Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id', $paymentType->unit_id) == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nominal (Rp)</label>
                    <input type="number" name="amount" value="{{ old('amount', $paymentType->amount) }}" required min="0"
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                    @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <a href="{{ route('admin.jenis-tagihan.index') }}"
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
