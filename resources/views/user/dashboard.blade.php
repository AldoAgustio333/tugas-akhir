<!--  -->

@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')

<style>
    .carapesan{
        margin-top:40px;
    }

    .teams img{
        height:150px;
    }

    .lingkaran{
        background-color:#13603B;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .imageslogo{
        display:flex;
        align-items:center;
        justify-content:center;
        padding-left:16px;
    }
</style>
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
<section class="py-5 ">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Bagaimana cara memesan?</h2>
        
        <div class="row justify-content-center carapesan">
            <!-- Card 1 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                       <div class="imageslogo"> <img src="{{ asset('images/logo1.png') }}" alt="User 1" class="rounded-circle me-3"></div>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Memilih JBI</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                        <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                       <div class="imageslogo"> <img src="{{ asset('images/logo2.png') }}" alt="User 1" class="rounded-circle me-3" style="padding-left:3px;"></div>
                    </div>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Mengisi Formulir</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                        <div class="imageslogo"> <img src="{{ asset('images/logo3.png') }}" alt="User 1" class="rounded-circle me-3" style="padding-left:3px;"></div>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Metode Pembayaran</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                        <div class="imageslogo"> <img src="{{ asset('images/logo4.png') }}" alt="User 1" class="rounded-circle me-3" style="padding-left:3px;"></div>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Pemberian Invoice</p>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="p-3">
                    <div class="lingkaran rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 90px; height: 90px;">
                          <div class="imageslogo"> <img src="{{ asset('images/logo5.png') }}" alt="User 1" class="rounded-circle me-3" style="padding-left:3px;"></div>
                    </div>
                    <p class="mt-2 text-success fw-semibold">Kehadiran JBI</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Section Tentang Kami -->
<section class="py-3" style="background-color: #198754;" id="tentang">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar (kiri) -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ asset('images/tentang.png') }}" alt="Tentang Kami" class="w-full" style="width:90%; border-radius:20px;">
            </div>

            <!-- Teks (kanan) -->
            <div class="col-md-6 text-white">
                <h2 class="fw-bold">Tentang Kami</h2>
                <p class="mt-3" style="width:500px">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section Team -->
<section class="py-5 bg-light teams">
    <div class="container text-center">
        <h2 class="mb-5 fw-bold">Juru Bahasa Isyarat</h2>

        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/jbi1.jpg') }}" class="card-img-top" alt="Team 1">
                    <div class="card-body p-2">
                        <h7 class="card-title mb-1">Aulia Azzahra</h7>
                        <span class="badge bg-success px-3 py-1 text-white">JBI Dengar</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/jbi2.jpg') }}" class="card-img-top" alt="Team 1">
                    <div class="card-body p-2">
                        <h7 class="card-title mb-1">Fadillah Riski Amelia</h7>
                        <span class="badge bg-success  px-3 py-1 text-white">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/jbi3.jpg') }}" class="card-img-top" alt="Team 2">
                    <div class="card-body p-2">
                        <h7 class="card-title mb-1">Farin Alfarizi Hasbi</h7>
                        <span class="badge bg-success  px-3 py-1 text-white">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/jbi4.jpg') }}" class="card-img-top" alt="Team 3">
                    <div class="card-body p-2">
                        <h7 class="card-title mb-1">Rizki Geo Rivanda</h7>
                        <span class="badge bg-success  px-3 py-1 text-white">JBI Dengar</span>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-6 col-sm-4 col-md-2 mb-4">
                <div class="card text-white" style="background-color: #14532d;">
                    <img src="{{ asset('images/jbi5.jpg') }}" class="card-img-top" alt="Team 4">
                    <div class="card-body p-2">
                        <h7 class="card-title mb-1">Meisi Maulida R.G</h7>
                        <span class="badge bg-success text-white px-3 py-1">JBI Dengar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Siap Bantu -->
<section class="py-3" style="background-color: #14532d;" id="pesan">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Kiri: Teks -->
            <div class="col-md-6 text-white">
                <h2 class="fw-bold mb-3">Juru Bahasa Isyarat Kami  <br> Siap Bantu Anda Kapan Saja</h2>
                <p class="mb-4">
                   Wujudkan kesetaraan akses informasi dan komunikasi bagi kalangan tuli
                </p>
                <a href="{{ route('user.jbi.index') }}" class="btn btn-warning text-white fw-semibold px-4 py-2">Pesan Sekarang</a>
            </div>

            <!-- Kolom Kanan: Gambar Bulat -->
            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="{{ asset('images/tentang.png') }}" alt="Kami Siap Bantu" class="img-fluid rounded-circle"  style="width:400px; height:400px;">
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="testimoni">
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
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
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
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
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
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                                <i class="bi bi-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
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
                                            <h5 class="mb-0"><strong>Anonim</strong></h5>
                                            <div class="text-warning">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mb-1"><strong>Layanan:</strong> JBI TULI</p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</section>
<!-- Footer End -->

@endsection

