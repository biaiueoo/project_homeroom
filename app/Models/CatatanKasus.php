<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKasus extends Model
{
    use HasFactory;
    protected $table = 'catatan_kasus';
    protected $fillable = [
        'kdsiswa',
        'semester',
        'tahun_ajaran',
        'tanggal',
        'kasus',
        'keterangan',
        'tidak_lanjut',
        'status_kasus',
        'dampingan_bk',
        // 'user_admin',
        // 'user_walas',
        // 'user_bk',
        // 'user_kakom',
    ];

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }
}
