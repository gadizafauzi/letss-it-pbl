<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Kartu Pelajar - {{ $student->full_name }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            body {
                background: none;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .print-card {
                box-shadow: none !important;
                margin: 0 !important;
                border: none !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }
        }
    </style>
    <script>
        // Auto-print if loaded inside an iframe
        if (window.self !== window.top) {
            window.addEventListener('load', () => {
                setTimeout(() => {
                    window.print();
                }, 500);
            });
        }
    </script>
</head>
<body class="bg-slate-100 flex flex-col items-center justify-center min-h-screen p-6">

    <div class="no-print mb-6">
        <button onclick="window.print()" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-2xl shadow-lg transition-all">
            Cetak Sekarang
        </button>
    </div>

    @php
        $unitName = strtolower($student->unit->unit_name ?? 'sd');
    @endphp

    <!-- Kartu Pelajar Card -->
    <div class="print-card w-[480px] h-[300px] text-slate-800 rounded-3xl p-6 relative shadow-2xl overflow-hidden border border-slate-200" style="background-image: url('{{ asset('images/ktm' . ($unitName == 'smp' ? 'smp' : 'sd') . '.png') }}'); background-size: cover; background-position: center;">
        
        <!-- Card Body -->
        <div class="flex justify-between items-start mt-[80px] px-2">
            <!-- Left Info -->
            <div class="space-y-1.5 w-[300px]">
                <div class="flex items-start text-[11px]">
                    <span class="text-slate-600 font-bold w-[75px] shrink-0">Nama</span>
                    <span class="text-slate-600 font-bold mr-1.5">:</span>
                    <span class="font-extrabold text-slate-900 leading-tight">{{ $student->full_name }}</span>
                </div>
                <div class="flex items-center text-[11px]">
                    <span class="text-slate-600 font-bold w-[75px] shrink-0">Kelas</span>
                    <span class="text-slate-600 font-bold mr-1.5">:</span>
                    <span class="font-extrabold text-slate-900">{{ $student->currentClass->schoolClass->class_name ?? '-' }}</span>
                </div>
                <div class="flex items-center text-[11px]">
                    <span class="text-slate-600 font-bold w-[75px] shrink-0">Gender</span>
                    <span class="text-slate-600 font-bold mr-1.5">:</span>
                    <span class="font-extrabold text-slate-900">{{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}</span>
                </div>
                <div class="flex items-center text-[11px]">
                    <span class="text-slate-600 font-bold w-[75px] shrink-0">NISN</span>
                    <span class="text-slate-600 font-bold mr-1.5">:</span>
                    <span class="font-extrabold text-slate-900">{{ $student->nisn ?? '-' }}</span>
                </div>
                <div class="flex items-center text-[11px]">
                    <span class="text-slate-600 font-bold w-[75px] shrink-0">Tgl Lahir</span>
                    <span class="text-slate-600 font-bold mr-1.5">:</span>
                    <span class="font-extrabold text-slate-900">{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') : '-' }}</span>
                </div>
            </div>

            <!-- Photo -->
            <div class="w-[96px] h-[128px] rounded-2xl overflow-hidden shrink-0 flex items-center justify-center mt-3 mr-1">
                @if($student->photo)
                    <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" class="object-cover w-full h-full">
                @else
                    <div class="text-slate-400 text-3xl font-extrabold opacity-60">
                        {{ strtoupper(substr($student->full_name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
