<?php

namespace App\Http\Controllers;

use App\Exports\KegiatanExport;
use App\Imports\KegiatanImport;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KegiatanController extends Controller
{


    public function importViewSiswa(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new KegiatanImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new KegiatanExport, 'kegiatan_template.xlsx');
    }
    
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function create()
    {
        return view(
            'kegiatan.create',
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bukti' => 'required'
        ]);

        $array = $request->only(['nama', 'bukti']);
        kegiatan::create($array);

        return redirect()->route('kegiatan.index')->with('success_message', 'Berhasil menambah kegiatan baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit 
        $kegiatan = kegiatan::find($id);
        if (!$kegiatan) return redirect()->route('kegiatan.index')
            ->with('error_message', 'kegiatan dengan id = ' . $id . ' 
tidak ditemukan');
        return view('kegiatan.edit', [
            'kegiatan' => $kegiatan,
           
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data kegiatan 
        $request->validate([
            'nama' => 'required',
            'bukti' => 'required'

        ]);
        $kegiatan = kegiatan::find($id);
        $kegiatan->nama = $request->nama;
        $kegiatan->bukti = $request->bukti;
        $kegiatan->save();
        return redirect()->route('kegiatan.index')
            ->with('success_message', 'Berhasil mengubah kegiatan');
    }

    public function destroy(Request $request, $id)
    
    {
        // Temukan kegiatan berdasarkan ID
        $kegiatan = Kegiatan::find($id);

        if (!$kegiatan) {
            return redirect()->route('kegiatan.index')->with('error_message', 'Kegiatan tidak ditemukan.');
        }

        // Hapus kegiatan
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success_message', 'Berhasil menghapus kegiatan dan rencana kegiatan terkait.');
    }
}

