<?php

namespace App\Http\Controllers;

use App\Models\Rencanakegiatan;
use Illuminate\Http\Request;

class RencanakegiatanController extends Controller
{
    public function index()
    {
        $rencanakegiatan = Rencanakegiatan::all();
        return view('rencanakegiatan.index', compact('rencanakegiatan'));
    }

    public function update(Request $request, $id)
    {
        $rencanaKegiatan = Rencanakegiatan::findOrFail($id);

        $validatedData = $request->validate([
            'minggu_ke' => 'required|string|regex:/^(\d{1,2},)*\d{1,2}$/',
        ]);

        $rencanaKegiatan->update([
            'minggu_ke' => $validatedData['minggu_ke'],
            // Tambahkan atribut lain yang perlu diperbarui di sini
        ]);

        return response()->json(['message' => 'Perubahan disimpan!'], 200);
    }
    
    public function edit($id)
    {
        $rencanakegiatan = Rencanakegiatan::findOrFail($id);
        return view('rencanakegiatan.edit', compact('rencanakegiatan'));
    }

    public function uploadFile(Request $request)
{
    $request->validate([
        'file_keterangan' => 'required|file|max:10240', // Validasi untuk file
        'rencanakegiatan_id' => 'required|exists:rencana__kegiatan,id'
    ]);

    $file = $request->file('file_keterangan');
    $rencanakegiatanId = $request->input('rencanakegiatan_id');

    // Simpan file yang diunggah ke dalam penyimpanan yang diinginkan (misalnya: storage/app/public)
    $filePath = $file->store('public');

    // Update kolom 'keterangan' pada RencanaKegiatan yang sesuai dengan path file
    $rencanaKegiatan = RencanaKegiatan::find($rencanakegiatanId);
    $rencanaKegiatan->keterangan = $filePath; // Simpan path file di dalam kolom 'keterangan'
    $rencanaKegiatan->save();

    return redirect()->back()->with('success', 'File berhasil diunggah.');
}


    public function destroy($id)
    {
        $rencanakegiatan = Rencanakegiatan::findOrFail($id);
        $rencanakegiatan->delete();

        return redirect()->route('rencanakegiatan.index')
                         ->with('success', 'Data Rencana Kegiatan berhasil dihapus.');
    }
}
