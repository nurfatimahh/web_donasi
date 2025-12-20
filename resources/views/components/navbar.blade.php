{{-- resources/views/components/navbar.blade.php --}}
<header class="bg-green-700 text-white w-full relative z-50 shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="/">
                <span class="text-2xl font-bold tracking-wide">DonasiKita</span>
            </a>
        </div>

        <nav class="hidden md:flex items-center ml-auto space-x-8 font-semibold text-sm p-4"> <a href="/"
                class="hover:text-emerald-200 transition">Home</a>
            <a href="/about" class="hover:text-emerald-200 transition">Tentang Kami</a>
            <a href="/program" class="hover:text-emerald-200 transition">Program</a>
            <a href="/donasi" class="hover:text-emerald-200 transition">Donasi</a>
            <a href="/contact" class="hover:text-emerald-200 transition">Kontak</a>
        </nav>

        <div class="flex items-center space-x-4">
            @auth
                <div class="relative group">
                    <button
                        class="flex items-center space-x-3 bg-green-700 hover:bg-green-800 transition px-4 py-2 rounded-full focus:outline-none border border-emerald-500 shadow-sm">
                        <span class="text-sm font-medium hidden sm:inline">{{ Auth::user()->name }}</span>

                        <div
                            class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-emerald-600 font-bold shadow-inner">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <svg class="w-4 h-4 opacity-70 transition-transform group-hover:rotate-180" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-xl py-2 hidden group-hover:block transition-all z-50 border border-gray-100 overflow-hidden">
                        <div
                            class="px-4 py-2 text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50 bg-gray-50">
                            Menu Pengguna
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2 text-sm hover:bg-emerald-50 hover:text-emerald-600 transition">
                            Profile
                        </a>
                        <hr class="my-1 border-gray-100">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="bg-white text-emerald-600 px-6 py-2 rounded-full font-bold text-sm hover:bg-emerald-50 transition shadow-sm border border-emerald-100">
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</header>