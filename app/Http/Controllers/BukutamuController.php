<?php

namespace App\Http\Controllers;

use App\Models\Bukutamu;
use App\Models\Siswa;
use App\Models\Lookup;

use Illuminate\Http\Request;

class BukutamuController extends Controller
{
    public function index()
    {
        $bukutamu = Bukutamu::all();
        return view('bukutamu.index', [
            'bukutamu' => $bukutamu
        ]);
    }


    public function create()
    {
        $semesters = Lookup::where('jenis', 'semester')->get();
        $bukutamu = Bukutamu::with('semesterLookup')->get();

        return view('bukutamu.create', [
            'bukutamu' => $bukutamu,
            'semesters' => $semesters,
            'siswa' => Siswa::all()
        ]);
    }
    public function store(Request $request)
    {
        // Menyimpan Data bukutamu Baru
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'semester' => 'required',
            'keperluan' => 'required',
            'tahun_ajaran' => 'required',
            'hasil' => 'image|file|max:2048',
            'ttd' => 'image|file|max:2048',


        ]);
        $array = $request->only([
            'kdsiswa',
            'tanggal',
            'semester',
            'keperluan',
            'tahun_ajaran',
            'hasil',
            'ttd',

        ]);
        $array['hasil'] = $request->file('hasil')->store('Foto bukutamu');
        $array['ttd'] = $request->file('ttd')->store('Foto bukutamu');

        $tambah = Bukutamu::create($array);
        if ($tambah) $request->file('hasil')->store('Foto bukutamu');
        if ($tambah) $request->file('ttd')->store('Foto bukutamu');
        return redirect()->route('bukutamu.index')
            ->with('success_message', 'Berhasil menambah bukutamu baru');
    }

    public function edit($id)
    {
    
        $semester = Lookup::where('jenis', 'semester')->get();
        $bukutamu = Bukutamu::with('semesterLookup')->get();

        //Menampilkan Form Edit
        $bukutamu = bukutamu::find($id);
        if (!$bukutamu) return redirect()->route('bukutamu.index')
            ->with('error_message', 'bukutamu dengan id' . $id . ' tidak ditemukan');
        return view('bukutamu.edit', [
            'semester' => $semester,
            'bukutamu' => $bukutamu,
            'dataEdit' => $bukutamu,
            'siswa' => Siswa::all()
            
        ]);
    }

    public function update(Request $request, $id)
    {
        //Menyimpan Data bukutamu
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required|date',
            'keperluan' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'hasil' => 'nullable|image|file|max:2048',
            'ttd' => 'nullable|image|file|max:2048',
            
        ]);
        $bukutamu = Bukutamu::find($id);
        $bukutamu->kdsiswa = $request->kdsiswa;
        $bukutamu->tanggal = $request->tanggal;
        $bukutamu->keperluan = $request->keperluan;
        $bukutamu->semester = $request->semester;
        $bukutamu->tahun_ajaran = $request->tahun_ajaran;
        if ($request->file('hasil')) {
            $bukutamu['hasil'] = $request->file('hasil')->store('Foto Wisata');
        }
        if ($request->file('ttd')) {
            $bukutamu['ttd'] = $request->file('ttd')->store('Foto Wisata');
        }
      
        $bukutamu->save();
        return redirect()->route('bukutamu.index')
            ->with('success_message', 'Berhasil mengubah bukutamu');
    }


    public function destroy(Request $request, $id)
    {
        $bukutamu = Bukutamu::find($id);
        if ($bukutamu) {
            $hapus = $bukutamu->delete();
            if ($hapus) unlink("storage/" . $bukutamu->hasil);
        }
        return redirect()->route('bukutamu.index')
            ->with('success_message', 'Berhasil menghapus Bukutamu');
    }


}