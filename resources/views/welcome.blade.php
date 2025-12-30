<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home</x-slot:title>


    <section class="bg-green-700 bg-pattern text-center pt-10 pb-36 px-4 relative z-10 overflow-hidden">
        <div class="container mx-auto">
            <h3 id="hero-title"
                class="text-amber-300 text-xl md:text-2xl font-bold mb-3 tracking-wide drop-shadow-sm opacity-0 transform translate-y-10 transition-all duration-700 ease-out">
                Pembangunan Masjid An-Nurul Fajri
            </h3>

            <h1 id="hero-heading"
                class="text-white text-2xl md:text-4xl leading-relaxed font-extrabold drop-shadow-md opacity-0 transform translate-y-10 transition-all duration-700 ease-out">
                Mari bersama membangun rumah Allah sebagai pusat ibadah, pembinaan umat, dan persatuan masyarakat.
            </h1>

            <p id="hero-desc"
                class="text-green-200 opacity-0 mt-4 mb-6 transform translate-y-10 transition-all duration-700 ease-out">
                Setiap donasi Anda adalah investasi akhirat yang tak ternilai harganya.
            </p>

            <div id="hero-btn-container"
                class="pb-4 flex justify-center opacity-0 transform translate-y-10 transition-all duration-500 ease-out">
                @auth
                    <button type="button" onclick="openModalDonasi('modalDonasi')"
                        class="w-fit text-xl font-bold text-white bg-gradient-to-r from-orange-500 to-amber-400 hover:from-orange-600 hover:to-yellow-500 py-4 px-12 rounded-full shadow-xl transform transition-all duration-300 hover:scale-105 active:scale-95 shadow-orange-500/50 border-4 border-white cursor-pointer">
                        Donasi Sekarang
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="w-fit text-xl font-bold text-white bg-gradient-to-r from-orange-500 to-amber-400 hover:from-orange-600 hover:to-yellow-500 py-4 px-12 rounded-full shadow-xl transform transition-all duration-300 hover:scale-105 active:scale-95 shadow-orange-500/50 border-4 border-white cursor-pointer inline-block text-center">
                        Donasi Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </section>




    <!-- Konten -->
    <main class="px-4 relative z-20 -mt-32 mb-20">

        <!-- Ayat-->
        <div id="quran-card" class="max-w-6xl mx-auto bg-white rounded-xl shadow-2xl p-10 md:p-14 text-center mb-12 
            opacity-0 transform translate-y-5 transition-all duration-500 ease-out pointer-events-none">

            <p id="ayah-arabic" class="text-gray-600 text-2xl md:text-3xl leading-relaxed mb-6 font-serif">
            </p>

            <div class="inline-block mb-8">
                <p id="ayah-info" class="text-green-800 font-bold text-lg bg-green-50 px-4 py-2 rounded-lg">
                </p>
            </div>

            <p id="ayah-translation" class="text-gray-600 text-lg md:text-xl leading-relaxed mb-4 italic">
            </p>
        </div>

        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <div class="md:col-span-2 space-y-6">
                                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold text-green-800 mb-4 text-center">
                        Latar Belakang Pembangunan Masjid An - Nurul Fajri
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Dalam menyikapi perkembangan zaman yang begitu pesat, dibutuhkan lembaga
                        pendidikan (dalam hal ini Agama Islam) yang mampu menjadi tempat yang nyaman
                        dan aman dalam proses belajar mengajarnya dengan segala kelengkapan sarana
                        dan prasarananya yang mendukung agar bisa memaksimalkan potensi-potensi
                        Santriyin/Santriyat. Sehingga apa yang sudah diusahakan bisa menghasilkan
                        generasi-generasi harapan kita semua.
                        Majelis Ta'lim Riyadhul Badi'ah merupakan lembaga pendidikan yang berbasis
                        sala fiyang berpedoman pada Pancasila dan Undang-undang Dasar 1945.
                    </p>
                    <br>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <p class="text-gray-600 leading-relaxed text-left">
                        Majelis Ta'lim Riyadhul Badi'ah yang menaungi pembangunan Masjid
                        An-Nurul Fajri yang merupakan lembaga pendidikan swadaya yang berdiri
                        pada tanggal 05 Mei 2018. Disebuah rumah kosong milik salah seorang
                        warga Kp. Manglayang RW 03 Desa Cihanjuang Rahayu, dan Gedung
                        pertama didirikan, kemudian diresmikan pada tanggal 15 Maret 2020.
                        Majelis ini sebagai wadah dan menaungi para Santriyin/Santriyat dalam
                        menimba ilmu Agama Islam.
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Bagi mereka yang membangun tempat ibadah/tempat pendidikan Islam atau
                        menyediakan dana, barang, jasa dan lain-lain untuk pembangunan-pembangunan
                        tersebut, relevan seperti dalam Firman Allah SWT. dalam Q.S. Al-Baqarah ayat 261:
                        ”Perumpamaan nafkah yang dikeluarkan oleh orang-orang yang menafkahkan
                        hartanya dijalan Allah adalah serupa dengan sebutir benih yang menumbuhkan
                        tujuh bulir, pada tiap-tiap bulirnya seratus biji Allah melipat-gandakan (ganjaran)
                        bagi siapa yang Dia kehendaki. Dan Allah Maha Luas Karunia-Nya lagi Maha Mengetahui”.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <p class="text-gray-600 leading-relaxed text-left">
                        Pengadaan Rumah Ibadah/fasilitas pendidikan keagamaan (Islam) termasuk
                        salah satu investasi amal bagi kita semua, yang akan mengalirkan pahala terusmenerus
                        bagi orang-orang yang membangunnya, walau hanya sebutir paku yang
                        ditancapkanya. Karena hal ini salah satu dari tiga amal yang pahalanya akan terus
                        mengalir, seperti apa yang sudah disabdakan oleh Rosulullah SAW. :
                        “Apabila Anak Adam (manusia) meninggal dunia, maka akan putuslah segala amal
                        perbutannya kecuali tiga perkara: Sedekah jariah, ilmu yang bermanfaat dan Anak
                        yang soleh yang mendoakan orang-tuanya”. (HR Muslim)
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Insya Allah, janji itu akan tiba pada kita semua yang sudah berpartisipasi atas
                        pembangunan tersebut.
                        Aamiin
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl border-l-4 border-green-500 sticky top-4">
                <h3 class="text-xl font-bold text-green-800 mb-6 text-center">Masjid An-Nurul Fajri</h3>
                <div class="space-y-4">
                    <img src="{{ asset('img/img1.PNG') }}" class="rounded-xl w-full h-50 object-cover">
                    <img src="{{ asset('img/img2.PNG') }}" class="rounded-xl w-full h-50 object-cover">
                    {{-- <img src="{{ asset('img/img3.PNG') }}" class="rounded-xl w-full h-50 object-cover"> --}}
                </div>
                <div class="w-full mt-6 mx-auto bg-white rounded-2xl shadow-xl p-8 border-t-4 border-green-600">
                    <h2 class="text-2xl font-bold text-green-800 mb-4 text-center">
                        Lokasi & Alamat Masjid
                    </h2>

                    <div class="text-center text-gray-700 space-y-2">
                        <p class="font-semibold">Masjid An-Nurul Fajri</p>
                        <p>Kp Manglayang RT 02 RW 03</p>
                        <p>Desa Cihanjuang Rahayu Kec. Parongpong</p>
                        <p>Kab. Bandung Barat Jawa Barat 40559</p>
                    </div>

                    <div class="mt-6 flex justify-center">
                        <a href="https://maps.google.com" target="_blank"
                            class="inline-block bg-green-600 text-white px-6 py-3 rounded-full font-bold hover:bg-green-700 transition">
                            Lihat di Google Maps
                        </a>
                    </div>
                </div>
            </div>


        </div>


    </main>
    <!-- Form Donasi -->
    <div id="modalDonasi"
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 px-3 transition-all duration-300">

        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl relative flex flex-col max-h-[90vh]">

            <div class="p-5 pb-0">
                <button onclick="closeModal('modalDonasi')"
                    class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl cursor-pointer z-10">&times;</button>

                <h2 class="text-2xl font-bold text-green-800 mb-1 text-center">Form Donasi</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Pembangunan Masjid An-Nurul Fajri</p>
            </div>

            <div class="overflow-y-auto p-5 pt-0 scrollbar-thin scrollbar-thumb-gray-200">
                <form action="{{ route('donations.store') }}" method="POST" id="formDonasi" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="jenis_donasi" id="jenis_donasi" value="uang">

                    <div class="flex gap-4 mb-4">
                        <button type="button" id="tabUangBtn" onclick="switchTabDonasi('uang')"
                            class="flex-1 py-2 rounded-xl border-2 border-orange-500 bg-orange-50 text-sm font-bold transition-all">
                            Uang Tunai
                        </button>
                        <button type="button" id="tabBarangBtn" onclick="switchTabDonasi('barang')"
                            class="flex-1 py-2 rounded-xl border-2 border-gray-100 text-sm font-bold transition-all">
                            Material
                        </button>
                    </div>

                    <div class="text-left">
                        <label class="block text-xs font-bold text-gray-400 uppercase">Nama Donatur</label>
                        <input type="text" name="nama_donatur" required placeholder="Hamba Allah"
                            class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div id="areaUang" class="space-y-4 text-left">
                        <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200">
                            <p class="text-[10px] text-amber-700 font-bold uppercase mb-1">Transfer Rekening BCA</p>
                            <p class="text-xl font-mono font-bold text-amber-900 tracking-wider">4532128840</p>
                            <p class="text-xs text-amber-800 uppercase font-bold">a.n ADE</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Nominal (Rp)</label>
                            <input type="number" name="nominal" id="inputNominal" placeholder="0" required
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Upload Bukti Transfer
                                (Gambar)</label>
                            <input type="file" name="bukti_transfer" id="inputBukti" accept="image/*"
                                class="w-full mt-1 p-2 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                    </div>

                    <div id="areaBarang" class="hidden space-y-4 text-left">
                        <div class="bg-green-50 p-4 rounded-2xl border border-green-200 text-xs">
                            <p class="font-bold text-green-700 mb-2 uppercase text-[10px]">
                                Kebutuhan Masjid
                            </p>

                            @foreach($needs as $need)
                                <div class="flex justify-between border-b border-green-100 pb-1 mb-1">
                                    <span>{{ $need->nama_barang }}</span>
                                    <span class="font-bold text-red-600">
                                        Sisa: {{ $need->target_jumlah - $need->jumlah_terkumpul }} {{ $need->satuan }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Pilih Barang</label>
                            <select name="need_id" id="selectNeed"
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">-- Pilih Kebutuhan --</option>
                                @foreach($needs as $need)
                                    <option value="{{ $need->id }}">{{ $need->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Jumlah</label>
                            <input type="number" name="jumlah_barang" id="inputJumlah" placeholder="Contoh: 10"
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition-all">
                        Kirim Donasi
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-layout>