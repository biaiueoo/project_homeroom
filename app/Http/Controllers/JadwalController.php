<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Lookup;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Kompetensi;
use App\Models\Mapel;


class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('jadwal.index', [
            'jadwal' => $jadwal
        ]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();

        return view(
            'jadwal.create',
            [
                'guru' => Guru::all(),
                'kelas' => Kelas::all(),
                'kompetensi' => Kompetensi::all(),
                'mapel' => Mapel::all(),
                'hari' => $hari,
                'semester' => $semester,

            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kdguru' => 'required',
            'kdkelas' => 'required',
            'kdkompetensi' => 'required',
            'kdmapel' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'jam' => 'required',
            'hari' => 'required',
        ]);

        $array = $request->only(['kdguru', 'kdkelas', 'kdkompetensi','kdmapel','tahun_ajaran', 'semester', 'jam', 'hari']);
        Jadwal::create($array);

        return redirect()->route('jadwal.index')->with('success_message', 'Berhasil menambah data Jadwal baru');
    }

    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();
        //Menampilkan Form Edit 
        $jadwal = Jadwal::find($id);
        if (!$jadwal) return redirect()->route('jadwal.index')
            ->with('error_message', 'Jadwal dengan id = ' . $id . ' 
        tidak ditemukan');
        return view('jadwal.edit', [
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all(),
            'mapel' => Mapel::all(),
            'jadwal' => $jadwal,
            'dataEdit' => $jadwal,
             'hari' => $hari,
            'semester' => $semester

        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kdguru' => 'required:walas,kdguru' . $id
        ]);
        $jadwal = Jadwal::find($id);
        $jadwal->kdguru = $request->kdguru;
        $jadwal->kdkelas = $request->kdkelas;
        $jadwal->kdkompetensi = $request->kdkompetensi;
        $jadwal->kdmapel = $request->kdmapel;
        $jadwal->tahun_ajaran = $request->tahun_ajaran;
        $jadwal->semester = $request->semester;
        $jadwal->jam = $request->jam;
        $jadwal->hari = $request->hari;
        $jadwal->save();
        return redirect()->route('jadwal.index')
            ->with('success_message', 'Berhasil mengubah Jadwal KBM');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $jadwal = Jadwal::find($id);

        if ($jadwal) $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success_message', 'Berhasil menghapus Jadwal KBM "' . $jadwal->fkelas->kelas . '" !');
    }
}
