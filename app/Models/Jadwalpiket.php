<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalpiket extends Model
{
    use HasFactory;
    protected $table = 'jadwal_piket';
    protected $fillable = [
        'kdsiswa',
        'tanggal',
        'hari',
        'semester',
        'tahun_ajaran'
    ];

    public function fsiswa(){
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }
}
