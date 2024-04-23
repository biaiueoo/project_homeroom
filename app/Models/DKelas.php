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

    protected static function booted()
    {
        static::created(function ($dkelas) {
            // Ambil data kelas berdasarkan kdkelas dari DKelas yang baru dibuat
            $kelas = Kelas::find($dkelas->kdkelas);

            if ($kelas) {
                // Perbarui kdkelas dan kdkompetensi di Siswa yang sesuai dengan nis dari DKelas
                $siswa = Siswa::where('nis', $dkelas->nis)->first();
                if ($siswa) {
                    $siswa->update([
                        'kdkelas' => $kelas->id,
                        'kdkompetensi' => $kelas->kdkompetensi,
                    ]);
                }
            }
        });
    }
}
