<x-admin-layout pageTitle="Detail Program">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.programs.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Detail Program</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Bagian Gambar --}}
                <div>
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Foto Program</label>
                    <img src="{{ asset('storage/' . $program->gambar) }}" 
                         class="w-full h-64 object-cover rounded-2xl border border-slate-100 shadow-inner" 
                         alt="{{ $program->nama_program }}">
                </div>

                {{-- Bagian Info --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Program</label>
                        <p class="text-xl font-bold text-slate-800">{{ $program->nama_program }}</p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Periode</label>
                        <p class="text-slate-600 font-medium">
                            📅 {{ \Carbon\Carbon::parse($program->tanggal_mulai)->format('d M Y') }} 
                            <span class="mx-2 text-slate-300">-</span> 
                            {{ \Carbon\Carbon::parse($program->tanggal_selesai)->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Deskripsi</label>
                        <p class="text-slate-600 leading-relaxed">{{ $program->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
             <button onclick='window.history.back()' class="bg-slate-200 text-slate-600 px-6 py-2 rounded-xl font-bold text-sm uppercase">Kembali</button>
        </div>
    </div>
</x-admin-layout>