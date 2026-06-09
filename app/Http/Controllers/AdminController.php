<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil jumlah data dari masing-masing tabel
        $data = [
            'total_motor'  => Motor::count(),
            'total_rental' => Rental::count(),
            'total_user'   => User::where('role', 'user')->count(), // Menghitung user non-admin
        ];

        // Pastikan path view sesuai (admin/dashboard.blade.php)
        return view('admin.dashboard', $data);
    }
}