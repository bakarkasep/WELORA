<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin() {
        return view('login');
    }

    // 2. Tampilkan Halaman Register
    public function showRegister() {
        return view('register');
    }

    // 3. Proses Register
    public function processRegister(Request $request) {
        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 4. Proses Login (YANG DIPERBAIKI)
    public function processLogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek database: Apakah username DAN password cocok?
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home'); // Sukses
        }

        // Jika salah, kembalikan ke login dengan error
        return back()->withErrors([
            'login_error' => 'Username atau Password salah!',
        ])->onlyInput('username');
    }

    // 5. Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}