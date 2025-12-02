<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            height: 500px;
        }

        .left-side {
            background: linear-gradient(to bottom, #1E7D4E, #13603B); /* Gradient dari hijau muda ke hijau tua */
            color: white;
            padding: 50px 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px 0 0 10px;
        }

        .left-side h2 {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .left-side p {
            font-size: 15px;
        }

        .right-side {
            padding: 50px 30px;
            flex: 1;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            text-align: left;
            gap: 15px;
        }

        .right-side h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .right-side form {
            width: 100%;
            max-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
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

        .password-container input {
            padding: 12px 15px;
            width: 100%;
        }

        .password-container i {
            position: absolute;
            right: 15px;
            top: 40%; /* Naikkan posisi ikon mata */
            transform: translateY(-50%);
            cursor: pointer;
            color: gray;
            z-index: 10;
        }

        input[type="email"]::placeholder, input[type="password"]::placeholder, input[type="text"]::placeholder {
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

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }
            .left-side {
                border-radius: 10px 10px 0 0;
                height: 200px;
            }
            .right-side {
                border-radius: 0 0 10px 10px;
            }
            .right-side form {
                max-width: none;
            }
        }

        @media (max-width: 1024px) {
            .login-container {
                flex-direction: column;
                height: auto;
            }
            .left-side {
                height: 250px;
            }
            .right-side form {
                max-width: 400px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <div class="left-side">
            <h2>Halo, Admin!</h2>
            <p style="margin-top:-5px;">Selamat Datang di Panel Admin</p>
        </div>

        <div class="right-side">
            <h3 class="mb-4">Masuk Admin</h3>
            
            <p style="font-size:14px; margin-bottom: 20px; color:#555;">Gunakan email dan kata sandi admin untuk melanjutkan.</p>

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <label for="email" class="form-label">Email</label>
                <div class="mb-3">
                    <input id="email" type="text" placeholder="admin" name="email" class="form-control" required autofocus>
                </div>
                
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="mb-3 password-container">
                    <input id="password" type="password" placeholder="••••••••" name="password" class="form-control" required>
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div>

                <div style="width:100%; text-align:right;">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-green w-100">Masuk</button>
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

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: '{{ $errors->first() }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

</body>
</html>