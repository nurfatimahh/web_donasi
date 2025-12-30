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

    @livewire('admin.donation-table')

    {{-- HAPUS DIV INI: Karena pagination sudah ada di dalam file Livewire --}}
    {{-- <div class="mt-4"> {{ $donations->links() }} </div> --}}

</x-admin-layout>