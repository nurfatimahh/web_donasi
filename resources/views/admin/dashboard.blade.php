<x-admin-layout pageTitle="Dashboard Overview">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="p-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-2xl w-full md:w-2/3 shadow-sm">
            <h2 class="text-xl font-black text-emerald-800 tracking-tight">Selamat datang kembali, Admin!</h2>
            <p class="text-sm text-emerald-600 mt-1 font-medium">Pantau aktivitas donasi dan program masjid Anda secara
                *real-time*.</p>
        </div>

        <div class="w-full md:w-1/3">
            <form action="/admin/programs" method="GET" class="relative">
                <div class="relative flex-1 min-w-[200px] group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..."
                        class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-medium font-jakarta">
                </div>
            </form>
        </div>
    </div>

    {{-- STATS CARDS (Menggunakan SVG Icon Modern) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Program --}}
        <div
            class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-wider">Aktivitas</span>
            </div>
            <div class="text-slate-400 text-xs font-black uppercase tracking-widest">Total Program</div>
            <div class="text-4xl font-black text-slate-800 mt-1">{{ $programsCount }}</div>
        </div>

        {{-- Material --}}
        <div
            class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-black text-blue-500 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">Logistik</span>
            </div>
            <div class="text-slate-400 text-xs font-black uppercase tracking-widest">Kebutuhan Material</div>
            <div class="text-4xl font-black text-slate-800 mt-1">{{ $needsCount }}</div>
        </div>

        {{-- Transaksi --}}
        <div
            class="bg-white p-7 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span
                    class="text-[10px] font-black text-orange-500 bg-orange-50 px-3 py-1 rounded-full uppercase tracking-wider">Keuangan</span>
            </div>
            <div class="text-slate-400 text-xs font-black uppercase tracking-widest">Total Transaksi</div>
            <div class="text-4xl font-black text-slate-800 mt-1">{{ $donationsCount }}</div>
        </div>
    </div>

    {{-- LISTS WITH NUMBERS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- PROGRAM TERBARU --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden font-jakarta">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em]">Program Terbaru</h3>
                <a href="/admin/programs"
                    class="text-[10px] text-emerald-600 font-black hover:text-emerald-700 tracking-widest uppercase">Lihat
                    Semua</a>
            </div>
            <div class="p-6">
                <ul class="space-y-4">
                    @forelse($latestPrograms as $p)
                        <li
                            class="flex justify-between items-center group bg-slate-50/50 p-4 rounded-2xl hover:bg-emerald-50 transition-colors border border-transparent hover:border-emerald-100">
                            <div class="flex items-center gap-4">
                                <span
                                    class="w-8 h-8 flex items-center justify-center bg-white rounded-lg text-xs font-black text-slate-400 border border-slate-100 group-hover:text-emerald-600 shadow-sm">
                                    {{ $loop->iteration }}
                                </span>
                                <span class="text-sm text-slate-700 font-bold tracking-tight">{{ $p->nama_program }}</span>
                            </div>
                            <span class="text-[10px] text-slate-400 font-bold">{{ $p->created_at->format('d/m/Y') }}</span>
                        </li>
                    @empty
                        <li class="py-10 text-center text-slate-400 text-sm font-bold">Belum ada data program.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- DONASI TERAKHIR --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden font-jakarta">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em]">Donasi Terakhir</h3>
                <a href="/admin/donations"
                    class="text-[10px] text-emerald-600 font-black hover:text-emerald-700 tracking-widest uppercase">Lihat
                    Semua</a>
            </div>
            <div class="p-6">
                <ul class="space-y-4">
                    @forelse($latestDonations as $d)
                        <li
                            class="flex justify-between items-center p-4 rounded-2xl bg-slate-50/50 hover:bg-slate-100 transition-colors">
                            <div class="flex items-center gap-4">
                                <span
                                    class="w-8 h-8 flex items-center justify-center bg-white rounded-lg text-xs font-black text-slate-400 border border-slate-100 shadow-sm">
                                    {{ $loop->iteration }}
                                </span>
                                <div>
                                    <p class="text-sm font-black text-slate-800 leading-tight">
                                        {{ $d->user->name ?? 'Hamba Allah' }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1">
                                        {{ $d->jenis_donasi == 'uang' ? 'Donasi Tunai' : 'Barang: ' . ($d->need->nama_barang ?? 'Umum') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="font-black {{ $d->jenis_donasi == 'uang' ? 'text-emerald-600' : 'text-blue-600' }} text-sm block">
                                    @if($d->jenis_donasi == 'uang')
                                        Rp {{ number_format((float) $d->nominal, 0, ',', '.') }}
                                    @else
                                        {{ $d->jumlah_barang }} {{ $d->need?->satuan ?? 'Unit' }}
                                    @endif
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="py-10 text-center text-slate-400 text-sm font-bold italic">Belum ada transaksi.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>