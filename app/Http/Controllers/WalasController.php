<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Walas;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kompetensi;

class WalasController extends Controller
{
    public function index()
    {
        $walas = Walas::all();
        return view('walas.index', [
            'walas' => $walas
        ]);
    }

    public function create()
    {
        return view(
            'walas.create',
            [
                'guru' => Guru::all(),
                'kelas' => Kelas::all(),
                'kompetensi' => Kompetensi::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdguru' => 'required',
            'kdkelas' => 'required',
            'kdkompetensi' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $array = $request->only(['kdguru', 'kdkelas', 'kdkompetensi', 'tahun_ajaran']);
        Walas::create($array);

        return redirect()->route('walas.index')->with('success_message', 'Berhasil menambah data Wali Kelas baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit 
        $walas = Walas::find($id);
        if (!$walas) return redirect()->route('walas.index')
            ->with('error_message', 'Walas dengan id = ' . $id . ' 
        tidak ditemukan');
        return view('walas.edit', [
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all(),
            'walas' => $walas
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kdguru' => 'required:walas,kdguru' . $id
        ]);
        $walas = Walas::find($id);
        $walas->kdguru = $request->kdguru;
        $walas->kdkelas = $request->kdkelas;
        $walas->kdkompetensi = $request->kdkompetensi;
        $walas->tahun_ajaran = $request->tahun_ajaran;
        $walas->save();
        return redirect()->route('walas.index')
            ->with('success_message', 'Berhasil mengubah data Wali Kelas');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $walas = Walas::find($id);

        if ($walas) $walas->delete();

        return redirect()->route('walas.index')
            ->with('success_message', 'Berhasil menghapus Walas kelas "' . $walas->fkelas->kelas . '" !');
    }
}
