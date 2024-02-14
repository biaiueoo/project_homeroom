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
        'kdkompetensi'
    ];

    public function fkompetensi(){
        return $this->belongsTo(Kompetensi::class, 'kdkompetensi', 'id');
    }
}