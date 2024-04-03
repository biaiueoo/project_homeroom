<?php

namespace App\Http\Controllers;

use App\Models\Presentase;
use App\Models\Siswa;
use App\Models\Lookup;
use Illuminate\Http\Request;

class PresentaseController extends Controller
{
    public function index()
    {
        $presentase = Presentase::all();
        return view('presentase.index', [
            'presentase' => $presentase
        ]);
    }


    public function create()
    {
        $pekerjaans = Lookup::where('jenis', 'pekerjaan')->get();
        $presentase = Presentase::with('pekerjaanLookup')->get();

        return view('presentase.create', [
            'presentase' => $presentase,
            'pekerjaan_ortus' => $pekerjaans,
            'siswa' => Siswa::all()
        ]);
    }
    public function store(Request $request)
    {
        // Menyimpan Data data Baru
        $request->validate([
            'kdsiswa' => 'required',
            'pekerjaan_ortu' => 'required',
        ]);

        $array = $request->only([
            'kdsiswa',
            'pekerjaan_ortu',
        ]);

        $tambah = Presentase::create($array);

        if ($tambah) {
            return redirect()->route('presentase.index')
                ->with('success_message', 'Berhasil menambah data baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah data baru');
        }
    }

    public function edit($id)
    {
        
        $pekerjaan = Lookup::where('jenis', 'pekerjaan')->get();
        $presentase = Presentase::with('pekerjaanLookup')->get();

        $presentase = presentase::find($id);
        if (!$presentase) return redirect()->route('presentase.index')
            ->with('error_message', 'presentase dengan id' . $id . ' tidak ditemukan');
        return view('presentase.edit', [
            'pekerjaan_ortu' => $pekerjaan,
            'presentase' => $presentase,
            'dataEdit' => $presentase,
            'siswa' => Siswa::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        //Menyimpan Data presentase
        $request->validate([
            'kdsiswa' => 'required',
            'pekerjaan_ortu' => 'required',
        ]);
        $presentase = Presentase::find($id);
        $presentase->kdsiswa = $request->kdsiswa;
        $presentase->pekerjaan_ortu = $request->pekerjaan_ortu;
        $presentase->save();
        return redirect()->route('presentase.index')
            ->with('success_message', 'Berhasil mengubah data');
    }


    public function destroy(Request $request, $id)
    {
       
       $presentase = Presentase::find($id);
        if ($presentase)$presentase->delete();
        return redirect()->route('presentase.index') ->with('success_message', 'Berhasil menghapus Mata Pelajaran');
    }
}
