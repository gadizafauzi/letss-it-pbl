document.addEventListener('DOMContentLoaded', function () {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    /* COUNTER ANGKA */
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const targetStr = counter.dataset.target;
        if (!targetStr) return;
        const target = parseFloat(targetStr);
        if (isNaN(target)) return;

        const decimal = parseInt(counter.dataset.decimal || 0);
        const duration = 1200;
        const startTime = performance.now();

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
                white 45%)`;
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

    function closeMobileSidebar() {
        if(sidebar) sidebar.classList.remove('sidebar-mobile-open');
        if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
    }

    function openMobileSidebar() {
        if(sidebar) sidebar.classList.add('sidebar-mobile-open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('hidden');
    }

    if (desktopToggle && sidebar) {
        desktopToggle.addEventListener('click', function () {
            if (window.innerWidth <= 1024) {
                if (sidebar.classList.contains('sidebar-mobile-open')) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            } else {
                sidebar.classList.toggle('sidebar-collapse');
                if (sidebar.classList.contains('sidebar-collapse')) {
                    localStorage.setItem('studentSidebarCollapsed', 'true');
                } else {
                    localStorage.setItem('studentSidebarCollapsed', 'false');
                }
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function () {
            closeMobileSidebar();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && window.innerWidth <= 1024) {
            closeMobileSidebar();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            if(sidebar) sidebar.classList.remove('sidebar-mobile-open');
            if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
        } else {
            if(sidebar) sidebar.classList.remove('sidebar-collapse');
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

    // Theme Toggle Logic
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }
});
