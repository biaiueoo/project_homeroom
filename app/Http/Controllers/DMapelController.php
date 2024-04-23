<?php

namespace App\Http\Controllers;

use App\Models\DMapel;
use App\Models\Kompetensi;
use App\Models\Mapel;
use Illuminate\Http\Request;

class DMapelController extends Controller
{
    public function index()
    {
        $dmapel = DMapel::all();
        return view('dmapel.index', [
            'dmapel' => $dmapel
        ]);
    }

    public function detail($id)
    {
        $dmapel = DMapel::where('kdmapel', $id)->get();
        $idmapel = DMapel::where('kdmapel', $id)->value('kdmapel');
        $kdkomp = Mapel::where('id', $idmapel)->value('kdkompetensi');
        $kompetensi = Kompetensi::where('id', $kdkomp)->value('kompetensi_keahlian');
        return view('dmapel.index', [
            'dmapel' => $dmapel,
            'kompetensi' => $kompetensi
        ]);
    }

    public function create()
    {
        return view(
            'dmapel.create',
            [
                'kompetensi' => Kompetensi::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdmapel' => 'required',
            'mapel' => 'required',
        ]);
        $array = $request->only([
            'kdmapel',
            'mapel',
        ]);
        DMapel::create($array);
        $kompetensi = $request['kompetensi_keahlian'];
        $kdkomp = $request['kdkompetensi'];
        // dd($kdkomp);
        return view(
            'dmapel.create',
            [
                'kompetensi' => $kompetensi,
                'cari_id' => $request['kdmapel'],
                'kdkomp' => $kdkomp
            ]
        );
        // return redirect()->route('dkelas.index')->with('success_message', 'Berhasil menambah data detail kelas');
    }
}
