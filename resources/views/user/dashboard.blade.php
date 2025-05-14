<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #198754;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="#">Logo</a>

        <!-- Toggle untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigasi kanan -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-white" href="#">Beranda</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Pesan</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">JBI</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Testimoni</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#">Riwayat</a></li>

                <!-- Search box -->
                <li class="nav-item ms-2">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Cari..." aria-label="Search">
                        <button class="btn btn-outline-light btn-sm" type="submit">Cari</button>
                    </form>
                </li>

                <!-- Icon lonceng -->
                <li class="nav-item ms-3">
                    <a class="nav-link text-white" href="#">
                        <i class="bi bi-bell-fill"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
<div class="container-fluid p-0">
    <div class="position-relative">
        <img src="{{ asset('images/hero.png') }}" class="img-fluid w-100" style="height: 600px; object-fit: cover;" alt="Hero Image">
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
            <!-- <h1 class="fw-bold">Selamat Datang di Platform Kami</h1>
            <p class="fs-5">Solusi layanan terbaik untuk Anda</p> -->
        </div>
    </div>
</div>

<!-- Section Pemesanan -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Bagaimana cara memesan</h2>
        
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-search text-white fs-4"></i>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Memilih JMI</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-pencil-square text-white fs-4"></i>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Mengisi Formulir</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-calendar-check text-white fs-4"></i>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Menentukan Jadwal</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-chat-dots text-white fs-4"></i>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Konsultasi</p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle text-white fs-4"></i>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Selesai</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Section Tentang Kami -->
<section class="py-5" style="background-color: #198754;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar (kiri) -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/tentang.png') }}" alt="Tentang Kami" class="img-fluid rounded">
            </div>

            <!-- Teks (kanan) -->
            <div class="col-md-6 text-white">
                <h2 class="fw-bold">Tentang Kami</h2>
                <p class="mt-3">
                    Kami adalah tim yang berkomitmen untuk memberikan pelayanan terbaik bagi pengguna kami. 
                    Dengan pengalaman dan dedikasi yang tinggi, kami siap membantu kebutuhan Anda dengan 
                    solusi yang efektif, terpercaya, dan efisien.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section Team -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-5 fw-bold">Juru Bahasa Isyarat</h2>

        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/team1.png') }}" class="card-img-top" alt="Team 1">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">Anisa Rahma</h6>
                        <span class="badge bg-success-subtle text-dark px-3 py-1 rounded-pill">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/team1.png') }}" class="card-img-top" alt="Team 2">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">Budi Santoso</h6>
                        <span class="badge bg-success-subtle text-dark px-3 py-1 rounded-pill">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/team1.png') }}" class="card-img-top" alt="Team 3">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">Citra Dewi</h6>
                        <span class="badge bg-success-subtle text-dark px-3 py-1 rounded-pill">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/team1.png') }}" class="card-img-top" alt="Team 4">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">Dimas Arya</h6>
                        <span class="badge bg-success-subtle text-dark px-3 py-1 rounded-pill">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/team1.png') }}" class="card-img-top" alt="Team 5">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">Eka Putri</h6>
                        <span class="badge bg-success-subtle text-dark px-3 py-1 rounded-pill">JBI Dengar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Siap Bantu -->
