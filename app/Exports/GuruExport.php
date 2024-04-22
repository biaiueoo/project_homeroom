<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GuruExport implements FromCollection
{
    public function collection()
    {
        // Mengembalikan koleksi kosong (array kosong) karena tidak perlu mengambil data dari database
        return collect([]);
    }

    public function generateTemplate(){
        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $agamaList = ['Islam', 'Katolik', 'Protestan', 'Hindu', 'Buddha', 'Lainnya'];
        $jk = ['L', 'P'];

        $sheet->setCellValue('A1', 'NIP');
        $sheet->setCellValue('B1', 'Nama Guru');
        $sheet->setCellValue('C1', 'Nomor Telepon');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Agama');
        $sheet->setCellValue('G1', 'Tempat Lahir');
        $sheet->setCellValue('H1', 'Tanggal Lahir');

        // Set data validasi untuk seluruh baris pada kolom agama (kolom F)
        for ($row = 2; $row <= 1000; $row++) { // Misalnya sampai baris ke-1000
            $cell = 'F' . $row;
            $validation = $sheet->getCell($cell)->getDataValidation();
            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
            $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
            $validation->setShowInputMessage(true);
            $validation->setShowErrorMessage(true);
            $validation->setShowDropDown(true);
            $validation->setErrorTitle('Input error');
            $validation->setError('Value is not in list.');
            $validation->setPromptTitle('Pick from list');
            $validation->setPrompt('Please pick a value from the drop-down list.');
            $validation->setFormula1('"'.implode(',', $agamaList).'"');
        }

        for ($row = 2; $row <= 1000; $row++) { // Misalnya sampai baris ke-1000
            $cell = 'D' . $row;
            $validation = $sheet->getCell($cell)->getDataValidation();
            $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
            $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
            $validation->setShowInputMessage(true);
            $validation->setShowErrorMessage(true);
            $validation->setShowDropDown(true);
            $validation->setErrorTitle('Input error');
            $validation->setError('Value is not in list.');
            $validation->setPromptTitle('Pick from list');
            $validation->setPrompt('Please pick a value from the drop-down list.');
            $validation->setFormula1('"'.implode(',', $jk).'"');
        }

        // Set format tanggal untuk kolom Tanggal Lahir (kolom D) mulai dari baris kedua dan seterusnya
        $sheet->getStyle('H2:H1000')->getNumberFormat()->setFormatCode('yyyy-mm-dd');

        // Simpan file ke Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'template_guru.xlsx';
        $writer->save($filename);

        // Set header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        // Flush buffer output ke browser
        $writer->save('php://output');
        exit;
    }
}
$templateGenerator = new GuruExport();
$templateGenerator->generateTemplate();