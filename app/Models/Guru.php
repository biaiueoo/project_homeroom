<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'nip', 
        'nama_guru', 
        'notelp', 
        'jk', 
        'alamat', 
        'agama', 
        'tempat_lahir', 
        'tanggal_lahir'
        

    ];
}
