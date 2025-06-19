<!-- resources/views/layouts/admin.blade.php -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- AdminLTE CSS via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

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

  .card3{
    background-color: #218838;
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
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
    <!-- Jumlah User -->
                <div class="col-lg-4 col-6">
                        <div class="bg-warning p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah User</h5>
                                <p class="text-white mb-0">{{ $jumlahUser }}</p>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4 col-6">
                        <div class="bg-success p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah JBI</h5>
                                <p class="text-white mb-0">{{ $jumlahJbi }}</p>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-4 col-6">
                        <div class="card3 p-3 rounded d-flex align-items-center shadow">
                            <div class="me-3">
                                <i class="fas fa-tasks fa-2x text-white"></i>
                            </div>
                            <div class="mx-4">
                                <h5 class="text-white mb-1">Jumlah Order</h5>
                                <p class="text-white mb-0">{{ $jumlahPemesanan }}</p>
                            </div>
                        </div>
                    </div>



    <!-- Tabel Pesanan Terbaru -->
<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header text-white">
            <h3 class="card-title text-dark" style="font-weight:bold;">Pesanan Terbaru</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <!-- <th>#</th> -->
                        <th>Nama Pemesan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesananTerbaru as $pemesanan)
                        <tr>
                            <!-- <td>{{ $loop->iteration }}</td> -->
                            <td>{{ $pemesanan->nama_pemesan }}</td>
                            <td>{{ $pemesanan->jbi->nama ?? '-' }}</td>
                            <td>{{ $pemesanan->jam_awal }}</td>
                            <td>{{ $pemesanan->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

                @yield('content')
            </div>
        </section>
    </div>

    

    <!-- Footer -->
    @include('admin.partials.footer')

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 20px;">
    @csrf
    <button type="submit" style="
        background-color: #e3342f;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    ">Logout</button>
</form>

</body>
</html>

