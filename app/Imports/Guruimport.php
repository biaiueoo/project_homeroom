<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class GuruImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Memulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
        // Membuat instance Guru hanya jika data valid (contoh: ada NIP)
        if (!empty($row[0])) {
            $tanggal_lahir = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]));
            return new Guru([
                'nip' => $row[0],
                'nama_guru' => $row[1],
                'notelp' => $row[2],
                'jk' => $row[3],
                'alamat' => $row[4],
                'agama' => $row[5],
                'tempat_lahir' => $row[6],
                'tanggal_lahir' => $tanggal_lahir->toDateString(),
            ]);
        }

        return null; // Mengembalikan null jika data tidak valid
    }
}
