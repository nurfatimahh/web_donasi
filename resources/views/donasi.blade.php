<x-layout>
    <div class="flex justify-center">
        <input type="checkbox" id="modal_saklar" class="peer hidden" />
        <div
            class="fixed inset-0 z-50 invisible opacity-0 peer-checked:visible peer-checked:opacity-100 transition-all duration-300 flex items-center justify-center bg-black/50 px-4">

            <div
                class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative translate-y-10 peer-checked:translate-y-0 transition-transform">

                <label for="modal_saklar"
                    class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl cursor-pointer">&times;</label>

                <h2 class="text-2xl font-bold text-green-800 mb-4 text-center">Form Donasi</h2>

                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" required
                            class="w-full mt-1 p-3 border rounded-xl focus:ring-orange-500 outline-none border-gray-200">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Donasi</label>
                        <select class="w-full mt-1 p-3 border rounded-xl bg-white outline-none">
                            <option>Uang Tunai (Rekening BCA) [cite: 9]</option>
                            <option>Material (Semen/Besi/Hebel) </option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 text-white font-bold py-3 rounded-xl hover:bg-orange-600 shadow-md shadow-orange-200">
                        Kirim Sekarang
                    </button>
                </form>
            </div>

            <label for="modal_saklar" class="absolute inset-0 -z-10 cursor-default"></label>
        </div>
    </div>
</x-layout>