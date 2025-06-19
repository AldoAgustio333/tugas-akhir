@extends('layouts.my-login') 


@section('content')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        height:400px;
    }
    .left-side {
        background-color: #005C3C;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 40px;
        border-top-right-radius: 30px;
        border-bottom-right-radius: 30px;
        width:450px;
    }
    .right-side {
        background-color: white;
        padding: 40px;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
    }
    .btn-yellow {
        background-color: #FFC107;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: bold;
    }
    .login-box {
        width: 700px;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        display:flex;
        text-align:center;
        height:500px;
    }

    .form-control{
        width:250px;
        border:1px solid gray;
        padding:10px 20px;
        margin-bottom:10px;
        outline:none;
    }

    a{
        text-decoration:none;
        color:green;
    }

    button{
        width:290px;
        padding:10px 20px;
        background-color:  #005C3C;
        border:none;
        color:white;
        margin-top:10px;
        border-radius:5px;
    }
</style>

<div class="container login-container">
    <div class="row login-box">
        {{-- KIRI --}}
        <div class="col-md-6 left-side">
            <h2 class="mb-3 font-weight-bold" style="font-size:20px;">Halo, Selamat Datang!</h2>
        </div>

        {{-- KANAN --}}
        <div class="col-md-6 right-side">
            <h3 class="text-center font-weight-bold mb-4">Masuk</h3>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Username" required autofocus>
                </div>

                <div class="form-group mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="mb-3 text-end">
                    <a href="{{ route('password.request') }}" class="text-muted" style="font-size: 0.9em;">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-success w-100">Masuk</button>
            </form>
        </div>
    </div>
</div>


@endsection