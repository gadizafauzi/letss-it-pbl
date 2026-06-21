@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.jenis-tagihan.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Edit Jenis Tagihan</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Perbarui komponen tagihan.</p>
            </div>
        </div>

        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6">
            <form action="{{ route('admin.jenis-tagihan.update', $paymentType->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Tagihan</label>
                    <input type="text" name="name" value="{{ old('name', $paymentType->name) }}" required
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Berlaku Untuk Unit</label>
                    <select name="unit_id"
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                        <option value="">Semua Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id', $paymentType->unit_id) == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nominal (Rp)</label>
                    <input type="number" name="amount" value="{{ old('amount', $paymentType->amount) }}" required min="0"
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                    @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit"
                        class="h-12 px-8 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.jenis-tagihan.index') }}"
                        class="h-12 px-8 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection


