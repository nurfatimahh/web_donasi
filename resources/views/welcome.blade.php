<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Home</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center pt-10 pb-36 px-4 relative z-10">
        <div class="container mx-auto">
            <h3 class="text-amber-300 text-xl md:text-2xl font-bold mb-3 tracking-wide drop-shadow-sm">
                Pembangunan Masjid An-Nurul Fajri
            </h3>
            <h1 class="text-white text-2xl md:text-4xl leading-relaxed font-extrabold drop-shadow-md">
                Mari bersama membangun rumah Allah sebagai pusat ibadah, pembinaan umat, dan persatuan masyarakat.
            </h1>
            <p class="text-green-200 opacity-90 mt-4 mb-6">
                Setiap donasi Anda adalah investasi akhirat yang tak ternilai harganya.
            </p>

            <div class="pt-8 md:pt-10 flex justify-center">
                @auth
                    {{-- Tombol jika sudah login --}}
                    <button type="button" onclick="openModalDonasi('modalDonasi')"
                        class="w-full md:w-fit text-lg md:text-xl font-bold text-white bg-gradient-to-r from-orange-500 to-amber-400 hover:from-orange-600 hover:to-yellow-500 py-4 px-12 rounded-full shadow-xl transform transition-all duration-300 hover:scale-105 active:scale-95 border-4 border-white cursor-pointer">
                        Donasi Sekarang
                    </button>
                @else
                    {{-- Tombol jika belum login --}}
                    <a href="{{ route('login') }}"
                        class="w-full md:w-fit text-lg md:text-xl font-bold text-white bg-gradient-to-r from-orange-500 to-amber-400 py-4 px-12 rounded-full shadow-xl inline-block text-center border-4 border-white">
                        Donasi Sekarang
                    </a>
                @endauth
            </div>
    </section>




    <!-- Konten -->
    <main class="px-4 relative z-20 -mt-32 mb-20">


        <!-- <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-10 md:p-14 text-center mb-12">
            <p id="ayah-arabic" class="text-gray-600 text-2xl md:text-3xl leading-relaxed mb-6 font-serif">
                ...
            </p>

            <div class="inline-block mb-8">
                <p id="ayah-info" class="text-green-800 font-bold text-lg bg-green-50 px-4 py-2 rounded-lg">
                    Memuat Ayat...
                </p>
            </div>

            <p id="ayah-translation" class="text-gray-600 text-lg md:text-xl leading-relaxed mb-4 italic">
                "..."
            </p>

            <div class="inline-block">
                <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">
                    Qur'an Jariyah Digital
                </p>
            </div>
        </div>

        <p class="text-gray-600 text-lg md:text-xl leading-relaxed mb-4 italic">
            “Apabila seseorang meninggal dunia, maka terputuslah amalnya kecuali tiga perkara:
            sedekah jariyah, ilmu yang bermanfaat, dan anak shalih yang mendoakannya.”
        </p>

        <div class="inline-block">
            <p class="text-green-800 font-bold text-lg bg-green-50 px-4 py-2 rounded-lg">
                HR. Muslim
            </p>
        </div>
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <p class="text-gray-600 leading-relaxed text-left">
                        Majelis Ta'lim Riyadhul Badi'ah yang menaungi pembangunan Masjid
                        An-Nurul Fajri merupakan lembaga pendidikan swadaya yang berdiri
                        pada tanggal 05 Mei 2018. Disebuah rumah kosong milik salah seorang
                        warga Kp. Manglayang RW 03 Desa Cihanjuang Rahayu, dan Gedung
                        pertama didirikan, kemudian diresmikan pada tanggal 15 Maret 2020.
                        Majelis ini sebagai wadah dan menaungi para Santriyin/Santriyat dalam
                        menimba ilmu Agama Islam.
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Melalui partisipasi dan dukungan kaum muslimin dan muslimat, pembangunan masjid ini terus
                        berjalan secara bertahap. Setiap donasi, baik berupa uang maupun material, menjadi bagian
                        dari amal jariyah yang pahalanya terus mengalir hingga akhirat.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold text-green-800 mb-4 text-left">
                        Pembangunan Masjid
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Pembangunan Masjid An-Nurul Fajri merupakan ikhtiar bersama dalam menghadirkan sarana ibadah
                        yang layak, nyaman, dan penuh keberkahan bagi masyarakat. Masjid ini diharapkan menjadi pusat
                        ibadah, pendidikan keislaman, serta kegiatan sosial umat.
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Melalui partisipasi dan dukungan kaum muslimin dan muslimat, pembangunan masjid ini terus
                        berjalan secara bertahap. Setiap donasi, baik berupa uang maupun material, menjadi bagian
                        dari amal jariyah yang pahalanya terus mengalir hingga akhirat.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h2 class="text-2xl font-bold text-green-800 mb-4 text-left">
                        Pembangunan Masjid
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Pembangunan Masjid An-Nurul Fajri merupakan ikhtiar bersama dalam menghadirkan sarana ibadah
                        yang layak, nyaman, dan penuh keberkahan bagi masyarakat. Masjid ini diharapkan menjadi pusat
                        ibadah, pendidikan keislaman, serta kegiatan sosial umat.
                    </p>
                    <br>
                    <p class="text-gray-600 leading-relaxed text-left">
                        Melalui partisipasi dan dukungan kaum muslimin dan muslimat, pembangunan masjid ini terus
                        berjalan secara bertahap. Setiap donasi, baik berupa uang maupun material, menjadi bagian
                        dari amal jariyah yang pahalanya terus mengalir hingga akhirat.
                    </p>
                </div>

                <!-- Card Alamat Masjid -->
                {{-- <section class="pb-20">
                    <div class="w-full mx-auto bg-white rounded-2xl shadow-xl p-8 border-t-4 border-green-600">
                        <h2 class="text-2xl font-bold text-green-800 mb-4 text-center">
                            Lokasi & Alamat Masjid
                        </h2>

                        <div class="text-center text-gray-700 space-y-2">
                            <p class="font-semibold">Masjid An-Nurul Fajri</p>
                            <p>Jl. Contoh Alamat No. 123</p>
                            <p>Desa Sukamaju, Kecamatan Sejahtera</p>
                            <p>Kabupaten Bandung, Jawa Barat</p>
                        </div>

                        <div class="mt-6 flex justify-center">
                            <a href="https://maps.google.com" target="_blank"
                                class="inline-block bg-green-600 text-white px-6 py-3 rounded-full font-bold hover:bg-green-700 transition">
                                Lihat di Google Maps
                            </a>
                        </div>
                    </div>
                </section> --}}

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
                        <p>Jl. Contoh Alamat No. 123</p>
                        <p>Desa Sukamaju, Kecamatan Sejahtera</p>
                        <p>Kabupaten Bandung, Jawa Barat</p>
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
        class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 px-4 transition-all duration-300">
        <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative">

            <button onclick="closeModal('modalDonasi')"
                class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl cursor-pointer">&times;</button>

            <h2 class="text-2xl font-bold text-green-800 mb-1 text-center">Form Donasi</h2>
            <p class="text-sm text-gray-500 text-center mb-6">Pembangunan Masjid An-Nurul Fajri</p>

            <form action="{{ route('admin.donations.store') }}" method="POST" id="formDonasi" class="space-y-4"
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
                        <p class="font-bold text-green-700 mb-2 uppercase text-[10px]">Kebutuhan Masjid</p>
                        @foreach($needs as $need)
                            <div class="flex justify-between border-b border-green-100 pb-1 mb-1">
                                <span>{{ $need->nama_barang }}</span>
                                <span class="font-bold text-red-600">Sisa:
                                    {{ $need->target_jumlah - $need->jumlah_terkumpul }} {{ $need->satuan }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase">Pilih Barang</label>
                        <select name="need_id" id="selectNeed"
                            class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none">
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
                    class="w-full bg-orange-500 text-white font-bold py-4 rounded-2xl hover:bg-orange-600 shadow-lg shadow-orange-200 transition-all active:scale-95">
                    Konfirmasi Donasi
                </button>
            </form>
        </div>
    </div>

    <script>//tes javascript
        window.openModalDonasi = function (id) {
            document.getElementById(id).classList.remove('hidden');
        };

        window.closeModal = function (id) {
            document.getElementById(id).classList.add('hidden');
        };

        window.switchTabDonasi = function (mode) {
            const areaUang = document.getElementById('areaUang');
            const areaBarang = document.getElementById('areaBarang');
            const jenisInput = document.getElementById('jenis_donasi');
            const tabUangBtn = document.getElementById('tabUangBtn');
            const tabBarangBtn = document.getElementById('tabBarangBtn');

            const inputNominal = document.getElementById('inputNominal');
            const selectNeed = document.getElementById('selectNeed');
            const inputJumlah = document.getElementById('inputJumlah');

            if (mode === 'barang') {
                areaUang.classList.add('hidden');
                areaBarang.classList.remove('hidden');
                jenisInput.value = 'barang';

                // Update Style Tab
                tabBarangBtn.classList.add('border-green-500', 'bg-green-50');
                tabUangBtn.classList.remove('border-orange-500', 'bg-orange-50');

                // Toggle Required
                inputNominal.required = false;
                selectNeed.required = true;
                inputJumlah.required = true;
            } else {
                areaBarang.classList.add('hidden');
                areaUang.classList.remove('hidden');
                jenisInput.value = 'uang';

                // Update Style Tab
                tabUangBtn.classList.add('border-orange-500', 'bg-orange-50');
                tabBarangBtn.classList.remove('border-green-500', 'bg-green-50');

                // Toggle Required
                inputNominal.required = true;
                selectNeed.required = false;
                inputJumlah.required = false;
            }
        };

    </script>
</x-layout>