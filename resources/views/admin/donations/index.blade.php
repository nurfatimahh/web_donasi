<x-admin-layout pageTitle="Manajemen Donasi">
    <!-- masi statis -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-emerald-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Dana </p>
            <h3 class="text-2xl font-black text-emerald-600">Rp tes</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-blue-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Barang (SUM)</p>
            <h3 class="text-2xl font-black text-blue-600">sekian Unit</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-amber-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Perlu Verifikasi</p>
            <h3 class="text-2xl font-black text-amber-600">sekian Transaksi</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6 flex flex-wrap gap-4 items-center">
        <form action="{{ url()->current() }}" method="GET" class="flex flex-wrap gap-3 w-full">
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
                <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>📈 Nilai Tertinggi</option>
            </select>
        </form>
    </div>

    <div class="bg-white overflow-hidden border border-slate-100 rounded-2xl shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-slate-600 font-black uppercase text-[10px] tracking-widest"> Donatur</th>
                    <th class="px-6 py-4 text-slate-600 font-black uppercase text-[10px] tracking-widest"> Nilai Donasi
                    </th>
                    <th class="px-6 py-4 text-slate-600 font-black uppercase text-[10px] tracking-widest text-center">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($donations as $d)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $d->nama_donatur }}</td>
                        <td class="px-6 py-4">
                            @if($d->jenis_donasi == 'uang')
                                <span class="text-emerald-600 font-black">Rp
                                    {{ number_format($d->nominal, 0, ',', '.') }}</span>
                            @else
                                <span class="text-slate-800 font-black">{{ $d->jumlah_barang }}
                                    {{ $d->need->nama_kebutuhan ?? 'Unit' }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($d->status == 'pending')
                                <button
                                    class="bg-emerald-600 text-white px-3 py-1 rounded-lg text-[10px] font-bold shadow-sm hover:bg-emerald-500 transition-all">VERIFIKASI</button>
                            @else
                                <span class="text-slate-300 font-bold uppercase text-[10px] italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                            <div class="text-2xl mb-2">📭</div>
                            Data kosong.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>