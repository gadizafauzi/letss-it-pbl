<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIT Mutiara Quran' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Sekolah Islam Terpadu Mutiara Quran - Mendidik Generasi Qurani yang Berakhlak Mulia' }}">

    {{-- TAILWIND CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased">

    {{-- NAVBAR --}}
    @include('components.public.navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.public.footer')

    {{-- JS --}}
    <script src="{{ asset('js/public.js') }}"></script>

</body>

</html>
