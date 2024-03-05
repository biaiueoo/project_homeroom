<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;
use App\Models\Daftarrapot;
use App\Models\Lookup;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\facades\Storage;





class DaftarrapotController extends Controller
{
    public function index()
    {
        $daftarrapot = Daftarrapot::all();
        return view('daftarrapot.index', [
            'daftarrapot' => $daftarrapot
        ]);
    
  
    }
    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $rapor = Lookup::where('jenis', 'rapor')->get();
        
        //Menampilkan Form tambah daftarrapot
        return view('daftarrapot.create', [
            'siswa' => Siswa::all(),
            'semester' => $semester,
            'rapor' => $rapor

        ]);
    }
    
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'rapor' => 'required',
            'dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('dokumentasi')) {
            $array['dokumentasi'] = $request->file('dokumentasi')->store('Daftar rapor');
        }
    
       
    
        $tambah = Daftarrapot::create($array);
    
        if ($tambah) {
            return redirect()->route('daftarrapot.index')
                ->with('success_message', 'Berhasil menambah Daftar rapor baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah daftarrapot baru');
        }
    }
    

public function edit($id)
    {

        //Menampilkan Form Edit
        $semester = Lookup::where('jenis', 'semester')->get();
        $rapor = Lookup::where('jenis', 'rapor')->get();

        $daftarrapot = daftarrapot::find($id);
        if (!$daftarrapot) return redirect()->route('daftarrapot.index')
            ->with('error_message', 'daftarrapot dengan id' . $id . ' tidak ditemukan');
        return view('daftarrapot.edit', [
            'daftarrapot' => $daftarrapot,
            'dataEdit' => $daftarrapot,
            'semester' => $semester,
            'rapor' => $rapor,
            'siswa' => Siswa::all()
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'rapor' => 'required'
         ]);
    
        // Get the existing record
        $daftarrapot = Daftarrapot::find($id);
        $daftarrapot->kdsiswa = $request->kdsiswa;
        $daftarrapot->tanggal = $request->tanggal;
        $daftarrapot->rapor = $request->semester;
        $daftarrapot->tahun_ajaran = $request->tahun_ajaran;
        $daftarrapot->save();
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil mengubah daftar rapot');
    }

    public function destroy(Request $request, $id)
    {
        $daftarrapot = Daftarrapot::find($id);
        if ($daftarrapot) {
            $hapus = $daftarrapot->delete();
            if ($hapus) unlink("storage/" . $daftarrapot->dokumentasi);
        }
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menghapus daftar rapot');
    }


   
    
    
}
