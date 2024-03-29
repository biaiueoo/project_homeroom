<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', [
            'guru' => $guru
        ]);
    }

    public function create()
    {
        return view('guru.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'notelp' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);
        $array = $request->only([
            'nip',
            'nama_guru',
            'notelp',
            'jk',
            'alamat',
            'agama',
            'tempat_lahir',
            'tanggal_lahir'

        ]);
        $guru = Guru::create($array);
        return redirect()->route('guru.index')->with('success_message', 'Berhasil menambah Guru baru');
    }


    public function edit($id)
    {

        $guru = Guru::find($id);
        if (!$guru) return redirect()->route('guru.index')->with('error_message', 'guru  dengan id = ' . $id . ' tidak ditemukan');
        return view('guru.edit', [
            'guru' => $guru
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $id,
            'nama_guru' => 'required',
            'notelp' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);
    
        $guru = Guru::find($id);
        if (!$guru) {
            return redirect()->route('guru.index')->with('error_message', 'Guru dengan id = ' . $id . ' tidak ditemukan');
        }
    
        $guru->nip = $request->nip;
        // Set other attributes accordingly
        $guru->nama_guru = $request->nama_guru;
        $guru->notelp = $request->notelp;
        $guru->jk = $request->jk;
        $guru->alamat = $request->alamat;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
    
        $guru->save();
    
        return redirect()->route('guru.index')->with('success_message', 'Berhasil mengubah Guru');
    }
    


    public function destroy(Request $request, $id)
    {

        $guru = Guru::find($id);
        if ($guru) $guru->delete();
        return redirect()->route('guru.index')->with('success_message', 'Berhasil menghapus guru "' . $guru->nama_guru . '" !');

    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $guru = Guru::all(); // Atur ini sesuai dengan cara Anda mendapatkan data guru

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.guru', compact('guru'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('data_guru.pdf');
    }
}

