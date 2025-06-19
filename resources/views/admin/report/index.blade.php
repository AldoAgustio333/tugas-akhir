<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pemesanan</title>

    <!-- AdminLTE CSS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle (dengan Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


</head>
<style>
  .main-sidebar {
    background-color: #28a745 !important; /* Hijau Bootstrap */
  }

  .brand-link, .nav-sidebar > .nav-item > .nav-link {
    background-color: #28a745 !important; 
    color: #fff !important;
  }

  .nav-sidebar .nav-link.active {
    background-color: #218838 !important; /* Hijau gelap saat aktif */
    color: #fff !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.navbar')

    <!-- Sidebar -->
    @include('admin.partials.sidebar')
       <div class="content-wrapper p-3">
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3>Laporan Data Pemesanan</h3>
        </div>
        <form method="GET" action="{{ route('admin.report.index') }}" class="d-flex align-items-end gap-2">
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
            <button type="submit" class="btn btn-success">Tampilkan</button>
        </form></div>
 
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>JBI</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Tarif</th>
                <th>Bukti TF</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPemesanan as $pemesanan)
            <tr>
                <td>{{ $pemesanan->nama_pemesan }}</td>
                <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
                <td>{{ $pemesanan->jam_awal }} - {{ $pemesanan->jam_akhir }}</td>
                <td>{{ $pemesanan->tanggal }}</td>
                <td>{{ ucfirst($pemesanan->status) }}</td>
                <td>Rp {{ number_format($pemesanan->biaya, 0, ',', '.') }}</td>
                <td>
                    @if ($pemesanan->bukti_pembayaran)
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalBukti{{ $pemesanan->id }}">
                        Lihat
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalBukti{{ $pemesanan->id }}" tabindex="-1" aria-labelledby="modalBuktiLabel{{ $pemesanan->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalBuktiLabel{{ $pemesanan->id }}">Bukti Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                     <img src="{{ asset('uploads/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 500px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

      
<div class="container mt-4">
    <h3>Laporan Ketersediaan JBI</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <!-- <th>#</th> -->
                <th>Nama Pemesan</th>
                <th>Keahlian</th>
                <th>JK</th>
                <th>No Hp</th>
                <th>Ketersediaan</th>
                <th>Jadwal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataJbi as $jbi)
            <tr>
                <td>{{ $jbi->nama }}</td>
                <td>{{ $jbi->keahlian }}</td>
                <td>{{ $jbi->jk }}</td>
                <td>{{ $jbi->no_hp }}</td>
                <td>{{ $jbi->ketersediaan }}</td>
                <td>{{ $jbi->jadwal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

</div>

