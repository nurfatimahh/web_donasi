<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home</x-slot:title>
    <section class="bg-green-700 bg-pattern text-center pt-10 pb-36 px-4 relative z-10">
        <div class="container mx-auto">
            <h3 class="text-amber-300 text-xl font-bold mb-3 tracking-wide drop-shadow-sm">Mari Berbagi</h3>
            <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight drop-shadow-md">
                Setiap Donasi Anda, Menyalakan Harapan Mereka
            </h1>
            <br>
            <div class="pt-10 flex justify-center">
                <label for="modal_saklar"
                    class="w-fit text-xl font-bold text-white bg-gradient-to-r from-orange-500 to-amber-400 hover:from-orange-600 hover:to-yellow-500 py-4 px-12 rounded-full shadow-xl transform transition-all duration-300 hover:scale-105 active:scale-95 shadow-orange-500/50 border-4 border-white cursor-pointer">
                    Donasi Sekarang
                </label>
            </div>
        </div>
    </section>

    <!-- Buat formya -->
    <div class="flex justify-center">
        <input type="checkbox" id="modal_saklar" class="peer hidden" />

        <div
            class="fixed inset-0 z-50 invisible opacity-0 peer-checked:visible peer-checked:opacity-100 transition-all duration-300 flex items-center justify-center bg-black/50 px-4">

            <div
                class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative translate-y-10 peer-checked:translate-y-0 transition-transform">

                <label for="modal_saklar"
                    class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl cursor-pointer">&times;</label>

                <h2 class="text-2xl font-bold text-green-800 mb-1 text-center">Form Donasi</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Pembangunan Masjid An-Nurul Fajri</p>

                <form action="#" method="POST" class="space-y-4">
                    <input type="radio" name="donasi_type" id="tab_uang" class="peer/uang hidden" checked>
                    <input type="radio" name="donasi_type" id="tab_material" class="peer/material hidden">

                    <div class="flex gap-4 mb-4">
                        <label for="tab_uang"
                            class="flex-1 cursor-pointer text-center py-2 rounded-xl border-2 border-gray-100 peer-checked/uang:border-orange-500 peer-checked/uang:bg-orange-50 text-sm font-bold transition-all">
                            Uang Tunai
                        </label>
                        <label for="tab_material"
                            class="flex-1 cursor-pointer text-center py-2 rounded-xl border-2 border-gray-100 peer-checked/material:border-green-500 peer-checked/material:bg-green-50 text-sm font-bold transition-all">
                            Material
                        </label>
                    </div>

                    <div class="text-left">
                        <label class="block text-xs font-bold text-gray-400 uppercase">Nama Donatur</label>
                        <input type="text" name="nama" required placeholder="Hamba Allah"
                            class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div class="hidden peer-checked/uang:block space-y-4 animate-fadeIn text-left">
                        <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200">
                            <p class="text-[10px] text-amber-700 font-bold uppercase mb-1 text-left">Transfer Rekening
                                BCA</p>
                            <p class="text-xl font-mono font-bold text-amber-900 tracking-wider text-left">4532128840
                            </p>
                            <p class="text-xs text-amber-800 uppercase text-left font-bold">a.n ADE </p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Nominal (Rp)</label>
                            <input type="number" name="nominal" placeholder="0"
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                    </div>

                    <div class="hidden peer-checked/material:block space-y-4 animate-fadeIn text-left">
                        <div class="bg-green-50 p-4 rounded-2xl border border-green-200 text-xs">
                            <p class="font-bold text-green-700 mb-2 uppercase text-[10px]">Kebutuhan Masjid
                            </p>
                            <div class="flex justify-between border-b border-green-100 pb-1 mb-1">
                                <span>Semen Padang</span>
                                <span class="font-bold text-red-600">Sisa: 45 Sak</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Besi Beton 12mm</span>
                                <span class="font-bold text-red-600">Sisa: 12 Btg </span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Barang & Jumlah</label>
                            <input type="text" name="material" placeholder="Contoh: 10 Sak Semen"
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-green-500 text-left">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 text-white font-bold py-4 rounded-2xl hover:bg-orange-600 shadow-lg shadow-orange-200 transition-all transform active:scale-95">
                        Konfirmasi Donasi
                    </button>
                </form>
            </div>
            <label for="modal_saklar" class="absolute inset-0 -z-10 cursor-default"></label>
        </div>
    </div>
    <!-- kontennya disini -->
    <main class="px-4 relative z-20 -mt-32 mb-20">
        <!-- <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-10 md:p-14 text-center">

            <p class="text-gray-500 text-lg md:text-xl leading-relaxed mb-8 italic">
                "Jika kamu menampakkan sedekahmu, itu baik. (Akan tetapi,) jika kamu menyembunyikannya dan memberikannya
                kepada orang-orang fakir, itu lebih baik bagimu. Allah akan menghapus sebagian kesalahanmu. Allah
                Mahateliti terhadap apa yang kamu kerjakan."
            </p>

            <div class="inline-block">
                <p class="text-green-800 font-bold text-lg bg-green-50 px-4 py-2 rounded-lg">
                    Al-Baqarah · Ayat 271
                </p>
            </div>
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold text-green-800 mb-4 text-left">Konten?</h2>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Est modi maiores sapiente nisi,
                        pariatur
                        minima aliquam omnis. Delectus facere doloremque inventore saepe corrupti est dolorum veniam
                        nulla!
                        Nam nostrum numquam id quos neque, aliquam porro aliquid deleniti non. Nulla delectus explicabo
                        exercitationem expedita dicta ratione accusamus excepturi?
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Est modi maiores sapiente nisi,
                        pariatur
                        minima aliquam omnis. Delectus facere doloremque inventore saepe corrupti est dolorum veniam
                        nulla!
                        Nam nostrum numquam id quos neque, aliquam porro aliquid deleniti non. Nulla delectus explicabo
                        exercitationem expedita dicta ratione accusamus excepturi?
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl border-l-4 border-green-500 sticky top-4">
                <h3 class="text-xl font-bold text-green-800 mb-6 text-left">Gallery Kegiatan</h3>
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1512970648279-ff3398568f77?q=80&w=1176&auto=format&fit=crop"
                        alt="Gallery 1" class="rounded-xl w-full h-44 object-cover">
                    <img src="https://images.unsplash.com/photo-1512970648279-ff3398568f77?q=80&w=1176&auto=format&fit=crop"
                        alt="Gallery 2" class="rounded-xl w-full h-44 object-cover">
                    <img src="https://images.unsplash.com/photo-1512970648279-ff3398568f77?q=80&w=1176&auto=format&fit=crop"
                        alt="Gallery 3" class="rounded-xl w-full h-44 object-cover">
                </div>
            </div>

        </div>
    </main>

</x-layout>