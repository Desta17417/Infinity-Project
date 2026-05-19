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
    <nav class="bg-white shadow-md fixed w-full z-30 top-0 left-0">
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
                    <a href="{{ route('about') }}" class="text-blue-600 font-semibold">Tentang</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <section class="pt-28 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">
                    Tentang <span class="text-blue-600">Rental Sahabat Kita</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan rental motor terpercaya dengan kualitas terbaik dan armada yang selalu prima.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <div class="bg-white rounded-xl shadow-md p-8 border border-gray-100">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-eye text-xl text-blue-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Visi Kami</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Menjadi layanan rental motor terpercaya yang memberikan kemudahan, keamanan, dan kenyamanan maksimal bagi setiap pelanggan dalam bermobilisasi.
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-8 border border-gray-100">
                    <div class="w-14 h-14 bg-sky-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-bullseye text-xl text-sky-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h2>
                    <ul class="text-gray-600 space-y-3">
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i>Menyediakan motor terawat dan siap pakai</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i>Memberikan harga terjangkau dan transparan</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i>Layanan pelanggan responsif ramah 24/7</li>
                        <li class="flex items-center"><i class="fas fa-check-circle text-blue-500 mr-3"></i>Proses pemesanan online mudah dan cepat</li>
                    </ul>
                </div>
            </div>

            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                    Mengapa Memilih Kami?
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-motorcycle text-2xl text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Motor Terawat</h3>
                        <p class="text-gray-500 text-sm">Semua motor kami rutin servis berkala dan dalam kondisi prima</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tags text-2xl text-sky-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Harga Pas</h3>
                        <p class="text-gray-500 text-sm">Tidak ada biaya tersembunyi, semua jujur sejak awal</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-2xl text-slate-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Layanan 24 Jam</h3>
                        <p class="text-gray-500 text-sm">Siap membantu keluhan Anda kapan saja demi kelancaran jalan</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-2xl text-blue-500"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Perlindungan Aman</h3>
                        <p class="text-gray-500 text-sm">Setiap unit dilengkapi asuransi perjalanan demi rasa tenang</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-600 to-indigo-800 rounded-2xl shadow-xl p-8 mb-16">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
                    <div>
                        <div class="text-4xl font-extrabold mb-2">500+</div>
                        <div class="text-blue-100 text-sm md:text-base">Motor Tersedia</div>
                    </div>
                    <div>
                        <div class="text-4xl font-extrabold mb-2">10.000+</div>
                        <div class="text-blue-100 text-sm md:text-base">Pelanggan Puas</div>
                    </div>
                    <div>
                        <div class="text-4xl font-extrabold mb-2">5+</div>
                        <div class="text-blue-100 text-sm md:text-base">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="text-4xl font-extrabold mb-2">4.9</div>
                        <div class="text-blue-100 text-sm md:text-base">Rating Google</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 mb-16 border border-gray-100">
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-full md:w-1/3 text-center md:text-left">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Lokasi Garasi</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-3 mb-4">Kunjungi Kantor Kami</h2>
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>
                            6CFX+QQ2, Jl. Ukrim, Cupuwatu I, Purwomartani, Kec. Kalasan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55571
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i> Buka setiap hari jam 10.00 - 22.00 WIB untuk pengambilan unit langsung.
                        </p>
                    </div>
                    <div class="w-full md:w-2/3 h-72 md:h-80 rounded-xl overflow-hidden shadow-inner border border-gray-200">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!3m2!1sid!2sid!4v1779197114049!5m2!1sid!2sid!6m8!1m7!1slTmf8zGHyewkT7wuTJ7MIA!2m2!1d-7.77559752905294!2d110.449474514565!3f275.28877317066804!4f2.7988895308702126!5f0.4000000000000002" 
                            class="w-full h-full border-0" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900 rounded-2xl shadow-lg p-8 text-center text-white">
                <h2 class="text-2xl font-bold mb-3">Siap Menggunakan Layanan Kami?</h2>
                <p class="text-slate-300 mb-6 max-w-lg mx-auto text-sm md:text-base">Jangan ragu untuk menghubungi tim CS kami atau pilih armada favorit Anda sekarang juga.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('motors.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-500 transition duration-200">
                        <i class="fas fa-motorcycle mr-2"></i>Lihat Katalog Motor
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-green-500 transition duration-200">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi Via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 Rental Motor Sahabat Kita - Rental Motor Terpercaya</p>
        </div>
    </footer>
</body>
</html>