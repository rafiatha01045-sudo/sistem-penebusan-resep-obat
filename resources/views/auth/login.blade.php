<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Penebusan Obat</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Latar belakang apotek modern dengan overlay gelap/biru */
            background: linear-gradient(rgba(13, 110, 253, 0.7), rgba(0, 0, 0, 0.8)), 
                        url('https://images.unsplash.com/photo-1631549916768-4119b2e5f926?q=80&w=2000&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
        }

        /* Elemen dekoratif blur di background */
        .blob-1 {
            position: absolute;
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(13,202,240,0.4) 0%, transparent 60%);
            filter: blur(60px);
            z-index: 0;
            animation: float 10s ease-in-out infinite;
        }
        
        .blob-2 {
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(13,110,253,0.4) 0%, transparent 60%);
            filter: blur(80px);
            z-index: 0;
            animation: float 15s ease-in-out infinite reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, 50px) scale(1.1); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* Glassmorphism Card */
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            z-index: 10;
            position: relative;
            transform: translateY(0);
            transition: all 0.4s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .card-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-bottom: 2.5rem;
        }

        /* Input Form styling untuk Glassmorphism */
        .form-floating > label {
            color: rgba(255, 255, 255, 0.6);
            padding-left: 1.25rem;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: #ffffff;
            height: 3.5rem;
            padding-left: 1.25rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .form-control::placeholder {
            color: transparent;
        }

        /* Validasi Error */
        .form-control.is-invalid {
            border-color: #ff6b6b;
            background-image: none;
        }
        .invalid-feedback {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        /* Checkbox Custom */
        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .form-check-input:checked {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }
        .form-check-label {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Button Custom */
        .btn-login {
            background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1rem;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
        }

        .btn-login:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 25px rgba(13, 110, 253, 0.4);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* Logo Icon */
        .logo-circle {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3);
        }
    </style>
</head>
<body>

    <!-- Animasi Latar Belakang -->
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <div class="login-card">
        <div class="logo-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-capsule" viewBox="0 0 16 16">
              <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"/>
            </svg>
        </div>
        
        <h1 class="card-title">Selamat Datang</h1>
        <p class="card-subtitle">Masuk untuk mengakses Sistem Apotek</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                <label for="emailInput">Alamat Email</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" placeholder="Password" required>
                <label for="passwordInput">Kata Sandi</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3 mt-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Ingat Sesi Saya
                </label>
            </div>

            <button type="submit" class="btn btn-login">
                Masuk Sistem
            </button>
        </form>
    </div>

</body>
</html>