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

            @foreach($programs as $program)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transition hover:shadow-xl">
                    <img src="{{ asset('storage/' . $program->gambar) }}" class="w-full h-48 object-cover"
                        alt="{{ $program->nama_program }}">

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-green-800 mb-2">
                            {{ $program->nama_program }}
                        </h3>

                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($program->deskripsi, 100) }}
                        </p>

                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">
                                Aktif
                            </span>
                            <a href="#" class="text-emerald-700 font-bold text-sm hover:underline">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

</x-layout>