<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'nama',
        'bukti'
    ];

    public function rencanaKegiatan()
    {
        return $this->hasOne(RencanaKegiatan::class, 'kdkegiatan', 'id');
    }

   

    protected static function booted()
    {
        static::created(function ($kegiatan) {
            // Buat entri baru dalam model RencanaKegiatan
            $kegiatan->rencanaKegiatan()->create([
                'kdkegiatan' => $kegiatan->id,
                'bukti_fisik' => $kegiatan->id,
                

            ]);
        });
    }
}
