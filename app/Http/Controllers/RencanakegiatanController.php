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
        'file_keterangan' => 'required|file|max:10240', // Sesuaikan validasi dengan kebutuhan
        'rencanakegiatan_id' => 'required|exists:rencana__kegiatan,id',
    ]);

    $rencanaKegiatan = RencanaKegiatan::find($request->rencanakegiatan_id);

    if (!$rencanaKegiatan) {
        return response()->json(['error' => 'Rencana kegiatan tidak ditemukan.'], 404);
    }

    // Simpan file ke storage
    $file = $request->file('file_keterangan');
    $filePath = $file->store('public/keterangan');

    // Update kolom 'keterangan' dengan nama file
    $rencanaKegiatan->keterangan = $filePath;
    $rencanaKegiatan->save();

    return response()->json(['keterangan' => asset('storage/' . $filePath)], 200);
}


    public function destroy($id)
    {
        $rencanakegiatan = Rencanakegiatan::findOrFail($id);
        $rencanakegiatan->delete();

        return redirect()->route('rencanakegiatan.index')
                         ->with('success', 'Data Rencana Kegiatan berhasil dihapus.');
    }
}
