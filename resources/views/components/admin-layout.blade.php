{{-- resources/views/components/admin-layout.blade.php --}}
@props(['title' => 'DonasiKita', 'pageTitle' => ''])

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/js/admin.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Scrollbar halus */
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


<body class="bg-gray-50 min-h-screen text-slate-900">
    <div class="flex">
        <aside class="w-64 bg-emerald-700 text-white min-h-screen sticky top-0 shadow-xl flex flex-col">
            <a href="/admin/dashboard"
                class="p-6 text-white text-xl font-bold border-b border-emerald-600 hover:bg-emerald-800 transition-all uppercase tracking-tight">
                DonasiKita
            </a>

            <nav class="mt-6 px-4 space-y-1.5 flex-1">
                @php
                    $menus = [
                        ['url' => '/admin/dashboard', 'label' => 'Dashboard Utama', 'icon' => '🏠'],
                        ['url' => '/admin/programs', 'label' => 'Aktivitas Majelis', 'icon' => '📅'],
                        ['url' => '/admin/needs', 'label' => 'Kebutuhan Material', 'icon' => '📦'],
                        ['url' => '/admin/donations', 'label' => 'Transaksi Donasi', 'icon' => '💰'],
                    ];
                @endphp

                @foreach($menus as $menu)
                    <a href="{{ $menu['url'] }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->is(trim($menu['url'], '/')) ? 'bg-white text-emerald-700 shadow-lg font-bold' : 'hover:bg-emerald-600 text-emerald-50' }}">
                        <span class="text-xs">{{ $menu['icon'] }}</span>
                        <span class="text-sm">{{ $menu['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-emerald-600">
                <p class="text-[10px] text-emerald-200 text-center uppercase tracking-widest font-bold">Sistem
                    Administrasi</p>
            </div>
        </aside>

        <main class="flex-1 flex flex-col">
            {{-- HEADER --}}
            <header class="bg-white border-b px-8 py-4 flex justify-between items-center sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-8 flex-1">
                    <h1 class="text-lg font-bold text-slate-800">{{ $pageTitle }}</h1>
                </div>

                {{-- PROFILE DENGAN DROPDOWN --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-3 hover:bg-slate-50 p-1 pr-3 rounded-full transition-all outline-none">
                        <div
                            class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold border border-emerald-200 transition-colors">
                            A
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-sm font-bold text-slate-800 leading-none group-hover:text-emerald-600">Admin
                            </p>
                            <p class="text-[10px] text-slate-400 font-medium mt-1">DonasiKita ▼</p>
                        </div>
                    </button>

                    {{-- Isi Dropdown --}}
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-xl py-2 z-50"
                        style="display: none;">

                        <a href="/admin/profile"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-medium">
                            Lihat Profil
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            <div class="p-8 flex-1">
                {{-- Alert Sukses --}}


                @if(session('success'))
                    <div id="alert"
                        class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                        <div class="flex items-center">
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()"
                            class="text-emerald-500 hover:text-emerald-700 font-bold text-xl">&times;</button>
                    </div>
                @endif
                {{ $slot }}
            </div>
    </div>
    </div>


    </main>
    </div>
    @livewireScripts
</body>

</html>