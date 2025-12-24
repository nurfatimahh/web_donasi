<x-admin-layout pageTitle="Dashboard Overview">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="p-6 bg-emerald-50 border-l-4 border-emerald-600 rounded-xl w-full md:w-2/3 shadow-sm">
            <h2 class="text-xl font-bold text-emerald-800">Selamat datang kembali, Admin! 👋</h2>
            <p class="text-sm text-emerald-600 mt-1">Sistem siap digunakan. Pantau aktivitas donasi dan program Anda di
                sini.</p>
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari donatur..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-100 rounded-lg text-emerald-600 text-xl">📁</div>
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">Program</span>
            </div>
            <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Program</div>
            <div class="text-3xl font-black text-slate-800 mt-1">{{ $programsCount }}</div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-100 rounded-lg text-blue-600 text-xl">🏗️</div>
                <span class="text-[10px] font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Material</span>
            </div>
            <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Kebutuhan Material</div>
            <div class="text-3xl font-black text-slate-800 mt-1">{{ $needsCount }}</div>
        </div>

        <div
            class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-100 rounded-lg text-orange-600 text-xl">💰</div>
                <span class="text-[10px] font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Transaksi</span>
            </div>
            <div class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Transaksi</div>
            <div class="text-3xl font-black text-slate-800 mt-1">{{ $donationsCount }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-bold text-slate-800 uppercase text-xs tracking-widest">📁 Program Terbaru</h3>
                <a href="/admin/programs" class="text-[11px] text-emerald-600 font-bold hover:underline">LIHAT SEMUA</a>
            </div>
            <div class="p-5">
                <ul class="divide-y divide-slate-50">
                    @forelse($latestPrograms as $p) <li class="py-3 flex justify-between items-center group">
                            <span
                                class="text-sm text-slate-700 font-medium group-hover:text-emerald-600 transition-colors">{{ $p->nama_program }}</span>
                            <span
                                class="text-[10px] text-slate-400 font-medium italic">{{ $p->created_at->format('d/m/Y') }}</span>
                        </li>
                    @empty
                        <li class="py-3 text-center text-slate-400 text-xs">Belum ada program.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-bold text-slate-800 uppercase text-xs tracking-widest">💰 Donasi Terakhir</h3>
                <a href="/donations" class="text-[11px] text-emerald-600 font-bold hover:underline">LIHAT SEMUA</a>
            </div>
            <div class="p-5">
                <ul class="divide-y divide-slate-50">
                    @forelse($latestDonations as $d)
                        <li class="py-3 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px]">
                                    {{ $d->tipe == 'uang' ? '💰' : '📦' }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-700">{{ $d->user->name ?? 'Hamba Allah' }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase">
                                        {{ $d->tipe == 'uang' ? 'Donasi Tunai' : 'Barang: ' . ($d->need->nama_barang ?? 'Umum') }}
                                    </p>
                                </div>
                            </div>

                            <span
                                class="font-black {{ $d->tipe == 'uang' ? 'text-emerald-600' : 'text-blue-600' }} text-sm">
                                @if($d->tipe == 'uang')
                                    Rp {{ number_format((float) $d->jumlah, 0, ',', '.') }}
                                @else
                                    {{ $d->jumlah }} {{ $d->need->satuan ?? 'Unit' }}
                                @endif
                            </span>
                        </li>
                    @empty
                        <li class="py-3 text-center text-slate-400 text-xs italic">Belum ada donasi.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-admin-layout>