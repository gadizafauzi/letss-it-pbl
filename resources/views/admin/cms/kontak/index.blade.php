@extends('layouts.admin')

@section('title', 'Kontak & Maps')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Pengaturan Kontak & Peta</h1>
    <p class="text-slate-500 mt-1 text-sm">Kelola informasi kontak dan lokasi sekolah yang akan tampil di halaman publik (Website & PPDB).</p>
</div>

<form action="{{ route('admin.kontak.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Kiri: Info Kontak --}}
        <div class="space-y-5">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center gap-2 text-lg">
                    <i data-lucide="phone-call" class="w-5 h-5 text-blue-500"></i>
                    Informasi Komunikasi
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor Telepon Sekolah</label>
                        <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '+62 822-8620-4878') }}"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nomor WhatsApp PPDB</label>
                        <p class="text-xs text-slate-500 mb-1">Format: 628xxx (Tanpa + atau 0, ini untuk tombol chat langsung)</p>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '6282286204878') }}"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email Sekolah</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'info@sitmutiaraquran.sch.id') }}"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center gap-2 text-lg">
                    <i data-lucide="clock" class="w-5 h-5 text-amber-500"></i>
                    Jam Operasional
                </h3>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jam Layanan PPDB</label>
                    <p class="text-xs text-slate-500 mb-1">Gunakan enter untuk baris baru.</p>
                    <textarea name="operational_hours" rows="3"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('operational_hours', $settings['operational_hours'] ?? "Senin – Jum'at: 08.00 – 14.00 WIB") }}</textarea>
                </div>
            </div>
        </div>

        {{-- Kanan: Alamat & Maps --}}
        <div class="space-y-5">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center gap-2 text-lg">
                    <i data-lucide="map-pin" class="w-5 h-5 text-emerald-500"></i>
                    Lokasi Sekolah
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('address', $settings['address'] ?? "Karasak, Jorong Pasar Baru,\nCupak, Gunung Talang, Solok") }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link Embed Google Maps (Iframe SRC)</label>
                        <p class="text-xs text-slate-500 mb-2 flex items-start gap-1">
                            <i data-lucide="info" class="w-4 h-4 shrink-0 text-blue-500"></i>
                            <span>Buka Google Maps > Bagikan > Sematkan Peta > Copy src url-nya saja (isi dari attribute src="...")</span>
                        </p>
                        <textarea name="maps_embed" rows="4" placeholder="https://www.google.com/maps/embed?pb=..."
                            class="w-full font-mono text-xs rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">{{ old('maps_embed', $settings['maps_embed'] ?? "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31914.641419208794!2d100.598466!3d-0.8962703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1780587530868!5m2!1sid!2sid") }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
                <h3 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center gap-2 text-lg">
                    <i data-lucide="share-2" class="w-5 h-5 text-indigo-500"></i>
                    Media Sosial Sekolah
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" placeholder="https://facebook.com/username"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                        @error('facebook')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" placeholder="https://instagram.com/username"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                        @error('instagram')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link YouTube</label>
                        <input type="text" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" placeholder="https://youtube.com/channel"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2.5 focus:ring-blue-500 focus:border-blue-500">
                        @error('youtube')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button type="submit"
            class="px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors flex items-center gap-2 shadow-sm">
            <i data-lucide="save" class="w-5 h-5"></i> Simpan Pengaturan Kontak
        </button>
    </div>
</form>
@endsection
