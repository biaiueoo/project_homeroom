<?php 
namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengembalikan koleksi kosong (array kosong) karena tidak perlu mengambil data dari database
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'NIS',
            'Nama Siswa',
            'Tempat Lahir',
            'Tanggal Lahir (YYYY-MM-DD)',
            'Alamat',
            'Agama (Islam, Hindu, Buddha, Katolik, Protestan, Lainnya)',
            'Kewarganegaraan',
            'No Hp',
            'Email',
            'NISN',
            'Kdkelas',
            'Kdkompetensi',
            'Tahun Masuk',
            'Nama Ayah',
            'nama Ibu',
            'Alamat Ortu',
            'No Ortu',
            'Nama Sekolah Asal',
            'Alamat Sekolah',
            'Tahun Lulus',
            'Riwayat Penyakit',
            'Alergi',
            'Prestasi Akademik',
            'Prestasi NonAkademik',
            'Ekstrakurikuler',
            'Biografi'
        ];
    }
}
