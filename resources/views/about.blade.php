<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Tentang Kami - DonasiKita</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center pt-16 pb-32 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Mengenal Lebih Dekat</h1>
            <p class="text-green-100 opacity-90">Sejarah, visi, dan orang-orang di balik pembangunan ini</p>
        </div>
    </section>

    <main class="px-4 relative z-20 -mt-24 mb-20">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-amber-500">

            <div class="p-8 md:p-12 border-b border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-10 items-center">

                    <div class="flex grid grid-cols-2 gap-5">

                    <div class="relative rounded-xl overflow-hidden shadow-lg h-64 md:h-80">
                        <img src="{{ asset('img/img4.JPG') }}"
                            class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-green-900/20"></div>
                    </div>
                        <div class="relative rounded-xl overflow-hidden shadow-lg h-64 md:h-80">
                        <img src="{{ asset('img/img5.JPG') }}"
                            class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-green-900/20"></div>
                    </div>
                </div>

                    <div class="container mx-auto flex flex-col justify-center">
                        {{-- <h3 class="text-amber-500 font-bold uppercase tracking-wider text-sm mb-2">Sejarah & Tujuan</h3> --}}
                        <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Majelis Ta’lim Riyadhul Badi’ah Masjid An-Nurul Fajri</h2>
                        
                        <p class="text-gray-600 leading-relaxed text-center"> 
                            Dalam menghadapi perkembangan zaman yang semakin pesat, 
                            diperlukan lembaga pendidikan Islam yang mampu menjadi tempat belajar yang nyaman dan aman,
                            didukung sarana dan prasarana yang memadai untuk mengembangkan potensi santriwan dan santriwati 
                            secara optimal. Majelis Ta’lim Riyadhul Badi’ah hadir sebagai lembaga pendidikan berbasis salafi 
                            yang berpedoman pada Pancasila dan Undang-Undang Dasar 1945.
                            Majelis Ta’lim Riyadhul Badi’ah berfungsi sebagai sarana ibadah untuk mendekatkan diri kepada Allah SWT 
                            serta meningkatkan keimanan dan ketakwaan. Selain sebagai wadah syiar dakwah dan penguatan ukhuwah Islamiyah 
                            berlandaskan Ahlussunnah wal Jama’ah, majelis ini juga membina aqidah melalui pengajian rutin, mendidik generasi 
                            muda agar berakhlakul karimah dan berprestasi melalui pendidikan Al-Qur’an, serta membentuk generasi unggul yang siap 
                            berkontribusi positif di masyarakat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="bg-white p-8 rounded-xl shadow-sm border-l-4 border-green-600">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-green-100 p-2 rounded-lg text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Visi Kami</h3>
                        </div>
                        <p class="text-gray-600 italic font-medium">Membangun generasi Manglayang berbasis islami yang
                            unggul dalam bidang
                            keagamaan, sosial, pendidikan dan kemanusiaan. Yang agamis, cerdas, kreatif,
                            visioner dan berkepribadian yang berakhlaqul-karimah.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-sm border-l-4 border-amber-500">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-amber-100 p-2 rounded-lg text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Misi Kami</h3>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start text-gray-600">
                                <span class="text-green-500 mr-2">✓</span>
                                Meningkatkan pendidikan dan pengajaran unggulan pada semua unit disiplin ilmu di bawah
                                naungan Majlis Ta'lim Riyadhul Badi'ah.
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="text-green-500 mr-2">✓</span>
                                Membangun pusat pendidikan, dakwah, sosial dan kemanusiaan yang berbasis pemberdayaan
                                masyarakat.
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="text-green-500 mr-2">✓</span>
                                Membangun citra/kepribadian yang mencintai dan bangga menjadi Muslim serta sebagai warga
                                bangsa Indonesia yang menjadikan Islam
                                sebagai pedoman hidup dan kecintaannya terhadap Tanah air.
                            </li>
                            <li class="flex items-start text-gray-600">
                                <span class="text-green-500 mr-2">✓</span>
                                Menyelenggarakan layanan sosial dan membantu pemberdayaan swadaya masyarakat.
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="p-8 md:p-12 border-b border-gray-100">
                <div class="text-center mb-10">
                    <h2 class="text-2xl font-bold text-gray-800">Tim Pengelola</h2>
                    <p class="text-gray-500">Orang-orang amanah di balik layar</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div class="text-center group">
                        <div
                            class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-green-500 transition">
                            <img src="{{ asset('img/img6.PNG') }}" alt="Ketua" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-lg text-gray-800">nama</h4>
                        <span class="text-sm text-amber-600 font-semibold bg-amber-50 px-3 py-1 rounded-full">Ketua
                            Pembangunan</span>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-green-500 transition">
                            <img src="{{ asset('img/img6.PNG') }}" alt="Bendahara" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-lg text-gray-800">nama</h4>
                        <span
                            class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">Bendahara</span>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-4 overflow-hidden border-4 border-white shadow-lg group-hover:border-green-500 transition">
                            <img src="{{ asset('img/img6.PNG') }}" alt="Relawan" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-bold text-lg text-gray-800">nama</h4>
                        <span class="text-sm text-blue-600 font-semibold bg-blue-50 px-3 py-1 rounded-full">Koord.
                            Relawan</span>
                    </div>

                </div>
            </div>

        </div>
    </main>
</x-layout>