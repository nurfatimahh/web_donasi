<x-layout>
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tight">Kirim Donasi</h1>
            <p class="text-slate-500 mt-2">Pilih jenis kontribusi Anda untuk membantu sesama.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 max-w-xl mx-auto">
            <form action="/donasi/store" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nama
                        Lengkap</label>
                    <input type="text" name="nama_donatur" placeholder="Nama Anda"
                        class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none transition-all shadow-sm"
                        required>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jenis
                        Donasi</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="jenis_donasi" value="uang" class="peer hidden" checked
                                onchange="pilihJenis('uang')">
                            <div
                                class="flex items-center justify-center gap-2 p-4 border-2 border-slate-100 rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5c.621 0 1.125.504 1.125 1.125v12.75c0 .621-.504 1.125-1.125 1.125H3.75A1.125 1.125 0 0 1 2.625 18.375V5.625C2.625 5.004 3.129 4.5 3.75 4.5Zm6.75 6.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm3-3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                                <span class="text-sm font-bold text-slate-700">Donasi Uang</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="jenis_donasi" value="material" class="peer hidden"
                                onchange="pilihJenis('material')">
                            <div
                                class="flex items-center justify-center gap-2 p-4 border-2 border-slate-100 rounded-2xl peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-5.25v9" />
                                </svg>
                                <span class="text-sm font-bold text-slate-700">Material</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="formUang" class="space-y-6">
                    <div>
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Nominal
                            (Rp)</label>
                        <input type="number" name="nominal" placeholder="Masukan jumlah uang"
                            class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 outline-none shadow-sm">
                    </div>

                    <div>
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Metode
                            Pembayaran</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="metode" value="tf" checked onchange="pilihMetode('tf')">
                                <span class="text-sm text-slate-600">Transfer Bank</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="metode" value="qris" onchange="pilihMetode('qris')">
                                <span class="text-sm text-slate-600">QRIS</span>
                            </label>
                        </div>
                    </div>

                    <div id="inputTf">
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Bukti
                            Transfer</label>
                        <input type="file" name="bukti_transfer"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>

                    <div id="infoQris"
                        class="hidden text-center p-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <p class="text-[10px] font-black text-slate-400 mb-2 uppercase">Scan QRIS</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DonasiMasjid" alt="QRIS"
                            class="mx-auto w-32 h-32 rounded-lg">
                    </div>
                </div>

                <div id="formMaterial" class="hidden space-y-6">
                    <div>
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Pilih
                            Kebutuhan Barang</label>
                        <select name="need_id"
                            class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                            @foreach($needs as $need)
                                <option value="{{ $need->id }}">{{ $need->nama_barang }} (Kurang:
                                    {{ $need->target_jumlah - $need->jumlah_terkumpul }} {{ $need->satuan }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-1.5">Jumlah
                            Barang</label>
                        <input type="number" name="jumlah_barang" placeholder="Contoh: 5"
                            class="w-full border border-slate-200 p-3 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none shadow-sm">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black text-sm hover:bg-slate-800 transition-all shadow-lg active:scale-95 uppercase tracking-widest">
                    Kirim Donasi
                </button>
            </form>
        </div>
    </div>

    <script>
        // Logika Ganti Jenis Donasi (Uang atau Material)
        function pilihJenis(tipe) {
            const uang = document.getElementById('formUang');
            const material = document.getElementById('formMaterial');

            if (tipe === 'uang') {
                uang.classList.remove('hidden');
                material.classList.add('hidden');
            } else {
                uang.classList.add('hidden');
                material.classList.remove('hidden');
            }
        }

        // Logika Ganti Metode Bayar (TF atau QRIS)
        function pilihMetode(metode) {
            const tf = document.getElementById('inputTf');
            const qris = document.getElementById('infoQris');

            if (metode === 'tf') {
                tf.classList.remove('hidden');
                qris.classList.add('hidden');
            } else {
                tf.classList.add('hidden');
                qris.classList.remove('hidden');
            }
        }
    </script>
</x-layout>