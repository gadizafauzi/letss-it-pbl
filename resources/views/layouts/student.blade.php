<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js for GPA line chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @php
        $studentLayout = \App\Models\Student::with('unit')->where('user_id', auth()->id())->first();
        $unitNameLayout = strtolower($studentLayout->unit->unit_name ?? 'smp');
    @endphp

    @if($unitNameLayout === 'sd')
    <style>
        :root {
            --theme-primary: #5B3CC4;
            --theme-primary-hover: #8B5CF6;
            --theme-accent: #8B5CF6;
            --theme-accent-hover: #8B5CF6;
            --theme-bg-light: #F1ECFF;
            --theme-bg-workspace: #F8F7FC;
            --theme-border-light: #D8CCFF;
            --theme-text-light: #4C1D95;
            --theme-icon-active: #5B3CC4;
            --theme-icon-indicator: #5B3CC4;
            --theme-stat-hover: rgba(139, 92, 246, 0.14);
            --theme-print-bg: #FEF3C7;
            --theme-print-text: #A16207;
            --theme-print-icon: #FACC15;
            --theme-print-hover: #FDE68A;
            --theme-logo-url: url('{{ asset("images/logomq.jpg") }}');
        }
    </style>
    @else
    <style>
        :root {
            --theme-primary: #3b5998;
            --theme-primary-hover: #1e3a6e;
            --theme-accent: #5c7cfa;
            --theme-accent-hover: #3b5998;
            --theme-bg-light: #eef4ff;
            --theme-bg-workspace: #f1f5f9;
            --theme-border-light: #c9d8ff;
            --theme-text-light: #3b5998;
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: rgba(255, 255, 255, 0.9);
            --theme-stat-hover: rgba(92, 124, 250, 0.1);
            --theme-print-bg: #fef2f2;
            --theme-print-text: #ef4444;
            --theme-print-icon: #ef4444;
            --theme-print-hover: #fee2e2;
            --theme-logo-url: url('{{ asset("images/smp.jpeg") }}');
        }
    </style>
    @endif
</head>

<body class="bg-[var(--theme-bg-workspace)] text-slate-800 overflow-hidden">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-[100dvh] w-full overflow-hidden max-w-full">

    @include('components.student.sidebar')

    {{-- Konten utama: pada mobile diberi margin-left 64px agar icon strip tidak menutupi konten --}}
    <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">

        @include('components.shared.header-student')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </main>

    </div>

</div>

<!-- Logout Confirmation Modal -->
<x-student.logout-modal id="studentLogoutModal" cancelId="studentCancelLogout" action="{{ route('logout') }}" />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        /* COUNTER ANGKA */
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const targetStr = counter.dataset.target;
            const target = parseFloat(targetStr);
            if (isNaN(target)) return;

            const decimal = parseInt(counter.dataset.decimal || 0);
            const duration = 1200;
            const startTime = performance.now();

            // Set initial value to 0 to prevent flashing
            counter.textContent = decimal > 0 ? "0." + "0".repeat(decimal) : "0";

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeOut = 1 - Math.pow(1 - progress, 4);
                const value = target * easeOut;

                counter.textContent = decimal > 0
                    ? value.toFixed(decimal)
                    : Math.round(value);

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = decimal > 0
                        ? target.toFixed(decimal)
                        : target;
                }
            }
            requestAnimationFrame(updateCounter);
        });

        /* CARD HOVER EFFECT */
        const cards = document.querySelectorAll('.dashboard-card');
        cards.forEach(card => {
            card.addEventListener('mousemove', function (e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                card.style.background =
                    `radial-gradient(circle at ${x}px ${y}px,
                    rgba(92, 124, 250, 0.12),
                    white 45%)`; // using soft blue color
            });

            card.addEventListener('mouseleave', function () {
                card.style.background = '';
            });
        });

        // Toggle Sidebar Responsive Logic
        const sidebar = document.getElementById('sidebar');
        const desktopToggle = document.getElementById('desktopToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        // Fungsi menutup sidebar mobile
        function closeMobileSidebar() {
            sidebar.classList.remove('sidebar-mobile-open');
            if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
        }

        // Fungsi membuka sidebar mobile
        function openMobileSidebar() {
            sidebar.classList.add('sidebar-mobile-open');
            if (sidebarOverlay) sidebarOverlay.classList.remove('hidden');
        }

        if (desktopToggle && sidebar) {
            desktopToggle.addEventListener('click', function () {
                if (window.innerWidth <= 1024) {
                    // Mobile: toggle panel biru tua (slide in/out di samping icon strip)
                    if (sidebar.classList.contains('sidebar-mobile-open')) {
                        closeMobileSidebar();
                    } else {
                        openMobileSidebar();
                    }
                } else {
                    // Desktop: collapse/expand sidebar penuh
                    sidebar.classList.toggle('sidebar-collapse');
                    if (sidebar.classList.contains('sidebar-collapse')) {
                        localStorage.setItem('studentSidebarCollapsed', 'true');
                    } else {
                        localStorage.setItem('studentSidebarCollapsed', 'false');
                    }
                }
            });
        }

        // Tutup sidebar mobile saat overlay ditekan
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function () {
                closeMobileSidebar();
            });
        }

        // Tutup sidebar mobile dengan tombol Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && window.innerWidth <= 1024) {
                closeMobileSidebar();
            }
        });

        // Reset saat resize window
        window.addEventListener('resize', function () {
            if (window.innerWidth > 1024) {
                // Desktop: bersihkan state mobile
                sidebar.classList.remove('sidebar-mobile-open');
                if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
            } else {
                // Mobile: bersihkan state desktop collapse
                sidebar.classList.remove('sidebar-collapse');
            }
        });



        // Logout Modal
        const logoutBtn = document.getElementById('studentLogoutBtn');
        const logoutModal = document.getElementById('studentLogoutModal');
        const cancelLogout = document.getElementById('studentCancelLogout');

        if (logoutBtn && logoutModal) {
            logoutBtn.addEventListener('click', function (e) {
                e.preventDefault();
                logoutModal.classList.remove('hidden');
                logoutModal.classList.add('flex');
            });
        }

        if (cancelLogout && logoutModal) {
            cancelLogout.addEventListener('click', function () {
                logoutModal.classList.remove('flex');
                logoutModal.classList.add('hidden');
            });
        }

        if (logoutModal) {
            logoutModal.addEventListener('click', function (e) {
                if (e.target === logoutModal) {
                    logoutModal.classList.remove('flex');
                    logoutModal.classList.add('hidden');
                }
            });
        }
    });
</script>

</body>
</html>
