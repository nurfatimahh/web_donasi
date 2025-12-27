<x-layout>
    <x-navbar></x-navbar>
    <x-slot:title>Program Kami</x-slot:title>

    <section class="bg-green-700 text-center p-16 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Program Majelis Ta'lim</h1>
            <p class="text-green-100 opacity-90">
                "Mewujudkan generasi yang unggul dalam bidang keagamaan, sosial, dan pendidikan."
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border program-card"
                 data-nama="{{ $program->nama_program }}"
                 data-deskripsi="{{ $program->deskripsi }}"
                 data-gambar="{{ asset('storage/' . $program->gambar) }}">
                <img src="{{ asset('storage/' . $program->gambar) }}" class="w-full h-48 object-cover" alt="{{ $program->nama_program }}">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-green-800 mb-2">{{ $program->nama_program }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($program->deskripsi, 100) }}</p>
                    <div class="mt-4 text-right">
                        <button class="open-modal text-emerald-700 font-bold text-sm hover:underline">Lihat Detail →</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- MODAL SATU SAJA -->
        <div id="program-modal" class="fixed inset-0 z-50 bg-black/50 hidden flex items-center justify-center px-4 transition-opacity duration-300" style="opacity:0;">
            <div class="bg-white max-w-2xl w-full rounded-2xl p-8 relative max-h-[90vh] overflow-y-auto scroll-smooth transform scale-95 transition-all duration-300">
                
                <img id="modal-gambar" src="" class="w-full h-72 object-cover rounded-xl mb-6" alt="">
                <h2 id="modal-nama" class="text-2xl font-bold text-green-800 mb-4"></h2>
                <p id="modal-deskripsi" class="text-gray-700 leading-relaxed mb-6"></p>

                <div class="text-center">
                    <button id="modal-close" class="bg-emerald-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-emerald-700">Tutup</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('program-modal');
            const modalNama = document.getElementById('modal-nama');
            const modalDeskripsi = document.getElementById('modal-deskripsi');
            const modalGambar = document.getElementById('modal-gambar');
            const openButtons = document.querySelectorAll('.open-modal');

            openButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.program-card');
                    modalNama.textContent = card.dataset.nama;
                    modalDeskripsi.textContent = card.dataset.deskripsi;
                    modalGambar.src = card.dataset.gambar;

                    modal.classList.remove('hidden');
                    // animate fade in
                    requestAnimationFrame(() => {
                        modal.style.opacity = '1';
                        modal.querySelector('div').style.transform = 'scale(1)';
                    });
                });
            });

            function closeModal() {
                modal.style.opacity = '0';
                modal.querySelector('div').style.transform = 'scale(0.95)';
                setTimeout(() => modal.classList.add('hidden'), 300);
            }

            document.getElementById('modal-close').addEventListener('click', closeModal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // ESC key
            document.addEventListener('keydown', function(e) {
                if(e.key === "Escape" && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
</x-layout>
