<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
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
        //Menghapus Bidang Studi 
        $kegiatan = kegiatan::find($id);

        if ($kegiatan) $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success_message', 'Berhasil menghapus kegiatan "' . $kegiatan->nama . '" !');
    }
}

