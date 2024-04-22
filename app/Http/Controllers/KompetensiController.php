<?php

namespace App\Http\Controllers;

use App\Exports\KompetensiExport;
use App\Models\Kompetensi;
use App\Models\Guru;
use Illuminate\Http\Request;

use App\Imports\KompetensiImport;
use Maatwebsite\Excel\Facades\Excel;

class KompetensiController extends Controller
{
    public function importViewSiswa(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request)
    {
        Excel::import(new KompetensiImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new KompetensiExport, 'kompetensi_template.xlsx');
    }


    public function index()
    {

        $kompetensi = Kompetensi::all();
        return view('kompetensi.index', [
            'kompetensi' => $kompetensi
        ]);
    }

    public function create()
    {
        return view('kompetensi.create', [
            'guru' => Guru::all()
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads'), $fileName);

    //         // Simpan nama file ke dalam kolom 'kompetensi_keahlian' di dalam database
    //         Kompetensi::create(['kompetensi_keahlian' => $fileName]);

    //         return redirect()->route('kompetensi.index')->with('success_message', 'File berhasil diunggah.');
    //     }

    //     return redirect()->back()->with('error_message', 'Gagal mengunggah file.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kompetensi_keahlian' => 'required|unique:kompetensi_keahlian,kompetensi_keahlian',
            'guru_nip' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $array = $request->only([
            'kompetensi_keahlian',
            'guru_nip',
            'tahun_ajaran'
        ]);

        kompetensi::create($array);
        return redirect()->route('kompetensi.index')->with('success_message', 'Berhasil menambah Kompetensi Keahlian baru');
    }


    public function edit(string $id)
    {

        $kompetensi = kompetensi::find($id);
        if (!$kompetensi) return redirect()->route('kompetensi.index')
            ->with('error_message', 'Kompetensi Keahlian dengan id = ' . $id . ' tidak ditemukan');
        return view('kompetensi.edit', [
            'kompetensi' => $kompetensi,
            'guru' => Guru::all()
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'kompetensi_keahlian' =>
            'required|unique:kompetensi_keahlian,kompetensi_keahlian,' . $id
        ]);
        $kompetensi = kompetensi::find($id);
        $kompetensi->kompetensi_keahlian = $request->kompetensi_keahlian;
        $kompetensi->guru_nip = $request->guru_nip;
        $kompetensi->tahun_ajaran = $request->tahun_ajaran;
        $kompetensi->save();
        return redirect()->route('kompetensi.index')->with('success_message', 'Berhasil mengubah Kompetensi Keahlian');
    }


    public function destroy(Request $request, $id)
    {

        $kompetensi = kompetensi::find($id);
        if ($kompetensi) $kompetensi->delete();
        return redirect()->route('kompetensi.index')->with('success_message', 'Berhasil menghapus Kompetensi Keahlian');
    }
}
