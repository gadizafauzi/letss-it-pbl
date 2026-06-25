@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.tagihan.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline shrink-0">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100 tracking-tight mb-0.5">Detail Tagihan Siswa</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Kelola seluruh riwayat tagihan milik <strong class="text-slate-700 dark:text-slate-200">{{ $student->full_name }}</strong></p>
            </div>
        </div>

        {{-- SUCCESS --}}

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            {{-- PROFIL CARD --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl p-6 shadow-sm sticky top-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="w-28 h-28 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4 overflow-hidden border-4 border-emerald-50 dark:border-slate-600">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Foto" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="user" class="w-12 h-12 text-slate-300 dark:text-slate-500"></i>
                            @endif
                        </div>
                        <h3 class="font-extrabold text-[19px] text-slate-800 dark:text-slate-100 leading-tight mb-1">{{ $student->full_name }}</h3>
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">{{ $student->nis }}</span>
                            @if($student->status == 'active')
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">Aktif</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">{{ ucfirst($student->status) }}</span>
                            @endif
                        </div>
                    </div>
                    
                    @php
                        $latestClass = $student->studentClasses->last();
                    @endphp
                    <div class="space-y-4 pt-5 border-t border-slate-100 dark:border-slate-700">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 mb-0.5 flex items-center gap-1.5"><i data-lucide="school" class="w-3 h-3"></i> Unit & Kelas</p>
                            <p class="text-[13px] font-bold text-slate-700 dark:text-slate-300">{{ $student->unit->unit_name ?? '-' }} &bull; {{ $latestClass?->schoolClass?->class_name ?? 'Belum ada kelas' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 mb-0.5 flex items-center gap-1.5"><i data-lucide="calendar" class="w-3 h-3"></i> Tahun Ajaran</p>
                            <p class="text-[13px] font-semibold text-slate-700 dark:text-slate-300">{{ $latestClass?->academicYear?->year ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 mb-0.5 flex items-center gap-1.5"><i data-lucide="phone" class="w-3 h-3"></i> No. HP Siswa</p>
                            <p class="text-[13px] font-semibold text-slate-700 dark:text-slate-300">{{ $student->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 mb-0.5 flex items-center gap-1.5"><i data-lucide="users" class="w-3 h-3"></i> Wali Murid ({{ $student->father_name ?? $student->mother_name ?? 'Orang Tua' }})</p>
                            <p class="text-[13px] font-semibold text-slate-700 dark:text-slate-300">{{ $student->parent_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 dark:text-slate-500 mb-0.5 flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3 h-3"></i> Alamat</p>
                            <p class="text-[13px] font-semibold text-slate-700 dark:text-slate-300 leading-relaxed">{{ $student->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLE INVOICES --}}
            <div class="lg:col-span-3">
                <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl overflow-hidden shadow-sm">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 flex justify-between items-center">
                        <h2 class="text-[15px] font-extrabold text-slate-700 dark:text-slate-200 uppercase tracking-wider">Rekapitulasi Tagihan</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[700px] border-collapse">
                            <thead>
                                <tr class="bg-white dark:bg-slate-800 border-b-[1.5px] border-slate-100 dark:border-slate-700">
                                    @foreach (['Jenis Tagihan', 'Periode', 'Jatuh Tempo', 'Nominal', 'Status', 'Aksi'] as $h)
                                        <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[.08em] text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                            {{ $h }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr class="border-b border-slate-50 dark:border-slate-700/50 hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors">
                                        <td class="px-5 py-4 text-[14px] text-slate-800 dark:text-slate-200 font-bold">
                                            {{ $invoice->payment_type }}
                                        </td>
                                        <td class="px-5 py-4 text-[13px] text-slate-600 dark:text-slate-400 font-medium">
                                            {{ $invoice->period }}
                                        </td>
                                        <td class="px-5 py-4 text-[13px] text-slate-600 dark:text-slate-400">
                                            {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                                        </td>
                                        <td class="px-5 py-4 text-[14px] font-extrabold text-slate-800 dark:text-slate-200">
                                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-5 py-4">
                                            @if ($invoice->status == 'paid')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400">Lunas</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400">Belum Lunas</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.tagihan.show', $invoice->id) }}"
                                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-[13px] font-bold transition-all shadow-sm
                                                    {{ $invoice->status == 'paid' ? 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                                                    <i data-lucide="{{ $invoice->status == 'paid' ? 'eye' : 'banknote' }}" class="w-4 h-4"></i>
                                                    {{ $invoice->status == 'paid' ? 'Detail' : 'Bayar' }}
                                                </a>

                                                <!-- 1. Tombol Kirim WA Satuan -->
                                                @if ($invoice->status == 'unpaid')
                                                    <form id="wa-form-{{ $invoice->id }}" action="{{ route('admin.tagihan.kirim-wa', $invoice->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button" onclick="openWaModal('{{ $invoice->id }}')"
                                                            class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-[13px] font-bold transition-all shadow-sm bg-green-500 text-white hover:bg-green-600"
                                                            title="Kirim Tagihan via WA">
                                                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                                                            WA
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="flex flex-col items-center justify-center py-20 text-center">
                                                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-700/50 rounded-full inline-flex items-center justify-center mb-4 text-slate-300 dark:text-slate-500">
                                                    <i data-lucide="receipt" class="w-8 h-8"></i>
                                                </div>
                                                <p class="text-[16px] font-extrabold text-slate-800 dark:text-slate-200 mb-1.5">Belum ada tagihan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($invoices->hasPages())
                        <div class="px-6 py-5 border-t border-slate-100 dark:border-slate-700 bg-slate-50/30 dark:bg-slate-800/30">
                            {{ $invoices->links() }}
                        </div>
                    @endif
                </div>
            </div>

<!-- 2. Modal Konfirmasi & Script -->
<div id="waModal" class="fixed inset-0 z-[70] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-[2px] transition-opacity">
    <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 w-full max-w-sm shadow-2xl border border-slate-200 dark:border-slate-700 transform transition-all text-center">
        <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-500/20 text-green-500 flex items-center justify-center mx-auto mb-5">
            <i data-lucide="message-circle" class="w-8 h-8"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Kirim Pesan WA?</h3>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-8 leading-relaxed">
            Apakah Anda yakin ingin mengirim pesan pengingat tagihan ini ke WhatsApp orang tua siswa?
        </p>
        <div class="flex gap-3 justify-center">
            <button type="button" onclick="closeWaModal()"
                class="h-11 px-6 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold transition-all">
                Batal
            </button>
            <button type="button" onclick="confirmWa()"
                class="h-11 px-6 rounded-2xl bg-green-600 hover:bg-green-700 text-white font-bold shadow-md shadow-green-500/20 hover:shadow-lg hover:shadow-green-500/30 transition-all">
                Ya, Kirim
            </button>
        </div>
    </div>
</div>
<script>
    let waFormToSubmit = null;
    function openWaModal(invoiceId) {
        waFormToSubmit = document.getElementById('wa-form-' + invoiceId);
        const modal = document.getElementById('waModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeWaModal() {
        const modal = document.getElementById('waModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        waFormToSubmit = null;
    }
    function confirmWa() {
        if(waFormToSubmit) waFormToSubmit.submit();
    }
</script>

@endsection


