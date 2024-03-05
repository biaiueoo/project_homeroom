<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftarrapot extends Model
{
    use HasFactory;
    protected $table = 'daftar_rapot';
    protected $fillable = [
        'kdsiswa',
        'tanggal',
        'semester',
        'tahun_ajaran',
        'dokumentasi',
        'rapor'
       
    ];

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }

 


}
