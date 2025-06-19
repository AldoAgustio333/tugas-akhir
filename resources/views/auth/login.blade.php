<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    <style>
        * {
        font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            /* box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); */
            overflow: hidden;
            display: flex;
            flex-direction: row;
            height:500px;
        }

        .left-side {
            background-color: #005C3C;
            color: white;
            padding: 50px 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            text-align:center;
            border-top-right-radius: 60px;
            border-bottom-right-radius: 60px;
            
        }

        .left-side h2 {
            font-weight: bold;
            font-size:20px;
        }

        .right-side {
            padding: 50px 30px;
            flex: 1;
            display:flex;
            align-items:center;
            flex-direction:column;
            justify-content:center;
            text-align:center;
        }

        .btn-green {
            background-color: #13603B;
            color: white;
            width:100%;
            padding:10px 20px;
            margin-top:10px;
            border:none;
            border-radius:10px;
        }

        a{
            color:#13603B;
            text-decoration:none;
        }

        .btnYellow{
            background:orange;
            padding:5px 15px;
            text-decoration:none;
            color:white;
            border-radius:7px;
            width:100px;
        }

        input{
            margin-bottom:10px;
            padding:10px 20px;
            border:1px solid gray;
            outline:none;
            width:250px;
        }

        p{
            font-size:13px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .left-side, .right-side {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">

        <!-- Left (Welcome) Side -->
        <div class="left-side">
            <h2>Halo, Selamat Datang!</h2>
            <p style="margin-top:-5px;">Apakah Kamu Belum Memiliki Akun?</p>
            <a href="{{ route('register') }}" class="btn btn-warning mt-2 btnYellow">Daftar</a>
        </div>

        <!-- Right (Form) Side -->
        <div class="right-side">
            <h3 class="mb-4">Masuk</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input id="username" type="email" placeholder="username" name="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <input id="password" type="password" placeholder="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
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

</body>
</html>
