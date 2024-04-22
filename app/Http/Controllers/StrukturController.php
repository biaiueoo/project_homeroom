<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        
        $struktur = Struktur::all();
        return view('struktur.index', [
            'struktur' => $struktur
        ]);
    }

    public function show($id)
    {
        // Ambil data struktur organisasi berdasarkan ID
        $struktur = Struktur::findOrFail($id);

        return view('struktur.show', [
            'struktur' => $struktur
        ]);
    }

    public function create()
    {
        return view(
            'struktur.create',
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $array = $request->only(['nama', 'jabatan']);
        Struktur::create($array);

        return redirect()->route('struktur.index')->with('success_message', 'Berhasil menambah struktur baru');
    }


    
    public function edit($id)
    {
        //Menampilkan Form Edit 
        $struktur = struktur::find($id);
        if (!$struktur) return redirect()->route('struktur.index')
            ->with('error_message', 'struktur dengan id = ' . $id . ' 
tidak ditemukan');
        return view('struktur.edit', [
            'struktur' => $struktur,
           
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data struktur 
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'

        ]);
        $struktur = struktur::find($id);
        $struktur->nama = $request->nama;
        $struktur->jabatan = $request->jabatan;
        $struktur->save();
        return redirect()->route('struktur.index')
            ->with('success_message', 'Berhasil mengubah struktur');
    }

    public function destroy(Request $request, $id)
    
    {
        // Temukan struktur berdasarkan ID
        $struktur = Struktur::find($id);

        if (!$struktur) {
            return redirect()->route('struktur.index')->with('error_message', 'struktur tidak ditemukan.');
        }

        // Hapus struktur
        $struktur->delete();

        return redirect()->route('struktur.index')->with('success_message', 'Berhasil menghapus struktur dan rencana struktur terkait.');
    }
    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $struktur = Struktur::all(); // Atur ini sesuai dengan cara Anda mendapatkan data siswa

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.struktur', compact('struktur'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('struktur.pdf');
    }
}

