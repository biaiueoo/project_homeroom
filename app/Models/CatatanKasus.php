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
        'tindak_lanjut',
        'status_kasus',
        'dampingan_bk',
        'user_walas',
        'user_kakom',
        'user_bk',
        'user_kesiswaan'
    ];

    public function getUserByRole($role)
    {
        return $this->belongsTo(User::class, $role, 'id');
    }

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}
