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
        $request->validate([
            'kdkasus' => 'required|exists:catatan_kasus,id',
            'tanggal' => 'required',
            'solusi' => 'required',
            'ttd' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Mengunggah file tanda tangan ke direktori penyimpanan yang diinginkan
        $ttdPath = $request->file('ttd')->store('ttd', 'public');

        KunjunganRumah::create([
            'kdkasus' => $request->kdkasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'ttd' => $ttdPath, // Menyimpan path file tanda tangan
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
        // $request->validate([
        //     'kdsiswa' => 'required|exists:siswa,id',
        //     'semester' => 'required',
        //     'tahun_ajaran' => 'required',
        //     'kasus' => 'required',
        //     'keterangan' => 'required',
        //     'tanggal' => 'required',
        //     'tindak_lanjut' => 'required',
        //     'status_kasus' => 'required',
        //     'dampingan_bk' => 'required',
        // ]);

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
