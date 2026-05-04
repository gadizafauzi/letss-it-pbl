{{-- lagi maintenance --}}

<aside class="w-64 bg-slate-900 text-slate-300 min-h-screen flex flex-col">

    <!-- LOGO -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800">
        <h1 class="text-white font-semibold">SIT</h1>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-4 text-sm space-y-1">

        <!-- DASHBOARD -->
        <x-admin-link route="admin.dashboard" icon="home">
            Dashboard
        </x-admin-link>

        <!-- DATA MASTER -->
        <p class="text-xs text-slate-500 mt-6 mb-2 uppercase">Data Master</p>

        <x-admin-link icon="student">Data Siswa</x-admin-link>
        <x-admin-link icon="teacher">Data Guru</x-admin-link>
        <x-admin-link icon="class">Data Kelas</x-admin-link>
        <x-admin-link icon="book">Mata Pelajaran</x-admin-link>
        <x-admin-link icon="teach">Data Mengajar</x-admin-link>
        <x-admin-link icon="calendar">Tahun Ajaran</x-admin-link>
        <x-admin-link icon="money">Pembayaran/Tagihan</x-admin-link>

        <!-- CMS -->
        <p class="text-xs text-slate-500 mt-6 mb-2 uppercase">CMS Sekolah</p>

        <x-admin-link icon="home">Beranda</x-admin-link>
        <x-admin-link icon="school">Profil Sekolah</x-admin-link>
        <x-admin-link icon="unit">Unit Pendidikan</x-admin-link>
        <x-admin-link icon="news">Berita & Kegiatan</x-admin-link>
        <x-admin-link icon="doc">Informasi PPDB</x-admin-link>
        <x-admin-link icon="chat">Kontak</x-admin-link>

        <!-- USER -->
        <p class="text-xs text-slate-500 mt-6 mb-2 uppercase">Manajemen User</p>

        <x-admin-link icon="user">Data User</x-admin-link>

        <!-- SETTINGS -->
        <p class="text-xs text-slate-500 mt-6 mb-2 uppercase">Pengaturan</p>

        <x-admin-link icon="setting">Profil</x-admin-link>

    </nav>

</aside>
