<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Program Kami</x-slot:title>

    <section class="bg-green-700 py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-white text-4xl font-extrabold mb-4">Program Majelis Ta'lim</h1>
            <p class="text-green-100 max-w-2xl mx-auto italic">
                "Mewujudkan generasi yang unggul dalam bidang keagamaan, sosial, dan pendidikan."
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1170&auto=format&fit=crop"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-800 mb-2">Pendidikan 180 Santri</h3>
                    <p class="text-gray-600 text-sm">Pembelajaran Al-Qur'an dan ilmu dasar agama bagi santriyin dan
                        santriyat setiap sore hari.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=1064&auto=format&fit=crop"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-800 mb-2">Kajian Rutin Warga</h3>
                    <p class="text-gray-600 text-sm">Majelis ilmu mingguan bagi bapak-bapak dan ibu-ibu di lingkungan
                        Kp. Manglayang.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=1170&auto=format&fit=crop"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-800 mb-2">Sosial & Santunan</h3>
                    <p class="text-gray-600 text-sm">Penyaluran bantuan sosial dan santunan bagi yang membutuhkan
                        sebagai bentuk kepedulian sesama.</p>
                </div>
            </div>

        </div>

        <div class="mt-16 bg-amber-50 rounded-3xl p-8 text-center border-2 border-dashed border-amber-200">
            <h2 class="text-2xl font-bold text-amber-800 mb-4">Ingin Berkontribusi untuk Program Ini?</h2>
            <p class="text-amber-700 mb-6">Setiap donasi Anda membantu operasional pendidikan santri.</p>
            <a href="/"
                class="bg-orange-500 text-white font-bold py-3 px-8 rounded-full hover:bg-orange-600 transition-all">
                Donasi Sekarang
            </a>
        </div>
    </main>
</x-layout>