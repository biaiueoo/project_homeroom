<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $struktur = Struktur::all();
        return view('struktur.index', [
            'struktur' => $struktur
        ]);
    }

    public function create()
    {
        return view(
            'struktur.create',
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        $array = $request->only(['nama', 'jabatan']);
        Struktur::create($array);

        return redirect()->route('struktur.index')->with('success_message', 'Berhasil menambah struktur baru');
    }


    
    public function edit($id)
    {
        //Menampilkan Form Edit 
        $struktur = struktur::find($id);
        if (!$struktur) return redirect()->route('struktur.index')
            ->with('error_message', 'struktur dengan id = ' . $id . ' 
tidak ditemukan');
        return view('struktur.edit', [
            'struktur' => $struktur,
           
        ]);
    }

    public function update(Request $request, $id)
    {
        //Mengedit Data struktur 
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required'

        ]);
        $struktur = struktur::find($id);
        $struktur->nama = $request->nama;
        $struktur->jabatan = $request->jabatan;
        $struktur->save();
        return redirect()->route('struktur.index')
            ->with('success_message', 'Berhasil mengubah struktur');
    }

    public function destroy(Request $request, $id)
    
    {
        // Temukan struktur berdasarkan ID
        $struktur = Struktur::find($id);

        if (!$struktur) {
            return redirect()->route('struktur.index')->with('error_message', 'struktur tidak ditemukan.');
        }

        // Hapus struktur
        $struktur->delete();

        return redirect()->route('struktur.index')->with('success_message', 'Berhasil menghapus struktur dan rencana struktur terkait.');
    }

}
