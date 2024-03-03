<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaKegiatan extends Model
{
    use HasFactory;
    protected $table = 'agenda_kegiatan';
    protected $fillable = [
        'kdkelas',
        'kdkompetensi',
        'dokumentasi',
        'keterangan',
        'tanggal',
        'waktu',
        'hari',
        'nama_kegiatan',
        'semester',
        'tahun_ajaran'
    ];

    public function fkelas(){
        return $this->belongsTo(Kelas::class, 'kdkelas', 'id');
    }

    public function fkompetensi(){
        return $this->belongsTo(Kompetensi::class, 'kdkompetensi', 'id');
    }
}
