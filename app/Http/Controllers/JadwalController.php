<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Lookup;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Kompetensi;
use App\Models\DMapel;
use App\Models\Mapel;
use Dompdf\Dompdf;
use Dompdf\Options;


class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // dd($user);
        $jadwal = null;

        switch ($user->level) {
            case 'admin':
                // Jika admin, ambil semua agenda kegiatan
                $jadwal = Jadwal::all();
                break;

            case 'kakom':
                // Jika kakom, ambil kompetensi keahlian yang terkait dengan guru yang sedang login
                $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->first();
                if (!$kompetensi) {
                    return redirect()->route('dashboard')->with('error_message', 'Anda tidak memiliki kompetensi terkait.');
                }

                // Ambil agenda kegiatan berdasarkan kompetensi keahlian
                $jadwal = Jadwal::where('kdkompetensi', $kompetensi->id)->get();
                break;

            case 'walikelas':
                // Jika walikelas, ambil kelas yang terkait dengan guru yang sedang login
                $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
                $idkelas = Kelas::where('guru_nip', $user->guru_nip)->value('kdkompetensi');

                // Ambil semua id mapel yang terkait dengan kompetensi
                $mapelIds = Mapel::where('kdkompetensi', $idkelas)->pluck('id');

                // Ambil DMapel yang memiliki kdmapel yang sesuai dengan mapelIds
                $dmapel = DMapel::whereIn('kdmapel', $mapelIds)->get();

                // Ambil agenda kegiatan berdasarkan kelas dan kompetensi keahlian walikelas
                $jadwal = Jadwal::where('kdkelas', $kelas->id)
                    ->whereHas('fkompetensi', function ($query) use ($kelas) {
                        $query->where('id', $kelas->kdkompetensi);
                    })
                    ->get();
                break;

            default:
                return redirect()->route('dashboard')->with('error_message', 'Akses ditolak.');
                break;
        }

        return view('jadwal.index', ['jadwal' => $jadwal, 'dmapel' => $dmapel]);
    }

    public function create()
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();
        $user = auth()->user();
        $kelas = null;
        $kompetensi = null;

        switch ($user->level) {
            case 'admin':
                // Jika admin, ambil semua kelas dan kompetensi keahlian
                $kelas = Kelas::all();
                $kompetensi = Kompetensi::all();
                break;

            case 'kakom':
                // Jika kakom, ambil kompetensi keahlian yang terkait dengan guru yang sedang login
                $kompetensi = Kompetensi::where('guru_nip', $user->guru_nip)->get();
                if (!$kompetensi->isEmpty()) {
                    $kelas = Kelas::where('kdkompetensi', $kompetensi->first()->id)->get();
                } else {
                    return redirect()->route('dashboard')->with('error_message', 'Anda tidak memiliki kompetensi terkait.');
                }
                break;

            case 'walikelas':
                $kelas = Kelas::where('guru_nip', $user->guru_nip)->get();
                $idkelas = Kelas::where('guru_nip', $user->guru_nip)->value('kdkompetensi');

                // Ambil semua id mapel yang terkait dengan kompetensi
                $mapelIds = Mapel::where('kdkompetensi', $idkelas)->pluck('id');

                // Ambil DMapel yang memiliki kdmapel yang sesuai dengan mapelIds
                $dmapel = DMapel::whereIn('kdmapel', $mapelIds)->get();

                // dd($dmapel);
                if ($kelas->isNotEmpty()) {
                    $kompetensi = Kompetensi::where('id', $kelas->first()->kdkompetensi)->get();
                } else {
                    return redirect()->route('dashboard')->with('error_message', 'Anda tidak memiliki kelas terkait.');
                }
                break;

            default:
                return redirect()->route('dashboard')->with('error_message', 'Akses ditolak.');
                break;
        }
        return view(
            'jadwal.create',
            [
                'guru' => Guru::all(),
                'kelas' => $kelas,
                'kompetensi' => $kompetensi,
                'mapel' => Mapel::all(),
                'dmapel' => $dmapel,
                'hari' => $hari,
                'semester' => $semester,

            ]
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'kdguru' => 'required',
            'kdkelas' => 'required',
            'kdkompetensi' => 'required',
            'kdmapel' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'jam' => 'required',
            'hari' => 'required',
        ]);

        $array = $request->only(['kdguru', 'kdkelas', 'kdkompetensi', 'kdmapel', 'tahun_ajaran', 'semester', 'jam', 'hari']);
        Jadwal::create($array);

        return redirect()->route('jadwal.index')->with('success_message', 'Berhasil menambah data Jadwal baru');
    }



    public function edit($id)
    {
        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();
        //Menampilkan Form Edit 
        $jadwal = Jadwal::find($id);
        if (!$jadwal) return redirect()->route('jadwal.index')
            ->with('error_message', 'Jadwal dengan id = ' . $id . ' 
        tidak ditemukan');
        return view('jadwal.edit', [
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all(),
            'mapel' => Mapel::all(),
            'jadwal' => $jadwal,
            'dataEdit' => $jadwal,
            'hari' => $hari,
            'semester' => $semester

        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data Kelas 
        $request->validate([
            'kdguru' => 'required:walas,kdguru' . $id
        ]);
        $jadwal = Jadwal::find($id);
        $jadwal->kdguru = $request->kdguru;
        $jadwal->kdmapel = $request->kdmapel;
        $jadwal->tahun_ajaran = $request->tahun_ajaran;
        $jadwal->semester = $request->semester;
        $jadwal->jam = $request->jam;
        $jadwal->hari = $request->hari;
        $jadwal->save();
        return redirect()->route('jadwal.index')
            ->with('success_message', 'Berhasil mengubah Jadwal KBM');
    }

    public function destroy(Request $request, $id)
    {
        //Menghapus Bidang Studi 
        $jadwal = Jadwal::find($id);

        if ($jadwal) $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success_message', 'Berhasil menghapus Jadwal KBM "' . $jadwal->fkelas->kelas . '" !');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $jadwal = Jadwal::all(); // Atur ini sesuai dengan cara Anda mendapatkan data jadwal

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.jadwal', compact('jadwal'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('jadwal_KBM.pdf');
    }
}