<section class="py-5" style="background-color: #14532d;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Kiri: Teks -->
            <div class="col-md-6 text-white">
                <h2 class="fw-bold mb-3">Kami Siap Bantu</h2>
                <p class="mb-4">
                    Kami hadir untuk memberikan layanan terbaik bagi Anda dengan sepenuh hati.
                </p>
                <a href="#pemesanan" class="btn btn-warning text-dark fw-semibold px-4 py-2">Pesan Sekarang</a>
            </div>

            <!-- Kolom Kanan: Gambar Bulat -->
            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="{{ asset('images/tentang.png') }}" alt="Kami Siap Bantu" class="img-fluid rounded-circle" style="max-width: 300px;">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Testimoni</h2>

        <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row justify-content-center gx-4">
                        <!-- Card 1 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 1" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">Andi Pratama</h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI Pernikahan</p>
                                    <p>"Sangat membantu dan profesional. Terima kasih!"</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 2" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">Sari Dewi</h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI Seminar</p>
                                    <p>"Juru bahasa sangat ramah dan komunikatif."</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row justify-content-center gx-4">
                        <!-- Card 3 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 3" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">Rian Putra</h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                                <i class="bi bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI Diskusi Publik</p>
                                    <p>"Sangat jelas dalam menerjemahkan isyarat, luar biasa."</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 4" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">Lisa Marlina</h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI Sekolah</p>
                                    <p>"Anak saya sangat terbantu saat belajar. Terima kasih banyak!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="row justify-content-center gx-4">
                        <!-- Card 5 -->
                        <div class="col-md-6">
                            <div class="card mb-3" style="background-color: #f3f4f6;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ asset('images/user1.png') }}" alt="User 5" class="rounded-circle me-3" width="60" height="60">
                                        <div>
                                            <h5 class="mb-0">Budi Hartono</h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI Pelatihan</p>
                                    <p>"Profesional dan tepat waktu. Recommended banget!"</p>
                                </div>
                            </div>
                        </div>
                        <!-- Kolom kanan kosong agar tetap 2 slot per slide -->
                        <div class="col-md-6"></div>
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- Footer Start -->
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
      <img src="logo.png" alt="Logo" style="width: 150px; margin-bottom: 20px;">
      
      <p style="text-align: justify;">
        Kami adalah penyedia layanan terbaik yang selalu mengutamakan kepuasan pelanggan. Dengan tim profesional dan pengalaman bertahun-tahun, kami siap melayani Anda dengan sepenuh hati. Inovasi dan kualitas adalah prioritas utama kami. Kami percaya bahwa layanan yang baik akan menghasilkan kepercayaan. Oleh karena itu, kami terus berupaya memberikan yang terbaik. Jangan ragu untuk menghubungi kami kapan saja. Kami hadir untuk Anda. Kepuasan Anda adalah kesuksesan kami. Bersama kami, masa depan lebih cerah. Terima kasih telah memilih kami sebagai mitra Anda. Semoga kerja sama ini memberikan manfaat berkelanjutan. Kami selalu terbuka terhadap masukan dan kritik. Dengan begitu, kami bisa menjadi lebih baik. Kami percaya pada kekuatan kerja sama. Terus maju bersama. Membangun masa depan. Melayani sepenuh hati. Memberikan solusi. Menjawab kebutuhan. Kami ada untuk Anda. Terima kasih atas kepercayaannya.
      </p>

      <h4>Ikuti Kami</h4>
      <div style="margin-bottom: 10px;">
        <a href="#" style="margin-right: 10px;"><img src="fb-icon.png" width="24"></a>
        <a href="#" style="margin-right: 10px;"><img src="ig-icon.png" width="24"></a>
        <a href="#" style="margin-right: 10px;"><img src="tw-icon.png" width="24"></a>
      </div>

      <h4>Kontak Kami</h4>
      <p>Email: <a href="mailto:example@gmail.com" style="color: white;">example@gmail.com</a></p>
      <p>Phone: <a href="tel:+6281234567890" style="color: white;">+62 812-3456-7890</a></p>
    </div>

    <!-- Kolom Kanan -->
    <div style="flex: 1; min-width: 300px; padding-left: 20px;">
      <h4>Alamat Kami</h4>
      <p style="text-align: justify;">
        Jl. Merdeka No.123, Kelurahan Maju Jaya, Kecamatan Harapan Baru, Kota Mandiri, Provinsi Sejahtera, Indonesia 12345. Kami berada di lokasi strategis yang mudah diakses dari berbagai penjuru kota. Parkir luas tersedia.
      </p>
      <img src="map-location.jpg" alt="Lokasi Peta" style="width: 100%; max-width: 400px; border-radius: 8px; margin-top: 10px;">
    </div>

  </div>
</footer>
<!-- Footer End -->
 <li class="nav-item ms-3">
    <form action="/logout" method="POST" class="d-inline">
        <!-- Jika menggunakan Laravel, jangan lupa csrf token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
    </form>
</li>
