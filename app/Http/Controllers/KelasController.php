<?php

namespace App\Http\Controllers;

use App\Exports\KelasExport;
use App\Imports\KelasImport;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{

    public function importViewSiswa(Request $request)
    {
        return view('importFile');
    }

    public function import(Request $request)
    {
        Excel::import(new KelasImport, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new KelasExport, 'kelas_template.xlsx');
    }
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
                'kompetensi' => Kompetensi::all(),
                'guru' => Guru::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'kdkompetensi' => 'required',
            'guru_nip' => 'required',
            'tahun_ajaran' => 'required'
        ]);

        $array = $request->only([
            'kelas',
            'kdkompetensi',
            'guru_nip',
            'tahun_ajaran'
        ]);

        Kelas::create($array);

        $cari_id = Kelas::where('id', '>', 0)->max('id');

        // Ambil data kelas berdasarkan ID terbesar
        $kelas = Kelas::where('id', $cari_id)->value('kelas'); // Tambahkan first() di sini
        // dd($kelas);

        // Tampilkan data di view dkelas.create
        return view('dkelas.create', [
            'kelas' => $kelas, // Kirim data kelas ke view
            'siswa' => Siswa::all(),
            'cari_id' => $cari_id
        ]);
    }


    public function edit($id)
    {
        //Menampilkan Form Edit 
        $kelas = Kelas::find($id);
        if (!$kelas) return redirect()->route('kelas.index')
            ->with('error_message', 'Kelas dengan id = ' . $id . ' tidak ditemukan');
        return view('kelas.edit', [
            'kelas' => $kelas,
            'kompetensi' => Kompetensi::all(),
            'guru' => Guru::all()
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
        $kelas->guru_nip = $request->guru_nip;
        $kelas->tahun_ajaran = $request->tahun_ajaran;
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
