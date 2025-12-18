<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
  /**
   * READ: tampilkan daftar program.
   */
  public function index()
  {
    $programs = Program::latest()->paginate(10);

    // Frontend bisa membuat view 'programs.index' sendiri.
    return view('programs.index', compact('programs'));
  }
  // tes 
  /**
   * CREATE: tampilkan form buat program baru.
   */
  public function create()
  {
    return view('programs.create');
  }

  /**
   * CREATE: simpan program baru ke database.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nama_program' => ['required', 'string', 'max:255'],
      'deskripsi' => ['required', 'string'],
      'tanggal_mulai' => ['required', 'date'],
      'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
      'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    if ($request->hasFile('gambar')) {
      $path = $request->file('gambar')->store('programs', 'public');
      $validated['gambar'] = $path;
    }

    Program::create($validated);

    return redirect()->route('programs.index')
      ->with('success', 'Program berhasil dibuat.');
  }
}
