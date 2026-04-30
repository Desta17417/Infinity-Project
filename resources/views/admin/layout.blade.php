<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - RentRide</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-bg: #2b3a55;      /* Navy Blue sesuai image_2f9a9b.png */
            --sidebar-active: #3b82f6;  /* Biru Cerah */
            --bg-main: #f8fafc;         /* Slate 50 */
            --text-sidebar: #d1d5db;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main); 
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            background: rgba(0,0,0,0.1);
        }

        .sidebar a {
            color: var(--text-sidebar);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 25px;
            transition: 0.3s;
            font-weight: 400;
        }

        .sidebar a i {
            width: 30px;
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .sidebar a.active {
            background: var(--sidebar-active);
            color: white !important;
            font-weight: 600;
        }

        .sidebar a:hover:not(.active) {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        /* Content Area */
        .content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: none;
        }

        /* SweetAlert Custom Style */
        .swal2-popup {
            border-radius: 20px !important;
            font-family: 'Inter', sans-serif !important;
        }

        @media (max-width: 768px) {
            .sidebar { width: 70px; }
            .sidebar span, .sidebar-header h5 { display: none; }
            .content { margin-left: 70px; padding: 15px; }
            .sidebar a { justify-content: center; padding: 15px 0; }
            .sidebar a i { margin-right: 0; width: auto; }
        }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <div class="sidebar-header">
        <h5 class="fw-bold mb-0 text-white">
            <i class="fa-solid fa-motorcycle me-2"></i><span>MotorRent</span>
        </h5>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge-high"></i> <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.motors.index') }}" class="{{ request()->routeIs('admin.motors.*') ? 'active' : '' }}">
            <i class="fa-solid fa-car-side"></i> <span>Data Motor</span>
        </a>

        <a href="{{ route('admin.rentals.index') }}" class="{{ request()->routeIs('admin.rentals') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i> <span>Penyewaan</span>
        </a>

        <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments') ? 'active' : '' }}">
            <i class="fa-solid fa-wallet"></i> <span>Pembayaran</span>
        </a>
    </div>

    <div class="position-absolute bottom-0 w-100 p-3">
        <hr class="opacity-25 text-white">
        @if (Route::has('logout'))
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
            <button type="button" id="logout-button" class="btn btn-outline-danger w-100 btn-sm py-2">
                <i class="fa-solid fa-right-from-bracket me-2"></i><span>Logout</span>
            </button>
        @endif
    </div>
</div>

<div class="content">
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom mb-4 p-3">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold text-dark">Manajemen Rental</span>
            <div class="d-flex align-items-center">
                <div class="text-end me-3 d-none d-sm-block">
                    <small class="text-muted d-block">Selamat datang,</small>
                    <span class="fw-bold text-dark">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Pop-up Logout Logic
    document.getElementById('logout-button').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Keluar',
            text: "Apakah Anda yakin ingin mengakhiri sesi ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6', // Tema Biru
            cancelButtonColor: '#ef4444', // Merah
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

</body>
</html>