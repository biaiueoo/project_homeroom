<?php

namespace App\Http\Controllers;

use App\Models\Rencanakegiatan;
use Dompdf\Dompdf;
use Dompdf\Options;
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


public function downloadPDF()
{
    try {
        // Ambil data rencana kegiatan
        $rencanaKegiatan = Rencanakegiatan::all();

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Konfigurasi options Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('orientation', 'landscape'); // Set orientasi ke landscape
        $dompdf->setOptions($options);

        // Render view ke PDF
        $html = view('pdf.rencanakegiatan', compact('rencanaKegiatan'))->render();

        // Atur kertas ke ukuran kustom (lebih panjang ke samping)
        $customPaper = array(0, 0, 1300, 700); // Lebih panjang ke samping (800x600 px)
        $dompdf->setPaper($customPaper);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('rencana_kegiatan.pdf');
    } catch (\Exception $e) {
        // Tangani kesalahan yang mungkin terjadi
        return response()->json(['error' => 'Gagal membuat PDF: ' . $e->getMessage()], 500);
    }
}
}


