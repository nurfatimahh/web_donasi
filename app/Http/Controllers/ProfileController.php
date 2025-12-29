<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk menghapus foto lama

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     * View yang dicari adalah resources/views/profile/index.blade.php
     */
    public function index()
    {
        // Perhatikan, PANGGILAN SUDAH BENAR: 'profile.index'
        return view('admin.profile.index'); 
    }

    /**
     * Memperbarui data profil pengguna (nama, email, dan foto).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Tambahkan validasi unique kecuali ID sendiri
            'photo' => 'nullable|image|max:2048', // Maksimum 2MB
        ]);

        // Tangani upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            
            // Simpan foto baru
            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
        }

        // Simpan data lainnya
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}