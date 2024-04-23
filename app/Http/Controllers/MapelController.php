<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {

        $mapel = Mapel::all();
        return view('mapel.index', [
            'mapel' => $mapel,
            'kompetensi' => Kompetensi::all(),
        ]);
    }

    public function create()
    {
        return view('mapel.create', [
            'kompetensi' => Kompetensi::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdkompetensi' => 'nullable'
        ]);

        $array = $request->only([
            'kdkompetensi'
        ]);

        Mapel::create($array);

        $cari_id = Mapel::where('id', '>', 0)->max('id');
        $kdkomp = Mapel::where('id', $cari_id)->value('kdkompetensi');
        $kompetensi = Kompetensi::where('id', $kdkomp)->value('kompetensi_keahlian');

        return view('dmapel.create', [
            'kompetensi' => $kompetensi,
            'cari_id' => $cari_id,
            'kdkomp' => $kdkomp
        ]);
    }


    public function edit($id)
    {

        $mapel = Mapel::find($id);
        if (!$mapel) return redirect()->route('mapel.index')
            ->with('error_message', 'Mata Pelajaran dengan id = ' . $id . ' tidak ditemukan');
        return view('mapel.edit', [
            'mapel' => $mapel
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'mata_pelajaran' =>
            'required|unique:mata_pelajaran,mata_pelajaran,' . $id
        ]);
        $mapel = Mapel::find($id);
        $mapel->mata_pelajaran = $request->mata_pelajaran;
        $mapel->save();
        return redirect()->route('mapel.index')->with('success_message', 'Berhasil mengubah Mata Pelajaran');
    }


    public function destroy(Request $request, $id)
    {

        $mapel = Mapel::find($id);
        if ($mapel) $mapel->delete();
        return redirect()->route('mapel.index')->with('success_message', 'Berhasil menghapus Mata Pelajaran');
    }
}
