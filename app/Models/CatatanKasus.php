<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKasus extends Model
{
    use HasFactory;
    protected $table = 'catatan_kasus';
    protected $fillable = [
        'id_siswa',
        'semester',
        'tahun_ajaran',
        'kasus',
        'keterangan',
        'tindak_lanjut',
        'status_kasus',
        'dampingan_bk',
        
    ];

    
    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
