<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Siswa;

class AttendanceController extends Controller
{

    public function create()
{
    $siswa = Siswa::all();
    return view('absensi.create', ['siswa' => $siswa]);
}


    public function store(Request $request)
    {
        // Validasi data yang dikirim dari formulir
        // $request->validate([
        //     'nis' => 'required|exists:siswa,nis',
        //     'tanggal_absensi' => 'required|date',
        //     'status' => 'required|in:hadir,absen,izin',
        // ]);

        // Simpan data absensi ke dalam database
        Attendance::create([
            'nis' => $request->nis,
            'tanggal_absensi' => $request->tanggal_absensi,
            'status' => $request->status,
        ]);

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success_message', 'Absensi siswa berhasil disimpan.');
    }

    public function index()
    {
        $absensi = Attendance::with('siswa')->get();
        return view('absensi.index', ['absensi' => $absensi]);
    }

    public function chart()
{
    // Mengambil jumlah absensi berdasarkan status
    $absensi = DB::table('attendances')
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

    return view('absensi.chart', compact('absensi'));
}
}
