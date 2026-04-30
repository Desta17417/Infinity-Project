<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Buat Akun Admin
    User::create([
        'name' => 'Administrator',
        'email' => 'admin@rental.com',
        'password' => bcrypt('password123'), // Jangan lupa di-encrypt
        'role' => 'admin',
    ]);

    // Buat Akun User Biasa
    User::create([
        'name' => 'Pelanggan',
        'email' => 'user@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
    ]);
}
}
