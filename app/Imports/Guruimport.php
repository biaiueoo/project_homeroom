<?php

namespace App\Imports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\ToModel;

class Guruimport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Guru|null
     */
    public function model(array $row)
    {
        $formattedDate = date('Y-m-d', strtotime($row[7]));

        return new Guru([
            'nip' => $row[0],
            'nama_guru' => $row[1],
            'notelp' => $row[2],
            'jk' => $row[3],
            'alamat' => $row[4],
            'agama' => $row[5],
            'tempat_lahir' => $row[6],
            'tanggal_lahir' =>  $formattedDate,
        ]);
    }
}
