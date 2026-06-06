<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password – SIT Mutiara Quran</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .page-title {
            text-align: center;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--theme-primary);
            margin-bottom: 0.5rem;
        }
        .page-subtitle {
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card" style="max-height: none;">

            <div class="top-section" style="padding: 2rem 1rem;">
                <div class="card-image">
                    <img src="{{ asset('images/student_card.png') }}" alt="Forgot Password Illustration" class="card-illustration" style="max-width: 150px;">
                </div>
            </div>

            <div class="bottom-section">
                <div class="form-container">
                    
                    <h1 class="page-title">Lupa Password?</h1>
                    <p class="page-subtitle">Masukkan alamat email Anda yang terdaftar. Kami akan mengirimkan tautan untuk melakukan reset password.</p>

                    @if (session('status'))
                        <div class="alert-success" style="background: #ecfdf5; color: #047857; padding: 12px; border-radius: 12px; font-size: 0.85rem; margin-bottom: 15px; border: 1px solid #a7f3d0;">
                            <i class="fas fa-check-circle"></i> {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-error" style="background: #fef2f2; color: #b91c1c; padding: 12px; border-radius: 12px; font-size: 0.85rem; margin-bottom: 15px; border: 1px solid #fecaca;">
                            <i class="fas fa-circle-exclamation"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="input-group">
                            <i class="fa fa-envelope icon-left"></i>
                            <input type="email" name="email" id="email"
                                placeholder="Masukkan Email Anda"
                                required autofocus>
                        </div>

                        <button class="submit" type="submit" style="margin-top: 10px;">
                            <span>Kirim Tautan Reset</span>
                        </button>
                    </form>

                    <div style="text-align: center; margin-top: 20px;">
                        <a href="{{ route('login') }}" style="color: #64748b; font-size: 0.85rem; text-decoration: none; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='var(--theme-primary)'" onmouseout="this.style.color='#64748b'">
                            <i class="fas fa-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>

                    <p class="footer-text" style="margin-top: 30px;">© 2026 SIT Mutiara Quran</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
