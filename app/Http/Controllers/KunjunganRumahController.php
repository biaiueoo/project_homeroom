<?php

namespace App\Http\Controllers;

use App\Models\KunjunganRumah;
use App\Models\CatatanKasus;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KunjunganRumahController extends Controller
{
    public function index()
    {
        $kunjunganrumah = KunjunganRumah::all();
        return view('kunjunganrumah.index', [
            'kunjunganrumah' => $kunjunganrumah
        ]);
    }

    public function create()
    {
        return view(
            'kunjunganrumah.create',
            [
                'kasus' => CatatanKasus::all()
            ]
        );
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'surat' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'dokumentasi' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'kdkasus' => 'required',
            'tanggal' => 'required',
            'solusi' => 'required',
        ]);

        // Pengolahan file
        $suratFile = $request->file('surat');
        $suratContents = file_get_contents($suratFile->getRealPath());

        $dokumentasiFile = $request->file('dokumentasi');
        $dokumentasiContents = file_get_contents($dokumentasiFile->getRealPath());

        // Simpan data ke dalam tabel 'KunjunganRumah'
        KunjunganRumah::create([
            'kdkasus' => $request->kdkasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'surat' => $suratContents,
            'dokumentasi' => $dokumentasiContents,
        ]);

        return redirect()->route('kunjunganrumah.index')->with('success_message', 'Berhasil menambah catatan kasus');
    }


    public function edit($id)
    {
        $kunjunganrumah = KunjunganRumah::find($id);
        if (!$kunjunganrumah) return redirect()->route('kunjunganrumah.index')
            ->with('error_message', 'Catatan Kunjungan Rumah dengan id = ' . $id . ' tidak ditemukan');
        return view('kunjunganrumah.edit', [
            'kunjunganrumah' => $kunjunganrumah,
            'kasus' => CatatanKasus::all()
        ]);
    }

    public function update(Request $request, $id)
    {

        $kunjunganrumah = KunjunganRumah::findOrFail($id);
        $kunjunganrumah->update([
            'kdkasus' => $request->kdkasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'kasus' => $request->kasus,
        ]);

        return redirect()->route('kunjunganrumah.index')->with('success_message', 'Berhasil mengupdate Catatan Kunjungan Rumah');
    }

    public function destroy(Request $request, $id)
    {

        $kunjunganrumah = KunjunganRumah::find($id);
        if ($kunjunganrumah) $kunjunganrumah->delete();
        return redirect()->route('kunjunganrumah.index')->with('success_message', 'Berhasil menghapus Catatan Kunjungan Rumah "' . $kunjunganrumah->id . '" !');
    }
}
