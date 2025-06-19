<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
  </head>

  <style>
    .nav-item a{
        font-size:12px;
    }
  </style>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #198754;">
        <div class="container-fluid">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">Beranda</a></li>
                @if (Route::currentRouteName() === 'dashboard')
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#pesan">Pesan</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#tentang">Tentang Kami</a></li>
                    @endif
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="{{ route('user.jbi.index') }}">JBI</a></li>
                    @if (Route::currentRouteName() === 'dashboard')
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="#testimoni">Testimoni</a></li>
                     @endif
                    <!-- <li class="nav-item mx-2"><a class="nav-link text-white" href="{{ route('testimoni.index') }}">Testimoni</a></li> -->

                    <li class="nav-item mx-2"><a class="nav-link text-white" href="{{ route('riwayat.index') }}">Riwayat</a></li>
                    <li class="nav-item mx-2"><a class="nav-link text-white" href="{{ route('user.profil') }}">Profile</a></li>
                    <li class="nav-item mx-2"><form action="/logout" method="POST" class="d-inline">
        <!-- Jika menggunakan Laravel, jangan lupa csrf token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn border-0 text-white" type="submit" style="font-size:12px;">Logout</button>
    </form></li>

                    @if (Route::currentRouteName() === 'user.dashboard')
                        <li class="nav-item ms-2">
                            <!-- <form class="d-flex" id="navbarSearchForm" role="search">
                                <input class="form-control form-control-sm me-2" type="search" id="navbarSearchInput" placeholder="Cari..." aria-label="Search">
                                <button class="btn btn-outline-light btn-sm" type="submit">Cari</button>
                            </form> -->
                            
                        </li>
                        
                    @endif
                    <li class="nav-item ms-3">
                        <a class="nav-link text-white" href="{{ route('user.notifikasi') }}">
                            <i class="bi bi-bell-fill"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Dinamis -->
    @yield('content')

    <!-- Footer Start -->
<footer style="background-color: #2e7d32; color: white; padding: 40px 20px;">
  <div style="
    display: flex; 
    flex-wrap: wrap; 
    justify-content: space-between; 
    gap: 40px; 
    max-width: 1200px; 
    margin: auto;
  ">

    <!-- Kolom Kiri -->
    <div style="flex: 1; min-width: 300px; padding-right: 20px;">
     <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 50px;">

      
      <p style="text-align: justify;">
       Wujudkan kesetaraan akses informasi dan komunikasi bagi kalangan Tuli
      </p>

      <h4>Ikuti Kami</h4>
      <div style="margin-bottom: 10px;">
        <a href="#"><i class="fab fa-facebook-f text-white me-2"></i></a>
<a href="#"><i class="fab fa-instagram text-white me-2"></i></a>
<a href="#"><i class="fab fa-twitter text-white me-2"></i></a>

      </div>

      <h4>Kontak Kami</h4>
      <p>Email: <a href="mailto:example@gmail.com" style="color: white;">example@gmail.com</a></p>
      <p>Phone: <a href="tel:+6281234567890" style="color: white;">+62 812-3456-7890</a></p>
    </div>

    <!-- Kolom Kanan -->
    <div style="flex: 1; min-width: 300px; padding-left: 20px;">
      <h4>Alamat Kami</h4>
      <p style="text-align: justify;">
       Jl. Dr. Mohammad Hatta Limau Manis, Pauh, Padang, Sumatera Barat, Indonesia
      </p>
      <img src="{{ asset('images/map.png') }}" alt="Lokasi Peta" style="width: 100%; max-width: 400px; border-radius: 8px; margin-top: 10px;">
    </div>

  </div>
</footer>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#198754'
    });
</script>
@endif
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#d33'
        });
    </script>
@endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
