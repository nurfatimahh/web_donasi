<x-admin-layout pageTitle="Manajemen Donasi">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-emerald-500">
            <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Dana</p>
            <h3 class="text-2xl font-black text-emerald-600">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h3>
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
                            Aksi</th>
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
                                <p class="text-[10px] text-slate-400 font-medium italic">Oleh:
                                    {{ $donation->user->name ?? 'User' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-[10px] font-bold {{ $donation->jenis_donasi == 'uang' ? 'bg-emerald-50 text-emerald-600' : 'bg-blue-50 text-blue-600' }} uppercase">
                                    {{ $donation->jenis_donasi == 'uang' ? '💰 Uang' : '📦 Barang' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-600">
                                @if($donation->jenis_donasi == 'uang')
                                    Rp {{ number_format($donation->nominal, 0, ',', '.') }}
                                @else
                                    {{ $donation->jumlah_barang }} Unit
                                    <p class="text-[10px] text-slate-400 font-medium italic">
                                        ({{ $donation->need->nama_barang ?? 'Umum' }})</p>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($donation->status == 'pending')
                                    <span
                                        class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-wider">Pending</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-wider">Sukses</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    {{-- Tombol Lihat Bukti --}}
                                    @if($donation->bukti_transfer)
                                        <a href="#bukti-{{ $donation->id }}"
                                            class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition-all shadow-sm"
                                            title="Lihat Bukti">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- MODAL (Tetap di dalam TD, muncul saat ID dipanggil oleh href) --}}
                                        <div id="bukti-{{ $donation->id }}"
                                            class="fixed inset-0 z-[100] hidden target:flex items-center justify-center bg-slate-900/95 backdrop-blur-md p-4">

                                            {{-- w-auto membuat kotak putih mengecil mengikuti lebar gambar --}}
                                            <div
                                                class="p-3 bg-white rounded-3xl shadow-2xl w-auto max-w-[95vw] md:max-w-4xl overflow-hidden border border-slate-100 flex flex-col">

                                                {{-- Header Modal --}}
                                                <div class="p-4 border-b flex justify-between items-center bg-white">
                                                    <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                                        Bukti Pengiriman</h3>
                                                    <a href="#"
                                                        class="text-slate-400 hover:text-slate-600 text-2xl font-bold">&times;</a>
                                                </div>

                                                {{-- Kontainer Gambar: max-h-[75vh] agar gambar tidak tenggelam melebihi layar
                                                --}}
                                                <div
                                                    class="bg-slate-50 flex justify-center items-center overflow-hidden max-h-[75vh]">
                                                    <img src="{{ asset('storage/' . $donation->bukti_transfer) }}"
                                                        class="max-w-full max-h-[75vh] object-contain shadow-inner"
                                                        alt="Bukti Transfer">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Tombol Verifikasi --}}
                                    @if($donation->status == 'pending')
                                        <form action="{{ route('admin.donations.verify', $donation->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="p-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all shadow-sm"
                                                onclick="return confirm('Verifikasi donasi ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] text-slate-300 italic font-medium uppercase">Valid</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-medium">Belum ada data donasi.
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
</x-admin-layout>