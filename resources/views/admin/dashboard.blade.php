@extends('layouts.admin')

@section('content')
    {{-- PAGE TITLE --}}
    <div class="mb-6">
        <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
            Dashboard
        </h1>
        <p class="text-sm text-slate-400 mt-1">Selamat datang kembali, Admin</p>
    </div>

    {{-- STATS SECTION --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-10">
        <x-admin.stats-card title="Total Siswa" value="{{ $stats['totalSiswa'] }}" icon="graduation-cap" color="text-blue-500 dark:text-blue-400"
            bg="bg-blue-50 dark:bg-blue-900/40" />

        <x-admin.stats-card title="Total Guru" value="{{ $stats['totalGuru'] }}" icon="badge-check" color="text-indigo-500 dark:text-indigo-400"
            bg="bg-indigo-50 dark:bg-indigo-900/40" />

        <x-admin.stats-card title="Total Kelas" value="{{ $stats['totalKelas'] }}" icon="school" color="text-sky-500 dark:text-sky-400"
            bg="bg-sky-50 dark:bg-sky-900/40" />

        <x-admin.stats-card title="Total Pembayaran" value="Rp {{ number_format($stats['totalPembayaran'], 0, ',', '.') }}" icon="wallet" color="text-emerald-500 dark:text-emerald-400"
            bg="bg-emerald-50 dark:bg-emerald-900/40" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- GRAFIK KEUANGAN --}}
        <div class="lg:col-span-2 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-7 shadow-sm flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-800 dark:text-slate-100">
                        Grafik Pendapatan
                    </h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Statistik keuangan bulanan di tahun {{ $stats['currentYear'] }}
                    </p>
                </div>
            </div>
            <div class="flex-1 w-full min-h-[300px]" id="revenueChart"></div>
        </div>

        {{-- ACTIVITY --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-7 shadow-sm">
            <h3 class="text-xl font-semibold text-slate-800 dark:text-slate-100 mb-1">
                Aktivitas Terbaru
            </h3>
            <p class="text-sm text-slate-500 mb-6">
                Pembayaran tervalidasi terbaru
            </p>

            <div class="space-y-5">
                @forelse($stats['recentActivities'] as $activity)
                    <div class="flex gap-4">
                        <div class="relative flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 z-10 shrink-0">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </div>
                            @if (!$loop->last)
                                <div class="w-[2px] h-full bg-slate-100 dark:bg-slate-700 absolute top-10"></div>
                            @endif
                        </div>
                        <div class="pb-2">
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-100 mb-0.5">
                                {{ $activity->invoice->student->full_name ?? 'Siswa' }}
                            </p>
                            <p class="text-xs text-slate-500 mb-1">
                                Pembayaran <span class="font-semibold text-slate-600 dark:text-slate-400">{{ $activity->invoice->payment_type ?? 'Tagihan' }}</span> (Rp {{ number_format($activity->invoice->amount ?? 0, 0, ',', '.') }})
                            </p>
                            <p class="text-[11px] text-slate-400 flex items-center gap-1">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                {{ \Carbon\Carbon::parse($activity->updated_at)->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center mx-auto mb-3 text-slate-400">
                            <i data-lucide="inbox" class="w-6 h-6"></i>
                        </div>
                        <p class="text-sm text-slate-500">Belum ada aktivitas pembayaran.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Pendapatan',
                    data: @json($stats['chartData'])
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    fontFamily: 'Inter, sans-serif',
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#10b981'], // emerald-500
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    labels: {
                        style: { colors: '#64748b', fontSize: '12px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            if (value >= 1000000) {
                                return "Rp " + (value / 1000000).toFixed(1) + " Jt";
                            }
                            return "Rp " + value.toLocaleString('id-ID');
                        },
                        style: { colors: '#64748b', fontSize: '12px' }
                    }
                },
                grid: {
                    borderColor: 'rgba(148, 163, 184, 0.1)',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } }
                },
                tooltip: {
                    theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
                    y: {
                        formatter: function (val) {
                            return "Rp " + val.toLocaleString('id-ID')
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        });
    </script>
@endsection
