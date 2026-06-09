<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Motor - RentRide</title>
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
                    <span class="text-xl font-bold text-gray-800">RentRide</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">Beranda</a>
                    <a href="#motor" class="text-gray-600 hover:text-blue-600">Motor</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Form Pemesanan -->
    <section class="pt-24 pb-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-calendar-check mr-2"></i>Form Pemesanan
                </h2>

                <!-- Info Motor -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-lg">{{ $motor->nama_motor }}</h3>
                    <p class="text-gray-600">{{ $motor->merk }}</p>
                    <p class="text-2xl font-bold text-blue-600 mt-2">Rp {{ number_format($motor->harga_sewa, 0, ',', '.') }} <span class="text-sm font-normal">/hari</span></p>
                </div>

                <form action="{{ route('rental.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="motor_id" value="{{ $motor->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal Sewa</label>
                            <input type="date" name="tanggal_sewa" required 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-2">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" required 
                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" required placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">No. Telepon</label>
                        <input type="tel" name="telepon" required placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" required rows="3" placeholder="Masukkan alamat lengkap"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                        <i class="fas fa-credit-card mr-2"></i>Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 RentRide - Rental Motor Terpercaya</p>
        </div>
    </footer>
</body>
</html>