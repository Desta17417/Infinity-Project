<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id', 'motor_id', 'tanggal_sewa', 'tanggal_kembali', 'total_harga', 'status'
    ];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Motor
    public function motor() {
        return $this->belongsTo(Motor::class);
    }

    // Relasi ke Payment (Satu rental punya satu pembayaran)
    public function payment() {
        return $this->hasOne(Payment::class);
    }
}