{{-- resources/views/components/navbar.blade.php --}}
<header class="bg-green-700 text-white w-full relative z-50 shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="/">
                <span class="text-2xl font-bold tracking-wide">MTRibad</span>
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center ml-auto space-x-8 font-semibold text-sm">
            <a href="/" class="hover:text-emerald-200 transition">Home</a>
            <a href="/about" class="hover:text-emerald-200 transition">Tentang Kami</a>
            <a href="/program" class="hover:text-emerald-200 transition">Program</a>
            <a href="/donasi" class="hover:text-emerald-200 transition">Donasi</a>
            <a href="/contact" class="hover:text-emerald-200 transition">Kontak</a>
        </nav>

        <div class="flex items-center space-x-4 ml-4">
            @auth
                {{-- Dropdown Profil (Checkbox Hack) --}}
                <div class="relative">
                    <input type="checkbox" id="menu_profil" class="peer hidden">

                    <label for="menu_profil"
                        class="flex items-center gap-2 hover:bg-green-600 p-1 pr-3 rounded-full transition-all cursor-pointer select-none">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium hidden sm:inline">{{ Auth::user()->name }} ▼</span>
                    </label>

                    {{-- Isi Dropdown (Hanya muncul jika checkbox di atas dicentang) --}}
                    <div class="absolute right-0 mt-2 w-48 bg-white text-slate-700 rounded-xl shadow-xl py-2 z-50 border border-slate-100 
                                    hidden peer-checked:block animate-in fade-in zoom-in duration-200">
                        <a href="/admin/profile" class="block px-4 py-2 text-sm hover:bg-slate-50 font-medium">Profil</a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="hidden md:block text-sm font-bold hover:text-emerald-200 transition">Masuk</a>
            @endauth

            {{-- Mobile Menu Toggle (Checkbox Hack) --}}
            <div class="md:hidden">
                <input type="checkbox" id="mobile_menu_toggle" class="peer hidden">

                <label for="mobile_menu_toggle"
                    class="p-2 rounded-lg hover:bg-green-600 transition cursor-pointer inline-block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </label>

                <div
                    class="fixed inset-x-0 top-[72px] bg-green-800 border-t border-green-600 shadow-xl hidden peer-checked:block md:hidden">
                    <div class="px-6 py-4 space-y-4 font-semibold">
                        <a href="/" class="block hover:text-emerald-200">Home</a>
                        <a href="/about" class="block hover:text-emerald-200">Tentang Kami</a>
                        <a href="/program" class="block hover:text-emerald-200">Program</a>
                        <a href="/donasi" class="block hover:text-emerald-200">Donasi</a>
                        @guest
                            <a href="{{ route('login') }}" class="block text-amber-300 border-t border-green-700 pt-4">Masuk
                                / Daftar</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>