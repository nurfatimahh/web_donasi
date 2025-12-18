@extends('layouts.admin')

@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program Donasi')

@section('content')

<div class="max-w-xl mx-auto">
    <div class="bg-gray-50 p-6 rounded shadow">

        <form>
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">
                    Acara / Kegiatan
                </label>
                <input type="text"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300"
                       placeholder="Contoh: Renovasi Atap">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">
                    Deskripsi
                </label>
                <textarea rows="4"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300"
                          placeholder="Deskripsi singkat program"></textarea>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">
                    Target Donasi (Rp)
                </label>
                <input type="number"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-emerald-300"
                       placeholder="Contoh: 5000000">
            </div>
            <div class="flex justify-between">
                <a href="/admin/program"
                class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                    Kembali
                </a>

                <button type="submit"
                        class="bg-emerald-600 text-white px-6 py-2 rounded hover:bg-emerald-500">
                    Simpan
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
