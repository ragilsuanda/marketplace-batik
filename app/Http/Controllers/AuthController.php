<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman registrasi.
     */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits_between:10,15|unique:users,phone', // Validasi nomor handphone
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role user
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }


    /**
     * Proses login pengguna.
     */
    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika admin, arahkan ke dashboard
            if ($user->role === 'admin') {
                return redirect('/dashboard')->with('success', 'Login berhasil sebagai Admin!');
            }

            // Jika user biasa, arahkan ke home
            return redirect('/home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['loginError' => 'Email atau password salah.']);
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
