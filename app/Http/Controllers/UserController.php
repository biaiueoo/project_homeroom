<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kompetensi;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showData(Request $request)
    {
        $user = User::find(auth()->id());

        if ($user->hasRole('admin')) {
            // Tampilkan semua data
            $data = [
                'guru' => Guru::all(),
                'users_keahlian' => Kompetensi::all(),
                'kelas' => Kelas::all(),
            ];
        } elseif ($user->hasRole('kepala_kompetensi_keahlian')) {
            // Tampilkan data sesuai dengan kompetensi keahlian user
            $user = Kompetensi::where('guru_nip', $user->guru_nip)->first();
            $data = [
                'guru' => Guru::where('nip', $user->guru_nip)->get(),
                'users_keahlian' => $user ? [$user] : [], // Menggunakan array untuk konsistensi
                'kelas' => Kelas::where('users_id', $user->id ?? null)->get(), // Jika tidak ada kompetensi, tidak ada kelas yang ditampilkan
            ];
        } elseif ($user->hasRole('walikelas')) {
            // Tampilkan data sesuai dengan kelas yang diajar oleh guru
            $kelas = Kelas::where('guru_nip', $user->guru_nip)->first();
            $data = [
                'guru' => Guru::where('nip', $user->guru_nip)->get(),
                'users_keahlian' => $kelas ? [user::find($kelas->users_id)] : [], // Menggunakan array untuk konsistensi
                'kelas' => $kelas ? [$kelas] : [], // Menggunakan array untuk konsistensi
            ];
        } else {
            // Tampilkan pesan akses ditolak karena level user tidak valid
            $data = [
                'message' => 'Akses ditolak: Level user tidak valid.'
            ];
        }

        return response()->json($data);
    }

    public function index()
    {
        $kelas = User::all();
        return view('users.index', [
            'users' => $kelas
        ]);
    }

    public function create()
    {
        return view('users.create', [
            'guru' => Guru::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'guru_nip' => 'required',


        ]);

        $array = $request->only([
            'name',
            'email',
            'password',
            'level',
            'guru_nip',


        ]);

        User::create($array);
        return redirect()->route('users.index')->with('success_message', 'Berhasil menambahUser baru');
    }


    public function edit(string $id)
    {

        $user = User::find($id);
        if (!$user) return redirect()->route('users.index')
            ->with('error_message', 'users Keahlian dengan id = ' . $id . ' tidak ditemukan');
        return view('users.edit', [
            'user' => $user,
            'guru' => Guru::all()
        ]);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'guru_nip' => 'required',

        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->guru_nip = $request->guru_nip;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = $request->level;


        $user->save();
        return redirect()->route('users.index')->with('success_message', 'Berhasil mengubah Kompetensi Keahlian');
    }


    public function destroy(Request $request, $id)
    {

        $user =User::find($id);
        if ($user) $user->delete();
        return redirect()->route('users.index')->with('success_message', 'Berhasil menghapus User');
    }



}
