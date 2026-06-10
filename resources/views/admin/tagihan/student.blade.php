@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div>
            <a href="{{ route('admin.tagihan.index') }}" class="text-sm text-slate-500 hover:text-emerald-600 mb-2 inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Rekap Tagihan
            </a>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Detail Tagihan Siswa</h1>
            <p class="text-sm text-slate-500">Kelola seluruh riwayat tagihan milik <strong class="text-slate-700">{{ $student->full_name }}</strong></p>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-red-100 border border-red-200 text-red-700">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            {{-- PROFIL CARD --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm sticky top-6">
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="w-28 h-28 bg-slate-100 rounded-full flex items-center justify-center mb-4 overflow-hidden border-4 border-emerald-50">
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Foto" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="user" class="w-12 h-12 text-slate-300"></i>
                            @endif
                        </div>
                        <h3 class="font-extrabold text-[19px] text-slate-800 leading-tight mb-1">{{ $student->full_name }}</h3>
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700">{{ $student->nis }}</span>
                            @if($student->status == 'active')
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-100 text-blue-700">Aktif</span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-slate-100 text-slate-600">{{ ucfirst($student->status) }}</span>
                            @endif
                        </div>
                    </div>
                    
                    @php
                        $latestClass = $student->studentClasses->last();
                    @endphp
                    <div class="space-y-4 pt-5 border-t border-slate-100">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-0.5 flex items-center gap-1.5"><i data-lucide="school" class="w-3 h-3"></i> Unit & Kelas</p>
                            <p class="text-[13px] font-bold text-slate-700">{{ $student->unit->unit_name ?? '-' }} &bull; {{ $latestClass?->schoolClass?->class_name ?? 'Belum ada kelas' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-0.5 flex items-center gap-1.5"><i data-lucide="calendar" class="w-3 h-3"></i> Tahun Ajaran</p>
                            <p class="text-[13px] font-semibold text-slate-700">{{ $latestClass?->academicYear?->year ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-0.5 flex items-center gap-1.5"><i data-lucide="phone" class="w-3 h-3"></i> No. HP Siswa</p>
                            <p class="text-[13px] font-semibold text-slate-700">{{ $student->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-0.5 flex items-center gap-1.5"><i data-lucide="users" class="w-3 h-3"></i> Wali Murid ({{ $student->father_name ?? $student->mother_name ?? 'Orang Tua' }})</p>
                            <p class="text-[13px] font-semibold text-slate-700">{{ $student->parent_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 mb-0.5 flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3 h-3"></i> Alamat</p>
                            <p class="text-[13px] font-semibold text-slate-700 leading-relaxed">{{ $student->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLE INVOICES --}}
            <div class="lg:col-span-3">
                <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <h2 class="text-[15px] font-extrabold text-slate-700 uppercase tracking-wider">Rekapitulasi Tagihan</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[700px] border-collapse">
                            <thead>
                                <tr class="bg-white border-b-[1.5px] border-slate-100">
                                    @foreach (['Jenis Tagihan', 'Periode', 'Jatuh Tempo', 'Nominal', 'Status', 'Aksi'] as $h)
                                        <th class="px-5 py-4 text-left text-[11px] font-extrabold uppercase tracking-[.08em] text-slate-400 whitespace-nowrap">
                                            {{ $h }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                    <tr class="border-b border-slate-50 hover:bg-slate-50/80 transition-colors">
                                        <td class="px-5 py-4 text-[14px] text-slate-800 font-bold">
                                            {{ $invoice->payment_type }}
                                        </td>
                                        <td class="px-5 py-4 text-[13px] text-slate-600 font-medium">
                                            {{ $invoice->period }}
                                        </td>
                                        <td class="px-5 py-4 text-[13px] text-slate-600">
                                            {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                                        </td>
                                        <td class="px-5 py-4 text-[14px] font-extrabold text-slate-800">
                                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-5 py-4">
                                            @if ($invoice->status == 'paid')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-emerald-100 text-emerald-700">Lunas</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-red-100 text-red-700">Belum Lunas</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <a href="{{ route('admin.tagihan.show', $invoice->id) }}"
                                                class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-[13px] font-bold transition-all shadow-sm
                                                {{ $invoice->status == 'paid' ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                                                <i data-lucide="{{ $invoice->status == 'paid' ? 'eye' : 'banknote' }}" class="w-4 h-4"></i>
                                                {{ $invoice->status == 'paid' ? 'Detail' : 'Bayar / Verifikasi' }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="flex flex-col items-center justify-center py-20 text-center">
                                                <div class="w-16 h-16 bg-slate-50 rounded-full inline-flex items-center justify-center mb-4 text-slate-300">
                                                    <i data-lucide="receipt" class="w-8 h-8"></i>
                                                </div>
                                                <p class="text-[16px] font-extrabold text-slate-800 mb-1.5">Belum ada tagihan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($invoices->hasPages())
                        <div class="px-6 py-5 border-t border-slate-100 bg-slate-50/30">
                            {{ $invoices->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
