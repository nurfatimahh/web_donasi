<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;

class NeedController extends Controller
{
  /**
   * READ: daftar kebutuhan (needs).
   */
  public function index()
  {
    $needs = Need::latest()->paginate(10);

    // Frontend bisa membuat view 'needs.index' sendiri.
    return view('needs.index', compact('needs'));
  }

  /**
   * CREATE: tampilkan form buat kebutuhan baru.
   */
  public function create()
  {
    return view('needs.create');
  }

  /**
   * CREATE: simpan kebutuhan baru.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama_barang' => ['required', 'string', 'max:255'],
      'target_jumlah' => ['required', 'integer', 'min:1'],
      'jumlah_terkumpul' => ['nullable', 'integer', 'min:0'],
      'satuan' => ['required', 'string', 'max:50'],
    ]);

    // Default jumlah_terkumpul ke 0 jika tidak diisi.
    if (!isset($validated['jumlah_terkumpul'])) {
      $validated['jumlah_terkumpul'] = 0;
    }

    Need::create($validated);

    return redirect()->route('needs.index')
      ->with('success', 'Kebutuhan berhasil dibuat.');
  }
}
