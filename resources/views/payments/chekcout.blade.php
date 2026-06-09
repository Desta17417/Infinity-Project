<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - RentRide</title>
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
            </div>
        </div>
    </nav>

    <!-- Payment Section -->
    <section class="pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-credit-card mr-2"></i>Konfirmasi Pembayaran
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ringkasan Pesanan -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Motor</span>
                            <span class="font-semibold">{{ $rental->motor->nama_motor }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Merk</span>
                            <span>{{ $rental->motor->merk }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Sewa</span>
                            <span>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Kembali</span>
                            <span>{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between text-lg">
                            <span class="font-semibold">Total Pembayaran</span>
                            <span class="font-bold text-blue-600 text-xl">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Pembayaran -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Metode Pembayaran</h3>
                    
                    <form action="{{ route('payment.process', $rental->id) }}" method="POST">
                        @csrf
                        
                        <div class="space-y-3 mb-6">
                            <label class="block">
                                <input type="radio" name="metode_pembayaran" value="transfer" checked class="mr-2">
                                <i class="fas fa-university mr-2 text-blue-600"></i>Transfer Bank
                            </label>
                            <label class="block">
                                <input type="radio" name="metode_pembayaran" value="e-wallet" class="mr-2">
                                <i class="fas fa-wallet mr-2 text-green-600"></i>E-Wallet (Dana/OVO/GoPay)
                            </label>
                            <label class="block">
                                <input type="radio" name="metode_pembayaran" value="cod" class="mr-2">
                                <i class="fas fa-hand-cash mr-2 text-orange-600"></i>Bayar di Tempat (COD)
                            </label>
                        </div>

                        <!-- Info Rekening (jika transfer) -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-yellow-800 mb-2">Informasi Transfer</h4>
                            <p class="text-sm text-yellow-700">
                                Bank BCA<br>
                                No. Rekening: 1234567890<br>
                                a.n. RentRide Motor
                            </p>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700">
                            <i class="fas fa-check-circle mr-2"></i>Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                </a>
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