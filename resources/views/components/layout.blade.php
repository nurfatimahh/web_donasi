<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DonasiKita' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/donations.js'])
    @vite(['resources/js/surah.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30L15 15 0 30l15 15zm0 0l15-15 15 15-15 15zm0 0l15 15-15 15-15-15zm0 0L15 45 0 30l15-15z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }
    </style>
</head>


<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
@if(session('success'))
    <div id="modalSuccess" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 animate-in fade-in duration-300">
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center transform scale-100 transition-all animate-in zoom-in duration-300">

            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-2">Alhamdulillah!</h3>
            <p class="text-gray-600 mb-8">
                {{ session('success') }}
            </p>

            <button onclick="document.getElementById('modalSuccess').remove()" 
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-lg shadow-green-200">
                Tutup
            </button>
        </div>
    </div>
    @endif
    
    {{ $slot }}
    @if(!request()->is('/', 'login*', 'register*'))
        @auth
            {{-- Tombol untuk yang SUDAH LOGIN (Membuka Modal) --}}
            <button onclick="openModalDonasi('modalDonasiGlobal')"
                class="fixed bottom-6 right-6 z-[60] bg-gradient-to-r from-orange-500 to-amber-400 text-white font-bold py-4 px-6 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 flex items-center gap-3 border-2 border-white group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 animate-bounce" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-lg">Donasi Sekarang</span>
            </button>
        @else
            {{-- Tombol untuk GUEST (Redirect ke Login) --}}
            <a href="{{ route('login') }}"
                class="fixed bottom-6 right-6 z-[60] bg-gradient-to-r from-orange-500 to-amber-400 text-white font-bold py-4 px-6 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 flex items-center gap-3 border-2 border-white group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 animate-bounce" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-lg">Donasi Sekarang</span>
            </a>
        @endauth

        <div id="modalDonasiGlobal"
            class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-black/50 px-4 transition-all duration-300">

            <div class="bg-white w-full max-w-md rounded-3xl shadow-2xl relative flex flex-col max-h-[90vh]">

                <div class="p-8 pb-0">
                    <button onclick="closeModal('modalDonasiGlobal')"
                        class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl cursor-pointer">&times;</button>
                    <h2 class="text-2xl font-bold text-green-800 mb-1 text-center">Form Donasi</h2>
                    <p class="text-sm text-gray-500 text-center mb-6">Pembangunan Masjid An-Nurul Fajri</p>
                </div>

                <div class="overflow-y-auto p-8 pt-0 scrollbar-thin scrollbar-thumb-gray-200">
                    <form action="{{ route('donations.store') }}" method="POST" id="formDonasiGlobal"
                        class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jenis_donasi" id="jenis_donasi_global" value="uang">

                        <div class="flex gap-4 mb-4">
                            <button type="button" id="tabUangBtnGlobal" onclick="switchTabDonasiGlobal('uang')"
                                class="flex-1 py-2 rounded-xl border-2 border-orange-500 bg-orange-50 text-sm font-bold transition-all">
                                Uang Tunai
                            </button>
                            <button type="button" id="tabBarangBtnGlobal" onclick="switchTabDonasiGlobal('barang')"
                                class="flex-1 py-2 rounded-xl border-2 border-gray-100 text-sm font-bold transition-all">
                                Material
                            </button>
                        </div>

                        <div class="text-left">
                            <label class="block text-xs font-bold text-gray-400 uppercase">Nama Donatur</label>
                            <input type="text" name="nama_donatur" required placeholder="Hamba Allah"
                                class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div id="areaUangGlobal" class="space-y-4 text-left">
                            <div class="bg-amber-50 p-4 rounded-2xl border border-amber-200">
                                <p class="text-[10px] text-amber-700 font-bold uppercase mb-1">Transfer Rekening BCA</p>
                                <p class="text-xl font-mono font-bold text-amber-900 tracking-wider">4532128840</p>
                                <p class="text-xs text-amber-800 uppercase font-bold">a.n ADE</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Nominal (Rp)</label>
                                <input type="number" name="nominal" id="inputNominalGlobal" placeholder="0" required
                                    class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Upload Bukti Transfer</label>
                                <input type="file" name="bukti_transfer" id="inputBuktiGlobal" accept="image/*"
                                    class="w-full mt-1 p-2 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" required>
                            </div>
                        </div>

                        <div id="areaBarangGlobal" class="hidden space-y-4 text-left">
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
                                <select name="need_id" id="selectNeedGlobal"
                                    class="w-full mt-1 p-3 border border-gray-200 rounded-xl outline-none">
                                    <option value="">-- Pilih Kebutuhan --</option>
                                    @foreach($needs as $need)
                                        <option value="{{ $need->id }}">{{ $need->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Jumlah</label>
                                <input type="number" name="jumlah_barang" id="inputJumlahGlobal" placeholder="Contoh: 10"
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
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cari form donasi global
            const formDonasi = document.getElementById('formDonasiGlobal');
            const successAlert = document.getElementById('success-alert');
            const closeAlertBtn = document.getElementById('close-alert-btn');

            if (formDonasi) {
                formDonasi.addEventListener('submit', function (e) {
                    // Munculkan pertanyaan konfirmasi (OK atau Batal)
                    const konfirmasi = confirm("Apakah Anda yakin data donasi sudah benar dan ingin mengirimnya sekarang?");

                    if (!konfirmasi) {
                        // Jika user klik "Batal" / "Cancel", batalkan pengiriman form
                        e.preventDefault();
                    }
                });
            }
        });
        window.openModalDonasi = function (id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Matikan scroll background
        };

        window.closeModal = function (id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto'; // Aktifkan kembali scroll
        };

        window.switchTabDonasiGlobal = function (mode) {
            const areaUang = document.getElementById('areaUangGlobal');
            const areaBarang = document.getElementById('areaBarangGlobal');
            const jenisInput = document.getElementById('jenis_donasi_global');
            const tabUangBtn = document.getElementById('tabUangBtnGlobal');
            const tabBarangBtn = document.getElementById('tabBarangBtnGlobal');

            // Input fields untuk toggle 'required'
            const inputNominal = document.getElementById('inputNominalGlobal');
            const selectNeed = document.getElementById('selectNeedGlobal');
            const inputJumlah = document.getElementById('inputJumlahGlobal');

            if (mode === 'barang') {
                areaUang.classList.add('hidden');
                areaBarang.classList.remove('hidden');
                jenisInput.value = 'barang';

                // Style Tab
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

                // Style Tab
                tabUangBtn.classList.add('border-orange-500', 'bg-orange-50');
                tabBarangBtn.classList.remove('border-green-500', 'bg-green-50');

                // Toggle Required
                inputNominal.required = true;
                selectNeed.required = false;
                inputJumlah.required = false;
            }
        };
    </script>


    <footer class="mt-auto py-6 text-center text-stone-50 text-sm bg-green-700">
        &copy; 2025 DonasiKita
    </footer>

</body>

</html>