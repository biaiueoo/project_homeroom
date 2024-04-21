<?php

namespace App\Imports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;

class KelasImport implements ToModel
{
   
    public function startRow(): int
    {
        return 2; // Memulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
       
        // Membuat instance Guru hanya jika data valid (contoh: ada NIP)
        if (!empty($row[0])) {
            return new Kelas([
                'kelas' => $row[0],
                'kompetensi_keahlian' => $row[1],

               
            ]);
        }

        return null; // Mengembalikan null jika data tidak valid
    }
}
