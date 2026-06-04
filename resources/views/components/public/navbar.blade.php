{{-- NAVBAR --}}
<nav class="public-navbar">

    {{-- LOGO --}}
    <a href="{{ route('public.home') }}" class="nav-logo">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo SIT Mutiara Quran">
        <img src="{{ asset('images/logo_jsit.png') }}" alt="Logo JSIT Indonesia">
        <div class="nav-logo-text">
            <h1>SIT Mutiara Qur'an</h1>
            <p>Sekolah Islam Terpadu</p>
        </div>
    </a>

    {{-- DESKTOP MENU --}}
    <ul class="nav-menu">
        <li><a href="{{ route('public.home') }}" class="{{ request()->routeIs('public.home') ? 'active' : '' }}">Beranda</a></li>

        {{-- PROFIL DROPDOWN --}}
        <li class="nav-dropdown">
            <button class="nav-dropdown-btn {{ request()->is('profil*') ? 'active' : '' }}">
                Profil <i data-lucide="chevron-down" class="w-3.5 h-3.5 ml-1"></i>
            </button>
            <div class="nav-dropdown-menu">
                <a href="{{ route('public.profil.visi-misi') }}">Visi & Misi</a>
                <a href="{{ route('public.profil.sejarah') }}">Sejarah</a>
                <a href="{{ route('public.profil.struktur-organisasi') }}">Struktur Organisasi</a>
            </div>
        </li>

        {{-- UNIT DROPDOWN --}}
        <li class="nav-dropdown">
            <button class="nav-dropdown-btn {{ request()->is('unit*') ? 'active' : '' }}">
                Unit Pendidikan <i data-lucide="chevron-down" class="w-3.5 h-3.5 ml-1"></i>
            </button>
            <div class="nav-dropdown-menu">
                <a href="{{ route('public.unit.index') }}">Semua Unit</a>
                <a href="{{ route('public.unit.tk.profil') }}">TK Islam Terpadu</a>
                <a href="{{ route('public.unit.sd.profil') }}">SD Islam Terpadu</a>
                <a href="{{ route('public.unit.smp.profil') }}">SMP Islam Terpadu</a>
            </div>
        </li>

        <li><a href="{{ route('public.berita.index') }}" class="{{ request()->is('berita*') ? 'active' : '' }}">Berita</a></li>
        <li><a href="{{ route('public.ppdb.index') }}" class="{{ request()->is('ppdb*') ? 'active' : '' }}">PPDB</a></li>
        <li><a href="{{ route('login') }}" class="nav-login-btn"><i data-lucide="log-in" class="w-4 h-4"></i> Login</a></li>
    </ul>

    {{-- HAMBURGER --}}
    <button id="navHamburger" class="nav-hamburger" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>

</nav>

{{-- MOBILE MENU --}}
<div id="navMobileMenu" class="nav-mobile-menu">
    <a href="{{ route('public.home') }}" class="{{ request()->routeIs('public.home') ? 'active' : '' }}"><i data-lucide="home" class="w-5 h-5"></i> Beranda</a>

    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-4 mb-1 px-4">Profil</p>
    <a href="{{ route('public.profil.visi-misi') }}"><i data-lucide="eye" class="w-5 h-5"></i> Visi & Misi</a>
    <a href="{{ route('public.profil.sejarah') }}"><i data-lucide="clock" class="w-5 h-5"></i> Sejarah</a>
    <a href="{{ route('public.profil.struktur-organisasi') }}"><i data-lucide="network" class="w-5 h-5"></i> Struktur Organisasi</a>

    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-4 mb-1 px-4">Unit Pendidikan</p>
    <a href="{{ route('public.unit.index') }}"><i data-lucide="layers-3" class="w-5 h-5"></i> Semua Unit</a>
    <a href="{{ route('public.unit.tk.profil') }}"><i data-lucide="baby" class="w-5 h-5"></i> TK Islam Terpadu</a>
    <a href="{{ route('public.unit.sd.profil') }}"><i data-lucide="school" class="w-5 h-5"></i> SD Islam Terpadu</a>
    <a href="{{ route('public.unit.smp.profil') }}"><i data-lucide="graduation-cap" class="w-5 h-5"></i> SMP Islam Terpadu</a>

    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-4 mb-1 px-4">Lainnya</p>
    <a href="{{ route('public.berita.index') }}"><i data-lucide="newspaper" class="w-5 h-5"></i> Berita</a>
    <a href="{{ route('public.ppdb.index') }}"><i data-lucide="file-text" class="w-5 h-5"></i> PPDB</a>

    <a href="{{ route('login') }}" class="nav-login-btn mt-4 justify-center"><i data-lucide="log-in" class="w-5 h-5"></i> Login</a>
</div>
