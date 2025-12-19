<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
  /**
   * READ: daftar donasi.
   */
  public function index()
  {
    $donations = Donation::with(['user', 'need'])
      ->latest()
      ->paginate(10);

    // Frontend bisa membuat view 'donations.index' sendiri.
    return view('donations.index', compact('donations'));
  }

  /**
   * CREATE: form buat donasi baru.
   * Di sini kita load daftar needs supaya bisa dipilih di frontend.
   */
  public function create()
  {
    $needs = Need::orderBy('nama_barang')->get();

    return view('donations.create', compact('needs'));
  }

  /**
   * CREATE: simpan donasi baru.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama_donatur' => ['required', 'string', 'max:255'],
      'jenis_donasi' => ['required', 'in:uang,barang'],
      'nominal' => ['nullable', 'integer', 'min:1'],
      'need_id' => ['nullable', 'exists:needs,id'],
      'jumlah_barang' => ['nullable', 'integer', 'min:1'],
      'bukti_transfer' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    // Set user_id dari user yang login (jika ada)
    $validated['user_id'] = Auth::id();

    // Validasi logika sederhana berdasarkan jenis_donasi
    if ($validated['jenis_donasi'] === 'uang') {
      $validated['jumlah_barang'] = null;
    } else {
      $validated['nominal'] = null;
    }

    if ($request->hasFile('bukti_transfer')) {
      $path = $request->file('bukti_transfer')->store('donations', 'public');
      $validated['bukti_transfer'] = $path;
    }

    Donation::create($validated);

    return redirect()->route('donations.index')
      ->with('success', 'Donasi berhasil dicatat.');
  }
}
