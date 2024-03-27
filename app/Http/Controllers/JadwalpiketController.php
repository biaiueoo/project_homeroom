<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalpiket;
use App\Models\Lookup;
use App\Models\Siswa;
use Dompdf\Dompdf;
use Dompdf\Options;


class jadwalpiketController extends Controller
{
    public function index()
    {
        $jadwalpiket = jadwalpiket::all();
        return view('jadwalpiket.index', [
            'jadwalpiket' => $jadwalpiket
        ]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();

        return view(
            'jadwalpiket.create',
            [
                'siswa' => Siswa::all(),
                'hari' => $hari,
                'semester' => $semester,

            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'hari' => 'required',
        ]);

        $array = $request->only(['kdsiswa', 'tahun_ajaran', 'semester', 'tanggal', 'hari']);
        jadwalpiket::create($array);

        return redirect()->route('jadwalpiket.index')->with('success_message', 'Berhasil menambah data jadwal Piket baru');
    }

    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();
        //Menampilkan Form Edit 
        $jadwalpiket = jadwalpiket::find($id);
        if (!$jadwalpiket) return redirect()->route('jadwalpiket.index')
            ->with('error_message', 'jadwal Piket dengan id = ' . $id . ' 
        tidak ditemukan');
        return view('jadwalpiket.edit', [
            'siswa' => Siswa::all(),
          
            'jadwalpiket' => $jadwalpiket,
            'dataEdit' => $jadwalpiket,
             'hari' => $hari,
            'semester' => $semester

        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kdsiswa' => 'required:jadwal_piket,kdsiswa' . $id
        ]);
        $jadwal = jadwalpiket::find($id);
        $jadwal->kdsiswa = $request->kdsiswa;
        $jadwal->tahun_ajaran = $request->tahun_ajaran;
        $jadwal->semester = $request->semester;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->hari = $request->hari;
        $jadwal->save();
        return redirect()->route('jadwalpiket.index')
            ->with('success_message', 'Berhasil mengubah jadwal KBM');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $jadwalpiket = jadwalpiket::find($id);

        if ($jadwalpiket) $jadwalpiket->delete();

        return redirect()->route('jadwalpiket.index')
            ->with('success_message', 'Berhasil menghapus jadwal Piket "' . $jadwalpiket->fsiswa->nama_lengkap . '" !');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $jadwalpiket = JadwalPiket::all(); // Atur ini sesuai dengan cara Anda mendapatkan data jadwal piket

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.jadwalpiket', compact('jadwalpiket'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('jadwal_piket.pdf');
    }

}
