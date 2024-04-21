<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    use HasFactory;

    protected $table = 'kompetensi_keahlian';
    protected $fillable = [
        'kompetensi_keahlian',
        'guru_nip', // Tambahkan 'guru_nip' ke fillable
    ];

    public function fguru()
    {
        return $this->belongsTo(Guru::class, 'guru_nip');
    }
}

