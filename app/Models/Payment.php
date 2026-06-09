<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
   protected $fillable = ['nama_motor', 'merk', 'harga_sewa', 'gambar', 'status'];


}