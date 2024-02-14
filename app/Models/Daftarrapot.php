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
        'bukti_ttd',
        'keterangan',
        'original_file_name',
    ];

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }

    public function getOriginalFileNameAttribute()
{
    return $this->attributes['original_file_name'];
}


}
