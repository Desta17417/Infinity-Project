<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRide - Layanan Sewa Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-blue-600 font-bold text-2xl tracking-tight">
                <i class="fas fa-motorcycle"></i>
                <span>RentRide</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                <a href="{{ route('motors.index') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors">Katalog</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <div class="max-w-5xl mx-auto px-4 py-10">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-8">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm italic mb-2">
                <i class="fas fa-shield-alt mr-1"></i> Simpan bukti transfer untuk verifikasi admin.
            </p>
            <p class="text-slate-400 text-xs">
                &copy; 2026 RentRide Indonesia. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </footer>

</body>
</html>