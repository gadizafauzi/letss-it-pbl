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
</head>

<body class="bg-slate-100 text-slate-800 overflow-hidden">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-screen overflow-hidden">

    @include('components.student.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

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
                    rgba(16,185,129,.08),
                    white 45%)`; // using emerald color for student
            });

            card.addEventListener('mouseleave', function () {
                card.style.background = 'white';
            });
        });

        // Toggle Sidebar Responsive Logic
        const sidebar = document.getElementById('sidebar');
        const desktopToggle = document.getElementById('desktopToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (desktopToggle && sidebar) {
            desktopToggle.addEventListener('click', function () {
                if (window.innerWidth <= 1024) {
                    // Mobile & Tablet (Split Screen) behavior
                    sidebar.classList.remove('sidebar-collapse');
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('hidden');
                } else {
                    // Desktop behavior
                    sidebar.classList.toggle('sidebar-collapse');
                }
            });
        }

        // Clean up classes on window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('show');
                if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('sidebar-collapse');
            }
        });

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.add('hidden');
            });
        }

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
