<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor - Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-motorcycle text-2xl text-blue-600 mr-2"></i>
                    <span class="text-xl font-bold text-gray-800">Motor Rental Sahabat Kita</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}#home" class="text-gray-600 hover:text-blue-600">Beranda</a>
                    <a href="{{ route('motors.index') }}" class="text-gray-600 hover:text-blue-600">Motor</a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-blue-600">Tentang</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-16 bg-gradient-to-r from-blue-600 to-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    Sewa Motor Terpercaya
                </h1>
                <p class="text-xl mb-8">
                    Nikmati perjalanan nyaman dengan harga terjangkau
                </p>
                <a href="#motor" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Lihat Motor
                </a>
            </div>
        </div>
    </section>

    <!-- Motor Section -->
    <section id="motor" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                Daftar Motor
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($motors as $motor)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            
            <div class="h-48 bg-gray-100 flex items-center justify-center rounded-t-lg">
                @if($motor->foto)
                    <img src="{{ asset('storage/' . $motor->foto) }}" alt="{{ $motor->nama_motor }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-motorcycle text-6xl text-gray-300"></i>
                @endif
            </div>

            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    @if($motor->status == 'tersedia')
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Disewa</span>
                    @endif
                    <span class="text-gray-500 text-sm">{{ $motor->merk }}</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $motor->nama_motor }}</h3>
                <p class="text-gray-600 mt-2">Rp {{ number_format($motor->harga_sewa, 0, ',', '.') }}/hari</p>
                <div class="mt-4">
                    <a href="{{ route('rental.create', $motor->id) }}" class="block w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 text-center">
                        Sewa Sekarang
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                Tentang Kami
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <i class="fas fa-check-circle text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Terpercaya</h3>
                    <p class="text-gray-600">Motor terawat dan siap pakai</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-money-bill-wave text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Harga Terjangkau</h3>
                    <p class="text-gray-600">Harga kompetitif tanpa biaya tersembunyi</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-headset text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                    <p class="text-gray-600">Siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 Rental Motor Sahabat Kita - Rental Motor Terpercaya</p>
        </div>
    </footer>
</body>
</html>