@extends('layouts.student')

@section('content')
<div class="space-y-6">

    <!-- Top Cards: Kelas, Mapel, Rata-rata -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <x-student.stat-card 
            title="Kelas Saat Ini" 
            value="{{ $student->class->class_name ?? '-' }}" 
            icon="graduation-cap" 
            color="emerald" 
        />
        <x-student.stat-card 
            title="Jumlah Mapel" 
            value="10" 
            icon="backpack" 
            color="indigo" 
        />
        <x-student.stat-card 
            title="Rata-rata Nilai" 
            value="85.5" 
            icon="award" 
            color="emerald" 
        />
    </div>

    <!-- Grid Atas: Biodata Akademik & Informasi Keuangan -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- BIODATA AKADEMIK -->
        <div class="bg-white rounded-[24px] border border-slate-200/80 p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between min-h-[250px]">
            <div>
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-base">Biodata Akademik</h3>
                </div>

                <div class="space-y-3 font-sans mt-2">
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Nama</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->full_name }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Kelas</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->class->class_name ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Status Registrasi</span>
                        <span class="font-bold text-emerald-600 text-sm">{{ $student->registration_status ?? 'Terdaftar' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold uppercase">NISN</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->nisn ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1 border-b border-slate-50">
                        <span class="text-slate-400 text-xs font-semibold uppercase">NIS</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->nis ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Gender</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->gender ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMASI KEUANGAN -->
        <div class="bg-slate-900 text-white rounded-[24px] p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between min-h-[250px] relative overflow-hidden">
            <!-- Decorative circle backgrounds -->
            <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-white/5 pointer-events-none"></div>
            <div class="absolute -left-10 -bottom-10 w-28 h-28 rounded-full bg-white/5 pointer-events-none"></div>

            <div>
                <div class="flex items-center gap-3 border-b border-white/10 pb-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-400">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-white text-base">Informasi Keuangan</h3>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                        <span class="text-slate-400 text-xs font-semibold uppercase block mb-1">Tagihan Saat Ini</span>
                        <span class="text-lg font-black text-amber-400">Rp {{ number_format($tagihanSaatIni, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-white/5 rounded-2xl p-4 border border-white/10">
                        <span class="text-slate-400 text-xs font-semibold uppercase block mb-1">Total Terbayar</span>
                        <span class="text-lg font-black text-emerald-400">Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            <div class="mt-6">
                <a href="{{ route('student.tagihan') }}" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm h-12 rounded-2xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/20">
                    <span>Lihat Detail Tagihan</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Grid Bawah: Kartu Mahasiswa & Grafik IP -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- KARTU PELAJAR -->
        <div class="bg-white rounded-[24px] border border-slate-200/80 p-7 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <i data-lucide="contact-2" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-base">Kartu Pelajar</h3>
                </div>
                <a href="{{ route('student.cetak-ktm') }}" target="_blank" class="bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-500 font-bold text-xs px-4 py-2 rounded-xl transition-all flex items-center gap-2">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                    <span>Cetak Kartu</span>
                </a>
            </div>

            <!-- Card Graphic component -->
            <div class="w-full max-w-[420px] mx-auto h-[260px] bg-gradient-to-br from-emerald-500 via-indigo-600 to-purple-700 text-white rounded-3xl p-5 relative shadow-xl flex flex-col justify-between overflow-hidden border border-indigo-400">
                <div class="absolute -right-10 -bottom-10 w-36 h-36 rounded-full bg-white/5 pointer-events-none"></div>

                <!-- Card Header -->
                <div class="flex items-center gap-3 border-b border-white/20 pb-2.5">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center p-1 shrink-0">
                        <!-- Placeholder logo for school -->
                        <div class="w-full h-full bg-indigo-100 rounded text-indigo-500 flex items-center justify-center font-bold text-[10px]">SD</div>
                    </div>
                    <div>
                        <h4 class="text-[9px] font-bold uppercase tracking-wider leading-none">Kartu Tanda Pelajar</h4>
                        <h3 class="text-xs font-black uppercase leading-none mt-0.5">Sekolah Dasar Negeri</h3>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="flex justify-between items-center mt-2.5">
                    <div class="space-y-2.5 max-w-[240px]">
                        <div>
                            <span class="text-[8px] text-indigo-200 uppercase font-semibold block leading-none">Nama Lengkap</span>
                            <span class="text-sm font-extrabold block leading-tight truncate">{{ $student->full_name }}</span>
                        </div>
                        <div class="flex gap-4">
                            <div>
                                <span class="text-[8px] text-indigo-200 uppercase font-semibold block leading-none">Kelas</span>
                                <span class="text-xs font-bold block leading-none mt-0.5">{{ $student->class->class_name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[8px] text-indigo-200 uppercase font-semibold block leading-none">Gender</span>
                                <span class="text-xs font-bold block leading-none mt-0.5">{{ $student->gender ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div>
                                <span class="text-[8px] text-indigo-200 uppercase font-semibold block leading-none">NISN</span>
                                <span class="text-[11px] font-semibold block leading-tight text-slate-100 truncate mt-0.5">{{ $student->nisn ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[8px] text-indigo-200 uppercase font-semibold block leading-none">Tanggal Lahir</span>
                                <span class="text-[11px] font-semibold block leading-tight text-slate-100 truncate mt-0.5">{{ $student->birth_date ? $student->birth_date->format('d/m/Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Portrait frame -->
                    <div class="w-20 h-28 bg-white/20 border-2 border-white/40 rounded-xl overflow-hidden shrink-0 shadow-md flex items-center justify-center">
                        @if($student->photo)
                            <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" class="object-cover w-full h-full">
                        @else
                            <div class="text-white text-2xl font-bold opacity-60">
                                {{ strtoupper(substr($student->full_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="text-[8px] text-white/50 text-right border-t border-white/10 pt-2 font-mono">
                    https://www.pnp.ac.id
                </div>
            </div>
        </div>

        <!-- GRAFIK RATA-RATA NILAI -->
        <div class="bg-white rounded-[24px] border border-slate-200/80 p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                    <i data-lucide="line-chart" class="w-5 h-5"></i>
                </div>
                <h3 class="font-extrabold text-slate-800 text-base">Grafik Rata-rata Nilai per Semester</h3>
            </div>

            <div class="relative h-[250px] w-full">
                <canvas id="ipChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('ipChart').getContext('2d');
        const ipChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    @php
    $gpaHistory = $student->gpa_history ?? [0, 0, 0, 0, 0, 0, 0, 0];
@endphp

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('ipChart').getContext('2d');

        const ipChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'],
                datasets: [{
                    label: 'Rata-rata Nilai',
                    data: @json($gpaHistory),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.06)',
                    tension: 0.35,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#1e293b',
                        titleColor: '#94a3b8',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 12,
                        bodyFont: {
                            family: 'Plus Jakarta Sans',
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 100,
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            stepSize: 10,
                            font: {
                                family: 'Plus Jakarta Sans'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Plus Jakarta Sans'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
