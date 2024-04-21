<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'kelas',
        'guru_nip', // Tambahkan 'guru_nip' ke fillable
        'kdkompetensi',
    ];

    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip');
    }

    public function fkompetensi()
    {
        return $this->belongsTo(Kompetensi::class, 'kdkompetensi');
    }
}
