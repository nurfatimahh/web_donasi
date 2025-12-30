<div>
    {{-- SEARCH & HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="w-full md:w-1/3 relative group">
            <div class="relative flex-1 min-w-[200px] group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama program..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
            </div>
        </div>

        <button onclick="openModalProgram('modalProgram', 'add')"
            class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-500 hover:-translate-y-0.5 transition-all active:scale-95">
            + Tambah Program
        </button>
    </div>

    {{-- TABEL PROGRAM --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Nama Program
                        </th>
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider text-center">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($programs as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $p->nama_program }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-sm text-slate-600 italic">
                                    <span>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</span>
                                    <span class="text-slate-300">-</span>
                                    <span>{{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center space-x-4">
                                {{-- TOMBOL LIHAT --}}
                                <a href="{{ route('admin.programs.show', $p->id) }}"
                                    class="text-emerald-600 font-bold hover:underline hover:text-emerald-700 transition-colors">
                                    Lihat
                                </a>

                                {{-- TOMBOL EDIT --}}
                                <button onclick='openModalProgram("modalProgram", "edit", @json($p))'
                                    class="text-blue-600 font-bold hover:underline hover:text-blue-700 transition-colors">
                                    Edit
                                </button>

                                {{-- TOMBOL HAPUS --}}
                                <form action="/admin/programs/{{ $p->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 font-bold hover:underline hover:text-red-600 transition-colors"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-500 font-medium">
                                Data program tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $programs->links() }}
    </div>

    {{-- MODAL PROGRAM --}}
    <div id="modalProgram"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[999] p-4 transition-all overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden border border-slate-100 my-auto">

            {{-- HEADER (Mirip Need) --}}
            <div class="p-6 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                <h3 id="modalTitleProgram" class="text-lg font-black text-slate-800 uppercase tracking-tight">Tambah
                    Program
                </h3>
                <button onclick="closeModal('modalProgram')"
                    class="text-slate-400 hover:text-slate-600 font-bold text-2xl">&times;</button>
            </div>

            <form id="formProgram" method="POST" action="/admin/programs" enctype="multipart/form-data"
                class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" id="formMethodProgram" value="POST">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- KIRI: INFO DASAR --}}
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama
                                Program</label>
                            <input type="text" name="nama_program" id="field_nama_program"
                                placeholder="Nama program donasi"
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm"
                                required>
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" id="field_deskripsi" rows="3"
                                placeholder="Jelaskan tujuan program..."
                                class="w-full border border-slate-200 p-2.5 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm resize-none"
                                required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tgl
                                    Mulai</label>
                                <input type="date" name="tanggal_mulai" id="field_tanggal_mulai"
                                    class="w-full border border-slate-200 p-2 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm"
                                    required>
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Tgl
                                    Selesai</label>
                                <input type="date" name="tanggal_selesai" id="field_tanggal_selesai"
                                    class="w-full border border-slate-200 p-2 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm"
                                    required>
                            </div>
                        </div>
                    </div>

                    {{-- KANAN: GAMBAR --}}
                    <div class="space-y-4">
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Gambar
                            Program</label>
                        <div id="dropZone"
                            class="relative border-2 border-dashed border-slate-200 rounded-2xl p-4 bg-slate-50 flex flex-col items-center justify-center transition-all hover:bg-emerald-50 hover:border-emerald-300 min-h-[180px]">
                            <input type="file" name="gambar" id="field_gambar" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                            <div id="image-placeholder" class="text-center">
                                <div
                                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mx-auto mb-2">
                                    📷
                                </div>
                                <p class="text-[10px] text-slate-500 font-bold">Klik atau seret gambar</p>
                            </div>

                            {{-- Preview Image --}}
                            <img id="img-preview"
                                class="hidden w-full h-full max-h-[160px] object-cover rounded-xl shadow-md border border-white">

                            {{-- Info Existing Image (Untuk Edit) --}}
                            <div id="existing-img-info"
                                class="hidden mt-2 p-1 bg-blue-50 text-[10px] text-blue-600 font-bold rounded">
                                Ada gambar tersimpan
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER BUTTONS (Sinkron dengan Need) --}}
                <div class="mt-8 flex justify-end items-center gap-4 border-t border-slate-50 pt-6">
                    <button type="button" onclick="closeModal('modalProgram')"
                        class="text-slate-500 font-bold text-sm hover:text-slate-700">BATAL</button>
                    <button type="submit"
                        class="bg-emerald-600 text-white px-8 py-2.5 rounded-xl font-black text-sm shadow-lg shadow-emerald-100 hover:bg-emerald-500 transition-all active:scale-95 uppercase">
                        Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>