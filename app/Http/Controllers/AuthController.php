<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User di-import

class AuthController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Metode untuk melakukan registrasi
    public function register(Request $request)
    {
        // Validasi data input dari form registrasi
        $request->validate([
            'name' => 'required|string|max:255|unique:users', // Nama harus unik di dalam tabel users
            // 'email' => 'required|string|email|max:255|unique:users', // Email harus unik di dalam tabel users
            'password' => 'required|string|min:8|confirmed', // Konfirmasi password harus sesuai dengan password
        ]);

        // Buat user baru dengan menggunakan model User
        $user = User::create([
            'name' => $request->name,
            // 'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan ke dalam database
        ]);

        // Redirect ke halaman login dengan pesan sukses jika registrasi berhasil
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        $user = User::where('name', $credentials['name'])->first();

        // Verifikasi password
if ($user && Hash::check($credentials['password'], $user->password)) {
    // Login berhasil
    Auth::login($user);
    return redirect()->intended('/dashboard');
}


        return redirect()->route('login')->with('error', 'Invalid login credentials');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }
}
