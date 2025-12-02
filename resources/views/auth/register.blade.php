<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            min-height: 100vh; /* PENTING: Gunakan min-height agar halaman bisa memanjang */
            display: flex;
            align-items: flex-start; /* PENTING: Mulai dari atas, bukan center */
            justify-content: center;
            padding: 30px 0; /* Memberi jarak atas dan bawah di desktop */
        }

        .login-container {
            width: 90%;
            max-width: 850px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: row-reverse;
            /* Hapus height: auto di sini, biarkan konten menentukan tingginya */
        }

        /* LEFT SIDE (Hijau) */
        .left-side {
            background: linear-gradient(to bottom, #1E7D4E, #13603B);
            color: white;
            padding: 50px 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 700px; /* PENTING: Tinggi minimum agar seimbang di desktop */
            border-radius: 0 10px 10px 0;
        }

        .left-side h2 {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .left-side p {
            font-size: 15px;
        }

        /* RIGHT SIDE (Form) */
        .right-side {
            padding: 30px 30px; /* Memberi padding yang cukup di desktop */
            flex: 1;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: flex-start; /* PENTING: Konten form mulai dari atas */
            text-align: left;
            gap: 15px;
            border-radius: 10px 0 0 10px;
        }

        .right-side h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px; /* Kurangi margin bawah agar lebih rapat */
        }

        .right-side form {
            width: 100%;
            max-width: 350px; 
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .right-side form select,
        .right-side form input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            outline: none;
            border-radius: 7px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn-green {
            background-color: #13603B;
            color: white;
            width: 100%;
            padding: 10px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 7px;
            font-weight: 600;
            cursor: pointer;
        }

        .btnYellow {
            background: orange;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 50px;
            width: 150px;
            font-weight: 600;
            text-align: center;
            margin-top: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btnYellow:hover {
            transform: scale(1.05); /* Sedikit diperkecil hover */
            background-color: #ff9800;
        }

        input {
            margin-bottom: 15px;
            padding: 12px 15px;
            border: 1px solid #ccc;
            outline: none;
            width: 100%;
            border-radius: 7px;
            font-size: 14px;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .password-container i {
            position: absolute;
            right: 15px;
            top: 50%; /* Diperbaiki: Selalu center di tengah input */
            transform: translateY(-50%);
            cursor: pointer;
            color: gray;
            z-index: 10;
        }

        input[type="email"]::placeholder, input[type="password"]::placeholder {
            color: #aaa;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        a {
            color: #13603B;
            text-decoration: none;
            font-size: 14px;
        }

        .mb-3 {
            margin-bottom: 10px;
            width: 100%;
        }

        #mahasiswaFields {
            display: none;
            width: 100%;
            flex-direction: column;
            gap: 15px;
        }

        /* MEDIA QUERIES */

        @media (max-width: 768px) {
            body {
                padding: 0; /* Hapus padding body agar konten rapat ke tepi viewport */
                align-items: flex-start;
            }
            
            .login-container {
                flex-direction: column; /* Ubah ke kolom */
                width: 100%;
                max-width: none;
                height: auto;
                box-shadow: none;
                border-radius: 0;
            }

            .left-side {
                min-height: 200px; /* Tinggi hijau disetel ulang untuk mobile */
                border-radius: 0;
            }
            
            .right-side {
                padding: 20px; /* Kurangi padding untuk efisiensi ruang */
                border-radius: 0;
                /* Hapus tinggi atau scroll yang memaksa */
            }
            
            .right-side form {
                max-width: 100%;
            }
            
            /* PENTING: Jika ada form yang sangat panjang, pastikan tidak ada tinggi yang membatasi scroll body */
        }

        @media (min-width: 769px) {
            /* Style untuk Desktop */
            .login-container {
                flex-direction: row-reverse;
                max-width: 850px;
            }
            .left-side {
                min-height: 700px; /* Pastikan tinggi seimbang */
                border-radius: 0 10px 10px 0;
            }
            .right-side {
                border-radius: 10px 0 0 10px;
                /* Tambahkan padding-top jika masih merasa terlalu nempel di desktop */
                /* padding-top: 50px; */ 
            }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="left-side">
            <h2>Halo, Selamat Datang!</h2>
            <p style="margin-top:-5px;">Apakah Kamu Sudah Memiliki Akun?</p>
            <a href="{{ route('login') }}" class="btn btn-warning mt-2 btnYellow">Masuk</a>
        </div>

        <div class="right-side">
            <h3 class="mb-4">Daftar</h3>
            
            <p style="font-size:14px; margin-bottom: 20px; color:#555;">Isi data di bawah untuk membuat akun baru.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <input id="name" type="text" placeholder="Nama Lengkap" name="name" class="form-control" 
                           value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <input id="email" type="email" placeholder="Email" name="email" class="form-control" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="jk" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <select id="jk" name="jk" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jk')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="no_hp" class="form-label">Nomor HP <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <input id="no_hp" type="text" placeholder="081234567890" name="no_hp" class="form-control" 
                           value="{{ old('no_hp') }}" required>
                    @error('no_hp')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <select id="status" name="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="mahasiswa" {{ old('status') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="umum" {{ old('status') == 'umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                    @error('status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                <div class="mb-3 password-container">
                    <input id="password" type="password" placeholder="••••••••" name="password" class="form-control" required>
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                <div class="mb-3">
                    <input id="password_confirmation" type="password" placeholder="••••••••" name="password_confirmation" class="form-control" required>
                    @error('password_confirmation')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div id="mahasiswaFields" style="display: none;">
                    <label for="npm" class="form-label">NPM</label>
                    <div class="mb-3">
                        <input id="npm" type="text" placeholder="NPM" name="npm" class="form-control" value="{{ old('npm') }}">
                        @error('npm')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="fakultas" class="form-label">Fakultas</label>
                    <div class="mb-3">
                        <input id="fakultas" type="text" placeholder="Fakultas" name="fakultas" class="form-control" value="{{ old('fakultas') }}">
                        @error('fakultas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="program_studi" class="form-label">Program Studi</label>
                    <div class="mb-3">
                        <input id="program_studi" type="text" placeholder="Program Studi" name="program_studi" class="form-control" value="{{ old('program_studi') }}">
                        @error('program_studi')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="kelas" class="form-label">Kelas</label>
                    <div class="mb-3">
                        <input id="kelas" type="text" placeholder="Kelas" name="kelas" class="form-control" value="{{ old('kelas') }}">
                        @error('kelas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-green w-100">Daftar</button>
            </form>
        </div>

    </div>
    
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('status'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: '{{ session('status') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    document.getElementById('status').addEventListener('change', function () {
        const mahasiswaFields = document.getElementById('mahasiswaFields');
        if (this.value === 'mahasiswa') {
            mahasiswaFields.style.display = 'block';
            mahasiswaFields.style.overflow = 'hidden'; // Prevent overflow
        } else {
            mahasiswaFields.style.display = 'none';
        }
    });
    
    // Check if old status was mahasiswa and show fields
    @if(old('status') === 'mahasiswa')
        document.getElementById('mahasiswaFields').style.display = 'block';
    @endif
</script>

<script>
    @if ($errors->any())
        let errorMessages = [];
        @foreach ($errors->all() as $error)
            errorMessages.push('{{ $error }}');
        @endforeach
        
        Swal.fire({
            icon: 'error',
            title: 'Registrasi Gagal!',
            html: errorMessages.join('<br>'),
            timer: 5000,
            showConfirmButton: true,
            confirmButtonColor: '#13603B',
            confirmButtonText: 'OK'
        });
    @endif
</script>

</body>
</html>