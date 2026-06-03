<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistem Penebusan Obat') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #212529; }
        .sidebar { min-height: 100vh; background: #ffffff; box-shadow: 0 0 15px rgba(0,0,0,.05); transition: all 0.3s; width: 250px; z-index: 1040; position: fixed; top: 0; left: 0; }
        .sidebar-brand { font-size: 1.2rem; font-weight: 700; color: #0d6efd; padding: 1.5rem 1rem; border-bottom: 1px solid #eee; text-decoration: none; display: block; text-align: center; }
        .sidebar-nav { padding: 1rem 0; list-style: none; margin: 0; }
        .nav-item { margin-bottom: 0.2rem; padding: 0 1rem; }
        .nav-link { color: #495057; font-weight: 500; border-radius: 0.5rem; padding: 0.8rem 1rem; display: flex; align-items: center; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active { background: #e9ecef; color: #0d6efd; }
        .nav-link svg { margin-right: 0.8rem; width: 20px; height: 20px; }
        .main-content { margin-left: 250px; transition: all 0.3s; padding-top: 60px; min-height: 100vh; }
        .navbar-custom { background: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,.05); height: 60px; position: fixed; top: 0; right: 0; left: 250px; z-index: 1030; transition: all 0.3s; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); border-radius: 0.5rem; }
        .card-header { background-color: #fff; border-bottom: 1px solid #eee; font-weight: 600; padding: 1rem 1.25rem; }
        @media (max-width: 768px) {
            .sidebar { margin-left: -250px; }
            .sidebar.show { margin-left: 0; }
            .main-content { margin-left: 0; }
            .navbar-custom { left: 0; }
            .sidebar-overlay.show { display: block; }
        }
        .sidebar-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.5); z-index: 1035; display: none; }
        .btn-primary { background-color: #0d6efd; border-color: #0d6efd; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include('layouts.sidebar')

    <div class="main-content" id="mainContent">
        @include('layouts.navbar')

        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        });
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            this.classList.remove('show');
        });

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{!! session('success') !!}',
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{!! session('error') !!}',
        });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
