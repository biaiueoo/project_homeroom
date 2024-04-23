<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\CatatanKasus;

class KesiswaanController extends Controller
{
    public function siswa(Request $request)
    {
        $siswa = Siswa::query();
        $kompetensiKeahlianOptions = Kompetensi::all();
        $kelasOptions = collect(); // Inisialisasi koleksi kosong untuk opsi kelas

        // Filter berdasarkan kompetensi keahlian
        if ($request->filled('kompetensi_keahlian')) {
            $siswa->where('kdkompetensi', $request->kompetensi_keahlian);
            // Ambil opsi kelas yang hanya berlaku untuk siswa dengan kompetensi keahlian yang dipilih
            $kelasOptions = Kelas::where('kdkompetensi', $request->kompetensi_keahlian)->get();
        } else {
            // Jika filter kompetensi keahlian tidak diaplikasikan, ambil semua kelas
            $kelasOptions = Kelas::all();
        }

        // Filter berdasarkan kelas
        if ($request->filled('kelas')) {
            $siswa->where('kdkelas', $request->kelas);
        }

        // Filter berdasarkan nama lengkap
        if ($request->filled('nama_lengkap')) {
            $siswa->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        // Ambil hasil akhir setelah penerapan semua filter
        $filteredSiswa = $siswa->get();

        return view('kesiswaan.siswa', [
            'siswa' => $filteredSiswa,
            'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
            'kelasOptions' => $kelasOptions,
        ]);
    }

    public function kasus()
    {
        $catatankasus = CatatanKasus::where('status_kasus', 'Penanganan Kesiswaan')->get();
        return view('kesiswaan.kasus', [
            'catatankasus' => $catatankasus
        ]);
    }

    public function selesaikanKasus(Request $request)
    {
        $id = $request->input('id');

        try {
            // Temukan data pembinaan berdasarkan ID
            $kasus = CatatanKasus::findOrFail($id);

            // Ubah status pembinaan menjadi 'Dalam Pembinaan'
            $kasus->status_kasus = 'Kasus Selesai';
            $kasus->save();

            // Kirim respons JSON sukses
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirim respons JSON dengan pesan kesalahan
            return response()->json(['success' => false, 'message' => 'Gagal memulai pembinaan.'], 500);
        }
    }

    public function kasusSelesai()
    {
        $catatankasus = CatatanKasus::where('status_kasus', 'Kasus Selesai')->get();
        return view('kesiswaan.kasus_selesai', [
            'catatankasus' => $catatankasus
        ]);
    }
}
