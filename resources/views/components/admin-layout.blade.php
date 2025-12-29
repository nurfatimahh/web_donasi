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
    {{-- Menggunakan Plus Jakarta Sans agar teks besar tetap terlihat elegan --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 5px;
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

<body class="bg-gray-50 min-h-screen text-slate-900 antialiased">
    <div class="flex min-h-screen">

        {{-- SIDEBAR - Menggunakan Emerald 700 sesuai kodingan awal --}}
        <aside class="w-72 bg-emerald-700 text-white sticky top-0 h-screen shadow-xl flex flex-col z-30">
            <div class="p-8 border-b border-emerald-600">
                <a href="/admin/dashboard" class="block">
                    <span class="text-2xl font-black uppercase tracking-tighter">
                        DonasiKita
                    </span>
                </a>
            </div>

            <nav class="mt-8 px-4 space-y-2 flex-1">
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
                            <a href="{{ $menu['url'] }}" class="flex items-center px-6 py-4 rounded-xl transition-all duration-200 
                                    {{ $isActive
                    ? 'bg-white text-emerald-700 shadow-lg font-black scale-[1.02]'
                    : 'hover:bg-emerald-600 text-emerald-50 font-bold hover:translate-x-1' }}">
                                {{-- Ukuran teks diperbesar ke text-lg --}}
                                <span class="text-lg tracking-tight">{{ $menu['label'] }}</span>
                            </a>
                @endforeach
            </nav>

            <div class="p-6 border-t border-emerald-600">
                <p class="text-[10px] text-emerald-200 text-center uppercase tracking-[0.3em] font-black">
                    Sistem Administrasi v1.0
                </p>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0">

            {{-- HEADER --}}
            <header
                class="bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center sticky top-0 z-20 shadow-sm">
                <div>
                    <h1 class="text-xl font-black text-slate-800 tracking-tight">{{ $pageTitle }}</h1>
                </div>

                {{-- PROFILE DROPDOWN --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-3 hover:bg-gray-50 p-1 pr-4 rounded-full transition-all border border-transparent hover:border-gray-200 outline-none">
                        <div
                            class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-black border border-emerald-200">
                            A
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-sm font-black text-slate-800 leading-none">Administrator</p>
                            <p class="text-[10px] text-emerald-600 font-bold mt-1 uppercase tracking-wider">DonasiKita
                            </p>
                        </div>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-52 bg-white border border-gray-200 rounded-2xl shadow-xl py-2 z-50"
                        style="display: none;">

                        <a href="/admin/profile"
                            class="block px-5 py-3 text-sm text-slate-700 hover:bg-gray-50 font-bold transition-colors">
                            Lihat Profil
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50 font-black transition-colors">
                                Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            <div class="p-10 flex-1">
                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div
                        class="bg-emerald-50 border-l-8 border-emerald-500 text-emerald-800 p-5 mb-8 rounded-2xl shadow-sm flex justify-between items-center animate-fadeIn">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">✅</span>
                            <span class="font-bold text-lg">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()"
                            class="text-emerald-500 hover:text-emerald-700 font-black text-2xl">&times;</button>
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