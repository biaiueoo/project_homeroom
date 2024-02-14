<?php

namespace App\Http\Controllers;

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
        //Menampilkan Form tambah daftarrapot
        return view('daftarrapot.create', [
            'siswa' => Siswa::all(),
            'semester' => $semester
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
            'keterangan' => 'required',
            'bukti_ttd' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,heic|max:2048',
        ]);
    
        // Save the file to storage
        $file_path = $request->file('bukti_ttd')->store('Foto daftarrapot');
    
        // Get the original file name
        $original_file_name = $request->file('bukti_ttd')->getClientOriginalName();
    
        // Save data to the database
        $tambah = Daftarrapot::create([
            'kdsiswa' => $request->input('kdsiswa'),
            'tanggal' => $request->input('tanggal'),
            'semester' => $request->input('semester'),
            'tahun_ajaran' => $request->input('tahun_ajaran'),
            'keterangan' => $request->input('keterangan'),
            'bukti_ttd' => $file_path,
            'original_file_name' => $original_file_name,
        ]);
    
        // Redirect with success message
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menambah daftarrapot baru');
    }
    




public function edit($id)
    {

        //Menampilkan Form Edit
        $semester = Lookup::where('jenis', 'semester')->get();

        $daftarrapot = daftarrapot::find($id);
        if (!$daftarrapot) return redirect()->route('daftarrapots.index')
            ->with('error_message', 'daftarrapot dengan id' . $id . ' tidak ditemukan');
        return view('daftarrapot.edit', [
            'daftarrapot' => $daftarrapot,
            'dataEdit' => $daftarrapot,
            'semester' => $semester,
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
            'keterangan' => 'required',
            'bukti_ttd' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,heic|max:2048',
        ]);
    
        // Get the existing record
        $daftarrapot = Daftarrapot::findOrFail($id);
    
        // Handle file update
        if ($request->hasFile('bukti_ttd')) {
            // Delete the existing file
            Storage::delete($daftarrapot->bukti_ttd);
    
            // Save the new file to storage
            $file_path = $request->file('bukti_ttd')->store('Foto daftarrapot');
    
            // Get the original file name
            $original_file_name = $request->file('bukti_ttd')->getClientOriginalName();
    
            // Update the record with the new file information
            $daftarrapot->update([
                'kdsiswa' => $request->input('kdsiswa'),
                'tanggal' => $request->input('tanggal'),
                'semester' => $request->input('semester'),
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'keterangan' => $request->input('keterangan'),
                'bukti_ttd' => $file_path,
                'original_file_name' => $original_file_name,
            ]);
        } else {
            // Update the record without changing the file
            $daftarrapot->update([
                'kdsiswa' => $request->input('kdsiswa'),
                'tanggal' => $request->input('tanggal'),
                'semester' => $request->input('semester'),
                'tahun_ajaran' => $request->input('tahun_ajaran'),
                'keterangan' => $request->input('keterangan'),
            ]);
        }
    
        // Redirect with success message
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil memperbarui daftarrapot');
    }
    
    

      
       



    
    public function destroy(Request $request, $id)
    {
        //Menghapus 
        $daftarrapot = daftarrapot::find($id);
        if ($daftarrapot) {
            $hapus = $daftarrapot->delete();
            if ($hapus) unlink("storage/" . $daftarrapot->bukti_ttd);
           
        }
        return redirect()->route('daftarrapot.index')
            ->with('success_message', 'Berhasil menghapus Paket daftarrapot');
    }

   
    
    
}
