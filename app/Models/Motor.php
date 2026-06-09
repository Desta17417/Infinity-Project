<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    // Tambahkan ini agar data bisa disimpan lewat $request->all()
    protected $fillable = [
    'nama_motor',
    'merk',
    'harga_sewa',
    'status',
    'foto', // <-- Pastikan ini ada!
];

    // Relasi ke Rental
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}