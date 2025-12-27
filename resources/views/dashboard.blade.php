<x-layout pageTitle="Dashboard">
    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- Header Dashboard --}}
        <div class="mb-12">
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Dashboard</h2>
            <p class="text-slate-500 mt-2 font-medium text-lg">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

            {{-- KOLOM KIRI: EDIT PROFIL --}}
            <div class="lg:col-span-1 space-y-6">
                <div
                    class="bg-white rounded-[40px] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-slate-100 p-8">
                    <h3 class="text-xl font-bold text-slate-800 mb-8">Pengaturan Profil</h3>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PATCH')

                        {{-- Upload Foto --}}
                        <div class="flex flex-col items-center mb-8">
                            <div class="relative group">
                                <img id="preview-photo"
                                    src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff&size=128' }}"
                                    alt="Profile"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-emerald-50 shadow-lg">

                                <label for="photo-input"
                                    class="absolute bottom-0 right-0 bg-emerald-600 p-2 rounded-full text-white shadow-lg cursor-pointer hover:scale-110 transition-all border-2 border-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                                <input type="file" name="photo" id="photo-input" class="hidden" accept="image/*"
                                    onchange="previewImage(event)">
                            </div>
                            <p class="text-[10px] text-slate-400 mt-4 uppercase font-bold tracking-widest">Klik ikon
                                kamera untuk ganti foto</p>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold text-slate-700 transition-all">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label
                                class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Alamat
                                Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                class="w-full p-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-emerald-500 outline-none font-bold text-slate-700 transition-all">
                        </div>

                        <button type="submit"
                            class="w-full bg-slate-900 text-white font-bold py-4 rounded-2xl hover:bg-black shadow-xl shadow-slate-200 transition-all active:scale-95">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            {{-- KOLOM KANAN: RIWAYAT DONASI --}}
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white rounded-[40px] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
                    <div class="p-10 border-b border-slate-50 flex justify-between items-center bg-white">
                        <h3 class="text-xl font-bold text-slate-800">Riwayat Donasi</h3>
                        <span
                            class="bg-emerald-50 text-emerald-600 text-[11px] font-black px-4 py-2 rounded-full uppercase">
                            Total: {{ $myDonations->count() }} Transaksi
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead
                                class="bg-slate-50/50 text-slate-400 text-[10px] uppercase tracking-[0.2em] font-black">
                                <tr>
                                    <th class="px-10 py-5">Waktu</th>
                                    <th class="px-10 py-5">Kategori</th>
                                    <th class="px-10 py-5">Kontribusi</th>
                                    <th class="px-10 py-5 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($myDonations as $donation)
                                    <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                                        <td class="px-10 py-6">
                                            <p class="text-slate-900 font-bold text-sm">
                                                {{ $donation->created_at->format('d M Y') }}</p>
                                            <p class="text-slate-400 text-[10px] font-medium italic mt-0.5">ID:
                                                #{{ $donation->id }}</p>
                                        </td>
                                        <td class="px-10 py-6">
                                            <span
                                                class="inline-flex px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $donation->jenis_donasi == 'uang' ? 'bg-amber-100 text-amber-700' : 'bg-indigo-100 text-indigo-700' }}">
                                                {{ $donation->jenis_donasi }}
                                            </span>
                                        </td>
                                        <td class="px-10 py-6">
                                            @if($donation->jenis_donasi == 'uang')
                                                <p class="text-slate-900 font-extrabold text-base italic">Rp
                                                    {{ number_format($donation->nominal, 0, ',', '.') }}</p>
                                            @else
                                                <p class="text-slate-900 font-extrabold text-sm">{{ $donation->jumlah_barang }}
                                                    {{ $donation->need->satuan ?? 'Unit' }}</p>
                                                <p class="text-slate-500 text-[10px] font-medium">
                                                    {{ $donation->need->nama_barang }}</p>
                                            @endif
                                        </td>
                                        <td class="px-10 py-6">
                                            <div class="flex justify-center">
                                                @if($donation->status == 'pending')
                                                    <span
                                                        class="text-orange-500 font-black text-[10px] uppercase flex items-center gap-2">
                                                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-ping"></span>
                                                        Verifikasi
                                                    </span>
                                                @elseif($donation->status == 'verified')
                                                    <span
                                                        class="text-blue-600 font-black text-[10px] uppercase flex items-center gap-2">
                                                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Diterima
                                                    </span>
                                                @else
                                                    <span
                                                        class="text-emerald-600 font-black text-[10px] uppercase flex items-center gap-2">
                                                        <span
                                                            class="w-2 h-2 bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                                        Disalurkan
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-10 py-20 text-center">
                                            <p class="text-slate-400 font-medium italic">Belum ada riwayat kontribusi.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Preview Foto --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('preview-photo');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-layout>