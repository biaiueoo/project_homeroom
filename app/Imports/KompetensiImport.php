<?php

namespace App\Imports;

use App\Models\Kompetensi;
use Maatwebsite\Excel\Concerns\ToModel;

class KompetensiImport implements ToModel
{
   
    public function startRow(): int
    {
        return 2; // Memulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
       
        // Membuat instance Guru hanya jika data valid (contoh: ada NIP)
        if (!empty($row[0])) {
            return new Kompetensi([
                'kompetensi_keahlian' => $row[0],
               
            ]);
        }

        return null; // Mengembalikan null jika data tidak valid
    }
}
