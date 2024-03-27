<?php

namespace App\Http\Controllers;

use App\Models\daftarrapot;
use App\Models\Siswa;
use App\Models\Lookup;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;

class DaftarrapotController extends Controller
{
    public function index()
    {
        $daftarrapot = daftarrapot::all();
        return view('daftarrapot.index', [
            'daftarrapot' => $daftarrapot
        ]);
    }


    public function create()
    {
        $semesters = Lookup::where('jenis', 'semester')->get();
        $rapor = Lookup::where('jenis', 'rapor')->get();


        return view('daftarrapot.create', [
            'semesters' => $semesters,
            'rapor' => $rapor,
            'siswa' => Siswa::all()
        ]);
    }



    public function store(Request $request)
    {

        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'semester' => 'required',
            'rapor' => 'required',
            'tahun_ajaran' => 'required',
            'Dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $array = $request->only([
            'kdsiswa',
            'tanggal',
            'semester',
            'rapor',
            'tahun_ajaran',

        ]);
        if ($request->hasFile('Dokumentasi')) {
            $array['Dokumentasi'] = $request->file('Dokumentasi')->store('Dokumentasi Daftar Rapot');
        }

        $tambah = daftarrapot::create($array);

        if ($tambah) {
            return redirect()->route('daftarrapot.index')
                ->with('success_message', 'Berhasil menambah Daftar Rapot baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah Daftar Rapot baru');
        }
    }


    public function edit($id)
    {

        $semester = Lookup::where('jenis', 'semester')->get();
        $rapor = Lookup::where('jenis', 'rapor')->get();


        //Menampilkan Form Edit
        $daftarrapot = daftarrapot::find($id);
        if (!$daftarrapot) return redirect()->route('daftarrapot.index')
            ->with('error_message', 'daftarrapot dengan id' . $id . ' tidak ditemukan');
        return view('daftarrapot.edit', [
            'semester' => $semester,
            'rapor' => $rapor,
            'daftarrapot' => $daftarrapot,
            'dataEdit' => $daftarrapot,
            'siswa' => Siswa::all()

        ]);
    }




    public function update(Request $request, $id)
    {
        //Menyimpan Data agenda
        $request->validate([
            'kdsiswa' => '',
            'tanggal' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'rapor' => 'required',



        ]);
        $daftarrapot = Daftarrapot::find($id);
        // $daftarrapot->kdsiswa = $request->kdsiswa;
        $daftarrapot->tanggal = $request->tanggal;
        $daftarrapot->semester = $request->semester;
        $daftarrapot->rapor = $request->rapor;
        $daftarrapot->tahun_ajaran = $request->tahun_ajaran;
        $daftarrapot->save();
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil mengubah Agenda Kegiatan');
    }




    public function destroy(Request $request, $id)
    {
        $daftarrapot = daftarrapot::find($id);
        if ($daftarrapot) {
            $hapus = $daftarrapot->delete();
            if ($hapus) unlink("storage/" . $daftarrapot->Dokumentasi);
        }
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menghapus daftarrapot');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $daftarrapot = daftarrapot::all(); // Atur ini sesuai dengan cara Anda mendapatkan data siswa

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.daftarrapot', compact('daftarrapot'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('daftar_rapot.pdf');
    }
}
