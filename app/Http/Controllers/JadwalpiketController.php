<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwalpiket;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Lookup;
use App\Models\Siswa;
use Dompdf\Dompdf;
use Dompdf\Options;


class jadwalpiketController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $jadwalpiket = null; 
    
        switch ($user->level) {
            case 'admin':
                $jadwalpiket = jadwalpiket::all();
                break;
    
            case 'kakom':
                $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->first();
                //dd($kompetensi);
                
                $jadwalpiket = jadwalpiket::where('kdkompetensi', $kompetensi->id)->get();
                //  dd($siswa);
                break;
    
            case 'walikelas':
                $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
                // dd($kelas);
                
                $jadwalpiket = jadwalpiket::whereHas('fsiswa', function ($query) use ($kelas) {
                    $query->where('kdkelas', $kelas->id)->where('kdkompetensi', $kelas->kdkompetensi);


                })->get();
                   
                //dd($siswa);
                break;

    
                case 'operator':
                    $jadwalpiket = jadwalpiket::all();
                    break;
    
            default:
                return redirect()->route('dashboard')->with('error_message', 'Akses ditolak.');
                break;
        }
    
        return view('jadwalpiket.index', ['jadwalpiket' => $jadwalpiket]);
            
    }
        public function create()
    {
        $semesters = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();

        $user = auth()->user();
        
        // Ambil kelas terkait dengan walikelas
        $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();

        // Pastikan kelas ditemukan dan memiliki kompetensi terkait
        if (!$kelas) {
            return redirect()->route('dashboard')->with('error_message', 'Anda tidak memiliki kelas terkait.');
        }

        // Ambil kompetensi dari kelas walikelas
        $kompetensiId = $kelas->kdkompetensi;

        // Ambil semua siswa yang terkait dengan kelas dan kompetensi walikelas
        $siswa = Siswa::where('kdkelas', $kelas->id)
                    ->where('kdkompetensi', $kompetensiId)
                    ->get();

        // Kemudian lemparkan data ke view
        return view('jadwalpiket.create', [
            'siswa' => $siswa,
            'semesters' => $semesters, // Pastikan variabel $semesters sudah didefinisikan
            'hari' => $hari // Pastikan variabel $rapor sudah didefinisikan
        ]);
}


    public function store(Request $request)
    {
        $request->validate([
            'kdsiswa' => 'required',
            'tanggal' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'hari' => 'required',
        ]);

        $array = $request->only(['kdsiswa', 'tahun_ajaran', 'semester', 'tanggal', 'hari']);
        jadwalpiket::create($array);

        return redirect()->route('jadwalpiket.index')->with('success_message', 'Berhasil menambah data jadwal Piket baru');
    }

    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();
        //Menampilkan Form Edit 
        $jadwalpiket = jadwalpiket::find($id);
        if (!$jadwalpiket) return redirect()->route('jadwalpiket.index')
            ->with('error_message', 'jadwal Piket dengan id = ' . $id . ' 
        tidak ditemukan');
        return view('jadwalpiket.edit', [
            'siswa' => Siswa::all(),
          
            'jadwalpiket' => $jadwalpiket,
            'dataEdit' => $jadwalpiket,
             'hari' => $hari,
            'semester' => $semester

        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kdsiswa' => 'required:jadwal_piket,kdsiswa' . $id
        ]);
        $jadwal = jadwalpiket::find($id);
        $jadwal->kdsiswa = $request->kdsiswa;
        $jadwal->tahun_ajaran = $request->tahun_ajaran;
        $jadwal->semester = $request->semester;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->hari = $request->hari;
        $jadwal->save();
        return redirect()->route('jadwalpiket.index')
            ->with('success_message', 'Berhasil mengubah jadwal KBM');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $jadwalpiket = jadwalpiket::find($id);

        if ($jadwalpiket) $jadwalpiket->delete();

        return redirect()->route('jadwalpiket.index')
            ->with('success_message', 'Berhasil menghapus jadwal Piket "' . $jadwalpiket->fsiswa->nama_lengkap . '" !');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $jadwalpiket = JadwalPiket::all(); // Atur ini sesuai dengan cara Anda mendapatkan data jadwal piket

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.jadwalpiket', compact('jadwalpiket'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('jadwal_piket.pdf');
    }

}
