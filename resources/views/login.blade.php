<x-layout>

    <x-slot:title>Masuk - DonasiKita</x-slot:title>

    <section class="bg-green-700 bg-pattern text-center pt-16 pb-32 px-4 relative z-10">
        <div class="container mx-auto">
            <h1 class="text-white text-3xl font-bold mb-2">Selamat Datang Kembali</h1>
            <p class="text-green-100 opacity-90">Silakan masuk untuk melanjutkan kebaikan Anda</p>
        </div>
    </section>

    <main class="px-4 relative z-20 -mt-24 mb-20">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-amber-500">

            <div class="p-8 md:p-10">
                <div class="text-center mb-8">
                    <span class="text-2xl font-extrabold text-green-700 tracking-tight">DonasiKita</span>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-5 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="nama@email.com" required autofocus>
                    </div>

                    <div class="mb-6 text-left">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                            placeholder="••••••••" required>
                    </div>

                    <button type="submit"
                        class="w-full bg-amber-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-amber-600 transition shadow-md uppercase tracking-wide">
                        MASUK SEKARANG
                    </button>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/5 lg:w-1/4"></span>
                        <a href="#" class="text-xs text-center text-gray-500 uppercase">atau login dengan</a>
                        <span class="border-b w-1/5 lg:w-1/4"></span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('google.login') }}"
                            class="w-full flex justify-center items-center gap-2 px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            Sign in with Google
                        </a>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm text-gray-500">
                    Belum punya akun?
                    <a href="/register" class="text-green-700 font-bold hover:underline">Daftar disini</a>
                </div>
            </div>
        </div>
    </main>
</x-layout>