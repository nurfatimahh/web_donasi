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

{{-- Tambahkan x-data sidebarOpen untuk kontrol responsif --}}

<body class="bg-gray-50 min-h-screen text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

    {{-- OVERLAY untuk Mobile (Klik background untuk tutup sidebar) --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
        class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>

    <div class="flex min-h-screen relative">

        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-emerald-700 text-white shadow-xl flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">

            {{-- Logo Area --}}
            <div class="flex items-center justify-between p-6 border-b border-emerald-600">
                <a href="/admin/dashboard" class="block">
                    <span class="text-xl font-extrabold uppercase tracking-tighter">
                        DonasiKita
                    </span>
                </a>
                {{-- Tombol Tutup Sidebar di Mobile --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-emerald-200 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Navigasi --}}
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
                                {{-- Ukuran teks diperkecil ke text-sm agar proporsional --}}
                                <span class="text-sm tracking-wide">{{ $menu['label'] }}</span>
                            </a>
                @endforeach
            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-5 border-t border-emerald-600">
                <p class="text-[10px] text-emerald-200 text-center uppercase tracking-[0.2em] font-bold">
                    Sistem v1.0
                </p>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0 transition-all duration-300">

            {{-- HEADER --}}
            <header
                class="bg-white border-b border-gray-200 px-4 sm:px-8 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">

                <div class="flex items-center gap-4">
                    {{-- Tombol Hamburger (Mobile Only) --}}
                    <button @click="sidebarOpen = true"
                        class="lg:hidden text-slate-500 hover:text-emerald-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    {{-- TOMBOL KEMBALI & JUDUL HALAMAN --}}
                    <div class="flex items-center gap-3">
                        <button onclick="history.back()"
                            class="group flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-emerald-50 text-slate-500 hover:text-emerald-600 transition-colors"
                            title="Kembali">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 transform group-hover:-translate-x-0.5 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </button>
                        <h1 class="text-lg sm:text-xl font-bold text-slate-800 tracking-tight line-clamp-1">
                            {{ $pageTitle }}
                        </h1>
                    </div>
                </div>

                {{-- PROFILE DROPDOWN --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 sm:gap-3 hover:bg-gray-50 p-1 pr-2 rounded-full transition-all border border-transparent hover:border-gray-200 outline-none">
                        <div
                            class="w-8 h-8 sm:w-9 sm:h-9 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold border border-emerald-200 text-sm">
                            A
                        </div>
                        <div class="text-left hidden md:block">
                            <p class="text-xs sm:text-sm font-bold text-slate-800 leading-none">Admin</p>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false" x-cloak
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-48 bg-white border border-gray-200 rounded-xl shadow-xl py-2 z-50">

                        <div class="px-4 py-2 border-b border-gray-100 md:hidden">
                            <p class="text-xs font-bold text-slate-800">Administrator</p>
                        </div>

                        <a href="/admin/profile"
                            class="block px-4 py-2 text-sm text-slate-600 hover:bg-gray-50 hover:text-emerald-600 font-medium transition-colors">
                            Lihat Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition-colors">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            {{-- Padding disesuaikan: p-4 di HP, p-8 di Desktop --}}
            <div class="p-4 sm:p-6 lg:p-8 flex-1 bg-gray-50">

                {{-- Alert Sukses --}}
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