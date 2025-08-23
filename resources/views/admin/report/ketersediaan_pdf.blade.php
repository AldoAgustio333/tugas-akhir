<!DOCTYPE html>
<html>
<head>
    <title>Laporan Ketersediaan JBI</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Ketersediaan JBI</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keahlian</th>
                <th>JK</th>
                <th>No Hp</th>
                <th>Ketersediaan</th>
                <th>Jadwal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataJbi as $index => $jbi)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $jbi->nama }}</td>
                    <td>{{ $jbi->keahlian }}</td>
                    <td>{{ $jbi->jk }}</td>
                    <td>{{ $jbi->no_hp }}</td>
                    <td>{{ $jbi->ketersediaan }}</td>
                    <td>{{ $jbi->jadwal }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
