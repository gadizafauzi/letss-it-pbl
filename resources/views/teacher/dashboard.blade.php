<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SIT</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body class="bg-gray-100 font-sans">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-md flex flex-col flex-shrink-0">

        <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">

            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md">

                <svg class="w-5 h-5 text-white"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2.5"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 14l9-5-9-5-9 5 9 5z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 14l6.16-3.422A12.083 12.083 0 0121 13c0 4.97-4.03 9-9 9s-9-4.03-9-9c0-.857.117-1.687.34-2.47L12 14z"/>
                </svg>
            </div>

            <div>
                <p class="font-bold text-gray-800 text-sm">SIT</p>
                <p class="text-xs text-gray-400">Guru</p>
            </div>

        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">

            <a href="{{ route('teacher.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all
               {{ request()->routeIs('teacher.dashboard')
                    ? 'bg-blue-500 text-white shadow-md [&_svg]:stroke-white'
                    : 'text-gray-600 hover:bg-gray-100 hover:text-blue-500 [&_svg]:stroke-gray-600'
               }}">

                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     viewBox="0 0 24 24">

                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                </svg>

                <span>Dashboard</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all hover:bg-gray-100 hover:text-blue-500">

                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     viewBox="0 0 24 24">

                    <path d="M4 7h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 17h10"/>
                </svg>

                <span>Kelas Saya</span>
            </a>
            <a href="#"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all hover:bg-gray-100 hover:text-blue-500">

                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     viewBox="0 0 24 24">

                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>

                <span>Input Nilai</span>
            </a>

            <!-- Profil -->
            <a href="#"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 transition-all hover:bg-gray-100 hover:text-blue-500">

                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     viewBox="0 0 24 24">

                    <path d="M20 21a8 8 0 0 0-16 0"/>
                    <circle cx="12" cy="7" r="4"/>
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
        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">

            <div>
                <h1 class="text-lg font-bold text-gray-800">Dashboard</h1>

                <p class="text-xs text-gray-400 mt-0.5">
                    Selamat datang di Sistem Informasi Akademik
                </p>
            </div>

            <div class="text-right">

                <p class="text-sm font-semibold text-gray-700">
                    {{ auth()->user()->name ?? 'Guru' }}
                </p>

                <p class="text-xs text-gray-400">
                    NIP: {{ auth()->user()->nip ?? '-' }}
                </p>

            </div>

        </header>

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto p-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

                <div class="bg-white rounded-2xl p-5 shadow-sm flex justify-between items-center">

                    <div>
                        <p class="text-xs text-gray-400">Total Kelas Diajar</p>
                        <h2 class="text-3xl font-bold mt-1" id="statKelas">0</h2>
                    </div>

                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center text-white">
                        📘
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm flex justify-between items-center">

                    <div>
                        <p class="text-xs text-gray-400">Kelas Wali</p>
                        <h2 class="text-3xl font-bold mt-1">5A</h2>
                    </div>

                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center text-white">
                        👨‍🏫
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm flex justify-between items-center">

                    <div>
                        <p class="text-xs text-gray-400">Jumlah Siswa</p>
                        <h2 class="text-3xl font-bold mt-1" id="statSiswa">0</h2>
                    </div>

                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-white">
                        👥
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm flex justify-between items-center">

                    <div>
                        <p class="text-xs text-gray-400">Rata-rata Nilai</p>
                        <h2 class="text-3xl font-bold mt-1">85.3</h2>
                    </div>

                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white">
                        🏅
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-gray-700">
                        Kelas yang Diajar
                    </h2>
                </div>

                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">

                        <tr>
                            <th class="px-6 py-3 text-left">No</th>
                            <th class="px-6 py-3 text-left">Kelas</th>
                            <th class="px-6 py-3 text-left">Mata Pelajaran</th>
                            <th class="px-6 py-3 text-left">Jumlah Siswa</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        <tr>
                            <td class="px-6 py-3">1</td>

                            <td class="px-6 py-3">
                                5A
                                <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded">
                                    Wali Kelas
                                </span>
                            </td>

                            <td class="px-6 py-3">Matematika</td>
                            <td class="px-6 py-3">28</td>

                            <td class="px-6 py-3">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                                    Aktif
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-3">2</td>
                            <td class="px-6 py-3">5B</td>
                            <td class="px-6 py-3">Matematika</td>
                            <td class="px-6 py-3">30</td>

                            <td class="px-6 py-3">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                                    Aktif
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-3">3</td>
                            <td class="px-6 py-3">6A</td>
                            <td class="px-6 py-3">Matematika</td>
                            <td class="px-6 py-3">25</td>

                            <td class="px-6 py-3">
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs">
                                    Aktif
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </main>

    </div>

</div>

<div id="modalLogout"
     style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center;">

    <div onclick="tutupModalLogout()"
         style="position:absolute; inset:0; background:rgba(0,0,0,0.45); backdrop-filter:blur(3px);">
    </div>

    <div style="position:relative; background:#fff; border-radius:16px; padding:32px 28px; width:340px; max-width:90vw; box-shadow:0 20px 60px rgba(0,0,0,0.2); text-align:center; animation:popIn .2s ease;">

        <div style="width:56px; height:56px; background:#fee2e2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">

            <svg width="28"
                 height="28"
                 fill="none"
                 stroke="#ef4444"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>

        <h3 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:8px;">
            Konfirmasi Keluar
        </h3>

        <p style="font-size:14px; color:#64748b; margin-bottom:24px;">
            Apakah Anda yakin ingin keluar dari sistem?
        </p>

        <div style="display:flex; gap:12px;">

            <button onclick="tutupModalLogout()"
                    style="flex:1; padding:10px; border-radius:10px; border:1.5px solid #e2e8f0; background:#fff; color:#475569; font-size:14px; font-weight:600; cursor:pointer;">

                Batal
            </button>

            <button onclick="lakukanLogout()"
                    style="flex:1; padding:10px; border-radius:10px; border:none; background:#ef4444; color:#fff; font-size:14px; font-weight:600; cursor:pointer;">

                Keluar
            </button>

        </div>
    </div>

</div>

<style>
@keyframes popIn {
    from {
        opacity: 0;
        transform: scale(0.92) translateY(12px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
</style>

<script>

function bukaModalLogout() {
    document.getElementById('modalLogout').style.display = 'flex';
}

function tutupModalLogout() {
    document.getElementById('modalLogout').style.display = 'none';
}

function lakukanLogout() {

    let form = document.createElement('form');

    form.method = 'POST';
    form.action = '/logout';

    let csrf = document.createElement('input');

    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';

    form.appendChild(csrf);

    document.body.appendChild(form);

    form.submit();
}

document.addEventListener('keydown', function(e) {

    if (e.key === 'Escape') {
        tutupModalLogout();
    }
});

document.addEventListener('DOMContentLoaded', function () {

    function counter(el, target, duration = 1200) {

        if (!el) return;

        let startTime = null;

        function animate(currentTime) {

            if (!startTime) {
                startTime = currentTime;
            }

            const progress = Math.min(
                (currentTime - startTime) / duration,
                1
            );

            const current = target * progress;

            el.textContent = Math.floor(current);

            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                el.textContent = target;
            }
        }

        requestAnimationFrame(animate);
    }

    counter(document.getElementById('statKelas'), 3, 1200);
    counter(document.getElementById('statSiswa'), 83, 1500);

});

</script>

</body>
</html>
