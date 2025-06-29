<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses login user
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Log saat user berhasil login
            Log::info('User Login', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'time' => now()->toDateTimeString(),
            ]);

            // Arahkan ke halaman utama setelah login
            return redirect()->intended('/home')->with('success', 'Login berhasil');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Menampilkan halaman register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses registrasi user
    public function register(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log saat user melakukan registrasi
        Log::info('User Registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'time' => now()->toDateTimeString(),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }

    // Logout user
    public function logout(Request $request) {
        // Log sebelum user logout
        Log::info('User Logout', [
            'user_id' => Auth::id(),
            'email' => Auth::user()->email,
            'time' => now()->toDateTimeString(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}
