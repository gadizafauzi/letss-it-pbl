<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <div class="card">

        <img src="/images/logo.jpeg" class="logo">
        <h2 class="title">Login</h2>

        <div class="tabs">
            <button type="button" class="tab active" data-role="student">Siswa</button>
            <button type="button" class="tab" data-role="teacher">Guru</button>
            <button type="button" class="tab" data-role="admin">Admin</button>
        </div>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <input type="hidden" name="role" id="role" value="student">

            <div class="input-group">
                <i class="fa fa-user icon-left"></i>
                <input type="text" name="login" id="login" placeholder="Masukkan NIS / NISN">
            </div>

            <div class="input-group">
                <i class="fa fa-lock icon-left"></i>

                <input type="password" name="password" id="password" placeholder="Password">

                <span id="togglePassword" class="icon-right">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>

            <button class="submit" id="loginBtn">
                <span>Masuk</span>
            </button>
        </form>

        <a href="{{ route('password.request') }}" style="font-size:12px; display:block; margin-bottom:10px;">
            Lupa Password?
        </a>

    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
