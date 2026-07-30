/* ========================================
   LUCIDE ICON
======================================== */

lucide.createIcons();

/* ========================================
   ELEMENT
======================================== */

const sidebar = document.getElementById("sidebar");

/* ========================================
   RESTORE SIDEBAR STATE
======================================== */

if (sidebar && window.innerWidth >= 1024) {
    if (localStorage.getItem("sidebar-collapsed") === "true") {
        sidebar.classList.add("sidebar-collapse");
    }
}

const menuToggle = document.getElementById("menuToggle");

const desktopToggle = document.getElementById("desktopToggle");

const sidebarOverlay = document.getElementById("sidebarOverlay");

const sidebarLinks = document.querySelectorAll(".sidebar-link");

/* ========================================
   MOBILE TOGGLE
======================================== */

if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("expand");

        sidebarOverlay.classList.toggle("hidden");
    });
}

/* ========================================
   DESKTOP TOGGLE
======================================== */

if (desktopToggle) {
    desktopToggle.addEventListener("click", () => {
        // REMOVE HOVER STATE
        sidebar.classList.remove("sidebar-hover");

        // TOGGLE COLLAPSE
        sidebar.classList.toggle("sidebar-collapse");

        // SAVE STATE
        const isCollapsed = sidebar.classList.contains("sidebar-collapse");
        localStorage.setItem("sidebar-collapsed", isCollapsed);
    });
}

/* ========================================
   DESKTOP HOVER SIDEBAR
======================================== */

if (sidebar) {
    // HOVER MASUK
    sidebar.addEventListener("mouseenter", () => {
        // DESKTOP ONLY
        if (window.innerWidth >= 1024) {
            // HANYA SAAT COLLAPSE
            if (sidebar.classList.contains("sidebar-collapse")) {
                sidebar.classList.add("sidebar-hover");
            }
        }
    });

    // HOVER KELUAR
    sidebar.addEventListener("mouseleave", () => {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove("sidebar-hover");
        }
    });
}

/* ========================================
   CLICK ICON MENU -> EXPAND SIDEBAR
======================================== */

sidebarLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
        // DESKTOP — jika sedang hover expand, kembali ke icon only
        if (window.innerWidth >= 1024) {
            if (sidebar.classList.contains("sidebar-collapse")) {
                sidebar.classList.remove("sidebar-hover");
            }
        }

        // ACTIVE MENU
        sidebarLinks.forEach((item) => {
            item.classList.remove("active-sidebar");
        });

        link.classList.add("active-sidebar");
    });
});

/* ========================================
   CLOSE SIDEBAR OUTSIDE
======================================== */

if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", () => {
        sidebar.classList.remove("expand");

        sidebarOverlay.classList.add("hidden");
    });
}

/* ========================================
   ESC CLOSE
======================================== */

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        // CLOSE SIDEBAR
        sidebar.classList.remove("expand");

        sidebarOverlay.classList.add("hidden");

        // CLOSE MODAL
        if (logoutModal) {
            logoutModal.classList.remove("flex");

            logoutModal.classList.add("hidden");
        }
    }
});

/* ========================================
   LOGOUT MODAL
======================================== */

const logoutBtn = document.getElementById("sidebarLogoutBtn");

const logoutModal = document.getElementById("logoutModal");

const cancelLogout = document.getElementById("cancelLogout");

const confirmLogout = document.getElementById("confirmLogout");

if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
        logoutModal.classList.remove("hidden");

        logoutModal.classList.add("flex");
    });
}

if (cancelLogout) {
    cancelLogout.addEventListener("click", () => {
        logoutModal.classList.remove("flex");

        logoutModal.classList.add("hidden");
    });
}

if (logoutModal) {
    logoutModal.addEventListener("click", (e) => {
        if (e.target === logoutModal) {
            logoutModal.classList.remove("flex");

            logoutModal.classList.add("hidden");
        }
    });
}

/* ========================================
   CONFIRM LOGOUT
======================================== */

if (confirmLogout) {
    confirmLogout.addEventListener("click", () => {
        const logoutUrl = document
            .querySelector('meta[name="logout-url"]')
            .getAttribute("content");

        window.location.href = logoutUrl;
    });
}

/* ========================================
   CARD HOVER EFFECT
======================================== */

const cards = document.querySelectorAll(".dashboard-card");

cards.forEach((card) => {
    card.addEventListener("mousemove", (e) => {
        const rect = card.getBoundingClientRect();

        const x = e.clientX - rect.left;

        const y = e.clientY - rect.top;

        card.style.background = `radial-gradient(circle at ${x}px ${y}px,
            rgba(59,130,246,.08),
            white 45%)`;
    });

    card.addEventListener("mouseleave", () => {
        card.style.background = "white";
    });
});

/* ========================================
   QUICK MENU EFFECT
======================================== */

const quickCards = document.querySelectorAll(".quick-menu-card");

quickCards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
        card.style.transition = ".3s";
    });
});

/* ========================================
   SAVE SIDEBAR SCROLL
======================================== */

const sidebarNav = document.querySelector("nav");

if (sidebarNav) {
    // RESTORE
    const savedScroll = localStorage.getItem("sidebar-scroll");

    if (savedScroll !== null) {
        sidebarNav.scrollTop = savedScroll;
    }

    // SAVE
    sidebarNav.addEventListener("scroll", () => {
        localStorage.setItem("sidebar-scroll", sidebarNav.scrollTop);
    });
}
