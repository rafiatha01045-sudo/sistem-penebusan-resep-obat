<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apotek System - Solusi Manajemen Resep Obat</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
            font-size: 1.5rem;
        }
        
        /* Hero Section */
        .hero-section {
            padding: 100px 0 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(13,110,253,0.1) 0%, rgba(13,110,253,0) 70%);
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
        }
        .hero-title span {
            color: #0d6efd;
        }
        .hero-subtitle {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 2rem;
            font-weight: 400;
        }
        
        /* Buttons */
        .btn-custom {
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background-color: #0d6efd;
            border: none;
            color: white;
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        }
        .btn-primary-custom:hover {
            background-color: #0b5ed7;
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(13, 110, 253, 0.3);
            color: white;
        }
        
        /* Features */
        .features-section {
            padding: 80px 0;
            background-color: #fff;
        }
        .feature-card {
            border: none;
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s ease;
            height: 100%;
            background: #f8f9fa;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            background: #fff;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .icon-blue { background: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .icon-green { background: rgba(25, 135, 84, 0.1); color: #198754; }
        .icon-purple { background: rgba(111, 66, 193, 0.1); color: #6f42c1; }
        
        /* Footer */
        footer {
            background-color: #1a1a1a;
            color: rgba(255,255,255,0.7);
            padding: 40px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-capsule" viewBox="0 0 16 16">
                  <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"/>
                </svg>
                Apotek System
            </a>
            <div class="d-flex align-items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary btn-custom">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary-custom btn-custom">Masuk Sistem</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center min-vh-100">
        <div class="container hero-content">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-medium">
                        Platform Pengelolaan Apotek #1
                    </div>
                    <h1 class="hero-title">Manajemen Apotek <br>Lebih <span>Modern & Efisien</span></h1>
                    <p class="hero-subtitle">Kelola stok obat, resep dokter, dan transaksi harian apotek Anda dalam satu sistem yang terintegrasi, cepat, dan mudah digunakan.</p>
                    <div class="d-flex gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary-custom btn-custom">Buka Dashboard Anda</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-custom">Masuk Sekarang</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center position-relative">
                    <img src="https://images.unsplash.com/photo-1587854692152-cbe668df9731?q=80&w=800&auto=format&fit=crop" alt="Apotek Dashboard" class="img-fluid rounded-4 shadow-lg" style="transform: perspective(1000px) rotateY(-15deg); border: 10px solid white;">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5 pb-3">
                <h2 class="fw-bold mb-3">Keunggulan Sistem Kami</h2>
                <p class="text-muted w-75 mx-auto">Kami merancang sistem ini secara khusus untuk mempercepat alur kerja apotek, dari penerimaan resep hingga pembayaran.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                              <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3">Pencatatan Real-time</h4>
                        <p class="text-muted mb-0">Setiap obat yang terjual langsung memotong stok utama secara real-time, menghindari terjadinya salah perhitungan stok di gudang.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                              <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3">Integrasi Resep</h4>
                        <p class="text-muted mb-0">Apoteker dapat memasukkan resep dokter, dan Kasir dapat langsung menarik data resep tersebut pada saat pasien melakukan pembayaran.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon icon-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z"/>
                            </svg>
                        </div>
                        <h4 class="fw-bold mb-3">Laporan Otomatis</h4>
                        <p class="text-muted mb-0">Dapatkan wawasan mendalam mengenai penjualan harian dan pergerakan stok obat dalam hitungan detik melalui dashboard admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Apotek System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
