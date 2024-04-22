<?php

namespace App\Http\Controllers;

use App\Models\PembinaanBK;
use Illuminate\Http\Request;

class PembinaanBkController extends Controller
{
    public function index()
    {
        $laporanKasusBK = PembinaanBK::where('status', 'Kasus Baru')->get();

        return view('pembinaanbk.index', [
            'laporanKasusBK' => $laporanKasusBK
        ]);
    }


    public function pembinaan()
    {
        $laporanKasusBK = PembinaanBK::where('status', 'Dalam Pembinaan')->get();
        return view('pembinaanbk.pembinaan', [
            'laporanKasusBK' => $laporanKasusBK
        ]);
    }

    public function kasusSelesai()
    {
        $laporanKasusBK = PembinaanBK::where('status', 'Kasus Selesai')->get();
        return view('pembinaanbk.selesai', [
            'laporanKasusBK' => $laporanKasusBK
        ]);
    }

    public function mulaiPembinaan(Request $request)
    {
        $id = $request->input('id');

        try {
            // Temukan data pembinaan berdasarkan ID
            $pembinaan = PembinaanBK::findOrFail($id);

            // Ubah status pembinaan menjadi 'Dalam Pembinaan'
            $pembinaan->status = 'Dalam Pembinaan';
            $pembinaan->save();

            // Kirim respons JSON sukses
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirim respons JSON dengan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Gagal memulai pembinaan.'], 500);
        }
  
    }
} 