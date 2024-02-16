<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import
use App\Models\User; // Pastikan model User di-import

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        $user = User::where('name', $credentials['name'])->first();

        // Verifikasi password
        if ($user && $user->password === $credentials['password']) {
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
