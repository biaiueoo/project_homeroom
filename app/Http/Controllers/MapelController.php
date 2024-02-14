<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {

        $mapel = Mapel::all();
        return view('mapel.index', [
            'mapel' => $mapel
        ]);
    }

    public function create()
    {
        return view('mapel.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'mata_pelajaran' => 'required|unique:mata_pelajaran,mata_pelajaran'
        ]);
        $array = $request->only([
            'mata_pelajaran'
        ]);
        $mapel = Mapel::create($array);
        return redirect()->route('mapel.index')->with('success_message', 'Berhasil menambah mata pelajaran baru');
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
        if ($mapel)$mapel->delete();
        return redirect()->route('mapel.index') ->with('success_message', 'Berhasil menghapus Mata Pelajaran');
    }
}
