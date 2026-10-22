<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpesifikasiMotor extends Model
{
    protected $table = 'spesifikasi_motors';

    protected $fillable = [
        'kapasitas_cc',
        'transmisi',
        'bahan_bakar',
        'berat_motor',
        'kapasitas_tangki',
        'rem_abs',
        'sistem_pendingin',
        'tenaga_mesin',
        'torsi',
    ];

    protected function casts(): array
    {
        return [
            'rem_abs' => 'boolean',
            'kapasitas_cc' => 'integer',
            'berat_motor' => 'decimal:2',
            'kapasitas_tangki' => 'decimal:2',
            'tenaga_mesin' => 'decimal:2',
            'torsi' => 'decimal:2',
        ];
    }

    public function motor(): BelongsTo
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}