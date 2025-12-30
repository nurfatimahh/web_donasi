<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Hubungi Kami - DonasiKita</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center pt-16 pb-32 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Hubungi Kami</h1>
            <p class="text-green-100 opacity-90 max-w-xl mx-auto">
                Tuliskan Saran Anda atau Pertanyaan seputar DonasiKita
            </p>
        </div>
    </section>

    <main class="px-4 relative z-20 -mt-24 mb-20">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-amber-500">

            <div class="grid grid-cols-1 md:grid-cols-2">

                <div class="p-8 md:p-12">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h3>

                    <form action="#" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Nama Lengkap</label>
                                <input type="text"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="Budi Santoso">
                            </div>
                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Email</label>
                                <input type="email"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                    placeholder="email@anda.com">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="block text-gray-600 text-sm font-bold mb-2">Subjek</label>
                            <input type="text"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Contoh: Konfirmasi Donasi">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-600 text-sm font-bold mb-2">Pesan Anda</label>
                            <textarea rows="4"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                                placeholder="Tuliskan pesan atau pertanyaan Anda disini..."></textarea>
                        </div>

                        <button type="submit"
                            class="bg-amber-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-amber-600 transition shadow-md uppercase tracking-wide">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <div class="bg-green-50 p-8 md:p-12 border-l border-green-100 flex flex-col justify-center">

                    <h3 class="text-2xl font-bold text-green-800 mb-6">Informasi Kontak</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi kami melalui informasi di bawah ini. 
                        Kami siap membantu Anda!
                    </p>

                    <div class="space-y-6">

                        <div class="flex items-start space-x-4">
                            <div class="bg-green-200 p-3 rounded-full text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Alamat</h4>
                                <p class="text-gray-600 text-sm mt-1">
                                    Kp.Manglayang <br>
                                    Kab.Bandung Barat, Indonesia
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-green-200 p-3 rounded-full text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Email</h4>
                                <p class="text-gray-600 text-sm mt-1">donasi@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-green-200 p-3 rounded-full text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">WhatsApp / Telepon</h4>
                                <p class="text-gray-600 text-sm mt-1">088210568578</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>