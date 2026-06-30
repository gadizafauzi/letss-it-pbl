<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Guru' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher.css') }}">
    <!-- Load Regular Teacher Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/teacher/regular-theme.css') }}">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-[var(--theme-bg-workspace)] text-[var(--text-main)] overflow-hidden transition-colors duration-300">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-screen overflow-hidden">

    @include('components.teacher.regular-sidebar')

    <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">
        @include('components.shared.header-teacher')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

</div>

<x-shared.logout-modal id="teacherLogoutModal" cancelId="teacherCancelLogout" action="{{ route('logout') }}" />

<script src="{{ asset('js/teacher.js') }}"></script>
<script>
    lucide.createIcons();

    // Theme Toggle Logic
    const themeToggleBtn = document.getElementById('themeToggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }
</script>

</body>
</html>
