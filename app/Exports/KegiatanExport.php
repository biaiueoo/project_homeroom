<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KegiatanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengembalikan koleksi kosong (array kosong) karena tidak perlu mengambil data dari database
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'URAIAN KEGIATAN',
            'BUKTI',
            
        ];
    }
}
