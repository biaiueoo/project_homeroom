<?php 
namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class SiswaExport implements FromCollection

{
    public function collection()
    {
        // Mengembalikan koleksi kosong (array kosong) karena tidak perlu mengambil data dari database
        return collect([]);
    }

    public function generateTemplate()
    {
        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Daftar agama yang akan digunakan dalam dropdown
        $agamaList = ['Islam', 'Katolik', 'Protestan', 'Hindu', 'Buddha', 'Lainnya'];
        $kewarganegaraan = ['WNI', 'WNA'];

        // Set judul kolom
        $sheet->setCellValue('A1', 'NIS');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'Tempat Lahir');
        $sheet->setCellValue('D1', 'Tanggal Lahir (Format: YYYY-MM-DD)');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Agama');
        $sheet->setCellValue('G1', 'Kewarganegaraan');
        $sheet->setCellValue('H1', 'No. HP');
        $sheet->setCellValue('I1', 'Email');
        $sheet->setCellValue('J1', 'NISN');
        $sheet->setCellValue('K1', 'Kode Kelas');
        $sheet->setCellValue('L1', 'Kode Kompetensi');
        $sheet->setCellValue('M1', 'Tahun Masuk');
        $sheet->setCellValue('N1', 'Nama Ayah');
        $sheet->setCellValue('O1', 'Nama Ibu');
        $sheet->setCellValue('P1', 'Alamat Ortu');
        $sheet->setCellValue('Q1', 'No. Ortu');
        $sheet->setCellValue('R1', 'Nama Sekolah Asal');
        $sheet->setCellValue('S1', 'Alamat Sekolah');
        $sheet->setCellValue('T1', 'Tahun Lulus');
        $sheet->setCellValue('U1', 'Riwayat Penyakit');
        $sheet->setCellValue('V1', 'Alergi');
        $sheet->setCellValue('W1', 'Prestasi Akademik');
        $sheet->setCellValue('X1', 'Prestasi Non-Akademik');
        $sheet->setCellValue('Y1', 'Ekstrakurikuler');
        $sheet->setCellValue('Z1', 'Biografi');

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

        // Set data validasi untuk seluruh baris pada kolom kewarganegaraan (kolom G)
        for ($row = 2; $row <= 1000; $row++) { // Misalnya sampai baris ke-1000
            $cell = 'G' . $row;
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
            $validation->setFormula1('"'.implode(',', $kewarganegaraan).'"');
        }

        // Set format tanggal untuk kolom Tanggal Lahir (kolom D) mulai dari baris kedua dan seterusnya
        $sheet->getStyle('D2:D1000')->getNumberFormat()->setFormatCode('yyyy-mm-dd');

        // Simpan file ke Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'template_siswa.xlsx';
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
$templateGenerator = new SiswaExport();
$templateGenerator->generateTemplate();