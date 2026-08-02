<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa SD' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1.0.7">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">
    <!-- Load SD Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/student/sd-theme.css') }}">

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-[var(--theme-bg-workspace)] text-[var(--text-main)] overflow-hidden transition-colors duration-300">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-[100dvh] w-full overflow-hidden max-w-full">

    @include('components.student.sd.sidebar')

    <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">
        @include('components.shared.header-student')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </main>
    </div>

</div>

<x-shared.logout-modal id="studentLogoutModal" cancelId="studentCancelLogout" action="{{ route('logout') }}" />

<script src="{{ asset('js/students.js') }}"></script>

</body>
</html>
