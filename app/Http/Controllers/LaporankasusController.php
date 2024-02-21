<?php

namespace App\Http\Controllers;

use App\Models\CatatanKasus;
use App\Models\Siswa;
use App\Models\Lookup;

use Illuminate\Http\Request;

class LaporankasusController extends Controller
{
    public function index()
    {
        $catatankasus = CatatanKasus::all();
        return view('laporankasus.index', [
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
            'kdsiswa' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'kasus' => 'required',
            'keterangan' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'tanggal' => 'required',
            'tidak_lanjut' => 'required',
            'status_kasus' => 'required',
            'dampingan_bk' => 'required',
            // 'user_bk' => 'required',

        ]);

        $keteranganFile = $request->file('keterangan');
        $keteranganContents = file_get_contents($keteranganFile->getRealPath());

        CatatanKasus::create([
            'kdsiswa' => $request->kdsiswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'keterangan' => $keteranganContents,
            'tanggal' => $request->tanggal,
            'tidak_lanjut' => $request->tidak_lanjut,
            'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk,
            // 'user_bk' => $request->user_bk,
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menambah catatan kasus baru');
    }


    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         'kdsiswa' => 'required',
    //         'keterangan' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
    //     ]);

    //     $file = $request->file('keterangan');

    //     // Menyimpan file ke dalam folder storage/app/public
    //     $filePath = $file->store('uploads');

    //     // Mengambil nama file dari path yang disimpan di storage
    //     $fileName = basename($filePath);

    //     return back()->with('success_message', 'File Keterangan berhasil diupload')->with('file_name', $fileName);
    // }




    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $catatankasus = CatatanKasus::find($id);
        if (!$catatankasus) return redirect()->route('catatankasus.index')
            ->with('error_message', 'Catatan Kasus dengan id = ' . $id . ' tidak ditemukan');
        return view('catatankasus.edit', [
            'catatankasus' => $catatankasus,
            'siswa' => Siswa::all(),
            'semester' => $semester
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

        $catatankasus = CatatanKasus::findOrFail($id);
        $catatankasus->update([
            'kdsiswa' => $request->kdsiswa,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kasus' => $request->kasus,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            // 'tidak_lanjut' => $request->tidak_lanjut,
            // 'status_kasus' => $request->status_kasus,
            'dampingan_bk' => $request->dampingan_bk,
        ]);

        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil mengupdate catatan kasus');
    }

    public function destroy(Request $request, $id)
    {

        $catatankasus = CatatanKasus::find($id);
        if ($catatankasus) $catatankasus->delete();
        return redirect()->route('catatankasus.index')->with('success_message', 'Berhasil menghapus Catatan Kasus');
    }
}
