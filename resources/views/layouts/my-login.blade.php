<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- atau CDN Bootstrap --}}


    <style>
        /* tambahkan style custom di sini */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body>

<script src="https://unpkg.com/sweetalert2@11"></script>
    @yield('content')
    
    
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#28a745'
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Login',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33'
    });
</script>
@endif
</body>
</html>
