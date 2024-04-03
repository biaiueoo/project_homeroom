<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentase extends Model
{
    use HasFactory;
    protected $table = 'presentase_sosial';
    protected $fillable = [
        'kdsiswa',
        'pekerjaan_ortu'
    ];

    public function fsiswa(){
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }

    public function pekerjaanLookup()
    {
        return $this->belongsTo(Lookup::class, 'pekerjaan_ortu', 'keterangan')
            ->where('jenis', '=', 'pekerjaan');
    }
}