<x-layout>
    <x-navbar></x-navbar>

    {{-- HEADER BESAR YANG SAMA DENGAN WELCOME.BLADE.PHP --}}
    <section class="bg-green-700 bg-pattern text-center pt-10 pb-48 px-4 relative z-10">
        <div class="container mx-auto">
            <h3 class="text-amber-300 text-xl font-bold mb-3 tracking-wide drop-shadow-sm">Jariah Abadi</h3>
            <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight drop-shadow-md">
                Wujudkan Masjid Impian, Satukan Amal Kita
            </h1>
        </div>
    </section>

    {{-- KONTEN UTAMA DIBUNGKUS DENGAN MARGIN NEGATIF UNTUK OVERLAP --}}
    <main class="px-4 relative z-20 -mt-32 mb-20">
        <div class="max-w-4xl mx-auto">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-lg border-l-4 border-amber-500 mb-10">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-bold text-green-700">Progres Dana Terkumpul</h3>
                    <span class="text-green-700 font-extrabold">37%</span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-amber-500 h-full" style="width: 37%"></div>
                </div>

                <div class="flex justify-between text-sm text-gray-600 font-medium mt-2">
                    <span>Rp 185.000.000</span>
                    <span>Target: Rp 500.000.000</span>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                <h3 class="text-3xl font-bold text-center mb-8 text-gray-800">Pilih Jenis Bantuan Anda</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div class="bg-white p-8 rounded-xl shadow-2xl border-t-8 border-green-700">
                        <div class="text-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-green-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h2 class="text-2xl font-bold mt-3 text-green-700">Donasi Uang Tunai</h2>
                            <p class="text-gray-500 text-sm">Dana akan langsung digunakan untuk membeli material.</p>
                        </div>

                        <form action="#" method="POST">
                            <h4 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Nominal Donasi</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2">Pilih Nominal Cepat:</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button"
                                        class="bg-gray-100 border border-gray-300 text-gray-800 hover:bg-amber-100 hover:border-amber-500 py-3 rounded-lg font-bold transition duration-150">Rp
                                        50.000</button>
                                    <button type="button"
                                        class="bg-gray-100 border border-gray-300 text-gray-800 hover:bg-amber-100 hover:border-amber-500 py-3 rounded-lg font-bold transition duration-150">Rp
                                        100.000</button>
                                    <button type="button"
                                        class="bg-gray-100 border border-gray-300 text-gray-800 hover:bg-amber-100 hover:border-amber-500 py-3 rounded-lg font-bold transition duration-150">Rp
                                        250.000</button>
                                    <button type="button"
                                        class="bg-gray-100 border border-gray-300 text-gray-800 hover:bg-amber-100 hover:border-amber-500 py-3 rounded-lg font-bold transition duration-150">Rp
                                        500.000</button>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="uang_nominal" class="block text-gray-700 font-semibold mb-2">Masukkan
                                    Nominal Lain</label>
                                <input type="text" name="uang_nominal" id="uang_nominal" placeholder="Contoh: 1.000.000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg text-lg focus:ring-amber-500 focus:border-amber-500">
                            </div>

                            <div class="mb-6 border-t pt-4 border-gray-200">
                                <label for="uang_nama" class="block text-gray-700 font-semibold mb-2">Nama Donatur
                                    (Pilihan)</label>
                                <input type="text" name="uang_nama" id="uang_nama"
                                    placeholder="Tulis nama atau 'Hamba Allah'"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                            </div>

                            <button type="button" disabled
                                class="w-full bg-amber-500 text-white font-bold py-3 rounded-lg shadow-md hover:bg-amber-600 transition duration-200 opacity-75 cursor-not-allowed">
                                Lanjut ke Pembayaran Uang
                            </button>
                        </form>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-2xl border-t-8 border-amber-500">
                        <div class="text-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-amber-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h2 class="text-2xl font-bold mt-3 text-amber-500">Donasi Bahan Bangunan</h2>
                            <p class="text-gray-500 text-sm">Kami akan menjemput material di lokasi Anda.</p>
                        </div>

                        <form action="#" method="POST">
                            <h4 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Detail Material</h4>

                            <div class="mb-4">
                                <label for="barang_jenis" class="block text-gray-700 font-semibold mb-2">Jenis
                                    Bahan</label>
                                <select name="barang_jenis" id="barang_jenis"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                                    <option value="">-- Pilih Jenis Bantuan --</option>
                                    <option value="semen">Semen (Sak)</option>
                                    <option value="pasir">Pasir (m³)</option>
                                    <option value="batu_bata">Batu Bata/Batako (Pcs)</option>
                                    <option value="besi">Besi (Batang)</option>
                                    <option value="keramik">Keramik (Box)</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="barang_jumlah"
                                    class="block text-gray-700 font-semibold mb-2">Jumlah/Volume</label>
                                <input type="text" name="barang_jumlah" id="barang_jumlah"
                                    placeholder="Contoh: 50 sak / 3 m³ pasir"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                            </div>

                            <div class="mb-6">
                                <label for="barang_lokasi" class="block text-gray-700 font-semibold mb-2">Alamat
                                    Penjemputan</label>
                                <textarea name="barang_lokasi" id="barang_lokasi" rows="3"
                                    placeholder="Alamat lengkap lokasi bahan bangunan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500"></textarea>
                            </div>

                            <div class="mb-6 border-t pt-4 border-gray-200">
                                <label for="barang_nama" class="block text-gray-700 font-semibold mb-2">Nama Donatur
                                    (Pilihan)</label>
                                <input type="text" name="barang_nama" id="barang_nama"
                                    placeholder="Tulis nama atau 'Hamba Allah'"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500">
                            </div>

                            <button type="button" disabled
                                class="w-full bg-green-700 text-white font-bold py-3 rounded-lg shadow-md hover:bg-green-800 transition duration-200 opacity-75 cursor-not-allowed">
                                Konfirmasi Donasi Material
                            </button>
                        </form>
                    </div>
                </div> {{-- Akhir Grid Dua Kolom --}}
            </div>
        </div>
    </main>
</x-layout>