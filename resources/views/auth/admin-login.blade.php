<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – SIT Mutiara Quran</title>
    <meta name="description" content="Login Administrator SIT Mutiara Quran">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
</head>

<body>

    <div class="admin-bg">
        {{-- Decorative shapes --}}
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="wrapper">

        {{-- LEFT PANEL --}}
        <div class="left-panel">
            <img src="{{ asset('images/logomq.jpg') }}" alt="Logo Sekolah" class="school-logo">
            <h1 class="school-name">SIT Mutiara Quran</h1>
            <p class="school-tagline">Sistem Informasi Manajemen Sekolah</p>
            <p class="school-address">Karasak, Jorong Pasar Baru, Nagari Cupak, Kecamatan Gunung Talang, Kabupaten Solok, Sumatra Barat</p>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="right-panel">
            <div class="admin-card">

                {{-- HEADER --}}
                <div class="admin-card-header">
                    <div class="admin-icon-wrap">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <h2>Admin Portal</h2>
                    <p>Masuk ke panel administrator</p>
                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-triangle-exclamation"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('admin.login.post') }}" id="adminLoginForm">
                    @csrf
                    <input type="hidden" name="role" value="admin">

                    <div class="input-group">
                        <label for="admin_login">Username</label>
                        <div class="input-wrap">
                            <i class="fa fa-user icon-left"></i>
                            <input type="text" name="login" id="admin_login"
                                placeholder="Masukkan username admin"
                                autocomplete="off" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="admin_password">Password</label>
                        <div class="input-wrap">
                            <i class="fa fa-lock icon-left"></i>
                            <input type="password" name="password" id="admin_password"
                                placeholder="Masukkan password" required>
                            <span id="adminToggle" class="icon-right">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="admin-submit" id="adminBtn">
                        <span id="adminBtnText">
                            <i class="fas fa-sign-in-alt"></i> Masuk sebagai Admin
                        </span>
                    </button>
                </form>

                {{-- BACK LINK --}}
                <a href="{{ route('login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login Siswa/Guru
                </a>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toggle = document.getElementById("adminToggle");
            const pass   = document.getElementById("admin_password");
            const form   = document.getElementById("adminLoginForm");
            const btn    = document.getElementById("adminBtn");
            const btnTxt = document.getElementById("adminBtnText");

            toggle.addEventListener("click", () => {
                const icon = toggle.querySelector("i");
                if (pass.type === "password") {
                    pass.type = "text";
                    icon.className = "fa-solid fa-eye-slash";
                } else {
                    pass.type = "password";
                    icon.className = "fa-solid fa-eye";
                }
            });

            form.addEventListener("submit", () => {
                btn.classList.add("loading");
                btnTxt.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            });
        });
    </script>

</body>
</html>
