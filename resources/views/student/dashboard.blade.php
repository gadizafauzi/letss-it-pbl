<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body class="bg-gray-100 font-sans">

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="sidebar w-52 bg-white flex flex-col shadow-md z-10 flex-shrink-0" id="sidebar">
        <nav class="flex-1 px-3 py-4 space-y-1">

            <a href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                {{ request()->routeIs('student.dashboard')
                        ? 'bg-blue-500 text-white shadow-md [&_svg]:stroke-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-blue-500 [&_svg]:stroke-gray-600 hover:[&_svg]:stroke-blue-500'
                }}">

                <svg class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    viewBox="0 0 24 24">

                    <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                </svg>

                <span>Dashboard</span>
            </a>

                <a href="#"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                    text-gray-600 hover:bg-gray-100 hover:text-blue-500
                    [&_svg]:stroke-gray-600 hover:[&_svg]:stroke-blue-500">

                    <svg class="w-5 h-5 flex-shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        viewBox="0 0 24 24">

                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                        <path d="M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                        <path d="M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        <path d="M12 12h3"/>
                        <path d="M12 16h3"/>
                        <path d="M9 12h.01"/>
                        <path d="M9 16h.01"/>
                    </svg>

                <span>Nilai</span>
             </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                text-gray-600 hover:bg-gray-100 hover:text-blue-500
                [&_svg]:stroke-gray-600 hover:[&_svg]:stroke-blue-500">

                <svg class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    viewBox="0 0 24 24">

                    <path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2"/>
                    <path d="M9 13h10a2 2 0 012 2v4a2 2 0 01-2 2H9a2 2 0 01-2-2v-4a2 2 0 012-2z"/>
                    <circle cx="17" cy="15" r="1"/>
                </svg>

             <span>Tagihan</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
                text-gray-600 hover:bg-gray-100 hover:text-blue-500
                [&_svg]:stroke-gray-600 hover:[&_svg]:stroke-blue-500">

                <svg class="w-5 h-5 flex-shrink-0"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    viewBox="0 0 24 24">

                    <path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804"/>
                    <path d="M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

              <span>Profil</span>
            </a>

        </nav>
         <!-- Logout -->
        <div class="px-3 pb-5 border-t border-gray-100 pt-3 flex justify-center">

            <button type="button"
                    onclick="bukaModalLogout()"
                    class="inline-flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all
                    bg-red-500 text-white hover:bg-red-600 [&_svg]:stroke-white mx-auto">

                <span>
                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </span>

                Keluar
            </button>
        </div>

    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">

        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <h1 class="text-lg font-bold text-gray-800">Dashboard</h1>
                <p class="text-xs text-gray-400 mt-0.5">Selamat datang di Sistem Informasi Akademik</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-700">{{ auth()->user()->name ?? 'Siswa' }}</p>
                    <p class="text-xs text-gray-400">NIS: {{ auth()->user()->nis ?? '' }}</p>
                </div>
                <div class="w-8"></div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Kelas yang Diikuti</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2" id="statKelas">8</p>
                    </div>
                    <div class="stat-icon-wrap w-14 h-14 rounded-xl bg-blue-500 flex items-center justify-center shadow-md shadow-blue-200">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Nilai Semester</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2" id="statNilai">85.5</p>
                    </div>
                    <div class="stat-icon-wrap w-14 h-14 rounded-xl bg-emerald-500 flex items-center justify-center shadow-md shadow-emerald-200">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="stat-card bg-white rounded-2xl p-6 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Kelas Saat Ini</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">5A</p>
                    </div>
                    <div class="stat-icon-wrap w-14 h-14 rounded-xl bg-violet-500 flex items-center justify-center shadow-md shadow-violet-200">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden table-container">
                <div class="table-header px-6 py-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="table-title-bar"></div>
                        <h2 class="text-base font-bold text-blue-700">Daftar Nilai Semester Genap 2025/2026</h2>
                    </div>
                    <span class="text-xs text-blue-500 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full font-semibold">
                        7 Mata Pelajaran
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="table-thead">
                                <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wide w-16">No</th>
                                <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wide">Mata Pelajaran</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wide w-24">UTS</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wide w-24">UAS</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wide w-28">Rata-rata</th>
                                <th class="px-6 py-3.5 text-center text-xs font-bold uppercase tracking-wide w-28">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nilaiData = [
                                    ['no'=>1,'mapel'=>'Bahasa Indonesia','uts'=>85,'uas'=>88,'rata'=>86.5,'predikat'=>'B'],
                                    ['no'=>2,'mapel'=>'Matematika','uts'=>78,'uas'=>82,'rata'=>80,'predikat'=>'B'],
                                    ['no'=>3,'mapel'=>'Bahasa Inggris','uts'=>90,'uas'=>92,'rata'=>91,'predikat'=>'A'],
                                    ['no'=>4,'mapel'=>'IPA','uts'=>82,'uas'=>85,'rata'=>83.5,'predikat'=>'B'],
                                    ['no'=>5,'mapel'=>'IPS','uts'=>88,'uas'=>90,'rata'=>89,'predikat'=>'A'],
                                    ['no'=>6,'mapel'=>'Pendidikan Agama Islam','uts'=>95,'uas'=>95,'rata'=>95,'predikat'=>'A'],
                                    ['no'=>7,'mapel'=>"Tahfidz Al-Qur'an",'uts'=>90,'uas'=>92,'rata'=>91,'predikat'=>'A'],
                                ];
                            @endphp
                            @foreach($nilaiData as $item)
                            <tr class="table-row">
                                <td class="px-6 py-4 text-sm text-gray-400 font-medium">{{ $item['no'] }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $item['mapel'] }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $item['uts'] }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $item['uas'] }}</td>
                                <td class="px-6 py-4 text-sm text-center font-bold text-gray-800">{{ $item['rata'] }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="predikat-badge predikat-{{ strtolower($item['predikat']) }} inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold">
                                        {{ $item['predikat'] }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<div id="modalLogout" style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center;">

    <div onclick="tutupModalLogout()" style="position:absolute; inset:0; background:rgba(0,0,0,0.45); backdrop-filter:blur(3px);"></div>

    <div style="position:relative; background:#fff; border-radius:16px; padding:32px 28px; width:340px; max-width:90vw; box-shadow:0 20px 60px rgba(0,0,0,0.2); text-align:center; animation:popIn .2s ease;">

        <div style="width:56px; height:56px; background:#fee2e2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
            <svg width="28" height="28" fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>

        <h3 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:8px;">Konfirmasi Keluar</h3>
        <p style="font-size:14px; color:#64748b; margin-bottom:24px;">Apakah Anda yakin ingin keluar dari sistem?</p>

        <div style="display:flex; gap:12px;">
            <button onclick="tutupModalLogout()"
                style="flex:1; padding:10px; border-radius:10px; border:1.5px solid #e2e8f0; background:#fff; color:#475569; font-size:14px; font-weight:600; cursor:pointer; transition:background .15s;">
                Batal
            </button>
            <button onclick="lakukanLogout()"
                style="flex:1; padding:10px; border-radius:10px; border:none; background:#ef4444; color:#fff; font-size:14px; font-weight:600; cursor:pointer; transition:background .15s;">
                Keluar
            </button>
        </div>
    </div>
</div>

<style>
@keyframes popIn {
    from { opacity:0; transform:scale(0.92) translateY(12px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}
</style>

<script>
function bukaModalLogout() {
    var m = document.getElementById('modalLogout');
    m.style.display = 'flex';
}

function tutupModalLogout() {
    var m = document.getElementById('modalLogout');
    m.style.display = 'none';
}

function lakukanLogout() {
    var form    = document.createElement('form');
    form.method = 'POST';
    form.action = '/logout';
    var csrf    = document.createElement('input');
    csrf.type   = 'hidden';
    csrf.name   = '_token';
    csrf.value  = '{{ csrf_token() }}';
    form.appendChild(csrf);
    document.body.appendChild(form);
    form.submit();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupModalLogout();
});

document.addEventListener('DOMContentLoaded', function() {
    function counter(el, target, dec, ms) {
        if (!el) return;
        var s = performance.now();
        function tick(now) {
            var p = Math.min((now-s)/ms, 1);
            var v = target*(1-Math.pow(1-p,4));
            el.textContent = dec ? v.toFixed(dec) : Math.round(v);
            if (p<1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    }
    counter(document.getElementById('statKelas'), 8, 0, 900);
    counter(document.getElementById('statNilai'), 85.5, 1, 1200);
});
</script>

</body>
</html>
