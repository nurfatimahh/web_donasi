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
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Nama Program</th>
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-slate-600 font-bold uppercase text-[11px] tracking-wider text-center">Aksi</th>
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
                                    <span>📅</span>
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
                                    <button type="submit" class="text-red-500 font-bold hover:underline hover:text-red-600 transition-colors"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-slate-400 font-medium italic">
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

    {{-- MODAL PROGRAM - ADVANCED WITH DRAG & DROP --}}
    <div id="modalProgram" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[999] p-4 transition-all duration-300 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden border border-slate-100 transform transition-all duration-300 my-8">
            {{-- HEADER WITH GRADIENT --}}
            <div class="p-8 border-b border-slate-100 bg-gradient-to-r from-emerald-50 via-white to-emerald-50 flex justify-between items-start">
                <div class="flex-1">
                    <h2 id="modalTitleProgram" class="text-3xl font-black text-slate-900 uppercase tracking-tight">Tambah Program</h2>
                    <p id="modalSubtitle" class="text-sm text-slate-600 mt-2 leading-relaxed">Buat program donasi baru dengan informasi lengkap dan gambar menarik</p>
                </div>
                <button onclick="closeModal('modalProgram')" class="text-slate-400 hover:text-slate-600 hover:bg-slate-200/50 font-bold p-2 rounded-lg transition-all ml-4 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- FORM CONTENT --}}
            <form id="formProgram" method="POST" action="/admin/programs" enctype="multipart/form-data" class="p-8">
                @csrf
                <input type="hidden" name="_method" id="formMethodProgram" value="POST">

                <div class="space-y-8">
                    {{-- SECTION 1: BASIC INFO --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b-2 border-slate-200">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">1</div>
                            <h3 class="text-lg font-bold text-slate-800">Informasi Dasar</h3>
                        </div>

                        {{-- NAMA PROGRAM --}}
                        <div class="form-group">
                            <label class="block text-sm font-bold text-slate-700 mb-2 flex items-center gap-2">
                                <span class="text-emerald-600 text-lg">●</span>
                                Nama Program
                                <span class="text-xs font-normal text-slate-500">(Wajib diisi)</span>
                            </label>
                            <div class="relative group">
                                <input type="text" name="nama_program" id="field_nama_program" 
                                       class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-lg text-sm font-medium text-slate-800 placeholder-slate-400 transition-all duration-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 group-hover:border-slate-300" 
                                       placeholder="Contoh: Program Kesehatan Masyarakat 2025" required>
                                <div class="absolute right-4 top-3.5 text-slate-300 group-focus-within:text-emerald-500 transition-colors pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            @error('nama_program')
                                <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded flex items-start gap-2">
                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-red-700 text-sm">Validasi Gagal</p>
                                        <p class="text-red-600 text-xs">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- SECTION 2: DESCRIPTION --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b-2 border-slate-200">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">2</div>
                            <h3 class="text-lg font-bold text-slate-800">Deskripsi Program</h3>
                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-bold text-slate-700 mb-2 flex items-center gap-2">
                                <span class="text-emerald-600 text-lg">●</span>
                                Deskripsi Lengkap
                                <span class="text-xs font-normal text-slate-500">(Minimal 20 karakter)</span>
                            </label>
                            <div class="relative group">
                                <textarea name="deskripsi" id="field_deskripsi"
                                          class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-lg text-sm font-medium text-slate-800 placeholder-slate-400 transition-all duration-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 group-hover:border-slate-300 resize-none overflow-hidden"
                                          placeholder="Jelaskan secara detail:&#10;• Tujuan program&#10;• Siapa yang mendapat manfaat&#10;• Bagaimana cara kerjanya&#10;• Target dan hasil yang diharapkan" 
                                          required
                                          data-auto-resize></textarea>
                                <div class="absolute right-4 bottom-3 text-slate-300 group-focus-within:text-emerald-500 transition-colors pointer-events-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-slate-500">Semakin detail, semakin baik untuk penerima manfaat.</p>
                                <span class="text-xs font-semibold text-slate-400" id="charCount">0 / 500</span>
                            </div>
                            @error('deskripsi')
                                <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded flex items-start gap-2">
                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-red-700 text-sm">Validasi Gagal</p>
                                        <p class="text-red-600 text-xs">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- SECTION 3: TIMELINE --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b-2 border-slate-200">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">3</div>
                            <h3 class="text-lg font-bold text-slate-800">Periode Program</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- START DATE --}}
                            <div class="form-group">
                                <label class="block text-sm font-bold text-slate-700 mb-2 flex items-center gap-2">
                                    <span class="text-emerald-600 text-lg">●</span>
                                    Tanggal Mulai
                                </label>
                                <div class="relative group">
                                    <input type="date" name="tanggal_mulai" id="field_tanggal_mulai" 
                                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-lg text-sm font-medium text-slate-800 transition-all duration-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 group-hover:border-slate-300"
                                           required>
                                    <div class="absolute right-4 top-3.5 text-slate-300 group-focus-within:text-emerald-500 transition-colors pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('tanggal_mulai')
                                    <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded flex items-start gap-2">
                                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-red-600 text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>

                            {{-- END DATE --}}
                            <div class="form-group">
                                <label class="block text-sm font-bold text-slate-700 mb-2 flex items-center gap-2">
                                    <span class="text-emerald-600 text-lg">●</span>
                                    Tanggal Selesai
                                </label>
                                <div class="relative group">
                                    <input type="date" name="tanggal_selesai" id="field_tanggal_selesai" 
                                           class="w-full px-4 py-3 bg-white border-2 border-slate-200 rounded-lg text-sm font-medium text-slate-800 transition-all duration-200 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 group-hover:border-slate-300"
                                           required>
                                    <div class="absolute right-4 top-3.5 text-slate-300 group-focus-within:text-emerald-500 transition-colors pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('tanggal_selesai')
                                    <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded flex items-start gap-2">
                                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="text-red-600 text-xs">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 4: IMAGE UPLOAD WITH DRAG & DROP --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b-2 border-slate-200">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">4</div>
                            <h3 class="text-lg font-bold text-slate-800">Gambar Program</h3>
                            <span class="text-xs font-normal text-slate-500">(Opsional)</span>
                        </div>

                        <div class="form-group">
                            {{-- DRAG & DROP ZONE --}}
                            <div id="dropZone" class="relative group border-2 border-dashed border-slate-300 rounded-xl p-8 bg-gradient-to-br from-slate-50 to-slate-100 transition-all duration-300 cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/50 hover:shadow-lg focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-100">
                                <input type="file" name="gambar" id="field_gambar" accept=".jpg,.jpeg,.png,.webp" 
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required-file>
                                
                                <div class="text-center pointer-events-none">
                                    <div class="mb-4 flex justify-center">
                                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-200 transition-transform">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800 mb-1">Seret & lepas gambar di sini</h4>
                                    <p class="text-xs text-slate-600 mb-3">atau klik untuk memilih dari perangkat Anda</p>
                                    <div class="inline-block px-4 py-2 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-500 transition-colors">
                                        Pilih Gambar
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-between text-xs text-slate-500">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 17v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd" />
                                    </svg>
                                    Format: JPG, PNG, WEBP
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a1 1 0 001 1h12a1 1 0 001-1V6a2 2 0 00-2-2H4zm0 4v4h12V8H4z" clip-rule="evenodd" />
                                    </svg>
                                    Max: 2MB
                                </div>
                            </div>

                            @error('gambar')
                                <div class="mt-3 p-3 bg-red-50 border-l-4 border-red-500 rounded flex items-start gap-2">
                                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-red-600 text-xs">{{ $message }}</p>
                                </div>
                            @enderror

                            {{-- IMAGE PREVIEW --}}
                            <div id="preview-container" class="hidden mt-6 p-6 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl border-2 border-emerald-300 shadow-sm">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-emerald-200">
                                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm font-bold text-emerald-800">Pratinjau Gambar</p>
                                    <button type="button" onclick="removeImage()" class="ml-auto text-sm text-emerald-600 hover:text-emerald-700 hover:underline font-semibold">Ganti Gambar</button>
                                </div>
                                <img id="img-preview" src="" alt="Preview" class="w-full max-h-64 rounded-lg object-cover shadow-md">
                            </div>

                            {{-- EXISTING IMAGE PREVIEW (FOR EDIT MODE) --}}
                            <div id="existing-image-container" class="hidden mt-6 p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-300 shadow-sm">
                                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-blue-200">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                    </svg>
                                    <p class="text-sm font-bold text-blue-800">Gambar Saat Ini</p>
                                </div>
                                <img id="existing-img-preview" src="" alt="Existing" class="w-full max-h-64 rounded-lg object-cover shadow-md">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER / ACTION BUTTONS --}}
                <div class="mt-10 pt-8 border-t border-slate-200 flex items-center justify-between">
                    <p class="text-xs text-slate-500">
                        <span class="text-red-600 font-bold">●</span> Wajib diisi | 
                        <span class="text-slate-400 font-bold">◆</span> Opsional
                    </p>
                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal('modalProgram')" 
                                class="px-6 py-3 bg-slate-100 text-slate-700 rounded-lg font-bold text-sm uppercase transition-all duration-200 hover:bg-slate-200 active:scale-95">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-lg font-bold text-sm uppercase shadow-lg shadow-emerald-200 transition-all duration-200 hover:shadow-emerald-300 hover:from-emerald-500 hover:to-emerald-400 active:scale-95 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Program
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
        // AUTO-EXPANDING TEXTAREA
        function autoExpandTextarea(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 500) + 'px';
        }

        // INITIALIZE ON PAGE LOAD
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('field_deskripsi');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    autoExpandTextarea(this);
                    updateCharCount();
                });
            }
            setupDragDropZone();
        });

        // DRAG & DROP ZONE
        function setupDragDropZone() {
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('field_gambar');

            if (!dropZone || !fileInput) return;

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-emerald-500', 'bg-emerald-100/80', 'shadow-lg');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-emerald-500', 'bg-emerald-100/80', 'shadow-lg');
                }, false);
            });

            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                fileInput.files = files;
                const event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }, false);
        }

        // CHARACTER COUNTER
        function updateCharCount() {
            const textarea = document.getElementById('field_deskripsi');
            const charCount = document.getElementById('charCount');
            if (charCount) {
                charCount.textContent = `${textarea.value.length} / 500`;
            }
        }

        // REMOVE/REPLACE IMAGE
        function removeImage() {
            document.getElementById('field_gambar').value = '';
            document.getElementById('preview-container').classList.add('hidden');
        }

        // PREVIEW IMAGE WITH VALIDATION
        function previewImage(input) {
            const previewContainer = document.getElementById('preview-container');
            const imgPreview = document.getElementById('img-preview');

            if (!input.files || !input.files[0]) return;

            const file = input.files[0];
            
            // SIZE VALIDATION
            if (file.size > 2 * 1024 * 1024) {
                alert('File terlalu besar! Maksimal 2MB.');
                input.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            // TYPE VALIDATION
            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                alert('Format tidak didukung! Gunakan JPG, PNG, atau WEBP.');
                input.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                imgPreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                previewContainer.style.opacity = '0';
                previewContainer.style.transition = 'opacity 0.3s ease-in-out';
                setTimeout(() => {
                    previewContainer.style.opacity = '1';
                }, 10);
            };
            reader.readAsDataURL(file);
        }

        // FILE INPUT CHANGE
        document.getElementById('field_gambar').addEventListener('change', function() {
            previewImage(this);
        });

        // OPEN MODAL
        function openModalProgram(modalId, mode, data = {}) {
            const modal = document.getElementById(modalId);
            const form = document.getElementById('formProgram');
            const methodInput = document.getElementById('formMethodProgram');
            const titleElement = document.getElementById('modalTitleProgram');
            const subtitleElement = document.getElementById('modalSubtitle');

            if (mode === 'create') {
                form.reset();
                form.action = '/admin/programs';
                methodInput.value = 'POST';
                titleElement.textContent = 'Tambah Program';
                subtitleElement.textContent = 'Buat program donasi baru dengan informasi lengkap dan gambar menarik';
                document.getElementById('preview-container').classList.add('hidden');
                document.getElementById('existing-image-container').classList.add('hidden');
            } else if (mode === 'edit') {
                methodInput.value = 'PUT';
                form.action = `/admin/programs/${data.id}`;
                titleElement.textContent = 'Edit Program';
                subtitleElement.textContent = `Edit informasi untuk program "${data.nama_program}"`;
                
                document.getElementById('field_nama_program').value = data.nama_program || '';
                document.getElementById('field_deskripsi').value = data.deskripsi || '';
                document.getElementById('field_tanggal_mulai').value = data.tanggal_mulai || '';
                document.getElementById('field_tanggal_selesai').value = data.tanggal_selesai || '';

                const textarea = document.getElementById('field_deskripsi');
                if (textarea) {
                    autoExpandTextarea(textarea);
                    updateCharCount();
                }

                if (data.gambar) {
                    const existingContainer = document.getElementById('existing-image-container');
                    document.getElementById('existing-img-preview').src = `/storage/${data.gambar}`;
                    existingContainer.classList.remove('hidden');
                } else {
                    document.getElementById('existing-image-container').classList.add('hidden');
                }
                document.getElementById('preview-container').classList.add('hidden');
            }

            modal.classList.remove('hidden');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.opacity = '1';
            }, 10);

            setTimeout(() => setupDragDropZone(), 100);
        }

        // CLOSE MODAL
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.3s ease-in-out';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.style.opacity = '1';
                document.getElementById('formProgram').reset();
                document.getElementById('preview-container').classList.add('hidden');
                document.getElementById('existing-image-container').classList.add('hidden');
            }, 300);
        }

        // ESC KEY
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const modal = document.getElementById('modalProgram');
                if (modal && !modal.classList.contains('hidden')) {
                    closeModal('modalProgram');
                }
            }
        });

        // FORM VALIDATION
        document.getElementById('formProgram').addEventListener('submit', function(e) {
            const nama = document.getElementById('field_nama_program').value.trim();
            const deskripsi = document.getElementById('field_deskripsi').value.trim();
            const mulai = document.getElementById('field_tanggal_mulai').value;
            const selesai = document.getElementById('field_tanggal_selesai').value;

            if (nama.length < 5) {
                e.preventDefault();
                alert('Nama program minimal 5 karakter.');
                return;
            }
            if (deskripsi.length < 20) {
                e.preventDefault();
                alert('Deskripsi minimal 20 karakter.');
                return;
            }
            if (new Date(mulai) >= new Date(selesai)) {
                e.preventDefault();
                alert('Tanggal selesai harus lebih besar dari tanggal mulai.');
                return;
            }
        });

        // INPUT FEEDBACK
        document.getElementById('formProgram').addEventListener('input', function(e) {
            if ((e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') && e.target.value.trim()) {
                e.target.parentElement.classList.add('ring-2', 'ring-emerald-100');
                setTimeout(() => {
                    e.target.parentElement.classList.remove('ring-2', 'ring-emerald-100');
                }, 150);
            }
        });
    </script>
</div>