<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            // Mengambil user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            // SKENARIO KRITIS: Konflik Email
            if (!$user) {
                // Cek apakah email sudah terdaftar via login biasa (manual)
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Update user yang ada dengan google_id (Account Linking)
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                } else {
                    // Buat user baru jika benar-benar belum ada
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => null, // Password null karena login via Google
                        'role' => 'user',   // Default role sesuai enum di migrasi Anda
                        'email_verified_at' => now(), // Auto-verify karena Google sudah memverifikasi
                    ]);
                }
            }

            Auth::login($user);

            $intended = Auth::user() && (Auth::user()->role ?? 'user') === 'admin'
                ? route('admin.dashboard')
                : '/';

            return redirect()->intended($intended);
        } catch (\Exception $e) {
            // Log error untuk debugging
            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }
    }
}
