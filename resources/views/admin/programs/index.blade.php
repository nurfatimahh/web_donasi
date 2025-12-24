<x-admin-layout pageTitle="Kelola Program Donasi">

    @if(session('success'))
        <div id="alert"
            class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
            <div class="flex items-center">
                <span class="mr-2">✅</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()"
                class="text-emerald-500 hover:text-emerald-700 font-bold text-xl">&times;</button>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form action="{{ url()->current() }}" method="GET" class="w-full md:w-1/3 relative group">
            <div class="relative flex-1 min-w-[200px] group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari donatur..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
            </div>
        </form>

        <button onclick="openModal('modalProgram', 'add')"
            class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-500 hover:-translate-y-0.5 transition-all active:scale-95">
            + Tambah Program
        </button>
    </div>

    <div class="bg-white overflow-hidden border border-slate-100 rounded-2xl shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Nama Program
                    </th>
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Periode</th>
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider text-center">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($programs as $p)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-800">{{ $p->nama_program }}</div>
                    </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2 text-sm text-slate-600 italic">
                            <span>📅</span>
                            <span>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</span>
                            <span class="text-slate-300">-</span>
                            <span>{{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center space-x-4">
                        <button class="text-blue-600 font-bold hover:underline hover:text-blue-700 transition-colors">
                            <a href="">Lihat</a></button>

                        <button onclick='openModal("modalProgram", "edit", @json($p))'
                            class="text-blue-600 font-bold hover:underline hover:text-blue-700 transition-colors">Edit</button>

                        <form action="/admin/programs/{{ $p->id }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 font-bold hover:underline hover:text-red-600 transition-colors"
                                onclick="return confirm('Hapus program ini?')">Hapus</button>
                        </form>
                    </td>
                    </tr>
                @empty
        <tr>
            <td colspan="3" class="px-6 py-12 text-center">
                <div class="text-slate-400 mb-2">📭</div>
                <p class="text-slate-500 font-medium">Data program tidak ditemukan.</p>
            </td>
        </tr>
    @endforelse
    </tbody>
    </table>
    </div>

    <div id="modalProgram"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4 transition-all">
        <div
            class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all border border-slate-100">
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-black text-slate-800 uppercase tracking-tight">Tambah Program
                </h3>
                <button onclick="closeModal('modalProgram')"
                    class="text-slate-400 hover:text-slate-600 font-bold text-2xl">&times;</button>
            </div>

            <form id="formProgram" method="POST" action="/admin/programs" enctype="multipart/form-data"
                class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-4">
                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama
                            Program</label>
                        <input type="text" name="nama_program" id="nama_program" placeholder="Contoh: Maulid Nabi"
                            class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none transition-all shadow-sm"
                            required>
                    </div>

                    <div>
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Jelaskan tujuan program ini..."
                            class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none transition-all shadow-sm"
                            required></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Foto
                            Program</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <p class="text-xs text-slate-500"><span class="font-bold">Klik untuk upload</span>
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase">JPG, PNG, WEBP (Max. 2MB)</p>
                                </div>
                                <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tanggal
                                Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm"
                                required>
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tanggal
                                Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm"
                                required>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end items-center gap-4 border-t border-slate-50 pt-6">
                    <button type="button" onclick="closeModal('modalProgram')"
                        class="text-slate-500 font-bold text-sm hover:text-slate-700">Batal</button>
                    <button type="submit"
                        class="bg-emerald-600 text-white px-8 py-2.5 rounded-xl font-black text-sm shadow-lg shadow-emerald-100 hover:bg-emerald-500 transition-all active:scale-95">SIMPAN
                        PROGRAM</button>
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
</x-admin-layout>