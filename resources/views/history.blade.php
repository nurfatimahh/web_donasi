<x-layout pageTitle="Riwayat Donasi">
    <x-navbar> </x-navbar>
    <div class="bg-slate-50 min-h-screen py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Riwayat Kebaikan</h1>
                    <p class="text-slate-500 mt-1">Rekap jejak donasi yang telah Anda berikan.</p>
                </div>

                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- Card Total Uang --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-10px_rgba(0,0,0,0.1)] border border-slate-100 flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Donasi Uang</p>
                        <p class="text-xl font-black text-slate-800">Rp {{ number_format($totalAmount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- Card Total Barang --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-10px_rgba(0,0,0,0.1)] border border-slate-100 flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Barang</p>
                        <p class="text-xl font-black text-slate-800">{{ number_format($totalBarang, 0, ',', '.') }}
                            <span class="text-sm font-medium text-slate-500">Unit</span>
                        </p>
                    </div>
                </div>

                {{-- Card Menunggu --}}
                <div
                    class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_-10px_rgba(0,0,0,0.1)] border border-slate-100 flex items-center gap-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Menunggu Verifikasi</p>
                        <p class="text-xl font-black text-slate-800">{{ $menungguVerifikasi }} <span
                                class="text-sm font-medium text-slate-500">Transaksi</span></p>
                    </div>
                </div>
            </div>

            {{-- Tabel History --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">ID
                                    Transaksi</th>
                                <th class="px-6 py-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                                    Jenis & Detail</th>
                                <th class="px-6 py-4 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                                    Nominal / Jumlah</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-black text-slate-500 uppercase tracking-widest text-center">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($histories as $history)
                                                    <tr class="hover:bg-slate-50/80 transition-colors">
                                                        {{-- Tanggal --}}
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <div class="flex flex-col">
                                                                <span class="text-sm font-bold text-slate-700">{{
                                $history->created_at->format('d M Y') }}</span>
                                                                <span class="text-xs text-slate-400">{{ $history->created_at->format('H:i') }}
                                                                    WIB</span>
                                                            </div>
                                                        </td>

                                                        {{-- ID --}}
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span
                                                                class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded">
                                                                #{{ $history->id }}
                                                            </span>
                                                        </td>

                                                        {{-- Jenis --}}
                                                        <td class="px-6 py-4">
                                                            @if($history->jenis_donasi == 'uang')
                                                                <div class="flex items-center gap-2">
                                                                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                                                    <span class="text-sm font-bold text-slate-700">Donasi Uang</span>
                                                                </div>
                                                                <p class="text-xs text-slate-400 mt-1 pl-4">Transfer Bank</p>
                                                            @else
                                                                <div class="flex items-center gap-2">
                                                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                                                    <span class="text-sm font-bold text-slate-700">Donasi Barang</span>
                                                                </div>
                                                                <p class="text-xs text-slate-400 mt-1 pl-4 italic">
                                                                    {{ $history->need->nama_barang ?? 'Barang Umum' }}
                                                                </p>
                                                            @endif
                                                        </td>

                                                        {{-- Nominal --}}
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            @if($history->jenis_donasi == 'uang')
                                                                <span class="text-sm font-bold text-emerald-600">
                                                                    Rp {{ number_format($history->nominal, 0, ',', '.') }}
                                                                </span>
                                                            @else
                                                                <span class="text-sm font-bold text-blue-600">
                                                                    {{ $history->jumlah_barang }} {{ $history->need->satuan ?? 'Unit' }}
                                                                </span>
                                                            @endif
                                                        </td>

                                                        {{-- Status --}}
                                                        <td class="px-6 py-4 text-center">
                                                            @if($history->status == 'pending')
                                                                <span
                                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-wide">
                                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                                    Proses
                                                                </span>
                                                            @elseif($history->status == 'sukses')
                                                                <span
                                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wide">
                                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                                    Berhasil
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-50 text-red-600 border border-red-100 uppercase tracking-wide">
                                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                                    Ditolak
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-slate-50 p-4 rounded-full mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            </div>
                                            <p class="text-slate-500 font-medium">Belum ada riwayat donasi tercatat.</p>
                                            <a href="/"
                                                class="mt-4 text-sm font-bold text-orange-500 hover:text-orange-600 underline cursor-pointer">
                                                Mulai Donasi Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($histories->hasPages())
                    <div class="bg-white px-6 py-4 border-t border-slate-100">
                        {{ $histories->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-layout>