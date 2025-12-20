@extends('layouts.admin')
@section('page-title', 'Kelola Program')

@section('content')
    <div class="flex justify-end mb-4">
        <button onclick="openModal('modalProgram', 'add')"
            class="bg-emerald-600 text-white px-4 py-2 rounded shadow hover:bg-emerald-500">
            + Tambah Program
        </button>
    </div>

    <div class="overflow-x-auto border rounded-lg">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-100 font-bold">
                <tr>
                    <th class="px-4 py-3 border">Nama Program</th>
                    <th class="px-4 py-3 border">Periode</th>
                    <th class="px-4 py-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $p)
                    <tr class="border-t">
                        <td class="px-4 py-3 border font-medium">{{ $p->nama_program }}</td>
                        <td class="px-4 py-3 border">{{ $p->tanggal_mulai }} s/d {{ $p->tanggal_selesai }}</td>
                        <td class="px-4 py-3 border text-center space-x-2">
                            <button onclick='openModal("modalProgram", "edit", @json($p))' class="text-blue-600">Edit</button>
                            <form action="/admin/programs/{{ $p->id }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="modalProgram" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h3 id="modalTitle" class="text-xl font-bold mb-4">Tambah Program</h3>
            <form id="formProgram" method="POST" action="/admin/programs" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Program</label>
                        <input type="text" name="nama_program" id="nama_program" placeholder="Nama Program"
                            class="w-full border p-2 rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="w-full border p-2 rounded"
                            required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Foto Program</label>
                        <input type="file" name="gambar" id="gambar" class="w-full border p-1 rounded text-sm"
                            accept="image/*">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP (Maks. 2MB). Kosongkan jika tidak ingin
                            mengubah foto.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-sm font-medium mb-1">Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full border p-2 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full border p-2 rounded"
                                required>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalProgram')" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded font-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, mode, data = null) {
            const modal = document.getElementById(id);
            const form = document.getElementById('formProgram');
            const method = document.getElementById('formMethod');
            const title = document.getElementById('modalTitle');

            if (mode === 'edit') {
                title.innerText = 'Edit Program';
                form.action = '/admin/programs/' + data.id;
                method.value = 'PUT';
                document.getElementById('nama_program').value = data.nama_program;
                document.getElementById('deskripsi').value = data.deskripsi;
                document.getElementById('tanggal_mulai').value = data.tanggal_mulai;
                document.getElementById('tanggal_selesai').value = data.tanggal_selesai;
                // Input file tidak bisa diisi nilainya secara programmatik karena alasan keamanan browser
                document.getElementById('gambar').value = "";
            } else {
                title.innerText = 'Tambah Program';
                form.action = '/admin/programs';
                method.value = 'POST';
                form.reset();
            }
            modal.classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
@endsection