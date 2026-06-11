<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    // Accessor untuk menghitung durasi sewa dalam hari
    protected function durasiSewa(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->tanggal_sewa && $this->tanggal_kembali) {
                    $tglSewa = \Carbon\Carbon::parse($this->tanggal_sewa);
                    $tglKembali = \Carbon\Carbon::parse($this->tanggal_kembali);
                    $durasi = $tglSewa->diffInDays($tglKembali);
                    return $durasi > 0 ? $durasi : 1;
                }
                return 0;
            }
        );
    }
}