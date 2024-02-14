<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaKegiatan;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\Lookup;

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
            // Menyimpan Data bukutamu Baru
            $request->validate([
                'kdkelas' => 'required',
                'kdkompetensi' => 'required',
                'tanggal' => 'required',
                'semester' => 'required',
                'keterangan' => 'required',
                'tahun_ajaran' => 'required',
                'hasil' => 'image|file|max:2048',
            ]);
    
            $array = $request->only([
                'kdkelas',
                'kdkompetensi',
                'tanggal',
                'semester',
                'keterangan',
                'tahun_ajaran',
                'hasil',
               
            ]);
    
            $array['hasil'] = $request->file('hasil')->store('Foto agenda');
    
            $tambah = AgendaKegiatan::create($array);
    
            if ($tambah) {
                $request->file('hasil')->store('Foto agenda');
                return redirect()->route('agenda.index')
                    ->with('success_message', 'Berhasil menambah agenda baru');
            } else {
                throw new \Exception('Gagal menambah agenda baru.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah agenda baru. Error: ' . $e->getMessage())
                ->withInput(); // Retain the input data on redirect
        }
    }
    
}

