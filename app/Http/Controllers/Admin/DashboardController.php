<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan ringkasan statistik di dashboard admin.
     */
    public function index()
    {
        // 1. Mengambil data statistik singkat
        $stats = [
            'total_motor'    => Motor::count(),
            'total_pelanggan' => User::where('role', 'user')->count(), // Asumsi ada kolom role
            'rental_aktif'    => Rental::where('status', 'disewa')->count(),
            'perlu_konfirmasi' => Rental::where('status', 'pending')->count(),
        ];

        // 2. Mengambil data pendapatan (Total dari rental yang sudah lunas)
        $total_pendapatan = Rental::where('status', 'lunas')->sum('total_harga');

        // 3. Mengambil 5 transaksi terbaru untuk tabel di dashboard
        $recent_rentals = Rental::with(['motor', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Mengirim data ke view resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('stats', 'total_pendapatan', 'recent_rentals'));
    }
}