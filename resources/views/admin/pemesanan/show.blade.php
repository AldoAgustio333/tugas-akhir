<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pemesanan</title>

    <!-- AdminLTE CSS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>

<style>
    .main-sidebar {
        background-color: #28a745 !important;
    }
    .brand-link, .nav-sidebar > .nav-item > .nav-link {
        background-color: #28a745 !important;
        color: #fff !important;
    }
    .nav-sidebar .nav-link.active {
        background-color: #218838 !important;
        color: #fff !important;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.navbar')

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h4 class="mt-4">Detail Pemesanan</h4>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama Pemesan</th>
                                <td>{{ $pemesanan->nama_pemesan }}</td>
                            </tr>
                            <tr>
                                <th>JBI</th>
                                <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <td>{{ $pemesanan->waktu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal)->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ ucfirst($pemesanan->status) }}</td>
                            </tr>
                            <tr>
                                <th>Tarif</th>
                                <td>Rp{{ number_format($pemesanan->tarif ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Bukti Transfer</th>
                                <td class="text-center">
                                    @if($pemesanan->bukti_tf)
                                        <img src="{{ asset('uploads/bukti_tf/' . $pemesanan->bukti_tf) }}" alt="Bukti Transfer" class="img-fluid rounded" style="max-height: 400px;">
                                    @else
                                        <p class="text-muted">Tidak ada bukti transfer.</p>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- AdminLTE Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
