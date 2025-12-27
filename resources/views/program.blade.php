<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Program Kami</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center p-16 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Program Majelis Ta'lim</h1>
            <p class="text-green-100 opacity-90"> "Mewujudkan generasi yang unggul dalam bidang keagamaan, sosial, dan
                pendidikan."
            </p>
        </div>
    </section>


    <!-- CONTENT -->
    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach($programs as $program)

                <!-- CARD -->
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

                            <!-- MODAL TRIGGER -->
                            <label for="modal-{{ $program->id }}"
                                class="cursor-pointer text-emerald-700 font-bold text-sm hover:underline">
                                Lihat Detail →
                            </label>
                        </div>
                    </div>
                </div>

                <!-- CHECKBOX -->
                <input type="checkbox" id="modal-{{ $program->id }}" class="peer hidden">

                <!-- OVERLAY -->
                <div class="fixed inset-0 z-50 bg-black/50 opacity-0 invisible
                                                   peer-checked:visible peer-checked:opacity-100 transition">

                    <!-- MODAL -->
                    <div class="flex items-center justify-center min-h-screen px-4">

                        <div class="bg-white max-w-2xl w-full max-h-[90vh]
                                                        rounded-2xl shadow-xl p-8 relative
                                                        scale-95 peer-checked:scale-100 transition
                                                        overflow-hidden">

                            <!-- SCROLL AREA -->
                            <div class="max-h-[70vh] overflow-y-auto pr-2">

                                <img src="{{ asset('storage/' . $program->gambar) }}"
                                    class="w-full h-72 object-cover rounded-xl mb-6" alt="{{ $program->nama_program }}">

                                <h2 class="text-2xl font-bold text-green-800 mb-4">
                                    {{ $program->nama_program }}
                                </h2>

                                <p class="text-gray-700 text-base leading-relaxed">
                                    {{ $program->deskripsi }}
                                </p>

                            </div>

                            <!-- TOMBOL TUTUP DI BAWAH -->
                            <div class="mt-6 text-center">
                                <label for="modal-{{ $program->id }}" class="inline-block bg-emerald-600 text-white
                                                                    px-6 py-2 rounded-lg font-semibold
                                                                    cursor-pointer hover:bg-emerald-700 transition">
                                    Tutup
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </main>
</x-layout>