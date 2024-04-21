<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuruExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengembalikan koleksi kosong (array kosong) karena tidak perlu mengambil data dari database
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama Guru',
            'Nomor Telepon',
            'Jenis Kelamin',
            'Alamat',
            'Agama',
            'Tempat Lahir',
            'Tanggal Lahir (YYYY-MM-DD)',
        ];
    }
}
