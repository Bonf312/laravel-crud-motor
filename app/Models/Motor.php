<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Motor extends Model
{
protected $fillable = [
    'nama',
    'merek',
    'tipe',
    'tahun',
    'harga',
    'stok',
    'gambar',
];

    public function spesifikasi(): HasOne
    {
        return $this->hasOne(SpesifikasiMotor::class, 'motor_id');
    }
}