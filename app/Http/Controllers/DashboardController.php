<?php

namespace App\Http\Controllers;

use App\Models\PembinaanBK;
use App\Models\Presentase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data presentase sosial
        $dataPresentase = Presentase::select('pekerjaan_ortu')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('pekerjaan_ortu')
            ->get();

        // Ambil data status kasus dari tabel penangananbk
        $dataStatusKasus = PembinaanBK::select('status')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('status')
            ->get();

        return view('dashboard.home', [
            'dataPresentase' => $dataPresentase,
            'dataStatusKasus' => $dataStatusKasus
        ]);
    }
}
