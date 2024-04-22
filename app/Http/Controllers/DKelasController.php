<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DKelas;
use App\Models\Kelas;
use App\Models\Siswa;


class DKelasController extends Controller
{
    public function index()
    {
        $dkelas = DKelas::all();
        return view('dkelas.index', [
            'dkelas' => $dkelas
        ]);
    }

    public function detail($id)
    {
        $dkelas = DKelas::where('kdkelas', $id)->get();
        $kelas = Kelas::where('id', $id)->value('kelas');
        return view('dkelas.index', [
            'dkelas' => $dkelas,
            'kelas' => $kelas
        ]);
    }

    public function create()
    {
        return view(
            'dkelas.create',
            [
                'kelas' => Kelas::all(),
                'siswa' => Siswa::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdkelas' => 'required',
            'nis' => 'required',
        ]);
        $array = $request->only([
            'kdkelas',
            'nis',
        ]);
        DKelas::create($array);
        $kelas = $request['kelas'];
        // dd($kelas);
        return view(
            'dkelas.create',
            [
                'kelas' => $kelas,
                'siswa' => Siswa::all(),
                'cari_id' => $request['kdkelas']
            ]
        );
        // return redirect()->route('dkelas.index')->with('success_message', 'Berhasil menambah data detail kelas');
    }
}
