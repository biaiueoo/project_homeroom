<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\CatatanKasus;
use App\Models\Lookup;
use App\Models\Siswa;
use Illuminate\Http\Request;

class CatatanKasusController extends Controller
{
    public function index()
    {
        $catatankasus = CatatanKasus::all();
        return view('catatankasus.index', [
            'catatankasus' => $catatankasus
        ]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        return view(
            'catatankasus.create',
            [
                'siswa' => Siswa::all(),
                'semester' => $semester,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'kasus' => 'required',
            'tindak_lanjut' => 'required',
            'status_kasus' => 'required',
            'dampingan_bk' => 'required',
            'semester' => 'required',
        ]);

        $user = Auth::user();

        CatatanKasus::create([
            'id_siswa' => $request->id_siswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'tindak_lanjut' => $request->tindak_lanjut,
            'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk,
            'semester' => $request->semester,
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menambah catatan kasus');
    }

    public function edit($id)
    {
        $catatankasus = CatatanKasus::findOrFail($id);
        $siswa = Siswa::all();

        return view('catatankasus.edit', compact('catatankasus', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'kasus' => 'required',
            'tindak_lanjut' => 'required',
            'status_kasus' => 'required',
            'dampingan_bk' => 'required',
        ]);

        $user = Auth::user();
        $catatankasus = CatatanKasus::findOrFail($id);
        $catatankasus->update([
            'kdsiswa' => $request->id_siswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'tindak_lanjut' => $request->tindak_lanjut,
            'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil mengupdate catatan kasus');
    }
}
