<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function index()
    {

        $kompetensi = Kompetensi::all();
        return view('kompetensi.index', [
            'kompetensi' => $kompetensi
        ]);
    }

    public function create()
    {
        return view('kompetensi.create');
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
            'kompetensi_keahlian' => 'required|unique:kompetensi_keahlian,kompetensi_keahlian'
        ]);
        $array = $request->only([
            'kompetensi_keahlian'
        ]);
        $kompetensi = kompetensi::create($array);
        return redirect()->route('kompetensi.index')->with('success_message', 'Berhasil menambah Kompetensi Keahlian baru');
    }


    public function edit(string $id)
    {

        $kompetensi = kompetensi::find($id);
        if (!$kompetensi) return redirect()->route('kompetensi.index')
            ->with('error_message', 'Kompetensi Keahlian dengan id = ' . $id . ' tidak ditemukan');
        return view('kompetensi.edit', [
            'kompetensi' => $kompetensi
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
