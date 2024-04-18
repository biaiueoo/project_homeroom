<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Siswa|null
     */
    public function model(array $row)
    {
        // Format the date before creating the Siswa instance
        $formattedDate = date('Y-m-d', strtotime($row[3]));

        return new Siswa([
            'nis' => $row[0],
            'nama_lengkap' => $row[1],
            'tempat_lahir' => $row[2],
            'tanggal_lahir' => $formattedDate,
            'alamat' => $row[4],
            'agama' => $row[5],
            'kewarganegaraan' => $row[6],
            'no_hp' => $row[7],
            'email' => $row[8],
            'nisn' => $row[9],
            'kdkelas' => $row[10],
            'kdkompetensi' => $row[11],
            'tahun_masuk' => $row[12],
            'nama_ayah' => $row[13],
            'nama_ibu' => $row[14],
            'alamat_ortu' => $row[15],
            'no_ortu' => $row[16],
            'nama_sekolah_asal' => $row[17],
            'alamat_sekolah' => $row[18],
            'tahun_lulus' => $row[19],
            'riwayat_penyakit' => $row[20],
            'alergi' => $row[21],
            'prestasi_akademik' => $row[22],
            'prestasi_non_akademik' => $row[23],
            'ekstrakurikuler' => $row[24],
            'biografi' => $row[25],
        ]);
    }
}
