<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rencanakegiatan extends Model
{
    use HasFactory;
    protected $table = 'rencana__kegiatan';
    protected $fillable = [
        'kdkegiatan',
        'minggu_ke',
        'bukti_fisik',
        'keterangan'
    ];

    public function fkegiatan(){
        return $this->belongsTo(Kegiatan::class, 'kdkegiatan', 'id');
    }

    public function fbukti(){
        return $this->belongsTo(Kegiatan::class, 'bukti_fisik', 'id');
    }
}
