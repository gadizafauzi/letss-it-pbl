document.addEventListener('DOMContentLoaded', () => {


    const logoutModal      = document.getElementById('logoutModal');
    const headerLogoutBtn  = document.getElementById('headerLogoutBtn');
    const sidebarLogoutBtn = document.getElementById('sidebarLogoutBtn');
    const cancelLogout     = document.getElementById('cancelLogout');
    const confirmLogout    = document.getElementById('confirmLogout');
    const modalBackdrop    = document.getElementById('modalBackdrop');

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    function openLogoutModal() {
        logoutModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLogoutModal() {
        logoutModal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function doLogout() {
        confirmLogout.textContent = 'Keluar...';
        confirmLogout.disabled = true;


        const logoutUrl = document.querySelector('meta[name="logout-url"]')?.getAttribute('content') || '/logout';

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = logoutUrl;

        const csrfInput = document.createElement('input');
        csrfInput.type  = 'hidden';
        csrfInput.name  = '_token';
        csrfInput.value = csrfToken;

        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }

    if (headerLogoutBtn)  headerLogoutBtn.addEventListener('click', openLogoutModal);
    if (sidebarLogoutBtn) sidebarLogoutBtn.addEventListener('click', openLogoutModal);
    if (cancelLogout)     cancelLogout.addEventListener('click', closeLogoutModal);
    if (modalBackdrop)    modalBackdrop.addEventListener('click', closeLogoutModal);
    if (confirmLogout)    confirmLogout.addEventListener('click', doLogout);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLogoutModal();
    });

    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Jangan intercept jika link punya href nyata (bukan #)
            const href = item.getAttribute('href');
            if (href && href !== '#') return;

            e.preventDefault();

            navItems.forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');
        });
    });

    function animateCounter(el, target, decimals, duration) {
        if (!el) return;
        const startTime = performance.now();

        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }

        function tick(now) {
            const progress = Math.min((now - startTime) / duration, 1);
            const value    = target * easeOutQuart(progress);
            el.textContent = decimals > 0 ? value.toFixed(decimals) : Math.round(value);
            if (progress < 1) requestAnimationFrame(tick);
        }

        requestAnimationFrame(tick);
    }

    animateCounter(document.getElementById('statKelas'), 8,    0, 900);
    animateCounter(document.getElementById('statNilai'), 85.5, 1, 1200);

    const tableRows = document.querySelectorAll('.table-row');

    tableRows.forEach(row => {
        row.addEventListener('click', () => {
            tableRows.forEach(r => r.classList.remove('row-selected'));
            row.classList.add('row-selected');
        });
    });

    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const menuToggle     = document.getElementById('menuToggle');

    if (menuToggle && sidebar && sidebarOverlay) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('show');
        });
    }

    const predikatLabels = {
        a: 'Sangat Baik (≥ 90)',
        b: 'Baik (75 – 89)',
        c: 'Cukup (60 – 74)',
        d: 'Kurang (< 60)',
    };

    document.querySelectorAll('.predikat-badge').forEach(badge => {
        const cls = [...badge.classList].find(c => /^predikat-[a-d]$/.test(c));
        if (!cls) return;
        const key = cls.split('-')[1];
        badge.setAttribute('title', predikatLabels[key] || '');
    });

});
