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

