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
                {{-- Container Utama Profil --}}
                <div class="relative group">
                    {{-- Tombol Pemicu (Muncul saat Hover) --}}
                    <button
                        class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-full border border-white/20 transition-all cursor-pointer">
                        <div
                            class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center text-green-900 font-black text-xs uppercase shadow-sm">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <span class="hidden md:block font-bold text-sm text-white tracking-wide">
                            {{ Auth::user()->name }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-amber-300 transition-transform group-hover:rotate-180" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div
                        class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 py-2 hidden group-hover:block z-50 transform origin-top animate-in fade-in zoom-in duration-200">

                        <div class="px-4 py-3 border-b border-slate-50">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="/admin/profile"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                            👤 Profil
                        </a>

                        <!-- <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                                📊 Dashboard Saya
                            </a> -->

                        <div class="border-t border-slate-100 my-1"></div>

                        {{-- Logout Form (Sudah Terintegrasi JS Confirm) --}}
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-black transition-colors cursor-pointer">
                                🚪 Logout
                            </button>
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