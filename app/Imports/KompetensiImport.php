<?php

namespace App\Imports;

use App\Models\Kompetensi;
use Maatwebsite\Excel\Concerns\ToModel;

class KompetensiImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return Kompetensi|null
     */
    public function model(array $row)
    {
        return new Kompetensi([
            'kompetensi_keahlian' => $row[1],
        ]);
    }
}
