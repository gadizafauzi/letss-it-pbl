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
    <style>
        /* Compact layout styles for the login screen */
        .login-container {
            max-width: 380px; /* Smaller default card width for mobile */
        }
        
        .card-illustration {
            max-width: 220px !important; /* Smaller illustration */
        }

        .input-group {
            margin-bottom: 12px !important;
        }

        .input-group input {
            height: 40px !important;
            padding: 0 42px !important;
            font-size: 13px !important;
            border-radius: 20px !important;
        }

        .icon-left {
            left: 15px !important;
            font-size: 13px !important;
        }

        .icon-right {
            right: 15px !important;
            font-size: 13px !important;
        }

        .tabs {
            margin-bottom: 14px !important;
            padding: 4px !important;
        }

        .tab {
            padding: 8px 10px !important;
            font-size: 13px !important;
        }

        .captcha-container {
            gap: 8px !important;
            margin-bottom: 12px !important;
        }

        .captcha-img-wrapper {
            height: 40px !important;
            border-radius: 20px !important;
            padding: 0 12px !important;
        }

        .captcha-img-wrapper img {
            max-height: 26px !important;
        }

        .btn-refresh {
            width: 40px !important;
            height: 40px !important;
            border-radius: 20px !important;
        }

        .btn-refresh i {
            font-size: 13px !important;
        }

        .submit {
            padding: 10px 14px !important;
            font-size: 14px !important;
            border-radius: 20px !important;
            margin-top: 4px !important;
        }

        .footer-text {
            font-size: 11px !important;
            margin-top: 16px !important;
        }

        .footer-address {
            font-size: 9px !important;
            margin-top: 4px !important;
        }

        /* On desktop viewports, layout the card horizontally (illustration left, form right) */
        @media (min-width: 992px) {
            body {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                min-height: 100vh !important;
            }

            .login-container {
                max-width: 700px !important;
                width: 100% !important;
            }

            .login-card {
                flex-direction: row !important;
                background: #ffffff !important;
                border-radius: 24px !important;
                overflow: hidden !important;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18) !important;
                border: 1.5px solid rgba(255, 255, 255, 0.9) !important;
                align-items: stretch !important;
            }

            .top-section {
                width: 44% !important;
                border-radius: 24px 0 0 24px !important;
                border: none !important;
                margin-top: 0 !important;
                padding: 30px 15px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .bottom-section {
                width: 56% !important;
                margin-top: 0 !important;
                border-radius: 0 24px 24px 0 !important;
                box-shadow: none !important;
                border: none !important;
                padding: 25px 25px 20px !important;
                display: flex !important;
                align-items: center !important;
            }
            
            .form-container {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">

            {{-- TOP SECTION: Transparan/Glassmorphism --}}
            <div class="top-section">
                <div class="card-image">
                    <img src="{{ asset('images/student_card.png') }}" alt="Login Card Siswa" class="card-illustration" id="cardIllustration">
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

                        {{-- CAPTCHA IMAGE & REFRESH BUTTON --}}
                        <div class="captcha-container">
                            <div class="captcha-img-wrapper" id="captcha-img-container">
                                {!! preg_replace('/src="https?:\/\/[^\/]+/', 'src="', captcha_img('math')) !!}
                            </div>
                            <button type="button" class="btn-refresh" id="btn-refresh-captcha" title="Refresh Captcha">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </button>
                        </div>

                        {{-- CAPTCHA INPUT --}}
                        <div class="input-group">
                            <i class="fa-solid fa-calculator icon-left"></i>
                            <input type="text" name="captcha" id="captcha" class="form-control"
                                placeholder="Masukkan hasil captcha" autocomplete="off" required>
                        </div>

                        <div style="text-align: center; margin-top: 4px; margin-bottom: 12px;">
                            <span style="color: #64748b; font-size: 0.72rem;">Lupa password? Silakan hubungi Tata Usaha / Admin.</span>
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
