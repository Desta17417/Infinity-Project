<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - RentRide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <i class="fas fa-motorcycle text-2xl text-blue-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-800">Motor Rental Sahabat Kita</span>
                    </a>
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

    <!-- About Section -->
    <section class="pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Tentang <span class="text-blue-600">Rental Sahabat Kita</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan rental motor terpercaya dengan kualitas terbaik
                </p>
            </div>

            <!-- Visi & Misi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-eye text-2xl text-blue-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Visi Kami</h2>
                    <p class="text-gray-600">
                        Menjadi layanan rental motor terpercaya yang memberikan kemudahan dan kenyamanan bagi setiap pelanggan dalam berpergian.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-bullseye text-2xl text-green-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h2>
                    <ul class="text-gray-600 space-y-2">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Menyediakan motor terawat dan siap pakai</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Memberikan harga terjangkau dan transparan</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Layanan pelanggan 24/7</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Proses pemesanan mudah dan cepat</li>
                    </ul>
                </div>
            </div>

            <!-- Keunggulan -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                    Mengapa Memilih Kami?
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-motorcycle text-3xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Motor Terawat</h3>
                        <p class="text-gray-600 text-sm">Semua motor kami rutin servis dan dalam kondisi prima</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tags text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Harga Transparan</h3>
                        <p class="text-gray-600 text-sm">Tidak ada biaya tersembunyi, harga sudah termasuk asuransi</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-3xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Layanan 24 Jam</h3>
                        <p class="text-gray-600 text-sm">Siap membantu Anda kapan saja, termasuk hari libur</p>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-3xl text-orange-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Asuransi Included</h3>
                        <p class="text-gray-600 text-sm">Setiap penyewaan sudah termasuk perlindungan lengkap</p>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-blue-600 rounded-lg shadow-lg p-8 mb-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
                    <div>
                        <div class="text-4xl font-bold mb-2">500+</div>
                        <div class="text-blue-200">Motor Tersedia</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">10.000+</div>
                        <div class="text-blue-200">Pelanggan Puas</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">5+</div>
                        <div class="text-blue-200">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">4.9</div>
                        <div class="text-blue-200">Rating</div>
                    </div>
                </div>
            </div>

            <!-- Tim -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                    Tim Kami
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                        <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Ahmad Wijaya</h3>
                        <p class="text-blue-600">CEO & Founder</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                        <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Budi Santoso</h3>
                        <p class="text-blue-600">Head of Operations</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                        <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Siti Rahayu</h3>
                        <p class="text-blue-600">Customer Service Manager</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="bg-gray-100 rounded-lg shadow-lg p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Siap Menggunakan Layanan Kami?</h2>
                <p class="text-gray-600 mb-6">Jangan ragu untuk menghubungi kami atau langsung pesan motor favorit Anda</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('motors.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-motorcycle mr-2"></i>Lihat Motor
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 Rental Motor Sahabat Kita- Rental Motor Terpercaya</p>
        </div>
    </footer>
</body>
</html>