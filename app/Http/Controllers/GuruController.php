<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Imports\Guruimport;
use App\Models\Guru;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function importViewSiswa(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request)
    {
        Excel::import(new Guruimport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new GuruExport, 'siswa_template.xlsx');
    }


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
        $guru = Guru::find($id);
        if (!$guru) {
            return redirect()->route('guru.index')->with('error_message', 'Guru dengan id = ' . $id . ' tidak ditemukan');
        }

        $request->validate([
            'nip' => 'required|unique:guru,nip,' . $id,
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
            'tempat_lahir',
            'tanggal_lahir'
        ]);

        $guru->update($array);
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
