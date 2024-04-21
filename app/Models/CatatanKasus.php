<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKasus extends Model
{
    use HasFactory;
    protected $table = 'catatan_kasus';
    protected $fillable = [
        'kdsiswa',
        'semester',
        'tahun_ajaran',
        'tanggal',
        'kasus',
        'keterangan',
        'tindak_lanjut',
        'status_kasus',
        'dampingan_bk',
        // 'user_admin',
        // 'user_walas',
        // 'user_bk',
        // 'user_kakom',
    ];

    public function fsiswa()
    {
        return $this->belongsTo(Siswa::class, 'kdsiswa', 'id');
    }

    // Mendefinisikan relasi dengan model PembinaanBK
    // Mendefinisikan relasi dengan model PembinaanBK
    public function pembinaanBK()
    {
        return $this->hasOne(PembinaanBK::class, 'kdkasus', 'id');
    }

    // Model event: akan dipanggil saat sebuah CatatanKasus baru dibuat
    protected static function booted()
    {
        static::created(function ($catatankasus) {
            // Cek nilai kolom dampingan_bk, jika "Ya", buat entri PembinaanBK
            if ($catatankasus->dampingan_bk === 'Ya') {
                $catatankasus->createPembinaanBK();
            }
        });

        static::updated(function ($catatankasus) {
            // Cek perubahan pada kolom dampingan_bk, jika berubah menjadi "Ya", buat entri PembinaanBK
            if ($catatankasus->isDirty('dampingan_bk') && $catatankasus->dampingan_bk === 'Ya') {
                $catatankasus->createPembinaanBK();
            }
        });

        static::deleting(function ($catatankasus) {
            // Hapus PembinaanBK terkait saat CatatanKasus dihapus
            if ($catatankasus->pembinaanBK) {
                $catatankasus->pembinaanBK->delete();
            }
        });
    }

    // Method untuk membuat entri PembinaanBK
    public function createPembinaanBK()
    {
        $this->pembinaanBK()->create([
            'kdkasus' => $this->id,
            'status' => 'Kasus Baru', // Default status 'Kasus Baru'
        ]);
    }
}
