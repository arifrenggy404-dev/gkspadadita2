<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Memproses autentikasi
    // Ubah nama method ini
public function login(Request $request) 
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->has('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password yang kamu masukkan salah.',
    ])->onlyInput('email');
}
public function logout(Request $request)
    {
        Auth::logout(); // Melakukan proses logout user

        $request->session()->invalidate(); // Menghapus sesi
        $request->session()->regenerateToken(); // Regenerasi token keamanan

        return redirect('/'); // Arahkan kembali ke halaman utama atau login
    }
}
