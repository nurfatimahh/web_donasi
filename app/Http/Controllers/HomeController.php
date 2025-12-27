<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Need;
use App\Models\Program;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan data program, 
     * kebutuhan, dan ayat Al-Quran acak.
     */
    public function index()
    {
        // 1. Ambil data dari database
        $needs = Need::all();
        $programs = Program::latest()->get();

        $baseUrl = env('https://quran-api.santrikoding.com/api/surah');

        $ayah = null;

        try {
            $surahNo = rand(1, 114);

            $response = Http::get("{$baseUrl}/{$surahNo}");

            if ($response->successful()) {
                $data = $response->json();
                $allAyat = $data['ayat'];

                // Pilih satu ayat secara acak dari surah tersebut
                $randomAyat = $allAyat[array_rand($allAyat)];

                // Susun data agar mudah dipanggil di Blade
                $ayah = [
                    'arabic' => $randomAyat['ar'],
                    'translation' => $randomAyat['idn'],
                    'surah' => $data['nama_latin'],
                    'number' => $randomAyat['nomor']
                ];
            }
        } catch (\Exception $e) {
            $ayah = null;
        }

        // 4. Kirim semua data ke view 'welcome'
        return view('welcome', compact('needs', 'programs', 'ayah'));
    }
}