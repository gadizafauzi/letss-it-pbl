@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Sejarah</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Sejarah Sekolah</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Perjalanan SIT Mutiara Qur'an dari awal pendirian hingga saat ini.</p>
        </div>
    </div>

    {{-- TIMELINE --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="glow-emerald top-10 left-10"></div>
        <div class="glow-amber bottom-10 right-10"></div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="clock" class="w-4 h-4"></i> Sejarah</span>
                <h2 class="section-title mx-auto">Perjalanan & Milestones Kami</h2>
                <p class="section-subtitle mx-auto text-center">Telusuri rekam jejak perkembangan SIT Mutiara Qur'an dari masa ke masa dengan mengklik tahun di bawah.</p>
            </div>

            @php
                $sejarah = [
                    ['tahun' => '2010', 'judul' => 'Pendirian Sekolah', 'desc' => 'SIT Mutiara Quran didirikan oleh yayasan dengan 2 kelas pertama dan 30 siswa. Visi awal adalah menciptakan pendidikan Islam yang memadukan ilmu dunia dan akhirat.'],
                    ['tahun' => '2012', 'judul' => 'Pembukaan PAUD/TK', 'desc' => 'Membuka jenjang PAUD/TK Islam Terpadu untuk memulai pendidikan Qur\'ani sejak usia dini.'],
                    ['tahun' => '2014', 'judul' => 'Akreditasi A', 'desc' => 'Meraih akreditasi A dari BAN-S/M untuk jenjang SD Islam Terpadu, membuktikan kualitas pendidikan yang unggul.'],
                    ['tahun' => '2016', 'judul' => 'Wisuda Tahfidz Pertama', 'desc' => 'Angkatan pertama program tahfidz berhasil menyelesaikan target hafalan, menandai keberhasilan program unggulan.'],
                    ['tahun' => '2018', 'judul' => 'Pembukaan SMP IT', 'desc' => 'Membuka jenjang SMP Islam Terpadu untuk melanjutkan misi pendidikan ke tingkat yang lebih tinggi.'],
                    ['tahun' => '2021', 'judul' => 'Prestasi Nasional', 'desc' => 'Siswa berhasil meraih prestasi di tingkat nasional dalam bidang tahfidz dan olimpiade sains.'],
                    ['tahun' => '2023', 'judul' => 'Kampus Baru', 'desc' => 'Pindah ke kampus baru dengan fasilitas modern termasuk laboratorium, perpustakaan digital, dan area bermain yang luas.'],
                    ['tahun' => '2025', 'judul' => 'Era Digital', 'desc' => 'Meluncurkan sistem informasi akademik terintegrasi dan portal pembelajaran digital untuk seluruh jenjang.'],
                ];
            @endphp

            {{-- Stepper Timeline --}}
            <div class="flex items-center justify-between relative max-w-3xl mx-auto mb-16 px-4 py-6 overflow-x-auto no-scrollbar fade-up" style="scroll-behavior: smooth;">
                {{-- Decorative horizontal line --}}
                <div class="absolute top-[48px] left-[5%] right-[5%] h-1 bg-slate-200 z-0"></div>
                <div class="absolute top-[48px] left-[5%] h-1 bg-emerald-500 z-0 transition-all duration-500" id="timelineProgress" style="width: 0%;"></div>
                
                @foreach($sejarah as $index => $item)
                    <button onclick="selectTimeline({{ $index }}, this)" class="relative z-10 flex flex-col items-center group timeline-btn outline-none focus:outline-none flex-shrink-0 px-2 sm:px-4">
                        <div class="w-12 h-12 rounded-full border-2 bg-white flex items-center justify-center font-bold text-xs sm:text-sm transition-all duration-300 cursor-pointer {{ $index === 0 ? 'border-emerald-500 text-emerald-600 shadow-lg shadow-emerald-100 ring-4 ring-emerald-50' : 'border-slate-300 text-slate-400 hover:border-slate-400 hover:text-slate-600' }} timeline-dot-circle">
                            {{ $item['tahun'] }}
                        </div>
                    </button>
                @endforeach
            </div>

            {{-- Milestone Details Display --}}
            <div class="max-w-3xl mx-auto relative bg-white border border-slate-100 p-8 sm:p-12 rounded-[32px] shadow-xl shadow-slate-100/50 min-h-[260px] fade-up">
                <div class="glow-emerald top-0 left-0"></div>
                
                <div class="relative z-10" id="milestoneContent">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 transition-all duration-300 transform opacity-100 scale-100" id="milestoneContainer">
                        <div class="w-20 h-20 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0" id="milestoneIcon">
                            <i data-lucide="award" class="w-10 h-10"></i>
                        </div>
                        <div class="text-center sm:text-left">
                            <span class="text-xs font-black text-amber-500 uppercase tracking-widest" id="milestoneYear">Tahun 2010</span>
                            <h3 class="text-2xl font-black text-slate-800 mt-1 mb-4" id="milestoneTitle">Pendirian Sekolah</h3>
                            <p class="text-sm sm:text-base text-slate-500 leading-relaxed" id="milestoneDesc">
                                SIT Mutiara Quran didirikan oleh yayasan dengan 2 kelas pertama dan 30 siswa. Visi awal adalah menciptakan pendidikan Islam yang memadukan ilmu dunia dan akhirat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- INTERACTIVE TIMELINE JAVASCRIPT --}}
    <script>
        const sejarahData = @json($sejarah);
        const icons = ['award', 'baby', 'shield-check', 'book-open', 'graduation-cap', 'trophy', 'home', 'monitor'];

        function selectTimeline(index, btn) {
            // Update active states of circles
            document.querySelectorAll('.timeline-dot-circle').forEach((circle, idx) => {
                if (idx === index) {
                    circle.classList.remove('border-slate-300', 'text-slate-400');
                    circle.classList.add('border-emerald-500', 'text-emerald-600', 'shadow-lg', 'shadow-emerald-100', 'ring-4', 'ring-emerald-50');
                } else {
                    circle.classList.remove('border-emerald-500', 'text-emerald-600', 'shadow-lg', 'shadow-emerald-100', 'ring-4', 'ring-emerald-50');
                    circle.classList.add('border-slate-300', 'text-slate-400');
                }
            });

            // Update horizontal progress bar width
            const progress = document.getElementById('timelineProgress');
            if (progress) {
                const pct = (index / (sejarahData.length - 1)) * 90; // Align with the right dot
                progress.style.width = pct + "%";
            }

            // Animate content container out and in
            const container = document.getElementById('milestoneContainer');
            if (container) {
                container.style.opacity = '0';
                container.style.transform = 'translateY(12px) scale(0.98)';

                setTimeout(() => {
                    // Set new data
                    document.getElementById('milestoneYear').innerText = "Tahun " + sejarahData[index].tahun;
                    document.getElementById('milestoneTitle').innerText = sejarahData[index].judul;
                    document.getElementById('milestoneDesc').innerText = sejarahData[index].desc;
                    
                    // Update Icon
                    const iconContainer = document.getElementById('milestoneIcon');
                    if (iconContainer) {
                        iconContainer.innerHTML = `<i data-lucide="${icons[index] || 'star'}" class="w-10 h-10"></i>`;
                    }
                    
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }

                    // Animate container back in
                    container.style.opacity = '1';
                    container.style.transform = 'translateY(0) scale(1)';
                }, 200);
            }
        }

        // Initialize progress line width
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const progress = document.getElementById('timelineProgress');
                if (progress) progress.style.width = "0%";
            }, 500);
        });
    </script>

@endsection
