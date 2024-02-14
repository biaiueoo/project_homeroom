<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    use HasFactory;
    protected $table = 'walas';
    protected $fillable = [
        'kdguru',
        'kdkelas',
        'kdkompetensi',
        'tahun_ajaran'
    ];

    public function fguru(){
        return $this->belongsTo(Guru::class, 'kdguru', 'id');
    }

    public function fkelas(){
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }

    public function fkompetensi(){
        return $this->belongsTo(Kompetensi::class, 'kdkompetensi', 'id');
    }
}
