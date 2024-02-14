<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', [
            'kelas' => $kelas
        ]);
    }

    public function create()
    {
        return view(
            'kelas.create',
            [
                'kompetensi' => Kompetensi::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas',
            'kdkompetensi' => 'required'
        ]);

        $array = $request->only(['kelas', 'kdkompetensi']);
        Kelas::create($array);

        return redirect()->route('kelas.index')->with('success_message', 'Berhasil menambah kelas baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit 
        $kelas = Kelas::find($id);
        if (!$kelas) return redirect()->route('kelas.index')
            ->with('error_message', 'Kelas dengan id = ' . $id . ' 
tidak ditemukan');
        return view('kelas.edit', [
            'kelas' => $kelas,
            'kompetensi' => Kompetensi::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kelas' => 'required|unique:kelas,kelas,' . $id
        ]);
        $kelas = Kelas::find($id);
        $kelas->kelas = $request->kelas;
        $kelas->kdkompetensi = $request->kdkompetensi;
        $kelas->save();
        return redirect()->route('kelas.index')
            ->with('success_message', 'Berhasil mengubah Kelas');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $kelas = Kelas::find($id);

        if ($kelas) $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success_message', 'Berhasil menghapus kelas "' . $kelas->kelas . '" !');
    }
}