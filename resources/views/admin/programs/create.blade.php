@extends('layouts.admin')

@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program Donasi')

@section('content')

    <div class="max-w-xl mx-auto">
        <div class="bg-gray-50 p-6 rounded shadow">

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data"> @csrf

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-gray-700">
                        Acara / Kegiatan
                    </label>
                    <input type="text" name="nama_program"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300"
                        placeholder="Contoh: Renovasi Atap" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-gray-700">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300"
                        placeholder="Deskripsi singkat program" required></textarea>
                </div>

                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-semibold text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="w-full border rounded px-3 py-2" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold text-gray-700">Gambar Program</label>
                    <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.programs.index') }}"
                        class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                        Kembali
                    </a>

                    <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded hover:bg-emerald-500">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection