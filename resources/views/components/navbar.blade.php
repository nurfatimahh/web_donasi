<header class="bg-green-700 text-white w-full sticky top-0 z-50 shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="/">
                <span class="text-2xl font-bold tracking-wide">MTRibad</span>
            </a>
        </div>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center ml-auto space-x-8 font-semibold text-md-10">
            <a href="/" class="hover:text-emerald-200 transition">Home</a>
            <a href="/about" class="hover:text-emerald-200 transition">Tentang Kami</a>
            <a href="/program" class="hover:text-emerald-200 transition">Program</a>
            <a href="/contact" class="hover:text-emerald-200 transition">Kontak</a>
        </nav>

        <div class="flex items-center space-x-4 ml-4">
            @auth
                {{--Tombol Lonceng & Dropdown Notifikasi --}}
                <div class="relative">
                    <button onclick="toggleDropdown('notificationDropdown')"
                        class="text-emerald-100 hover:text-white transition-colors mt-1 p-1 relative focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @php $unread = auth()->user()->unreadNotifications->count() ?? 0; @endphp
                        @if ($unread > 0)
                                    <span
                                        class="absolute -top-2 -right-2 inline-flex items-center justify-center min-w-[18px] px-1.5 py-0.5 rounded-full bg-red-500 text-white text-[11px] font-bold">{{
                            $unread }}</span>
                        @endif
                    </button>

                    <div id="notificationDropdown"
                        class="hidden 
                                               fixed top-[80px] left-4 right-4 z-[999] w-auto h-auto max-h-[80vh]
                                               md:absolute md:top-full md:right-0 md:left-auto md:mt-3 md:w-96 md:h-auto md:max-h-none
                                               bg-white rounded-xl shadow-2xl border border-slate-100 overflow-hidden origin-top transition-all animate-in fade-in zoom-in duration-200">

                        <div
                            class="p-3 bg-amber-50 border-b border-amber-100 flex justify-between items-center sticky top-0 bg-opacity-95 backdrop-blur-sm z-10">
                            <h3 class="font-bold text-amber-800 text-sm flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 2a6 6 0 00-6 6v3l-1 2h14l-1-2V8a6 6 0 00-6-6z" />
                                </svg>
                                Notifikasi
                            </h3>
                            <span class="text-[10px] font-bold bg-amber-200 text-amber-800 px-2 py-0.5 rounded-full">
                                {{ auth()->user()->unreadNotifications->count() }} Baru
                            </span>
                        </div>

                        <div class="overflow-y-auto max-h-[60vh] md:max-h-[400px] divide-y divide-slate-50">
                            @php
                                $notifications = auth()->user()->notifications()->latest()->take(10)->get();
                            @endphp

                            @forelse($notifications as $notification)
                                @php
                                    $data = (array) ($notification->data ?? []);
                                    $isUnread = is_null($notification->read_at);

                                    if ($isUnread) {
                                        if (str_contains($data['color'] ?? '', 'red')) {
                                            $itemBg = 'bg-red-50/50';
                                            $hoverClass = 'hover:bg-red-50';
                                            $iconContainer = 'mt-1 p-1.5 bg-red-100 rounded-full text-red-600 h-fit shrink-0';
                                        } elseif (str_contains($data['color'] ?? '', 'green')) {
                                            $itemBg = 'bg-emerald-50/50';
                                            $hoverClass = 'hover:bg-emerald-50';
                                            $iconContainer = 'mt-1 p-1.5 bg-emerald-100 rounded-full text-emerald-600 h-fit shrink-0';
                                        } else {
                                            $itemBg = 'bg-amber-50/50';
                                            $hoverClass = 'hover:bg-amber-50';
                                            $iconContainer = 'mt-1 p-1.5 bg-amber-100 rounded-full text-amber-600 h-fit shrink-0';
                                        }
                                    } else {
                                        $itemBg = 'bg-white';
                                        $hoverClass = 'hover:bg-slate-50';
                                        $iconContainer = 'mt-1 p-1.5 bg-slate-100 rounded-full text-slate-600 h-fit shrink-0';
                                    }
                                @endphp

                                <a href="{{ route('notifications.read', $notification->id) }}"
                                    class="block p-3 {{ $itemBg }} {{ $hoverClass }} transition-colors group">
                                    <div class="flex gap-3">
                                        <div class="{{ $iconContainer }}">
                                            <i
                                                class="fa {{ $data['icon'] ?? 'fa-info-circle' }} {{ $data['color'] ?? 'text-green-500' }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">
                                                {{ $data['pesan'] ?? 'Notifikasi baru' }}
                                            </p>
                                            <p class="text-[12px] text-slate-500 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-8 text-center flex flex-col items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2 opacity-50" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <p class="text-sm">Tidak ada notifikasi.</p>
                                </div>
                            @endforelse
                        </div>

                        <a href="{{ route('notifications.markAllRead') }}"
                            class="block bg-slate-50 p-3 text-center text-xs font-bold text-slate-500 hover:text-emerald-600 hover:bg-slate-100 transition-colors border-t border-slate-100 uppercase tracking-wide">
                            Tandai Semua Dibaca
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <button onclick="toggleDropdown('profileDropdown')"
                        class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-full border border-white/20 transition-all cursor-pointer focus:outline-none">
                        
                        {{-- MODIFIKASI FOTO PROFIL DI SINI --}}
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                alt="Profile" 
                                class="w-8 h-8 rounded-full object-cover shadow-sm border border-white/50">
                        @else
                            <div class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center text-green-900 font-black text-xs uppercase shadow-sm">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        @endif
                        {{-- END MODIFIKASI --}}

                        <span class="hidden md:block font-bold text-sm text-white tracking-wide">
                            {{ Auth::user()->name }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-amber-300 transition-transform duration-200" id="profileArrow" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu Profil --}}
                    <div id="profileDropdown"
                        class="hidden absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 py-2 z-50 origin-top animate-in fade-in zoom-in duration-200">

                        <div class="px-4 py-3 border-b border-slate-50">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        {{-- LOGIKA: Cek apakah user adalah admin --}}
                        {{-- Ganti 'role' dan 'admin' sesuai kolom di database kamu (misal: usertype == 'admin') --}}
                        @if(Auth::user()->role === 'admin')
                            <a href="/admin/dashboard"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Dashboard
                            </a>
                        @endif

                        {{-- Menu Profil (Muncul untuk Admin & User Biasa) --}}
                        <a href="{{ route('profile.index') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        {{-- Menu Logout (Muncul untuk Semua) --}}
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-black transition-colors cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="hidden md:block text-sm font-bold px-6 py-2 rounded-full border-2 border-white bg-white text-emerald-600 transition-all duration-300 ease-in-out hover:bg-emerald-700 hover:text-white hover:border-emerald-700 hover:scale-105">
                    Masuk
                </a>
            @endauth

            {{-- Mobile Menu Toggle --}}
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
                    <div class="px-6 py-4 space-y-4 font-semibold text">
                        <a href="/" class="block hover:text-emerald-200">Home</a>
                        <a href="/about" class="block hover:text-emerald-200">Tentang Kami</a>
                        <a href="/program" class="block hover:text-emerald-200">Program</a>
                        <a href="/contact" class="block hover:text-emerald-200">Kontak</a>
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

{{-- Script Dropdown Lengkap --}}
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const isHidden = dropdown.classList.contains('hidden');

        document.querySelectorAll('[id$="Dropdown"]').forEach(el => {
            el.classList.add('hidden');
        });

        const arrow = document.getElementById('profileArrow');
        if (arrow) arrow.classList.remove('rotate-180');

        if (isHidden) {
            dropdown.classList.remove('hidden');
            if (id === 'profileDropdown' && arrow) {
                arrow.classList.add('rotate-180');
            }
        }
    }

    document.addEventListener('click', function (event) {
        const isButton = event.target.closest('button[onclick^="toggleDropdown"]');
        const isDropdown = event.target.closest('[id$="Dropdown"]');

        if (!isButton && !isDropdown) {
            document.querySelectorAll('[id$="Dropdown"]').forEach(el => {
                el.classList.add('hidden');
            });
            const arrow = document.getElementById('profileArrow');
            if (arrow) arrow.classList.remove('rotate-180');
        }
    });
</script>