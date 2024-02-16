<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganRumah extends Model
{
    use HasFactory;
    protected $table = 'kunjungan_rumah';
    protected $fillable = [
        'kdkasus',
        'tanggal',
        'solusi',
    ];

    public function fkasus()
    {
        return $this->belongsTo(CatatanKasus::class, 'kdkasus', 'id');
    }
}
