<x-layout>
    <x-slot:title>Program Donasi - DonasiKita</x-slot:title>

    <!-- Dummy data -->
    @php
        $programs = [
            (object) [
                'id' => 1,
                'title' => 'Bantu Pendidikan Anak Yatim Piatu',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop',
                'description' => 'Ribuan anak terancam putus sekolah. Mari bantu mereka menggapai cita-cita dengan beasiswa pendidikan yang layak.',
                'target_amount' => 100000000,
                'collected_amount' => 45000000,
                'is_urgent' => true
            ],
            (object) [
                'id' => 2,
                'title' => 'Sedekah Jumat: Berbagi Nasi Bungkus',
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=800&auto=format&fit=crop',
                'description' => 'Rutin setiap hari Jumat kita membagikan makanan gratis untuk kaum dhuafa dan pekerja jalanan di sekitar kita.',
                'target_amount' => 15000000,
                'collected_amount' => 8500000,
                'is_urgent' => false
            ],
            (object) [
                'id' => 3,
                'title' => 'Tanggap Darurat Bencana Banjir Demak',
                'image' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=800&auto=format&fit=crop',
                'description' => 'Bantuan logistik, obat-obatan, dan selimut untuk saudara kita yang terdampak banjir bandang di daerah Demak.',
                'target_amount' => 200000000,
                'collected_amount' => 120000000,
                'is_urgent' => true
            ],
        ];
    @endphp

    <section class="bg-green-700 bg-pattern text-center pt-16 pb-32 px-4 relative z-10">
        <div class="container mx-auto">
            <h3 class="text-amber-300 text-sm font-bold uppercase tracking-widest mb-2">Program Unggulan</h3>
            <h1 class="text-white text-3xl md:text-4xl font-bold mb-4">Salurkan Kebaikan Anda</h1>
            <p class="text-green-100 opacity-90 max-w-2xl mx-auto">
                Pilih program kebaikan yang ingin Anda bantu hari ini.
            </p>
        </div>
    </section>

    <main class="px-4 relative z-20 -mt-24 mb-20">
        <div class="container mx-auto max-w-6xl">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($programs as $program)
                    <div
                        class="bg-white rounded-xl shadow-xl overflow-hidden hover:-translate-y-1 transition duration-300 border border-gray-100 flex flex-col h-full">

                        {{-- GAMBAR --}}
                        <div class="h-48 bg-gray-200 relative overflow-hidden group">
                            <img src="{{ Str::startsWith($program->image, 'http') ? $program->image : ($program->image ? asset('storage/' . $program->image) : 'https://placehold.co/600x400?text=No+Image') }}"
                                alt="{{ $program->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                            @if($program->is_urgent)
                                <div
                                    class="absolute top-0 right-0 bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg shadow-sm">
                                    Mendesak
                                </div>
                            @endif
                        </div>

                        {{-- KONTEN --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="font-bold text-xl text-gray-800 mb-2 line-clamp-2 hover:text-green-700 transition">
                                {{ $program->title }}
                            </h3>

                            <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">
                                {{ Str::limit($program->description, 100) }}
                            </p>

                            {{-- PROGRESS BAR --}}
                            <div class="mb-4 mt-auto">
                                <div class="flex justify-between text-xs font-semibold mb-1">
                                    <span class="text-green-700">Terkumpul: Rp
                                        {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                                    <span class="text-gray-400">Target: Rp
                                        {{ number_format($program->target_amount / 1000000, 0, ',', '.') }}jt</span>
                                </div>

                                @php
                                    $percent = ($program->collected_amount / $program->target_amount) * 100;
                                    $width = $percent > 100 ? 100 : $percent;
                                @endphp

                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $width }}%"></div>
                                </div>
                            </div>

                            <a href="/program/{{ $program->id }}"
                                class="block w-full text-center bg-green-700 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-800 transition shadow-md">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </main>
</x-layout>