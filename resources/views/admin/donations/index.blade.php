<x-admin-layout pageTitle="Manajemen Donasi">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-emerald-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Dana</p>
            <h3 class="text-2xl font-black text-emerald-600">Rp {{ number_format($totalUang, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-blue-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Barang (SUM)</p>
            <h3 class="text-2xl font-black text-blue-600">{{ $totalBarang }} Unit</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-amber-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Perlu Verifikasi</p>
            <h3 class="text-2xl font-black text-amber-600">{{ $pendingCount }} Transaksi</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6 flex flex-wrap gap-4 items-center">
        <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap gap-3 flex-1">
            <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap gap-3 flex-1">
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

                <select name="type" onchange="this.form.submit()"
                    class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all cursor-pointer text-slate-600">
                    <option value="">Semua Jenis</option>
                    <option value="uang" {{ request('type') == 'uang' ? 'selected' : '' }}>💰 Uang</option>
                    <option value="barang" {{ request('type') == 'barang' ? 'selected' : '' }}>📦 Barang</option>
                </select>

                <select name="sort" onchange="this.form.submit()"
                    class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all cursor-pointer text-slate-600">
                    <option value="">Urutan Default</option>
                    <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>📈 Nilai Tertinggi
                    </option>
                </select>
            </form>

            <div class="flex gap-2">
                <!-- isi route -->
                <a href=""
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-sm flex items-center gap-2 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    CETAK PDF
                </a>
            </div>

            <div class="flex gap-2">
                <!-- isi route -->
                <a href="/admin/donations/pdf"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-sm flex items-center gap-2 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    CETAK PDF
                </a>
            </div>
    </div>

    <div class="flex gap-2">
        <!-- isi route -->
        <a href=""
            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-sm flex items-center gap-2 transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            CETAK PDF
        </a>
    </div>
    </div>
    <div class="mt-4">
        {{ $donations->links() }}
    </div>
</x-admin-layout>