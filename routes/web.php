<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;

use App\Models\Motor;
use App\Models\Rental;
use App\Models\User;

// 1. HALAMAN PUBLIK
Route::get('/', function () {
    // Ambil semua data motor dari database
    $motors = Motor::all(); 

    // Kirim variabel $motors ke view home
    return view('home', compact('motors')); 
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/motor', [MotorController::class, 'index'])->name('motors.index');

// 2. AUTHENTICATION
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Bagian Pemesanan & Pembayaran User ---

// Form sewa
Route::get('/rental/create/{id}', [RentalController::class, 'create'])->name('rental.create');
Route::post('/rental/store', [RentalController::class, 'store'])->name('rental.store');

// Halaman Instruksi Pembayaran (Hapus duplikasi, pilih salah satu)
// Gunakan RentalController karena di store() Anda melakukan redirect ke sini
Route::get('/payment/{id}', [RentalController::class, 'payment'])->name('payment.index');

// Proses upload bukti bayar atau konfirmasi bayar
Route::post('/payment/process/{id}', [RentalController::class, 'processPayment'])->name('payment.process');


// --- Bagian Area Admin ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('motors', MotorController::class);

    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    
    
    // Halaman verifikasi pembayaran untuk Admin (Jangan gunakan payment.index)
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
});