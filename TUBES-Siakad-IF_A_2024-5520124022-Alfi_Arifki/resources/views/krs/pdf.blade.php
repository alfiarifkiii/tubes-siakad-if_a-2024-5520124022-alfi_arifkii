<!DOCTYPE html>
<html>
<head>
    <title>Cetak KRS</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #2E5AA7; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #2E5AA7; font-size: 24px;}
        .header p { margin: 5px 0 0; color: #666; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .data-table th { background-color: #2E5AA7; color: white; }
        .text-center { text-align: center; }
        .total-row td { font-weight: bold; background-color: #f8f9fa; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h1>KARTU RENCANA STUDI (KRS)</h1>
        <p>Sistem Informasi Akademik Sederhana</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>Nama</strong></td>
            <td width="35%">: {{ $user->name }}</td>
            <td width="15%"><strong>Dosen Wali</strong></td>
            <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>NPM</strong></td>
            <td>: {{ $user->npm }}</td>
            <td><strong>Tanggal Cetak</strong></td>
            <td>: {{ date('d M Y') }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%">Kode Mata Kuliah</th>
                <th width="55%">Nama Mata Kuliah</th>
                <th width="20%" class="text-center">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krs as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->matakuliah->nama_matakuliah }}</td>
                <td class="text-center">{{ $item->matakuliah->sks }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">Total SKS yang diambil:</td>
                <td class="text-center">{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>{{ $mahasiswa->dosen->nama ?? 'Dosen Wali' }}</strong></p>
    </div>

</body>
</html>