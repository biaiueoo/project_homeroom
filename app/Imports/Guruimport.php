<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use DateTime;

class GuruImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Memulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
        // Validasi dan transformasi data sebelum membuat model Guru baru
        $formattedDate = date('Y-m-d', strtotime($row[3]));

        // Membuat instance Guru hanya jika data valid (contoh: ada NIP)
        if (!empty($row[0])) {
            return new Guru([
                'nip' => $row[0],
                'nama_guru' => $row[1],
                'notelp' => $row[2],
                'jk' => $row[3],
                'alamat' => $row[4],
                'agama' => $row[5],
                'tempat_lahir' => $row[6],
                'tanggal_lahir' => $formattedDate,
            ]);
        }

        return null; // Mengembalikan null jika data tidak valid
    }
}
