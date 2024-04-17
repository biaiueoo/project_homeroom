<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;

class SiswakesController extends Controller
{
    // ///
    // public function index(Request $request)
    // {
    //     $siswa = Siswa::query();
    //     $kompetensiKeahlianOptions = Kompetensi::all();

    //     if ($request->has('kompetensi_keahlian') && $request->kompetensi_keahlian !== '') {
    //         $siswa->where('kdkompetensi', $request->kompetensi_keahlian);
    //     } else {
    //         $siswa->where('kdkompetensi', '');
    //     }

    //     $filteredSiswa = $siswa->get();

    //     return view('siswakes.index', [
    //         'siswa' => $filteredSiswa,
    //         'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
    //     ]);
    // }

    public function index(Request $request)
    {
        $siswa = Siswa::query();
        $kompetensiKeahlianOptions = Kompetensi::all();
        $kelasOptions = collect(); // Inisialisasi koleksi kosong untuk opsi kelas

        // Jika filter kompetensi keahlian telah diaplikasikan
        if ($request->filled('kompetensi_keahlian')) {
            // Ambil siswa yang memiliki kompetensi keahlian yang dipilih
            $siswa->where('kdkompetensi', $request->kompetensi_keahlian);

            // Ambil opsi kelas yang hanya berlaku untuk siswa dengan kompetensi keahlian yang dipilih
            $kelasOptions = Kelas::where('kdkompetensi', $request->kompetensi_keahlian)->get();
        } else {
            // Jika filter kompetensi keahlian tidak diaplikasikan, ambil semua kelas
            $kelasOptions = Kelas::all();
        }

        // Jika filter kelas juga telah diaplikasikan
        if ($request->filled('kelas')) {
            // Filter siswa berdasarkan kelas yang dipilih
            $siswa->where('kdkelas', $request->kelas);
        }

        $filteredSiswa = $siswa->get();

        return view('siswakes.index', [
            'siswa' => $filteredSiswa,
            'kompetensiKeahlianOptions' => $kompetensiKeahlianOptions,
            'kelasOptions' => $kelasOptions, // Mengirim opsi kelas ke tampilan
        ]);
    }





    public function store(Request $request)
    {
        $request->validate([

            'nis' => 'required|unique:siswa,nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $array = $request->only([
            'nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);
        $siswa = Siswa::create($array);

        // Associate the student with the class and competency
        $siswa->fkelas()->associate($request->input('kdkelas'));
        $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswakes.index')->with('success_message', 'Berhasil menambah siswa baru');
    }

    public function edit($id)
    {
        //Menampilkan Form Edit 
        $siswa = Siswa::find($id);
        if (!$siswa) return redirect()->route('siswakes.index')
            ->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        return view('siswakes.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->route('siswakes.index')->with('error_message', 'Siswa dengan id = ' . $id . ' tidak ditemukan');
        }

        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $id,
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $array = $request->only([
            'nis',
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'agama',
            'kewarganegaraan',
            'no_hp',
            'email',
            'nisn',
            'kdkelas',
            'kdkompetensi',
            'tahun_masuk',
            'nama_ayah',
            'nama_ibu',
            'alamat_ortu',
            'no_ortu',
            'nama_sekolah_asal',
            'alamat_sekolah',
            'tahun_lulus',
            'riwayat_penyakit',
            'alergi',
            'prestasi_akademik',
            'prestasi_non_akademik',
            'ekstrakurikuler',
            'biografi'
        ]);

        $siswa->update($array);

        $siswa->fkelas()->associate($request->input('kdkelas'));
        $siswa->fkompetensi()->associate($request->input('kdkompetensi'));

        $siswa->save();

        return redirect()->route('siswakes.index')->with('success_message', 'Data siswa berhasil diperbarui');
    }

    public function destroy(Request $request, $id)
    {

        $siswa = siswa::find($id);
        if ($siswa) $siswa->delete();
        return redirect()->route('siswakes.index')->with('success_message', 'Berhasil menghapus siswa');
    }
}
