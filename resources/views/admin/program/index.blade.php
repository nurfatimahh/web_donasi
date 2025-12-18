@extends('layouts.admin')

@section('title', 'Program Donasi')
@section('page-title', 'Program Donasi')

@section('content')

<div class="flex justify-between items-center mb-4">
    <p class="text-gray-600">Daftar program/kegiatan donasi</p>

    <a href="/admin/program/create"
       class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-500">
        + Tambah Program
    </a>
</div>

<div class="overflow-x-auto">
    <table class="w-full border border-gray-200 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nama Program</th>
                <th class="px-4 py-2 border">Nama Kegiatan</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- dummy data -->
            <tr class="text-center">
                <td class="px-4 py-2 border">1</td>
                <td class="px-4 py-2 border">Donasi Masjid</td>
                <td class="px-4 py-2 border">Pembangunan Atap</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                    <a href="#" class="text-red-600 hover:underline">Hapus</a>
                </td>
            </tr>

            <tr class="text-center">
                <td class="px-4 py-2 border">2</td>
                <td class="px-4 py-2 border">Santunan Anak Yatim</td>
                <td class="px-4 py-2 border">Ramadhan Berbagi</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Edit</a>
                    <a href="#" class="text-red-600 hover:underline">Hapus</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
