@props([
    'unitLogo' => 'images/tk.jpeg',
    'unitName' => 'TK Islam Terpadu',
    'textTheme' => 'light'
])

<style>
    /* === UNIT NAVBAR STYLES === */
    #unit-navbar {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
        transition: all 0.3s ease;
        background: transparent;
        box-shadow: none;
    }

    #unit-navbar.scrolled {
        position: fixed;
        background: rgba(6, 78, 59, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .unit-nav-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .unit-nav-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .unit-nav-logo img {
        height: 40px;
        width: auto;
        object-fit: contain;
        border-radius: 8px;
    }

    .unit-nav-logo-text h1 {
        font-size: 0.9rem;
        font-weight: 800;
        color: white;
        line-height: 1.2;
        text-shadow: 0 1px 4px rgba(0,0,0,0.4);
    }

    .unit-nav-logo-text p {
        font-size: 0.65rem;
        color: rgba(255,255,255,0.8);
        line-height: 1;
    }

    .unit-nav-divider {
        width: 1px;
        height: 28px;
        background: rgba(255,255,255,0.3);
    }

    /* Desktop Links */
    .unit-nav-links {
        display: none;
        align-items: center;
        gap: 0.25rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    @media (min-width: 768px) {
        .unit-nav-links { display: flex; }
    }

    .unit-nav-links a {
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        transition: color 0.3s ease, background 0.3s ease;
        position: relative;
        text-shadow: 0 1px 4px rgba(0,0,0,0.5);
    }

    .unit-nav-links a:hover {
        color: white;
        background: rgba(255,255,255,0.15);
    }

    .unit-nav-links a.active {
        color: #34d399; /* emerald-400 */
        background: rgba(52, 211, 153, 0.15);
    }



    /* Hamburger */
    .unit-nav-hamburger {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 10px;
        cursor: pointer;
        color: white;
        transition: background 0.3s ease;
    }
    .unit-nav-hamburger:hover {
        background: rgba(255,255,255,0.2);
    }

    @media (min-width: 768px) {
        .unit-nav-hamburger { display: none; }
    }

    /* Mobile Drawer */
    .unit-mobile-drawer {
        position: fixed;
        top: 0;
        right: -100%;
        width: min(320px, 85vw);
        height: 100vh;
        background: #022c22; /* emerald-950 */
        z-index: 200;
        transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        overflow-y: auto;
        padding: 1.5rem;
        box-shadow: -10px 0 40px rgba(0,0,0,0.4);
        border-left: 1px solid rgba(255,255,255,0.06);
    }

    .unit-mobile-drawer.open {
        right: 0;
    }

    .unit-mobile-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        z-index: 199;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
        backdrop-filter: blur(2px);
    }

    .unit-mobile-overlay.open {
        opacity: 1;
        pointer-events: all;
    }

    .unit-mobile-drawer a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
        transition: background 0.2s, color 0.2s;
        margin-bottom: 0.25rem;
    }

    .unit-mobile-drawer a:hover,
    .unit-mobile-drawer a.active {
        background: rgba(52, 211, 153, 0.15);
        color: #34d399; /* emerald-400 */
    }

    .unit-mobile-drawer .drawer-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.4);
        padding: 0.5rem 1rem;
        margin-top: 1rem;
    }

    .unit-mobile-drawer .drawer-close {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 0.5rem;
        color: rgba(255,255,255,0.8);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .unit-mobile-drawer .drawer-close:hover {
        background: rgba(255,255,255,0.15);
    }

    /* === THEME DARK (For light hero backgrounds) === */
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-logo-text h1 {
        color: #064e3b; /* emerald-900 */
        text-shadow: none;
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-logo-text p {
        color: #059669; /* emerald-600 */
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-divider {
        background: rgba(5, 150, 105, 0.2);
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-links a {
        color: #064e3b;
        text-shadow: none;
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-links a:hover {
        background: rgba(5, 150, 105, 0.1);
        color: #047857;
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-links a.active {
        color: #059669;
        background: rgba(5, 150, 105, 0.15);
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-hamburger {
        color: #064e3b;
        border: 1px solid rgba(5, 150, 105, 0.2);
        background: transparent;
    }
    #unit-navbar.theme-dark:not(.scrolled) .unit-nav-hamburger:hover {
        background: rgba(5, 150, 105, 0.1);
    }
</style>

{{-- Mobile Overlay --}}
<div class="unit-mobile-overlay" id="unitMobileOverlay" onclick="closeUnitDrawer()"></div>

{{-- Mobile Drawer --}}
<div class="unit-mobile-drawer" id="unitMobileDrawer">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <img src="{{ asset($unitLogo) }}" alt="{{ $unitName }}" style="width:36px;height:36px;border-radius:8px;object-fit:contain;">
            <p style="font-weight:800;color:white;font-size:0.85rem;">{{ $unitName }}</p>
        </div>
        <button class="drawer-close" onclick="closeUnitDrawer()">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <div class="drawer-label">Navigasi</div>
    <a href="#home" class="nav-link-mobile active"><i data-lucide="home" class="w-4 h-4"></i>Home</a>
    <a href="#profil" class="nav-link-mobile"><i data-lucide="info" class="w-4 h-4"></i>Profil</a>
    <a href="#guru" class="nav-link-mobile"><i data-lucide="users" class="w-4 h-4"></i>Guru</a>
    <a href="#ekstrakurikuler" class="nav-link-mobile"><i data-lucide="star" class="w-4 h-4"></i>Ekstrakurikuler</a>
    <a href="#fasilitas" class="nav-link-mobile"><i data-lucide="building-2" class="w-4 h-4"></i>Fasilitas</a>
    <a href="#prestasi" class="nav-link-mobile"><i data-lucide="award" class="w-4 h-4"></i>Prestasi</a>
    
    <div style="margin-top:2rem; padding-top:1.5rem; border-top:1px solid rgba(255,255,255,0.06);">
        <a href="{{ route('public.ppdb.index') }}" style="background: linear-gradient(135deg, #059669, #047857); color:white; justify-content:center; border-radius:12px; padding:0.9rem 1.5rem; font-weight:800; font-size:0.85rem; display:flex; text-shadow:none;">
            Daftar PPDB
        </a>
    </div>
</div>

{{-- Navbar --}}
<nav id="unit-navbar" class="theme-{{ $textTheme }}">
    <div class="unit-nav-inner">
        {{-- Logo --}}
        <a href="{{ route('public.home') }}" class="unit-nav-logo">
            <img src="{{ asset($unitLogo) }}" alt="{{ $unitName }}">
            <div class="unit-nav-divider"></div>
            <div class="unit-nav-logo-text">
                <h1>{{ $unitName }}</h1>
                <p>SIT Mutiara Qur'an</p>
            </div>
        </a>

        {{-- Desktop Nav --}}
        <ul class="unit-nav-links">
            <li><a href="#home" class="nav-link active">Home</a></li>
            <li><a href="#profil" class="nav-link">Profil</a></li>
            <li><a href="#guru" class="nav-link">Guru</a></li>
            <li><a href="#ekstrakurikuler" class="nav-link">Ekstrakurikuler</a></li>
            <li><a href="#fasilitas" class="nav-link">Fasilitas</a></li>
            <li><a href="#prestasi" class="nav-link">Prestasi</a></li>
        </ul>

        {{-- Right Side --}}
        <div style="display:flex; align-items:center; gap:0.75rem;">
            <button class="unit-nav-hamburger" id="unitHamburger" onclick="openUnitDrawer()" aria-label="Open menu">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // ── Navbar Scroll Effect ────────────────────────
        const navbar = document.getElementById('unit-navbar');

        function handleNavbarScroll() {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', handleNavbarScroll, { passive: true });


        // ── Scroll Spy ─────────────────────────────────
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileNavLinks = document.querySelectorAll('.nav-link-mobile');

        function onScroll() {
            const scrollY = window.pageYOffset;
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        if (link.getAttribute('href') !== '#home') {
                            link.classList.remove('active');
                        }
                        if (link.getAttribute('href') === '#' + sectionId) {
                            link.classList.add('active');
                        }
                    });
                    mobileNavLinks.forEach(link => {
                        if (link.getAttribute('href') !== '#home') {
                            link.classList.remove('active');
                        }
                        if (link.getAttribute('href') === '#' + sectionId) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', onScroll, { passive: true });


        // ── Smooth Scroll ───────────────────────────────
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({ top: target.offsetTop - 72, behavior: 'smooth' });
                    closeUnitDrawer();
                }
            });
        });

    });

    // ── Mobile Drawer ───────────────────────────────
    function openUnitDrawer() {
        document.getElementById('unitMobileDrawer').classList.add('open');
        document.getElementById('unitMobileOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
        lucide.createIcons();
    }

    function closeUnitDrawer() {
        document.getElementById('unitMobileDrawer').classList.remove('open');
        document.getElementById('unitMobileOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
</script>
@endpush
