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
            'surat' => 'required|file|mimes:pdf|max:2048',
            'dokumentasi' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'kdkasus' => 'required',
            'tanggal' => 'required',
            'solusi' => 'required',
        ]);

        // Pengolahan file
        $suratFile = $request->file('surat');
        $suratFileName = time() . '_' . $suratFile->getClientOriginalName();
        $suratFile->move(public_path('uploads'), $suratFileName);

        $dokumentasiFile = $request->file('dokumentasi');
        $dokumentasiFileName = time() . '_' . $dokumentasiFile->getClientOriginalName();
        $dokumentasiFile->move(public_path('uploads'), $dokumentasiFileName);

        // Simpan data ke dalam tabel 'KunjunganRumah'
        KunjunganRumah::create([
            'kdkasus' => $request->kdkasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
            'surat' => $suratFileName,
            'dokumentasi' => $dokumentasiFileName,
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
        // Validasi
        $request->validate([
            'surat' => 'nullable|file|mimes:pdf|max:2048',
            'dokumentasi' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'kdkasus' => 'required',
            'tanggal' => 'required',
            'solusi' => 'required',
        ]);

        // Ambil data kunjungan rumah berdasarkan ID
        $kunjunganrumah = KunjunganRumah::findOrFail($id);

        // Update data kunjungan rumah
        $kunjunganrumah->update([
            'kdkasus' => $request->kdkasus,
            'tanggal' => $request->tanggal,
            'solusi' => $request->solusi,
        ]);

        // Proses upload dan update file surat
        if ($request->hasFile('surat')) {
            $suratFile = $request->file('surat');
            $suratFileName = time() . '_' . $suratFile->getClientOriginalName();
            $suratFile->move(public_path('uploads'), $suratFileName);

            // Hapus file surat lama jika ada
            if ($kunjunganrumah->surat && file_exists(public_path('uploads/' . $kunjunganrumah->surat))) {
                unlink(public_path('uploads/' . $kunjunganrumah->surat));
            }

            // Update nama file surat baru
            $kunjunganrumah->surat = $suratFileName;
        }

        // Proses upload dan update file dokumentasi
        if ($request->hasFile('dokumentasi')) {
            $dokumentasiFile = $request->file('dokumentasi');
            $dokumentasiFileName = time() . '_' . $dokumentasiFile->getClientOriginalName();
            $dokumentasiFile->move(public_path('uploads'), $dokumentasiFileName);

            // Hapus file dokumentasi lama jika ada
            if ($kunjunganrumah->dokumentasi && file_exists(public_path('uploads/' . $kunjunganrumah->dokumentasi))) {
                unlink(public_path('uploads/' . $kunjunganrumah->dokumentasi));
            }

            // Update nama file dokumentasi baru
            $kunjunganrumah->dokumentasi = $dokumentasiFileName;
        }

        // Simpan perubahan pada kunjungan rumah
        $kunjunganrumah->save();

        return redirect()->route('kunjunganrumah.index')->with('success_message', 'Berhasil memperbarui catatan kunjungan rumah');
    }




    public function destroy(Request $request, $id)
    {

        $kunjunganrumah = KunjunganRumah::find($id);
        if ($kunjunganrumah) $kunjunganrumah->delete();
        return redirect()->route('kunjunganrumah.index')->with('success_message', 'Berhasil menghapus Catatan Kunjungan Rumah "' . $kunjunganrumah->id . '" !');
    }
}
