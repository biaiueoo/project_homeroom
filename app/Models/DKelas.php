<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DKelas extends Model
{
    use HasFactory;
    protected $table = 'dkelas';
    protected $fillable = [
        'kdkelas',
        'nis'
    ];

    public function fkelas()
    {
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }
}
