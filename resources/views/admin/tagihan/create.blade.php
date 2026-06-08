@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-3xl">

        {{-- PAGE HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Generate Tagihan Masal</h1>
            <p class="text-sm text-slate-500">Buat tagihan untuk satu kelas atau semua siswa aktif sekaligus.</p>
        </div>

        {{-- FORM --}}
        <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
            <form action="{{ route('admin.tagihan.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Tagihan</label>
                    <select name="payment_type_id" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        <option value="">-- Pilih Tagihan --</option>
                        @foreach ($paymentTypes as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }} - Rp {{ number_format($type->amount,0,',','.') }} ({{ $type->unit ? $type->unit->unit_name : 'Semua Unit' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Periode Bulan / Keterangan</label>
                    <input type="text" name="period" value="{{ old('period', date('F Y')) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all"
                        placeholder="Contoh: Juli 2026">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jatuh Tempo</label>
                    <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-15')) }}" required
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Target Siswa</label>
                    <div class="space-y-2 mt-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="target" value="all" checked class="text-emerald-500 focus:ring-emerald-500" onchange="toggleKelas(false)">
                            <span class="text-sm text-slate-700">Semua Siswa Aktif (Sesuai Unit Tagihan)</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="target" value="class" class="text-emerald-500 focus:ring-emerald-500" onchange="toggleKelas(true)">
                            <span class="text-sm text-slate-700">Spesifik Kelas</span>
                        </label>
                    </div>
                </div>

                <div id="kelasWrapper" class="hidden">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Kelas</label>
                    <select name="class_id"
                        class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->unit->unit_name }} - {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-4 flex items-center gap-3">
                    <a href="{{ route('admin.tagihan.index') }}"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-emerald-500 hover:bg-emerald-600 shadow-sm shadow-emerald-500/20 transition-all">
                        Generate Tagihan
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        function toggleKelas(show) {
            document.getElementById('kelasWrapper').style.display = show ? 'block' : 'none';
        }
    </script>
@endsection
