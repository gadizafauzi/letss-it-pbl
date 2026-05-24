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
                border: 1px solid #cbd5e1 !important;
                margin: 0 !important;
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
    <div class="print-card w-[480px] h-[300px] bg-gradient-to-br from-emerald-500 via-indigo-600 to-purple-700 text-white rounded-3xl p-6 relative shadow-2xl flex flex-col justify-between overflow-hidden border border-indigo-400">
        
        <!-- Logo & Header -->
        <div class="flex items-center gap-3 border-b border-white/20 pb-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center p-1 shrink-0 shadow-md">
                <div class="w-full h-full bg-indigo-100 rounded text-indigo-500 flex items-center justify-center font-bold text-xs">SD</div>
            </div>
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider leading-tight">Kartu Tanda Pelajar</h3>
                <h2 class="text-sm font-extrabold uppercase leading-none mt-0.5">Sekolah Dasar Negeri</h2>
            </div>
        </div>

        <!-- Card Body -->
        <div class="flex justify-between items-center mt-3">
            <!-- Left Info -->
            <div class="space-y-2 max-w-[280px]">
                <div>
                    <span class="text-[10px] text-indigo-200 uppercase font-semibold block leading-none">Nama Lengkap</span>
                    <span class="text-base font-extrabold block leading-tight truncate">{{ $student->full_name }}</span>
                </div>
                <div class="flex gap-6">
                    <div>
                        <span class="text-[10px] text-indigo-200 uppercase font-semibold block leading-none">Kelas</span>
                        <span class="text-sm font-bold block leading-none mt-1">{{ $student->class->class_name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-indigo-200 uppercase font-semibold block leading-none">Gender</span>
                        <span class="text-sm font-bold block leading-none mt-1">{{ $student->gender ?? '-' }}</span>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div>
                        <span class="text-[10px] text-indigo-200 uppercase font-semibold block leading-none">NISN</span>
                        <span class="text-xs font-semibold block leading-tight text-slate-100 truncate mt-1">{{ $student->nisn ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] text-indigo-200 uppercase font-semibold block leading-none">Tanggal Lahir</span>
                        <span class="text-xs font-semibold block leading-tight text-slate-100 truncate mt-1">{{ $student->birth_date ? $student->birth_date->format('d/m/Y') : '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Photo -->
            <div class="w-24 h-32 bg-white/20 border-2 border-white/40 rounded-2xl overflow-hidden shrink-0 shadow-lg relative flex items-center justify-center">
                @if($student->photo)
                    <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Photo" class="object-cover w-full h-full">
                @else
                    <div class="text-white text-3xl font-extrabold opacity-60">
                        {{ strtoupper(substr($student->full_name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer link -->
        <div class="text-[9px] text-white/50 mt-2 text-right border-t border-white/10 pt-2 font-mono">
            SD Negeri
        </div>
    </div>

</body>
</html>
