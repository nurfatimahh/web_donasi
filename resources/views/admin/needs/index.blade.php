@extends('layouts.admin')
@section('page-title', 'Kebutuhan Material')

@section('content')
    <div class="flex justify-end mb-4">
        <button onclick="openModal('modalNeed')" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
            + Tambah Barang
        </button>
    </div>

    <div class="overflow-x-auto border rounded-lg">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 border">Barang</th>
                    <th class="px-4 py-3 border">Target</th>
                    <th class="px-4 py-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-3 border">Semen Merah Putih</td>
                    <td class="px-4 py-3 border">100 Sak</td>
                    <td class="px-4 py-3 border text-center">
                        <button class="text-blue-600 px-2">Edit</button>
                        <button class="text-red-600 px-2">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="modalNeed" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold">Form Kebutuhan</h3>
                <button onclick="closeModal('modalNeed')" class="text-gray-400 text-xl">&times;</button>
            </div>
            <form class="space-y-4">
                <input type="text" placeholder="Nama Barang" class="w-full border p-2 rounded outline-none">
                <div class="grid grid-cols-2 gap-2">
                    <input type="number" placeholder="Jumlah" class="border p-2 rounded">
                    <input type="text" placeholder="Satuan (Pcs/Kg)" class="border p-2 rounded">
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeModal('modalNeed')" class="text-gray-500">Batal</button>
                    <button type="button" class="bg-blue-600 text-white px-6 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    </script>
@endsection