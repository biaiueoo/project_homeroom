<?php

namespace App\Imports;

use App\Models\Siswa;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Mulai impor dari baris kedua (indeks 2)
    }

    public function model(array $row)
    {
        // Cek apakah kolom NIS tidak kosong (indeks 0)
        if (!empty($row[0])) {
            // Format tanggal (indeks 3)
            // Buat instance Siswa dengan data yang diimpor
            //dd ($row);
            $tanggal_lahir = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]));

            return new Siswa([
                'nis' => $row[0],
                'nama_lengkap' => $row[1],
                'tempat_lahir' => $row[2],
                'tanggal_lahir' => $tanggal_lahir->toDateString(), 
                'alamat' => $row[4],
                'agama' => $row[5],
                'kewarganegaraan' => $row[6],
                'no_hp' => $row[7],
                'email' => $row[8],
                'nisn' => $row[9],
                'tahun_masuk' => $row[10],
                'nama_ayah' => $row[11],
                'nama_ibu' => $row[12],
                'alamat_ortu' => $row[13],
                'no_ortu' => $row[14],
                'nama_sekolah_asal' => $row[15],
                'alamat_sekolah' => $row[16],
                'tahun_lulus' => $row[17],
                'riwayat_penyakit' => $row[18],
                'alergi' => $row[19],
                'prestasi_akademik' => $row[20],
                'prestasi_non_akademik' => $row[21],
                'ekstrakurikuler' => $row[22],
                'biografi' => $row[23],
            ]);
        }

        // Mengembalikan null jika data tidak valid (misalnya baris kosong)
        return null;
    }
}
