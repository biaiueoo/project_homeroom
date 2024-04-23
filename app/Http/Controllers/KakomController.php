<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\CatatanKasus;
use App\Models\KunjunganRumah;

class KakomController extends Controller
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

        return view('kakom.siswa', [
            'siswa' => $filteredSiswa,
            'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
            'kelasOptions' => $kelasOptions,
        ]);
    }

    public function kasus()
    {
        $catatankasus = CatatanKasus::all();
        return view('kakom.kasus', [
            'catatankasus' => $catatankasus
        ]);
    }

    public function homevisit()
    {
        $kunjunganrumah = KunjunganRumah::all();
        return view('kakom.homevisit', [
            'kunjunganrumah' => $kunjunganrumah
        ]);
    }
}
