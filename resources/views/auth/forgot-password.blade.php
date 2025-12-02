<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
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

        .forgot-password-container {
            width: 90%;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 50px 30px;
            text-align: center;
        }

        h3 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
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

        .form-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .forgot-password-container {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .forgot-password-container {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>

    <div class="forgot-password-container">
        <h3>Lupa Password</h3>
        <p>Masukkan email Anda untuk menerima tautan reset password.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" placeholder="Email" required autofocus>

            <button type="submit" class="btn-green">Kirim Tautan Reset</button>
        </form>
    </div>

@if(session('status'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('status') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

</body>
</html>
