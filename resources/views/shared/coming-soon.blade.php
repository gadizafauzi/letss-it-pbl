<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segera Hadir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 h-screen flex flex-col items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8 text-center border border-slate-100">
        <div class="w-20 h-20 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <i data-lucide="hammer" class="w-10 h-10"></i>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-900 mb-3">Fitur Sedang Dibangun</h1>
        <p class="text-slate-500 mb-8 leading-relaxed">
            Halaman ini masih dalam tahap pengembangan dan akan segera hadir. Terima kasih atas kesabarannya!
        </p>
        <button onclick="window.history.back()" class="inline-flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg hover:-translate-y-0.5">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Kembali ke Halaman Sebelumnya
        </button>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
