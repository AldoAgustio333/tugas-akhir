<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan & JBI</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>Laporan Data Pemesanan @if($tanggal) (Tanggal: {{ $tanggal }}) @endif</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>JBI</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Tarif</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPemesanan as $p)
            <tr>
                <td>{{ $p->nama_pemesan }}</td>
                <td>{{ $p->jbi->nama ?? '-' }}</td>
                <td>{{ $p->jam_awal }} - {{ $p->jam_akhir }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>Rp {{ number_format($p->biaya, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
