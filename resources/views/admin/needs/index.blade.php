<x-admin-layout pageTitle="Kebutuhan Material">
    <!-- messagenya -->
    @if(session('success'))
        <div id="alert"
            class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
            <div class="flex items-center">
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

        <button onclick="openModal('modalNeed', 'add')"
            class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-500 hover:-translate-y-0.5 transition-all active:scale-95">
            + Tambah Kebutuhan
        </button>
    </div>

    <!-- Tabelnya -->
    <div class="bg-white overflow-hidden border border-slate-100 rounded-2xl shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Nama Barang</th>
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider text-center">
                        Jumlah Terkumpul / Target</th>
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Satuan</th>
                    <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider text-center">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($needs as $n)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-800">{{ $n->nama_barang }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm font-medium">
                                <span
                                    class="text-emerald-600 font-bold">{{ number_format($n->jumlah_terkumpul, 0, ',', '.') }}</span>
                                <span class="mx-1.5 text-slate-400">/</span>
                                <span>{{ number_format($n->target_jumlah, 0, ',', '.') }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-slate-500 font-medium">{{ $n->satuan }}</span>
                        </td>

                        <td class="px-6 py-4 text-center space-x-3">
                            {{-- Tombol Edit --}}
                            <button onclick='openModal("modalNeed", "edit", @json($n))'
                                class="text-blue-600 font-bold hover:underline hover:text-blue-700 transition-colors">
                                Edit
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.needs.destroy', $n->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 font-bold hover:underline hover:text-red-600 transition-colors"
                                    onclick="return confirm('Hapus kebutuhan ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-slate-300 text-4xl mb-3">📦</div>
                            <p class="text-slate-500 font-medium">Data kebutuhan tidak ditemukan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- form tambah edit -->
    <div id="modalNeed"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4 transition-all">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-black text-slate-800 uppercase tracking-tight">Tambah Kebutuhan
                </h3>
                <button onclick="closeModal('modalNeed')"
                    class="text-slate-400 hover:text-slate-600 font-bold text-2xl">&times;</button>
            </div>

            <form id="formNeed" method="POST" action="{{ route('admin.needs.store') }}" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-4">
                    <div>
                        <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama
                            Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" placeholder="Contoh: Semen Gresik"
                            class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none transition-all shadow-sm"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Target
                                Jumlah</label>
                            <input type="number" name="target_jumlah" id="target_jumlah" required min="1"
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm">
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Satuan</label>
                            <input type="text" name="satuan" id="satuan" placeholder="Zak, Pcs, dll" required
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm">
                        </div>
                    </div>

                    <div id="divTerkumpul" class="hidden animate-fade-in">
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jumlah
                            Terkumpul</label>
                        <input type="number" name="jumlah_terkumpul" id="jumlah_terkumpul" min="0"
                            class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none bg-slate-50 shadow-inner">
                        <p class="text-[10px] text-slate-400 mt-1.5 italic">*Ubah manual jika ada donasi barang masuk.
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end items-center gap-4 border-t border-slate-50 pt-6">
                    <button type="button" onclick="closeModal('modalNeed')"
                        class="text-slate-500 font-bold text-sm hover:text-slate-700">BATAL</button>
                    <button type="submit"
                        class="bg-emerald-600 text-white px-8 py-2.5 rounded-xl font-black text-sm shadow-lg shadow-emerald-100 hover:bg-emerald-500 transition-all active:scale-95 uppercase">Simpan
                        Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id, mode, data = null) {
            const modal = document.getElementById(id);
            const form = document.getElementById('formNeed');
            const method = document.getElementById('formMethod');
            const title = document.getElementById('modalTitle');
            const divTerkumpul = document.getElementById('divTerkumpul');

            if (mode === 'edit') {
                title.innerText = 'Edit Kebutuhan';
                form.action = '/admin/needs/' + data.id;
                method.value = 'PUT';

                // Isi data field
                document.getElementById('nama_barang').value = data.nama_barang;
                document.getElementById('target_jumlah').value = data.target_jumlah;
                document.getElementById('satuan').value = data.satuan;

                // Tampilkan & isi jumlah terkumpul
                divTerkumpul.classList.remove('hidden');
                document.getElementById('jumlah_terkumpul').value = data.jumlah_terkumpul;
            } else {
                title.innerText = 'Tambah Kebutuhan';
                form.action = '/admin/needs';
                method.value = 'POST';

                // Sembunyikan & reset jumlah terkumpul
                divTerkumpul.classList.add('hidden');
                document.getElementById('jumlah_terkumpul').value = 0;
                form.reset();
            }

            modal.classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-admin-layout>