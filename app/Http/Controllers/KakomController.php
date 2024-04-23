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
        $kompetensiId = $request->kompetensi_keahlian;
        $siswa->where('kdkompetensi', $kompetensiId);

        // Ambil opsi kelas yang hanya berlaku untuk siswa dengan kompetensi keahlian yang dipilih
        $kelasOptions = Kelas::where('kdkompetensi', $kompetensiId)->get();
    } else {
        // Jika filter kompetensi keahlian tidak diaplikasikan, ambil semua kelas
        $kelasOptions = Kelas::all();
    }

    // Filter berdasarkan kelas jika kelasOptions tidak kosong
    if (!$kelasOptions->isEmpty() && $request->filled('kelas')) {
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


public function kasus(Request $request)
{
    $query = CatatanKasus::query();
    $kompetensiKeahlianOptions = Kompetensi::all();
    $kelasOptions = collect(); // Inisialisasi koleksi kosong untuk opsi kelas

    // Filter berdasarkan kompetensi keahlian
    if ($request->filled('kompetensi_keahlian')) {
        $kompetensiId = $request->kompetensi_keahlian;
        $query->whereHas('fsiswa', function ($siswa) use ($kompetensiId) {
            $siswa->where('kdkompetensi', $kompetensiId);
        });

        // Ambil opsi kelas yang hanya berlaku untuk catatan kasus dengan kompetensi keahlian yang dipilih
        $kelasOptions = Kelas::whereHas('siswa', function ($siswa) use ($kompetensiId) {
            $siswa->where('kdkompetensi', $kompetensiId);
        })->get();
    } else {
        // Jika filter kompetensi keahlian tidak diaplikasikan, ambil semua kelas
        $kelasOptions = Kelas::all();
    }

    // Filter berdasarkan kelas jika kelasOptions tidak kosong
    if (!$kelasOptions->isEmpty() && $request->filled('kelas')) {
        $query->whereHas('fsiswa', function ($siswa) use ($request) {
            $siswa->where('kdkelas', $request->kelas);
        });
    }

    // Filter berdasarkan nama lengkap
    if ($request->filled('nama_lengkap')) {
        $query->whereHas('fsiswa', function ($siswa) use ($request) {
            $siswa->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        });
    }

    // Ambil hasil akhir setelah penerapan semua filter
    $filteredCatatanKasus = $query->get();

    return view('kakom.kasus', [
        'catatankasus' => $filteredCatatanKasus,
        'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
        'kelasOptions' => $kelasOptions,
    ]);
}


    public function homevisit(Request $request)
    {
    $kunjunganrumah = kunjunganrumah::query();
    $kompetensiKeahlianOptions = Kompetensi::all();
    $kelasOptions = collect(); // Inisialisasi koleksi kosong untuk opsi kelas

    // Filter berdasarkan kompetensi keahlian
    if ($request->filled('kompetensi_keahlian')) {
        $kompetensiId = $request->kompetensi_keahlian;
        $kunjunganrumah->where('kdkompetensi', $kompetensiId);

        // Ambil opsi kelas yang hanya berlaku untuk kunjunganrumah dengan kompetensi keahlian yang dipilih
        $kelasOptions = Kelas::where('kdkompetensi', $kompetensiId)->get();
    } else {
        // Jika filter kompetensi keahlian tidak diaplikasikan, ambil semua kelas
        $kelasOptions = Kelas::all();
    }

    // Filter berdasarkan kelas jika kelasOptions tidak kosong
    if (!$kelasOptions->isEmpty() && $request->filled('kelas')) {
        $kunjunganrumah->where('kdkelas', $request->kelas);
    }

    // Filter berdasarkan nama lengkap
    if ($request->filled('nama_lengkap')) {
        $kunjunganrumah->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
    }

    // Ambil hasil akhir setelah penerapan semua filter
    $filteredkunjunganrumah = $kunjunganrumah->get();

    return view('kakom.homevisit', [
        'kunjunganrumah' => $filteredkunjunganrumah,
        'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
        'kelasOptions' => $kelasOptions,
    ]);
    }
}