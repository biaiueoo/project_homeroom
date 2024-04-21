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
            $pembinaan = PembinaanBK::findOrFail($id);
            $pembinaan->status = 'Dalam Pembinaan';
            $pembinaan->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengubah status kasus.'], 500);
        }
    }
}
