<header class="bg-green-700 text-white w-full relative z-50 shadow-md shadow-white/30">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center">
            <a href="/">
                <span class="text-2xl font-bold tracking-wide">DonasiKita</span></a>
        </div>
        <!-- Nav -->
        <nav class="hidden md:flex items-center space-x-8 font-bold text-sm">
            <a href="/" class="hover:text-amber-300 transition flex items-center gap-1">
                Home
            </a>
            <div class="flex space-x-6">
                <a href="/about" class="hover:text-amber-300 transition flex items-center gap-1 group">
                    Tentang Kami
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>

                <a href="/program" class="hover:text-amber-300 transition flex items-center gap-1">
                    Program
                </a>

                <a href="#" class="hover:text-amber-300 transition flex items-center gap-1">
                    Berita
                </a>

                <a href="/contact" class="hover:text-amber-300 transition flex items-center gap-1">
                    Contact
                </a>

            </div>
            <div class="flex items-center space-x-3 ml-6">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-gray-300 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-300 hover:bg-green-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Login
                    </a>
                @endauth
            </div>
        </nav>
    </div>
</header>