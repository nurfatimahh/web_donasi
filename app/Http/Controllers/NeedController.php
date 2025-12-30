<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // tes doang

class NeedController extends Controller
{
  /**
   * READ: daftar kebutuhan (needs).
   */
  public function index()
  {
      // Cukup panggil view saja, data list diambil di Livewire
      return view('admin.needs.index');
  }
  
  /**
   * CREATE: tampilkan form buat kebutuhan baru.
   */
  public function create()
  {
    return view('admin.needs.create');
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

    // tes komentar
    Need::create($validated);

    return redirect()->route('admin.needs.index')
      ->with('success', 'Kebutuhan berhasil dibuat.');
  }

  /**
   * UPDATE: tampilkan form edit kebutuhan.
   */
  public function edit(Need $need)
  {
    return view('admin.needs.edit', compact('need'));
  }
  /**
   * UPDATE: simpan perubahan data kebutuhan.
   */
  public function update(Request $request, Need $need)
  {
    $validated = $request->validate([
      'nama_barang' => ['required', 'string', 'max:255'],
      'target_jumlah' => ['required', 'integer', 'min:1'],
      'jumlah_terkumpul' => ['required', 'integer', 'min:0'],
      'satuan' => ['required', 'string', 'max:50'],
    ]);

    $need->update($validated);

    return redirect()->route('admin.needs.index')
      ->with('success', 'Kebutuhan berhasil diperbarui.');
  }

  /**
   * DELETE: hapus kebutuhan.
   */
  public function destroy(Need $need)
  {
    $need->delete();  

    return redirect()->route('admin.needs.index')
      ->with('success', 'Kebutuhan berhasil dihapus.');
  }

  
}
