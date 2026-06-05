<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan halaman lupa password.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Menghasilkan token reset password dan mengirimkan ke email pengguna.
     */
    public function sendResetToken(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Buat token reset password
        $token = strtoupper(Str::random(6)); // Token 6 karakter huruf besar

        // Simpan token di database dengan timestamp
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => Carbon::now()]
        );

        // Kirim token ke email pengguna
        Mail::raw("Gunakan token berikut untuk reset password Anda: $token (Berlaku 10 menit)", function ($message) use ($request) {
            $message->to($request->email)->subject('Token Reset Password Anda');
        });

        return redirect()->route('password.reset.form')->with('success', 'Token reset telah dikirim ke email Anda.');
    }

    /**
     * Menampilkan halaman reset password.
     */
    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    /**
     * Memproses reset password dengan validasi token 10 menit.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $reset = DB::table('password_resets')->where('email', $request->email)->first();

        // Cek apakah token ada di database
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Cek apakah token masih berlaku (maksimal 10 menit)
        if (Carbon::parse($reset->created_at)->addMinutes(10)->isPast()) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['error' => 'Token sudah kadaluarsa, silakan buat permintaan ulang.']);
        }

        // Update password pengguna
        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Hapus token setelah digunakan
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password berhasil diubah, silakan login.');
    }
}
