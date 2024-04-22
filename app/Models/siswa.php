<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'kewarganegaraan',
        'no_hp',
        'email',
        'nisn',
        'tahun_masuk',
        'nama_ayah',
        'nama_ibu',
        'alamat_ortu',
        'no_ortu',
        'nama_sekolah_asal',
        'alamat_sekolah',
        'tahun_lulus',
        'riwayat_penyakit',
        'alergi',
        'prestasi_akademik',
        'prestasi_non_akademik',
        'ekstrakurikuler',
        'biografi'
    ];
}
