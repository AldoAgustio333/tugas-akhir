<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

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
        <div class="small-box bg-info">
            <div class="inner">
                <h3>asjdgh</h3>
                <p>Jumlah User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            
            
        </div>
    </div>

    <!-- Jumlah JBI -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>asd</h3>
                <p>Jumlah JBI</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            
        </div>
    </div>

    <!-- Jumlah Order -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>asdasd</h3>
                <p>Jumlah Order</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
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

