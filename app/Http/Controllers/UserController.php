<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showData(Request $request)
    {
        $user = User::find(auth()->id());

        if ($user->hasRole('admin')) {
            // Tampilkan semua data
            $data = [
                'guru' => Guru::all(),
                'kompetensi_keahlian' => Kompetensi::all(),
                'kelas' => Kelas::all(),
            ];
        } elseif ($user->hasRole('kepala_kompetensi_keahlian')) {
            // Tampilkan data sesuai dengan kompetensi keahlian user
            $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->first();
            $data = [
                'guru' => Guru::where('nip', $user->guru_nip)->get(),
                'kompetensi_keahlian' => $kompetensi ? [$kompetensi] : [], // Menggunakan array untuk konsistensi
                'kelas' => Kelas::where('kompetensi_id', $kompetensi->id ?? null)->get(), // Jika tidak ada kompetensi, tidak ada kelas yang ditampilkan
            ];
        } elseif ($user->hasRole('walikelas')) {
            // Tampilkan data sesuai dengan kelas yang diajar oleh guru
            $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
            $data = [
                'guru' => Guru::where('nip', $user->guru_nip)->get(),
                'kompetensi_keahlian' => $kelas ? [Kompetensi::find($kelas->kompetensi_id)] : [], // Menggunakan array untuk konsistensi
                'kelas' => $kelas ? [$kelas] : [], // Menggunakan array untuk konsistensi
            ];
        } else {
            // Tampilkan pesan akses ditolak karena level user tidak valid
            $data = [
                'message' => 'Akses ditolak: Level user tidak valid.'
            ];
        }

        return response()->json($data);
    }
}
