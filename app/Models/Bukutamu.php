<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukutamu extends Model
{
    use HasFactory;
    protected $table = 'buku_tamu';
    protected $fillable = [
        'kdsiswa',
        'tanggal',
        'keperluan',
        'hasil',
        'semester',
        'tahun_ajaran'
    ];

    public function fsiswa(){
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }

    public function semesterLookup()
{
    return $this->belongsTo(Lookup::class, 'semester', 'keterangan')
        ->where('jenis', '=', 'semester');
}

}