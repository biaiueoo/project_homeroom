<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaKegiatan;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\Lookup;
use Illuminate\Support\Facades\Log;

class AgendaKegiatanController extends Controller
{
    public function index()
    {
        $agenda = AgendaKegiatan::all();
        return view('agenda.index', [
            'agenda' => $agenda
        ]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();

        return view(
            'agenda.create',
            [

                'kelas' => Kelas::all(),
                'kompetensi' => Kompetensi::all(),
                'hari' => $hari,
                'semester' => $semester,

            ]
        );
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'kdkelas' => 'required',
                'kdkompetensi' => 'required',
                'tanggal' => 'required',
                'semester' => 'required',
                'keterangan' => 'required',
                'tahun_ajaran' => 'required',
                'nama_kegiatan' => 'required',
                'dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $array = $request->only([
                'kdkelas',
                'kdkompetensi',
                'tanggal',
                'semester',
                'keterangan',
                'tahun_ajaran',
                'nama_kegiatan',
            ]);
    
            if ($request->file('dokumentasi')) {
                $dokumentasiPath = $request->file('dokumentasi')->store('DokumentasiAgenda');
                if (!$dokumentasiPath) {
                    throw new \Exception('Gagal menyimpan dokumentasi.');
                }
                $array['dokumentasi'] = $dokumentasiPath;
            }
    
            AgendaKegiatan::create($array);
    
            return redirect()->route('agenda.index')->with('success_message', 'Berhasil menambah data agenda kegiatan baru');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->withErrors(['error_message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    

}
