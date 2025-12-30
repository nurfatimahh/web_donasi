<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
  /**
   * READ: tampilkan daftar program.
   */
  public function index() {
    return view('admin.programs.index');
  }
  
  /**
   * CREATE: tampilkan form buat program baru.
   */
  public function create()
  {
    return view('admin.programs.create');
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

    // Handle image upload
    if ($request->hasFile('gambar')) {
      $file = $request->file('gambar');
      $path = $file->store('programs', 'public');
      $validated['gambar'] = $path;
    }

    Program::create($validated);

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil dibuat.');
  }

  /**
   * UPDATE: tampilkan form edit program.
   */
  public function edit(Program $program)
  {
    return view('admin.programs.edit', compact('program'));
  }

  /**
   * UPDATE: simpan perubahan data program ke database.
   */
  public function update(Request $request, Program $program)
  {
    $validated = $request->validate([
      'nama_program' => ['required', 'string', 'max:255'],
      'deskripsi' => ['required', 'string'],
      'tanggal_mulai' => ['required', 'date'],
      'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
      'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    // Handle image upload - delete old image if new one is uploaded
    if ($request->hasFile('gambar')) {
      // Delete old image if it exists
      if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
        Storage::disk('public')->delete($program->gambar);
      }

      // Store new image
      $file = $request->file('gambar');
      $path = $file->store('programs', 'public');
      $validated['gambar'] = $path;
    }

    $program->update($validated);

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil diperbarui.');
  }

  /**
   * DELETE: hapus program dari database.
   */
  public function destroy(Program $program)
  {
    // Delete associated image file if it exists
    if ($program->gambar && Storage::disk('public')->exists($program->gambar)) {
      Storage::disk('public')->delete($program->gambar);
    }

    $program->delete();

    return redirect()->route('admin.programs.index')
      ->with('success', 'Program berhasil dihapus.');
  }

  public function publicIndex()
  {
      $programs = Program::latest()->get();
      return view('program', compact('programs'));
  }

  public function show(Program $program)
  {
      // Mengarahkan ke resources/views/admin/programs/show.blade.php
      return view('admin.programs.show', compact('program'));
  }
}