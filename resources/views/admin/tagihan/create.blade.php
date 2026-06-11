@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-3xl">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.tagihan.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Generate Tagihan Masal</h1>
            </div>
        </div>

        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6">
            <form action="{{ route('admin.tagihan.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Jenis Tagihan</label>
                    <select name="payment_type_id" required
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                        <option value="">-- Pilih Tagihan --</option>
                        @foreach ($paymentTypes as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }} - Rp {{ number_format($type->amount, 0, ',', '.') }} ({{ $type->unit ? $type->unit->unit_name : 'Semua Unit' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Periode Bulan / Keterangan</label>
                    <input type="text" name="period" value="{{ old('period', date('F Y')) }}" required
                        placeholder="Contoh: Juli 2026"
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Jatuh Tempo</label>
                    <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-15')) }}" required
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Target Siswa</label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/30 cursor-pointer hover:border-blue-300 dark:hover:border-blue-700 transition-all">
                            <input type="radio" name="target" value="all" checked class="text-blue-600 focus:ring-blue-500 w-4 h-4" onchange="toggleKelas(false)">
                            <span class="text-sm text-slate-700 dark:text-slate-300 font-medium">Semua Siswa Aktif <span class="text-slate-400 dark:text-slate-500 text-xs">(Sesuai Unit Tagihan)</span></span>
                        </label>
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/30 cursor-pointer hover:border-blue-300 dark:hover:border-blue-700 transition-all">
                            <input type="radio" name="target" value="class" class="text-blue-600 focus:ring-blue-500 w-4 h-4" onchange="toggleKelas(true)">
                            <span class="text-sm text-slate-700 dark:text-slate-300 font-medium">Spesifik Kelas</span>
                        </label>
                    </div>
                </div>

                <div id="kelasWrapper" class="hidden">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Pilih Kelas</label>
                    <select name="class_id"
                        class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->unit->unit_name }} - {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-2 flex items-center gap-3">
                    <button type="submit"
                        class="h-12 px-8 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                        Generate Tagihan
                    </button>
                    <a href="{{ route('admin.tagihan.index') }}"
                        class="h-12 px-8 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                        Batal
                    </a>
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
