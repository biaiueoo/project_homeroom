<?php

namespace App\Http\Controllers;

use App\Models\CatatanKasus;
use App\Models\Siswa;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\Lookup;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;

class CatatanKasusController extends Controller
{
    public function index()
    {
        $catatankasus = CatatanKasus::all();
        return view('catatankasus.index', [
            'catatankasus' => $catatankasus
        ]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();

        return view(
            'catatankasus.create',
            [
                'siswa' => Siswa::all(),
                'semester' => $semester,
            ]
        );
    }

    public function store(Request $request)
    {
        // Pada metode store untuk validasi file
        $request->validate([
            'kdsiswa' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'kasus' => 'required',
            'keterangan' => 'required|file|mimes:pdf|max:2048', // Sesuaikan dengan tipe file yang diizinkan
            'tanggal' => 'required',
            'tindak_lanjut' => 'required',
            'status_kasus' => 'required',
            'dampingan_bk' => 'required',
        ]);

        // Simpan file keterangan
        $keteranganFile = $request->file('keterangan');
        $keteranganContents = file_get_contents($keteranganFile->getRealPath());

        CatatanKasus::create([
            'kdsiswa' => $request->kdsiswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'keterangan' => $keteranganContents,
            'tanggal' => $request->tanggal,
            'tindak_lanjut' => $request->tindak_lanjut,
            'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk,
            // 'user_bk' => $request->user_bk,
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menambah catatan kasus baru');
    }




    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         'kdsiswa' => 'required',
    //         'keterangan' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
    //     ]);

    //     $file = $request->file('keterangan');

    //     // Menyimpan file ke dalam folder storage/app/public
    //     $filePath = $file->store('uploads');

    //     // Mengambil nama file dari path yang disimpan di storage
    //     $fileName = basename($filePath);

    //     return back()->with('success_message', 'File Keterangan berhasil diupload')->with('file_name', $fileName);
    // }




    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $catatankasus = CatatanKasus::find($id);
        if (!$catatankasus) return redirect()->route('catatankasus.index')
            ->with('error_message', 'Catatan Kasus dengan id = ' . $id . ' tidak ditemukan');
        return view('catatankasus.edit', [
            'catatankasus' => $catatankasus,
            'siswa' => Siswa::all(),
            'semester' => $semester
        ]);
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'kdsiswa' => 'required|exists:siswa,id',
        //     'semester' => 'required',
        //     'tahun_ajaran' => 'required',
        //     'kasus' => 'required',
        //     'keterangan' => 'required',
        //     'tanggal' => 'required',
        //     'tindak_lanjut' => 'required',
        //     'status_kasus' => 'required',
        //     'dampingan_bk' => 'required',
        // ]);

        $catatankasus = CatatanKasus::findOrFail($id);
        $catatankasus->update([
            'kdsiswa' => $request->kdsiswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'tindak_lanjut' => $request->tindak_lanjut,
            'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk,
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil mengupdate catatan kasus');
    }

    public function destroy(Request $request, $id)
    {

        $catatankasus = CatatanKasus::find($id);
        if ($catatankasus) $catatankasus->delete();
        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menghapus Catatan Kasus');
    }

    public function laporanKasusBK(Request $request)
{
    // Ambil semua catatan kasus dengan dampingan BK
    $laporanKasusBK = CatatanKasus::where('dampingan_bk', 'Ya');

    // Filter berdasarkan kompetensi keahlian
    if ($request->filled('kompetensi_keahlian')) {
        $kompetensiId = $request->kompetensi_keahlian;
        $laporanKasusBK->whereHas('fsiswa.fkompetensi', function ($query) use ($kompetensiId) {
            $query->where('id', $kompetensiId);
        });
    }

    // Filter berdasarkan kelas
    if ($request->filled('kelas')) {
        $kelasId = $request->kelas;
        $laporanKasusBK->whereHas('fsiswa.fkelas', function ($query) use ($kelasId) {
            $query->where('id', $kelasId);
        });
    }

    // Ambil hasil setelah penerapan semua filter
    $laporanKasusBK = $laporanKasusBK->get();

    // Ambil opsi kelas yang sesuai dengan kompetensi keahlian yang dipilih
    $kelasOptions = [];
    if ($request->filled('kompetensi_keahlian')) {
        $kelasOptions = Kelas::where('kdkompetensi', $request->kompetensi_keahlian)->get();
    }

    return view('catatankasus.laporan_kasus_bk', [
        'laporanKasusBK' => $laporanKasusBK,
        'kompetensiKeahlianOptions' => Kompetensi::all(),
        'kelasOptions' => $kelasOptions,
    ]);
}



    public function downloadPDF($id)
    {
        // Ambil data kunjungan rumah berdasarkan ID yang dipilih
        $catatankasus = CatatanKasus::findOrFail($id);

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF dengan data kunjungan rumah yang dipilih
        $html = view('pdf.catatankasus', compact('catatankasus'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Tentukan nama file PDF berdasarkan ID yang dipilih
        $fileName = 'catatankasus_' . $id . '.pdf';

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream($fileName);
    }




    public function laporanKasusKakom(Request $request)
    {
        // Ambil semua kelas yang terkait dengan kompetensi keahlian Sistem Informatika, Jaringan, atau Aplikasi
        $kelasOptions = Kelas::whereHas('fkompetensi', function ($query) {
            $query->where('kompetensi_keahlian', 'like', '%Sistem Informatika, Jaringan dan Aplikasi%');
        })->get();

        // Ambil semua catatan kasus yang memiliki kompetensi keahlian Sistem Informatika, Jaringan, atau Aplikasi
        $laporanKasusKakom = CatatanKasus::whereHas('fsiswa.fkompetensi', function ($query) {
            $query->where('kompetensi_keahlian', 'like', '%Sistem Informatika, Jaringan dan Aplikasi%');
        });

        // Filter berdasarkan kelas yang terkait dengan kompetensi keahlian tersebut
        if ($request->filled('kelas')) {
            $laporanKasusKakom->whereHas('fsiswa.fkelas', function ($query) use ($request) {
                // Filter kelas yang memiliki kompetensi keahlian yang sesuai
                $query->whereHas('fkompetensi', function ($subquery) {
                    $subquery->where('kompetensi_keahlian', 'like', '%Sistem Informatika, Jaringan dan Aplikasi%');
                });
                // Filter berdasarkan id kelas yang dipilih
                $query->where('id', $request->kelas);
            });
        }

        // Ambil hasil setelah penerapan semua filter
        $laporanKasusKakom = $laporanKasusKakom->get();

        return view('catatankasus.laporan_kasus_kakom', [
            'laporanKasusKakom' => $laporanKasusKakom,
            'kompetensiKeahlianOptions' => Kompetensi::all(),
            'kelasOptions' => $kelasOptions,
        ]);
    }

    public function store(Request $request)
{
    // Validasi data input
    $request->validate([
        'kdsiswa' => 'required',
        'semester' => 'required',
        'tahun_ajaran' => 'required',
        'kasus' => 'required',
        'keterangan' => 'required|file|mimes:pdf|max:2048', // Sesuaikan dengan tipe file yang diizinkan
        'tanggal' => 'required',
        'tindak_lanjut' => 'required',
        'status_kasus' => 'required',
        'dampingan_bk' => 'required',
    ]);

    // Tetapkan nilai default untuk status_kasus dan dampingan_bk
    $request->merge([
        'status_kasus' => 'baru', // Nilai default untuk status_kasus
        'dampingan_bk' => 'Tidak', // Nilai default untuk dampingan_bk
    ]);

    // Simpan file keterangan
    $keteranganFile = $request->file('keterangan');
    $keteranganContents = file_get_contents($keteranganFile->getRealPath());

    // Simpan data ke dalam basis data
    CatatanKasus::create([
        'kdsiswa' => $request->kdsiswa,
        'semester' => $request->semester,
        'tahun_ajaran' => $request->tahun_ajaran,
        'kasus' => $request->kasus,
        'keterangan' => $keteranganContents,
        'tanggal' => $request->tanggal,
        'tindak_lanjut' => $request->tindak_lanjut,
        'status_kasus' => $request->status_kasus,
        'dampingan_bk' => $request->dampingan_bk,
    ]);

    // Redirect atau kembali ke halaman yang sesuai
    return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menambah catatan kasus baru');
}

// Jika Anda ingin mengizinkan pengguna untuk mengubah status_kasus dan dampingan_bk di halaman index, biarkan metode berikut tetap ada:

// Metode untuk mengubah status_kasus
public function updateStatus(Request $request, $id)
{
    // Validasi data input

    // Ambil data catatan kasus berdasarkan ID
    $catatanKasus = CatatanKasus::findOrFail($id);

    // Perbarui nilai status_kasus sesuai dengan input pengguna
    $catatanKasus->status_kasus = $request->status;

    // Simpan perubahan
    $catatanKasus->save();

    // Redirect atau kembali ke halaman yang sesuai
}

// Metode untuk mengubah dampingan_bk
public function updateDampinganBK(Request $request, $id)
{
    // Validasi data input

    // Ambil data catatan kasus berdasarkan ID
    $catatanKasus = CatatanKasus::findOrFail($id);

    // Perbarui nilai dampingan_bk sesuai dengan input pengguna
    $catatanKasus->dampingan_bk = $request->dampingan_bk;

    // Simpan perubahan
    $catatanKasus->save();

    // Redirect atau kembali ke halaman yang sesuai
}

}
