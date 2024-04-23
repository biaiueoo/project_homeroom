<?php

namespace App\Http\Controllers;

use App\Models\Presentase;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Lookup;
use Illuminate\Http\Request;

class PresentaseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $presentase = null; 
    
        switch ($user->level) {
            case 'admin':
                $presentase = presentase::all();
                break;
    
            case 'kakom':
                $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->first();
                //dd($kompetensi);
                
                $presentase = presentase::where('kdkompetensi', $kompetensi->id)->get();
                //  dd($siswa);
                break;
    
            case 'walikelas':
                $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
                // dd($kelas);
                
                $presentase = presentase::whereHas('fsiswa', function ($query) use ($kelas) {
                    $query->where('kdkelas', $kelas->id)->where('kdkompetensi', $kelas->kdkompetensi);


                })->get();
                
                //dd($siswa);
                break;

    
                case 'operator':
                    $presentase = presentase::all();
                    break;
    
            default:
                return redirect()->route('dashboard')->with('error_message', 'Akses ditolak.');
                break;
        }
    
        return view('presentase.index', ['presentase' => $presentase]);
            
    }


    public function create()
    {
        $pekerjaans = Lookup::where('jenis', 'pekerjaan')->get();

        $user = auth()->user();
        // dd($user);
    
    // Ambil kelas terkait dengan walikelas
    $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
    // dd($kelas);
    // Ambil kompetensi dari kelas walikelas
    $kompetensi = $kelas->kdkompetensi;
        // dd($kompetensi);
    // Ambil semua siswa yang terkait dengan kelas dan kompetensi walikelas
    $siswa = Siswa::where('kdkelas', $kelas->id)
                ->where('kdkompetensi', $kompetensi)
                ->get();
        
        return view('presentase.create', [
            
            'pekerjaan_ortus' => $pekerjaans,
            'siswa' => $siswa
        ]);
    }

    public function store(Request $request)
    {
        // Menyimpan Data data Baru
        $request->validate([
            'kdsiswa' => 'required',
            'pekerjaan_ortu' => 'required',
        ]);

        $array = $request->only([
            'kdsiswa',
            'pekerjaan_ortu',
        ]);

        $tambah = Presentase::create($array);

        if ($tambah) {
            return redirect()->route('presentase.index')
                ->with('success_message', 'Berhasil menambah data baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah data baru');
        }
    }

    public function edit($id)
    {
        
        $pekerjaan = Lookup::where('jenis', 'pekerjaan')->get();
        $presentase = Presentase::with('pekerjaanLookup')->get();

        $presentase = presentase::find($id);
        if (!$presentase) return redirect()->route('presentase.index')
            ->with('error_message', 'presentase dengan id' . $id . ' tidak ditemukan');
        return view('presentase.edit', [
            'pekerjaan_ortu' => $pekerjaan,
            'presentase' => $presentase,
            'dataEdit' => $presentase,
            'siswa' => Siswa::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        //Menyimpan Data presentase
        $request->validate([
            'kdsiswa' => 'required',
            'pekerjaan_ortu' => 'required',
        ]);
        $presentase = Presentase::find($id);
        $presentase->kdsiswa = $request->kdsiswa;
        $presentase->pekerjaan_ortu = $request->pekerjaan_ortu;
        $presentase->save();
        return redirect()->route('presentase.index')
            ->with('success_message', 'Berhasil mengubah data');
    }


    public function destroy(Request $request, $id)
    {
       
       $presentase = Presentase::find($id);
        if ($presentase)$presentase->delete();
        return redirect()->route('presentase.index') ->with('success_message', 'Berhasil menghapus Mata Pelajaran');
    }
}
