<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout') }}">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- ICON --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="bg-slate-50 text-slate-800 overflow-hidden">

    {{-- OVERLAY --}}
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden md:hidden">
    </div>

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        @include('components.admin.sidebar')

        {{-- MAIN --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- HEADER --}}
            @include('components.shared.header', [
                'title' => $headerTitle ?? 'Dashboard',
                'subtitle' => $headerSubtitle ?? 'Selamat datang kembali'
            ])

            {{-- CONTENT --}}
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    {{-- LOGOUT MODAL --}}
    @include('components.admin.logout-modal')

    {{-- JS --}}
    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>