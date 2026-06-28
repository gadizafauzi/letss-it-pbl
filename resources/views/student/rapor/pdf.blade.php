<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rapor {{ $student->full_name }}</title>
    <style>
        body { font-family: 'Inter', sans-serif; color: #1e293b; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { width: 80px; margin-bottom: 10px; }
        .title { font-size: 24px; font-weight: 600; }
        .section { margin-bottom: 20px; }
        .section h2 { font-size: 18px; border-bottom: 2px solid #3b5998; padding-bottom: 5px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px 12px; border: 1px solid #e2e8f0; text-align: left; }
        th { background-color: #3b5998; color: #ffffff; }
        .grade { font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo" />
        <div class="title">Rapor Siswa</div>
        <div>{{ $student->full_name }} - {{ $student->nis }}</div>
    </div>

    <div class="section">
        <h2>Identitas Siswa</h2>
        <p><strong>Nama:</strong> {{ $student->full_name }}</p>
        <p><strong>NIS:</strong> {{ $student->nis }}</p>
        <p><strong>Kelas:</strong> {{ $student->studentClasses->first()->schoolClass->name ?? '-' }}</p>
        <p><strong>Tahun Ajaran:</strong> {{ $student->studentClasses->first()->academicYear->year ?? '-' }}</p>
    </div>

    <div class="section">
        <h2>Nilai</h2>
        <table>
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $grade)
                <tr>
                    <td>{{ $grade->subject->name }}</td>
                    <td class="grade">{{ $grade->value }}</td>
                </tr>
                @empty
                <tr><td colspan="2" style="text-align:center;">Tidak ada data nilai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section" style="text-align:right; margin-top:40px;">
        <p>Generated on {{ now()->format('d/m/Y') }}</p>
    </div>
</body>
</html>
