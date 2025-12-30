<div>
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm mb-6 flex flex-wrap gap-4 items-center">
        <div class="flex flex-wrap gap-3 flex-1">
            <div class="relative flex-1 min-w-[200px] group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari donatur..."
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all">
            </div>

            <select wire:model.live="type"
                class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all cursor-pointer text-slate-600">
                <option value="">Semua Jenis</option>
                <option value="uang"> Uang</option>
                <option value="barang"> Barang</option>
            </select>

            <select wire:model.live="status"
                class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all cursor-pointer text-slate-600">>
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="sukses">Diterima</option>
                <option value="ditolak">Ditolak</option>
            </select>

            <select wire:model.live="sort"
                class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-emerald-500 transition-all cursor-pointer text-slate-600">
                <option value="">Urutan Default</option>
                <option value="highest"> Nilai Tertinggi</option>
            </select>
        </div>

        <div class="flex gap-2">
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
    <!--Tabel  -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th
                            class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center w-16">
                            No</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Donatur
                        </th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Jenis</th>
                        <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nilai /
                            Jumlah</th>
                        <th
                            class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">
                            Status</th>
                        <th
                            class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">
                            Bukti</th>
                        <th
                            class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">
                            Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($donations as $donation)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-center text-sm font-medium text-slate-400">
                                {{ ($donations->currentPage() - 1) * $donations->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-700">{{ $donation->nama_donatur }}</p>
                                <p class="text-[12px] text-slate-400 font-medium italic">Oleh:
                                    {{ $donation->user->name ?? 'User' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @if($donation->jenis_donasi == 'uang')
                                    <span
                                        class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[12px] font-bold bg-emerald-50 text-emerald-600 uppercase">
                                        Uang</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[12px] font-bold bg-blue-50 text-blue-600 uppercase">
                                        Barang</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-600">
                                @if($donation->jenis_donasi == 'uang')
                                    Rp {{ number_format($donation->nominal, 0, ',', '.') }}
                                @else
                                    {{ $donation->jumlah_barang }} Unit
                                    <p class="text-[12px] text-slate-400 font-medium italic">
                                        ({{ $donation->need->nama_barang ?? 'Umum' }})</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'pending' => 'bg-amber-50 text-amber-600',
                                        'sukses' => 'bg-emerald-50 text-emerald-600',
                                        'ditolak' => 'bg-red-50 text-red-600'
                                    ];
                                    $color = $colors[$donation->status] ?? 'bg-slate-50 text-slate-600';
                                @endphp
                                <span
                                    class="px-2.5 py-1 rounded-lg {{ $color }} text-[12px] font-black uppercase tracking-wider">
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($donation->jenis_donasi == 'uang' && $donation->bukti_transfer)
                                    <a href="{{ asset('storage/' . $donation->bukti_transfer) }}" target="_blank"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:bg-emerald-100 hover:text-emerald-600 transition-colors"
                                        title="Lihat Bukti Transfer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                @elseif($donation->jenis_donasi == 'uang')
                                    <span class="text-xs text-slate-300 italic">-</span>
                                @else
                                    <span class="text-xs text-slate-300">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($donation->status === 'pending')
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Terima --}}
                                        <form action="{{ route('admin.donations.verify', $donation->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Konfirmasi terima donasi ini?')"
                                                class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition-all active:scale-95 shadow-md shadow-emerald-100 uppercase"
                                                title="Terima">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Terima
                                            </button>
                                        </form>

                                        {{-- Tombol Tolak --}}
                                        <form action="{{ route('admin.donations.reject', $donation->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Konfirmasi tolak donasi ini?')"
                                                class="inline-flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-lg transition-all active:scale-95 shadow-md shadow-red-100 uppercase"
                                                title="Tolak">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span
                                        class="text-[12px] text-slate-300 font-bold italic uppercase tracking-widest">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 font-medium">Belum ada data donasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>




    <div class="mt-4">
        {{ $donations->links() }}
    </div>

</div>