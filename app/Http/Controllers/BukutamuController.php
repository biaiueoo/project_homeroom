<?php

namespace App\Http\Controllers;

use App\Models\Bukutamu;
use App\Models\Siswa;
use App\Models\Lookup;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;

class BukutamuController extends Controller
{
    public function index()
    {
        $bukutamu = Bukutamu::all();
        return view('bukutamu.index', [
            'bukutamu' => $bukutamu
        ]);
    }


    public function create()
    {
        $semesters = Lookup::where('jenis', 'semester')->get();
        $bukutamu = Bukutamu::with('semesterLookup')->get();

        return view('bukutamu.create', [
            'bukutamu' => $bukutamu,
            'semesters' => $semesters,
            'siswa' => Siswa::all()
        ]);
    }
    public function store(Request $request)
    {
        // Menyimpan Data bukutamu Baru
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'semester' => 'required',
            'keperluan' => 'required',
            'tahun_ajaran' => 'required',
            'hasil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $array = $request->only([
            'kdsiswa',
            'tanggal',
            'semester',
            'keperluan',
            'tahun_ajaran',
        ]);

        if ($request->hasFile('hasil')) {
            $array['hasil'] = $request->file('hasil')->store('Foto bukutamu');
        }



        $tambah = Bukutamu::create($array);

        if ($tambah) {
            return redirect()->route('bukutamu.index')
                ->with('success_message', 'Berhasil menambah bukutamu baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah bukutamu baru');
        }
    }


    public function edit($id)
    {

        $semester = Lookup::where('jenis', 'semester')->get();
        $bukutamu = Bukutamu::with('semesterLookup')->get();

        //Menampilkan Form Edit
        $bukutamu = bukutamu::find($id);
        if (!$bukutamu) return redirect()->route('bukutamu.index')
            ->with('error_message', 'bukutamu dengan id' . $id . ' tidak ditemukan');
        return view('bukutamu.edit', [
            'semester' => $semester,
            'bukutamu' => $bukutamu,
            'dataEdit' => $bukutamu,
            'siswa' => Siswa::all()

        ]);
    }

    public function update(Request $request, $id)
    {
        //Menyimpan Data bukutamu
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required|date',
            'keperluan' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',



        ]);
        $bukutamu = Bukutamu::find($id);
        $bukutamu->kdsiswa = $request->kdsiswa;
        $bukutamu->tanggal = $request->tanggal;
        $bukutamu->keperluan = $request->keperluan;
        $bukutamu->semester = $request->semester;
        $bukutamu->tahun_ajaran = $request->tahun_ajaran;
        $bukutamu->save();
        return redirect()->route('bukutamu.index')
            ->with('success_message', 'Berhasil mengubah bukutamu');
    }


    public function destroy(Request $request, $id)
    {
        $bukutamu = Bukutamu::find($id);
        if ($bukutamu) {
            $hapus = $bukutamu->delete();
            if ($hapus) unlink("storage/" . $bukutamu->hasil);
        }
        return redirect()->route('bukutamu.index')
            ->with('success_message', 'Berhasil menghapus Bukutamu');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $bukutamu = Bukutamu::all(); // Mengambil data dari model Bukutamu

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.bukutamu', compact('bukutamu'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('bukutamu.pdf');
    }
}
