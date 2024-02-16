<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        // Ambil data pengguna berdasarkan name
        $user = User::where('name', $credentials['name'])->first();

        // Verifikasi password
        if ($user && $user->password == $credentials['password']) {
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
