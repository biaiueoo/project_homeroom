<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;
use Dompdf\Dompdf;
use Dompdf\Options;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index', ['siswa' => $siswa]);
    }

    public function create()
    {
        return view(
            'siswa.create',
            [
                'kelas' => Kelas::all()
            ],
            [
                'kompetensi' => Kompetensi::all()
            ]

        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'nis' => 'required|unique:siswa,nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $array = $request->only([
            'nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);
        $siswa = Siswa::create($array);

        // Associate the student with the class and competency
        $siswa->fkelas()->associate($request->input('kdkelas'));
        $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswa.index')->with('success_message', 'Berhasil menambah siswa baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit 
        $siswa = Siswa::find($id);
        if (!$siswa) return redirect()->route('siswa.index')
            ->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        return view('siswa.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        }

        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id,
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $array = $request->only([
            'nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $siswa->update($array);

        $siswa->fkelas()->associate($request->input('kdkelas'));
        $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswa.index')->with('success_message', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {

        $siswa = siswa::find($id);
        if ($siswa) $siswa->delete();
        return redirect()->route('siswa.index')->with('success_message', 'Berhasil menghapus siswa');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $siswa = Siswa::all(); // Atur ini sesuai dengan cara Anda mendapatkan data siswa

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.siswa', compact('siswa'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('data_siswa.pdf');
    }
}
