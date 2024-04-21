<?php

namespace App\Imports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DateTime;

class KegiatanImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Memulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
        if (!empty($row[0])) {
            return new Kegiatan([
                'nama' => $row[0],
                'bukti' => $row[1],
               
            ]);
        }

        return null; // Mengembalikan null jika data tidak valid
    }
}
