<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgendaKegiatan;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\Lookup;
use Dompdf\Dompdf;
use Dompdf\Options;
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

        $request->validate([
            'kdkelas' => 'required',
            'kdkompetensi' => 'required',
            'tanggal' => 'required',
            'hari' => 'required',
            'semester' => 'required',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'waktu' => 'required',
            'nama_kegiatan' => 'required',
            'dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $array = $request->only([
            'kdkelas',
            'kdkompetensi',
            'tanggal',
            'waktu',
            'semester',
            'keterangan',
            'tahun_ajaran',
            'nama_kegiatan',
            'hari',

        ]);

        if ($request->hasFile('dokumentasi')) {
            $array['dokumentasi'] = $request->file('dokumentasi')->store('Dokumentasi Agenda Kegiatan');
        }

        $tambah = AgendaKegiatan::create($array);

        if ($tambah) {
            return redirect()->route('agenda.index')
                ->with('success_message', 'Berhasil menambah Agenda Kegiatan baru');
        } else {
            return redirect()->back()
                ->with('error_message', 'Gagal menambah Agenda Kegiatan baru');
        }
    }

    public function edit($id)
    {

        $semester = Lookup::where('jenis', 'semester')->get();
        $hari = Lookup::where('jenis', 'hari')->get();

        //Menampilkan Form Edit
        $agenda = AgendaKegiatan::find($id);
        if (!$agenda) return redirect()->route('agenda.index')
            ->with('error_message', 'Agenda Kegiatan dengan id' . $id . ' tidak ditemukan');
        return view('agenda.edit', [
            'semester' => $semester,
            'agenda' => $agenda,
            'dataEdit' => $agenda,
            'hari' => $hari,
            'kelas' => Kelas::all(),
            'kompetensi' => Kompetensi::all(),

        ]);
    }

    public function update(Request $request, $id)
    {
        //Menyimpan Data agenda
        $request->validate([
            'kdkelas' => 'required',
            'kdkompetensi' => 'required',
            'tanggal' => 'required',
            'hari' => 'required',
            'semester' => 'required',
            'keterangan' => 'required',
            'tahun_ajaran' => 'required',
            'waktu' => 'required',
            'nama_kegiatan' => 'required',



        ]);
        $agenda = AgendaKegiatan::find($id);
        $agenda->kdkelas = $request->kdkelas;
        $agenda->kdkompetensi = $request->kdkompetensi;
        $agenda->tanggal = $request->tanggal;
        $agenda->keterangan = $request->keterangan;
        $agenda->semester = $request->semester;
        $agenda->nama_kegiatan = $request->nama_kegiatan;
        $agenda->hari = $request->hari;
        $agenda->waktu = $request->waktu;
        $agenda->tahun_ajaran = $request->tahun_ajaran;
        $agenda->save();
        return redirect()->route('agenda.index')
            ->with('success_message', 'Berhasil mengubah Agenda Kegiatan');
    }

    public function destroy(Request $request, $id)
    {
        $agenda = AgendaKegiatan::find($id);
        if ($agenda) {
            $hapus = $agenda->delete();
            if ($hapus) unlink("storage/" . $agenda->dokumetasi);
        }
        return redirect()->route('agenda.index')
            ->with('success_message', 'Berhasil menghapus Agenda Kegiatan');
    }

    public function downloadPDF()
    {
        // Ambil data yang diperlukan untuk PDF
        $agenda = AgendaKegiatan::all(); // Atur ini sesuai dengan cara Anda mendapatkan data siswa

        // Buat objek Dompdf
        $dompdf = new Dompdf();

        // Render view ke PDF
        $html = view('pdf.agenda', compact('agenda'))->render();
        $dompdf->loadHtml($html);

        // (Opsional) Konfigurasi PDF sesuai kebutuhan Anda
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf->setOptions($options);

        // Render PDF
        $dompdf->render();

        // Kembalikan respons dengan PDF untuk diunduh
        return $dompdf->stream('agenda_walas.pdf');
    }
}
