<?php

namespace App\Http\Controllers;

use App\Models\daftarrapot;
use App\Models\Kelas;
use App\Models\Kompetensi;
use App\Models\Siswa;
use App\Models\Lookup;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;

class DaftarrapotController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $daftarrapot = null; 
    
        switch ($user->level) {
            case 'admin':
                $daftarrapot = daftarrapot::all();
                break;
    
            case 'kakom':
                $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->first();
                //dd($kompetensi);
                
                $daftarrapot = daftarrapot::where('kdkompetensi', $kompetensi->id)->get();
                //  dd($siswa);
                break;
    
            case 'walikelas':
                $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
                // dd($kelas);
                
                $daftarrapot = daftarrapot::whereHas('fsiswa', function ($query) use ($kelas) {
                    $query->where('kdkelas', $kelas->id)->where('kdkompetensi', $kelas->kdkompetensi);


                })->get();
                   
                //dd($siswa);
                break;

    
                case 'operator':
                    $daftarrapot = daftarrapot::all();
                    break;
    
            default:
                return redirect()->route('dashboard')->with('error_message', 'Akses ditolak.');
                break;
        }
    
        return view('daftarrapot.index', ['daftarrapot' => $daftarrapot]);
            
    }
    public function show($id)
{
    $dr = DaftarRapot::find($id); // Misalnya, mengambil data DaftarRapot berdasarkan ID
    return view('daftarrapot.index', compact('dr'));
}



    // public function create()
    // {
    //     $semesters = Lookup::where('jenis', 'semester')->get();
    //     $rapor = Lookup::where('jenis', 'rapor')->get();


    //     return view('daftarrapot.create', [
    //         'semesters' => $semesters,
    //         'rapor' => $rapor,
    //         'siswa' => Siswa::all()
    //     ]);
    // }

    public function create()
{
    $semesters = Lookup::where('jenis', 'semester')->get();
    $rapor = Lookup::where('jenis', 'rapor')->get();

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
    return view('daftarrapot.create', [
        'siswa' => $siswa,
        'semesters' => $semesters, // Pastikan variabel $semesters sudah didefinisikan
        'rapor' => $rapor // Pastikan variabel $rapor sudah didefinisikan
    ]);
}


    public function prosesPenyerahan(Request $request)
    {
        $document = daftarrapot::findOrFail($request->id);

        // Lakukan logika untuk penyerahan dokumen
        $document->update(['rapor' => 'Selesai']);

        return response()->json(['success' => true]);
    }



    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'kdsiswa' => 'required',
        'tanggal' => 'required',
        'semester' => 'required',
        'tahun_ajaran' => 'required',
        'Dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Menyiapkan data untuk disimpan
    $data = $request->only([
        'kdsiswa',
        'tanggal',
        'semester',
        'tahun_ajaran',
    ]);

    // Menetapkan nilai default "pengambilan" untuk field 'rapor'
    $data['rapor'] = $request->input('rapor', 'pengambilan');

    // Jika terdapat file yang diunggah, simpan file ke direktori dan tambahkan ke data
    if ($request->hasFile('Dokumentasi')) {
        $data['Dokumentasi'] = $request->file('Dokumentasi')->store('Dokumentasi Daftar Rapot');
    }

    // Simpan data ke database
    $daftarrapot = DaftarRapot::create($data);

    if ($daftarrapot) {
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menambah Daftar Rapot baru');
    } else {
        return redirect()->back()
            ->with('error_message', 'Gagal menambah Daftar Rapot baru');
    }
}


    public function edit($id)
    {

        $semester = Lookup::where('jenis', 'semester')->get();
        $rapor = Lookup::where('jenis', 'rapor')->get();


        //Menampilkan Form Edit
        $daftarrapot = daftarrapot::find($id);
        if (!$daftarrapot) return redirect()->route('daftarrapot.index')
            ->with('error_message', 'daftarrapot dengan id' . $id . ' tidak ditemukan');
        return view('daftarrapot.edit', [
            'semester' => $semester,
            'rapor' => $rapor,
            'daftarrapot' => $daftarrapot,
            'dataEdit' => $daftarrapot,
            'siswa' => Siswa::all()

        ]);
    }




    public function update(Request $request, $id)
    {
        //Menyimpan Data agenda
        $request->validate([
            'kdsiswa' => '',
            'tanggal' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'rapor' => 'required',



        ]);
        $daftarrapot = Daftarrapot::find($id);
        // $daftarrapot->kdsiswa = $request->kdsiswa;
        $daftarrapot->tanggal = $request->tanggal;
        $daftarrapot->semester = $request->semester;
        $daftarrapot->rapor = $request->rapor;
        $daftarrapot->tahun_ajaran = $request->tahun_ajaran;
        $daftarrapot->save();
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil mengubah Agenda Kegiatan');
    }




    public function destroy(Request $request, $id)
    {
        $daftarrapot = daftarrapot::find($id);
        if ($daftarrapot) {
            $hapus = $daftarrapot->delete();
            if ($hapus) unlink("storage/" . $daftarrapot->Dokumentasi);
        }
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menghapus daftarrapot');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $daftarrapot = daftarrapot::all(); // Atur ini sesuai dengan cara Anda mendapatkan data siswa

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.daftarrapot', compact('daftarrapot'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('daftar_rapot.pdf');
    }
}
