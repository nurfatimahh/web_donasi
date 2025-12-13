<x-layout>
    <x-slot:title>Registrasi - DonasiKita</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center pt-16 pb-32 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Bergabung dalam Kebaikan</h1>
            <p class="text-green-100 opacity-90">Mulai langkah kecil Anda hari ini untuk dampak yang besar</p>
        </div>
    </section>

    <main class="px-4 relative z-20 -mt-24 mb-20">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-amber-500">

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <span class="text-2xl font-extrabold text-green-700 tracking-tight">DonasiKita</span>
                </div>

                <form action="#" method="POST">
                    @csrf

                    <div class="mb-5 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: Budi Santoso">
                    </div>

                    <div class="mb-5 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" name="username"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Contoh: budi_santoso99">
                    </div>

                    <div class="mb-5 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="nama@email.com">
                    </div>

                    <div class="mb-5 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Minimal 8 karakter">
                    </div>

                    <div class="mb-8 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ulangi Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="Masukkan ulang password">
                    </div>

                    <button type="submit"
                        class="w-full bg-amber-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-amber-600 transition shadow-md uppercase tracking-wide">
                        DAFTAR SEKARANG
                    </button>
                </form>

                <div class="mt-6 text-center text-sm text-gray-500">
                    Sudah punya akun?
                    <a href="/login" class="text-green-700 font-bold hover:underline">Masuk disini</a>
                </div>
            </div>
        </div>
    </main>
</x-layout>