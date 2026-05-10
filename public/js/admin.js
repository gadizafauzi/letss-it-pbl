/* ========================================
   LUCIDE ICON
======================================== */

lucide.createIcons();

/* ========================================
   SIDEBAR MOBILE
======================================== */

const sidebar = document.getElementById('sidebar');
const menuToggle = document.getElementById('menuToggle');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if(menuToggle){

    menuToggle.addEventListener('click', () => {

        sidebar.classList.toggle('show');

        sidebarOverlay.classList.toggle('hidden');

    });

}

if(sidebarOverlay){

    sidebarOverlay.addEventListener('click', () => {

        sidebar.classList.remove('show');

        sidebarOverlay.classList.add('hidden');

    });

}

/* ========================================
   ACTIVE MENU
======================================== */

const sidebarLinks = document.querySelectorAll('.sidebar-link');

sidebarLinks.forEach(link => {

    link.addEventListener('click', () => {

        sidebarLinks.forEach(item => {
            item.classList.remove('active-sidebar');
        });

        link.classList.add('active-sidebar');

    });

});

/* ========================================
   LOGOUT MODAL
======================================== */

const logoutBtn = document.getElementById('sidebarLogoutBtn');

const logoutModal = document.getElementById('logoutModal');

const cancelLogout = document.getElementById('cancelLogout');

const confirmLogout = document.getElementById('confirmLogout');

if(logoutBtn){

    logoutBtn.addEventListener('click', () => {

        logoutModal.classList.remove('hidden');

        logoutModal.classList.add('flex');

    });

}

if(cancelLogout){

    cancelLogout.addEventListener('click', () => {

        logoutModal.classList.remove('flex');

        logoutModal.classList.add('hidden');

    });

}

/* ========================================
   CLOSE MODAL OUTSIDE
======================================== */

if(logoutModal){

    logoutModal.addEventListener('click', (e) => {

        if(e.target === logoutModal){

            logoutModal.classList.remove('flex');

            logoutModal.classList.add('hidden');

        }

    });

}

/* ========================================
   CONFIRM LOGOUT
======================================== */

if(confirmLogout){

    confirmLogout.addEventListener('click', () => {

        const logoutUrl = document
            .querySelector('meta[name="logout-url"]')
            .getAttribute('content');

        window.location.href = logoutUrl;

    });

}

/* ========================================
   CARD HOVER EFFECT
======================================== */

const cards = document.querySelectorAll('.dashboard-card');

cards.forEach(card => {

    card.addEventListener('mousemove', (e) => {

        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        card.style.background =
            `radial-gradient(circle at ${x}px ${y}px,
            rgba(59,130,246,.08),
            white 45%)`;

    });

    card.addEventListener('mouseleave', () => {

        card.style.background = 'white';

    });

});

/* ========================================
   QUICK MENU EFFECT
======================================== */

const quickCards = document.querySelectorAll('.quick-menu-card');

quickCards.forEach(card => {

    card.addEventListener('mouseenter', () => {

        card.style.transition = '.3s';

    });

});

/* ========================================
   ESC CLOSE MODAL
======================================== */

document.addEventListener('keydown', (e) => {

    if(e.key === 'Escape'){

        logoutModal.classList.remove('flex');

        logoutModal.classList.add('hidden');

    }

});

/* ========================================
   DESKTOP SIDEBAR COLLAPSE
======================================== */

const desktopToggle = document.getElementById('desktopToggle');

if(desktopToggle){

    desktopToggle.addEventListener('click', () => {

        sidebar.classList.toggle('sidebar-collapse');

    });

}
