{{-- RUNNING MARQUEE --}}
    <div class="announcement-marquee">
        <div class="marquee-container">
            <span class="marquee-badge">Pengumuman</span>
            <div class="marquee-track">
                @forelse($marqueeItems ?? [] as $item)
                    <span class="marquee-item">{{ $item->text }}</span>
                @empty
                    <span class="marquee-item">📢 Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }} Resmi Dibuka! Gelombang 1 Dapatkan Diskon Dana Pembangunan.</span>
                    <span class="marquee-item">🏆 Alhamdulillah, Siswa SMP IT Mutiara Qur'an Meraih Medali Emas & Perak pada Olimpiade Sains Nasional Tingkat Kabupaten Solok!</span>
                    <span class="marquee-item">🕌 Wisuda Tahfidz Qur'an Angkatan ke-8 Sukses Diselenggarakan, Melahirkan 45 Hafizh Cilik yang Siap Berbakti.</span>
                @endforelse
                <!-- Repeat for infinite scroll continuity -->
                @forelse($marqueeItems ?? [] as $item)
                    <span class="marquee-item">{{ $item->text }}</span>
                @empty
                    <span class="marquee-item">📢 Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an TA {{ date('Y') }}/{{ date('Y')+1 }} Resmi Dibuka! Gelombang 1 Dapatkan Diskon Dana Pembangunan.</span>
                    <span class="marquee-item">🏆 Alhamdulillah, Siswa SMP IT Mutiara Qur'an Meraih Medali Emas & Perak pada Olimpiade Sains Nasional Tingkat Kabupaten Solok!</span>
                    <span class="marquee-item">🕌 Wisuda Tahfidz Qur'an Angkatan ke-8 Sukses Diselenggarakan, Melahirkan 45 Hafizh Cilik yang Siap Berbakti.</span>
                @endforelse
            </div>
        </div>
    </div>

