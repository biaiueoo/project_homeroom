<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal_kbm';
    protected $fillable = [
        'kdguru',
        'kdkelas',
        'kdkompetensi',
        'kdmapel',
        'tahun_ajaran',
        'semester',
        'jam',
        'hari'
    ];

    public function fguru(){
        return $this->belongsTo(Guru::class, 'kdguru', 'id');
    }

    public function fkelas(){
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }

    public function fkompetensi(){
        return $this->belongsTo(Kompetensi::class, 'kdkompetensi', 'id');
    }

    public function fmapel(){
        return $this->belongsTo(Mapel::class, 'kdmapel', 'id');
    }
}
