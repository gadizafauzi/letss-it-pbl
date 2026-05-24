document.addEventListener('DOMContentLoaded', function () {

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    /* COUNTER ANGKA */
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = parseFloat(counter.dataset.target);
        const decimal = parseInt(counter.dataset.decimal || 0);
        const duration = 1200;
        const startTime = performance.now();

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

    /* LOGOUT MODAL */
    const logoutBtn = document.getElementById('teacherLogoutBtn');
    const logoutModal = document.getElementById('teacherLogoutModal');
    const cancelLogout = document.getElementById('teacherCancelLogout');

    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', function () {
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

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && logoutModal) {
            logoutModal.classList.remove('flex');
            logoutModal.classList.add('hidden');
        }
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
                rgba(59,130,246,.08),
                white 45%)`;
        });

        card.addEventListener('mouseleave', function () {
            card.style.background = 'white';
        });
    });

        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('desktopToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function () {

                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('show');

                    if (sidebarOverlay) {
                        sidebarOverlay.classList.toggle('hidden');
                    }

                } else {
                    sidebar.classList.toggle('teacher-sidebar-collapse');
                }

            });
        }

        if (sidebarOverlay && sidebar) {
            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.add('hidden');
            });
        }
        });
