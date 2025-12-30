{{-- resources/views/components/admin-layout.blade.php --}}
@props(['title' => 'DonasiKita', 'pageTitle' => ''])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/admin.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-gray-50 min-h-screen text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

    {{-- OVERLAY untuk Mobile --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>

    <div class="flex min-h-screen relative">

        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-emerald-700 text-white shadow-xl flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0  lg:inset-0">

            {{-- Logo Area --}}
            <div class="flex items-center justify-between p-6 border-b border-emerald-600">
                <a href="/admin/dashboard" class="block">
                    <span class="text-xl font-extrabold uppercase tracking-tighter">
                        DonasiKita
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-emerald-200 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Navigasi Sidebar --}}
            <nav class="mt-6 px-3 space-y-1 flex-1 overflow-y-auto">
                @php
                    $menus = [
                        ['url' => '/admin/dashboard', 'label' => 'Dashboard Utama'],
                        ['url' => '/admin/programs', 'label' => 'Aktivitas Majelis'],
                        ['url' => '/admin/needs', 'label' => 'Kebutuhan Material'],
                        ['url' => '/admin/donations', 'label' => 'Transaksi Donasi'],
                    ];
                @endphp

                @foreach($menus as $menu)
                            @php $isActive = request()->is(trim($menu['url'], '/')); @endphp
                            <a href="{{ $menu['url'] }}" class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                                                                                                            {{ $isActive
                    ? 'bg-white text-emerald-700 shadow-md font-bold'
                    : 'hover:bg-emerald-600 text-emerald-50 font-medium hover:translate-x-1' }}">
                                <span class="text-sm tracking-wide">{{ $menu['label'] }}</span>
                            </a>
                @endforeach
            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-5 border-t border-emerald-600">
                <p class="text-[10px] text-emerald-200 text-center uppercase tracking-[0.2em] font-bold">
                    dashboard admin
                </p>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col lg:ml-64 min-w-0 transition-all duration-300">

            {{-- HEADER --}}
            <header
                class="bg-white border-b border-gray-200 px-4 sm:px-8 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">

                <!-- hamburger nav -->
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden text-slate-500 hover:text-emerald-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-lg sm:text-xl font-bold text-slate-800 tracking-tight line-clamp-1">
                        {{ $pageTitle }}
                    </h1>
                </div>
                <div class="flex items-center gap-4">

                    {{-- PROFILE DROPDOWN --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 sm:gap-3 bg- hover:bg-emerald-100 px-2 py-1.5 sm:px-3 sm:py-2 rounded-full border border-transparent hover:border-slate-200 transition-all cursor-pointer focus:outline-none">

                            {{-- LOGIKA FOTO PROFIL --}}
                            @if(Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                                    class="w-8 h-8 sm:w-9 sm:h-9 rounded-full object-cover border border-emerald-200 shadow-sm">
                            @else
                                <div
                                    class="w-8 h-8 sm:w-9 sm:h-9 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold border border-emerald-200 text-xs sm:text-sm uppercase">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            @endif

                            {{-- Nama User --}}
                            <span class="hidden md:block font-bold text-sm text-slate-700 tracking-wide">
                                {{ Auth::user()->name }}
                            </span>
                            {{-- Panah (Arrow) --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400 transition-transform duration-200"
                                :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Isi Dropdown --}}
                        <div x-show="open" @click.away="open = false" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 py-2 z-50 origin-top">

                            {{-- Header Akun --}}
                            <div class="px-4 py-3 border-b border-slate-50">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>
                                <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            {{-- [BARU] Kembali ke Beranda --}}
                            <a href="/"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Kembali ke Beranda
                            </a>

                            <a href="{{ route('profile.index') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 font-semibold transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Lihat Profil
                            </a>

                            <div class="border-t border-slate-100 my-1"></div>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-black transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
            </header>

            {{-- CONTENT AREA --}}
            <div class="p-4 sm:p-6 lg:p-8 flex-1 bg-gray-50">
                @if(session('success'))
                    <div
                        class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-lg shadow-sm flex justify-between items-center animate-fadeIn">
                        <div class="flex items-center gap-3">
                            <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()"
                            class="text-emerald-400 hover:text-emerald-600 font-bold text-xl">&times;</button>
                    </div>
                @endif

                <div class="animate-fadeIn">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>

</html>