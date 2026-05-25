<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Kartu Pelajar - {{ $student->full_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-slate-100 flex flex-col items-center justify-center min-h-screen p-6">

    <div class="no-print mb-6">
        <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-2xl shadow-lg transition-all">
            Cetak Sekarang
        </button>
    </div>

    <!-- Kartu Pelajar Card -->
    <div class="print-card w-[480px] h-[300px] text-slate-800 rounded-3xl p-6 relative shadow-2xl overflow-hidden border border-slate-200" style="background-image: url('{{ asset('images/ktm.jpeg') }}'); background-size: cover; background-position: center;">
        
        <!-- Card Body -->
        <div class="flex justify-between items-start mt-[80px] px-2">
            <!-- Left Info -->
            <div class="space-y-3 max-w-[280px]">
                <div>
                    <span class="text-[10px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Nama Lengkap</span>
                    <span class="text-base font-extrabold block leading-tight truncate text-white drop-shadow-md">{{ $student->full_name }}</span>
                </div>
                <div class="flex gap-6">
                    <div>
                        <span class="text-[10px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Kelas</span>
                        <span class="text-sm font-bold block leading-none mt-1 text-white drop-shadow-md">{{ $student->currentClass->schoolClass->class_name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Gender</span>
                        <span class="text-sm font-bold block leading-none mt-1 text-white drop-shadow-md">{{ $student->gender === 'L' ? 'Laki-Laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}</span>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div>
                        <span class="text-[10px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">NISN</span>
                        <span class="text-xs font-bold block leading-tight truncate mt-1 text-white drop-shadow-md">{{ $student->nisn ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-blue-300 uppercase font-black block leading-none drop-shadow-sm">Tanggal Lahir</span>
                        <span class="text-xs font-bold block leading-tight truncate mt-1 text-white drop-shadow-md">{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') : '-' }}</span>
                    </div>
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
