<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – SIT Mutiara Quran</title>
    <meta name="description" content="Login Siswa dan Guru SIT Mutiara Quran">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>

    <div class="login-container">
        <div class="login-card">

            {{-- TOP SECTION: Transparan/Glassmorphism --}}
            <div class="top-section">
                <div class="card-image">
                    <img src="{{ asset('images/student_card.png') }}" alt="Login Card Siswa" class="card-illustration">
                </div>
            </div>

            {{-- BOTTOM SECTION: Putih Solid --}}
            <div class="bottom-section">
                <div class="form-container">

                    {{-- TAB --}}
                    <div class="tabs">
                        <button type="button" class="tab active" data-role="student" id="tab-student">
                            <i class="fas fa-user-graduate"></i> Siswa
                        </button>
                        <button type="button" class="tab" data-role="teacher" id="tab-teacher">
                            <i class="fas fa-chalkboard-teacher"></i> Pegawai
                        </button>
                    </div>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <i class="fas fa-circle-exclamation"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <input type="hidden" name="role" id="role" value="student">

                        <div class="input-group">
                            <i class="fa fa-user icon-left"></i>
                            <input type="text" name="login" id="login"
                                placeholder="Masukkan NIS"
                                autocomplete="off" required>
                        </div>

                        <div class="input-group">
                            <i class="fa fa-lock icon-left"></i>
                            <input type="password" name="password" id="password"
                                placeholder="Password" required>
                            <span id="togglePassword" class="icon-right">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>

                        <div style="text-align: center; margin-top: 5px; margin-bottom: 20px;">
                            <span style="color: #64748b; font-size: 0.8rem;">Lupa password? Silakan hubungi Tata Usaha / Admin.</span>
                        </div>

                        <button class="submit" id="loginBtn" type="submit">
                            <span id="btnText">Masuk</span>
                        </button>
                    </form>

                    {{-- FOOTER --}}
                    <p class="footer-text">© 2026 SIT Mutiara Quran</p>
                    <p class="footer-address">Karasak, Jorong Pasar Baru, Nagari Cupak, Kecamatan Gunung Talang, Kabupaten Solok, Sumatra Barat</p>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
