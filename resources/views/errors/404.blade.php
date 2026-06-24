<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc; /* Slate 50 */
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col items-center justify-center bg-[#f8fafc] p-4 relative">
    
    <div class="w-full text-center space-y-4 sm:space-y-6 flex flex-col items-center">
        
        {{-- Illustration Area --}}
        <div class="relative w-32 h-32 sm:w-40 sm:h-40 mx-auto mb-2 sm:mb-4">
            <div class="absolute inset-0 bg-slate-100 rounded-full blur-2xl opacity-50 animate-pulse"></div>
            <div class="relative w-full h-full flex items-center justify-center bg-white rounded-full shadow-xl shadow-slate-900/5 border border-slate-100">
                <i data-lucide="compass" class="w-16 h-16 sm:w-20 sm:h-20 text-slate-700"></i>
            </div>
            
            {{-- Floating Elements --}}
            <div class="absolute -top-1 -right-1 sm:-top-2 sm:-right-2 w-8 h-8 sm:w-10 sm:h-10 bg-slate-100 rounded-full flex items-center justify-center shadow-lg animate-bounce" style="animation-delay: 0.1s">
                <i data-lucide="map-pin-off" class="w-4 h-4 sm:w-5 sm:h-5 text-slate-800"></i>
            </div>
            <div class="absolute -bottom-1 -left-1 sm:-bottom-2 sm:-left-2 w-10 h-10 sm:w-12 sm:h-12 bg-red-100 rounded-full flex items-center justify-center shadow-lg animate-bounce" style="animation-delay: 0.5s">
                <i data-lucide="search-x" class="w-5 h-5 sm:w-6 sm:h-6 text-red-500"></i>
            </div>
        </div>

        {{-- Text Content --}}
        <div class="space-y-2">
            <h1 class="text-6xl sm:text-7xl font-black text-slate-800 tracking-tighter">404</h1>
            <h2 class="text-xl sm:text-2xl font-bold text-slate-700">Oops! Halaman Tidak Ditemukan</h2>
            <p class="text-slate-500 text-sm sm:text-base max-w-md mx-auto leading-relaxed px-4">
                URL yang Anda tuju mungkin salah ketik, telah dihapus, atau tidak pernah ada. Mari kembali ke jalan yang benar.
            </p>
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-row items-center justify-center gap-3 sm:gap-4 pt-2">
            <a href="javascript:history.back()" class="px-5 py-2.5 rounded-xl bg-white border-2 border-slate-200 text-slate-700 font-semibold hover:border-slate-300 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-sm sm:text-base">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
            <a href="{{ url('/') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-800 text-white font-semibold transition-all shadow-md shadow-slate-700/30 flex items-center justify-center gap-2 text-sm sm:text-base">
                <i data-lucide="home" class="w-4 h-4"></i>
                Ke Beranda
            </a>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
