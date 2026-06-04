@extends('layouts.student')

@php
    $unitName = strtolower($student->unit->unit_name ?? 'sd');
@endphp

@section('content')
<div class="space-y-6">

    <!-- Banner Sambutan -->
    <div class="w-full box-border rounded-[20px] p-4 md:p-6 flex flex-col md:flex-row md:items-center justify-between relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)] gap-4">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
        <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
        <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
        <div class="relative z-10 text-white w-full">
            <h2 class="text-lg md:text-2xl font-extrabold mb-1">Hai, {{ explode(' ', $student->full_name)[0] }}! <span class="wave">👋</span></h2>
            <p class="text-blue-100 text-xs md:text-sm font-medium leading-snug max-w-xl">
                Selamat datang kembali. Pantau informasi akademik dan tagihanmu dengan mudah.
            </p>
        </div>
    </div>

    <!-- Top Cards: Kelas, Mapel, Rata-rata -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
        <x-student.stat-card 
            title="Kelas Saat Ini" 
            value="{{ $student->currentClass->schoolClass->class_name ?? '-' }}" 
            icon="graduation-cap" 
            color="red" 
        />
        <x-student.stat-card 
            title="Jumlah Mapel" 
            value="{{ $jumlahMapel > 0 ? $jumlahMapel : '-' }}" 
            icon="backpack" 
            color="amber" 
        />
        <x-student.stat-card 
            title="Rata-rata Nilai" 
            value="{{ $rataRataNilai }}" 
            icon="award" 
            color="emerald" 
        />
    </div>

    <!-- Baris Atas: Biodata Akademik & Informasi Keuangan -->
    <div class="flex flex-col gap-4 md:gap-6">

        <!-- BIODATA AKADEMIK -->
        <div class="bg-[var(--theme-bg-light)] rounded-[24px] border border-[var(--theme-border-light)] p-5 md:p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between w-full h-full">
            <div>
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white text-[var(--theme-primary)] shadow-sm flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Biodata Akademik</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1 font-sans mt-2">
                    <div class="flex items-center justify-between py-2 border-b border-slate-100/60">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Nama</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->full_name }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-100/60">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Kelas</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->currentClass->schoolClass->class_name ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-100/60">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Status Registrasi</span>
                        <span class="font-bold text-[var(--theme-primary)] text-sm">{{ $student->status === 'active' ? 'Aktif' : ucfirst($student->status) }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-100/60">
                        <span class="text-slate-400 text-xs font-semibold uppercase">NISN</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->nisn ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-slate-100/60 md:border-b-0">
                        <span class="text-slate-400 text-xs font-semibold uppercase">NIS</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->nis ?? '-' }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-slate-400 text-xs font-semibold uppercase">Gender</span>
                        <span class="font-bold text-slate-700 text-sm">{{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMASI KEUANGAN -->
        <div class="bg-[#ffffff] text-slate-800 rounded-[24px] border border-[#dbe4f0] p-5 md:p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between w-full h-full relative overflow-hidden">
            <!-- Decorative circle backgrounds -->
            <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-[var(--theme-bg-light)] opacity-50 pointer-events-none"></div>
            <div class="absolute -left-10 -bottom-10 w-28 h-28 rounded-full bg-[var(--theme-bg-light)] opacity-50 pointer-events-none"></div>

            <div>
                <div class="flex items-center gap-3 border-b border-[#e2e8f0] pb-4 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-[var(--theme-bg-light)] flex items-center justify-center text-[var(--theme-primary)]">
                        <i data-lucide="wallet" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Informasi Keuangan</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-[#f8fafc] rounded-2xl p-4 border border-[#e2e8f0]">
                        <span class="text-[#64748b] text-xs font-semibold uppercase block mb-1">Tagihan Saat Ini</span>
                        <span class="text-lg font-black text-[#f59e0b]">Rp {{ number_format($tagihanSaatIni, 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-[#f8fafc] rounded-2xl p-4 border border-[#e2e8f0]">
                        <span class="text-[#64748b] text-xs font-semibold uppercase block mb-1">Total Terbayar</span>
                        <span class="text-lg font-black text-[#10b981]">Rp {{ number_format($totalTerbayar, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            <div class="mt-6">
                <a href="{{ route('student.tagihan') }}" class="w-full md:w-auto md:px-8 inline-flex bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold text-sm h-12 rounded-2xl transition-all items-center justify-center gap-2 shadow-sm">
                    <span>Lihat Detail Tagihan</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Grid Bawah: Kartu Mahasiswa & Grafik IP -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 md:gap-6 mt-6">

        <!-- KARTU PELAJAR -->
        <div class="bg-[#ffffff] rounded-[24px] border border-[#dbe4f0] p-4 md:p-7 shadow-sm hover:shadow-md transition-shadow w-full h-full overflow-hidden">
            <div class="flex flex-wrap items-center justify-between border-b border-slate-100 pb-3 md:pb-4 mb-4 md:mb-6 gap-2">
                <div class="flex items-center gap-2 md:gap-3">
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-[#f8fafc] text-[var(--theme-accent)] border border-[#dbe4f0] shadow-sm flex items-center justify-center shrink-0">
                        <i data-lucide="contact-2" class="w-4 h-4 md:w-5 md:h-5"></i>
                    </div>
                    <h3 class="font-extrabold text-[var(--theme-primary)] text-[15px] md:text-base leading-tight">Kartu Pelajar</h3>
                </div>
                <a href="{{ route('student.cetak-ktm') }}" target="_blank" class="bg-[var(--theme-print-bg)] border border-[var(--theme-print-hover)] hover:bg-[var(--theme-print-hover)] text-[var(--theme-print-text)] font-bold text-[12px] md:text-xs px-3 md:px-4 py-1.5 md:py-2 h-[34px] md:h-[38px] rounded-lg md:rounded-xl transition-all flex items-center gap-1.5 md:gap-2 shrink-0">
                    <i data-lucide="printer" class="w-3.5 h-3.5 text-[var(--theme-print-icon)]"></i>
                    <span class="whitespace-nowrap">Cetak</span>
                </a>
            </div>

            <!-- Card Graphic component -->
            <div id="ktm-wrapper" class="w-full max-w-full overflow-hidden rounded-3xl mx-auto" style="aspect-ratio: 420/260; max-width: 420px;">
                <div id="ktm-inner" class="w-[420px] h-[260px] text-slate-800 p-5 relative shadow-xl overflow-hidden border border-slate-200 origin-top-left" style="background-image: url('{{ asset('images/ktm.jpeg') }}'); background-size: cover; background-position: center;">
                
                <!-- Card Content -->
                <div class="flex justify-between items-start mt-[70px] px-2">
                    <div class="space-y-3 max-w-[200px]">
                        <div>
                            <span class="text-[9px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Nama Lengkap</span>
                            <span class="text-sm font-extrabold block leading-tight truncate text-white drop-shadow-md">{{ $student->full_name }}</span>
                        </div>
                        <div class="flex gap-4">
                            <div>
                                <span class="text-[9px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Kelas</span>
                                <span class="text-xs font-bold block leading-none mt-1 text-white drop-shadow-md">{{ $student->currentClass->schoolClass->class_name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Gender</span>
                                <span class="text-xs font-bold block leading-none mt-1 text-white drop-shadow-md">{{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}</span>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div>
                                <span class="text-[9px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">NISN</span>
                                <span class="text-xs font-bold block leading-tight truncate mt-1 text-white drop-shadow-md">{{ $student->nisn ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Tanggal Lahir</span>
                                <span class="text-xs font-bold block leading-tight truncate mt-1 text-white drop-shadow-md">{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') : '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Portrait frame -->
                    <div class="w-[84px] h-[112px] rounded-2xl overflow-hidden shrink-0 flex items-center justify-center mt-2 mr-1">
                        @if($student->photo)
                            <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" class="object-cover w-full h-full">
                        @else
                            <div class="text-slate-400 text-2xl font-bold opacity-60">
                                {{ strtoupper(substr($student->full_name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute inset-0 ring-1 ring-inset ring-black/10 rounded-xl"></div>
                    </div>
                </div>
                
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const wrapper = document.getElementById('ktm-wrapper');
                    const inner = document.getElementById('ktm-inner');
                    
                    if (wrapper && inner) {
                        const resizeCard = () => {
                            const wrapperWidth = wrapper.getBoundingClientRect().width;
                            const scale = Math.min(1, wrapperWidth / 420);
                            inner.style.transform = `scale(${scale})`;
                        };
                        
                        // Observe changes in parent container size
                        const observer = new ResizeObserver(resizeCard);
                        observer.observe(wrapper);
                        
                        // Execute immediately
                        resizeCard();
                    }
                });
            </script>
        </div>

        <!-- GRAFIK RATA-RATA NILAI -->
        <div class="bg-[#ffffff] rounded-[24px] border border-[#dbe4f0] p-5 md:p-7 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between w-full h-full">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                <div class="w-10 h-10 rounded-xl bg-[var(--theme-bg-light)] text-[var(--theme-accent)] border border-[var(--theme-border-light)] shadow-sm flex items-center justify-center">
                    <i data-lucide="line-chart" class="w-5 h-5"></i>
                </div>
                <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Grafik Rata-rata Nilai per Semester</h3>
            </div>

            <div class="relative h-[250px] w-full">
                <canvas id="ipChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rootStyles = getComputedStyle(document.documentElement);
        const themeColor = rootStyles.getPropertyValue('--theme-primary').trim() || '#3b5998';
        const themeHover = rootStyles.getPropertyValue('--theme-stat-hover').trim() || 'rgba(59, 130, 246, 0.06)';
        
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
                    data: @json($gpaHistory),
                    borderColor: themeColor,
                    backgroundColor: themeHover,
                    tension: 0.35,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: themeColor,
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
