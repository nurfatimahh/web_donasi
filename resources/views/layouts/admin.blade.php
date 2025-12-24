{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Donasi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-emerald-600 text-white min-h-screen">
            <div class="p-6 text-xl font-bold border-b border-emerald-600">
                Admin Donasi
            </div>
            <nav class="mt-6 space-y-1">
                <a href="/admin/programs" class="block px-6 py-3 hover:bg-emerald-500">Program Donasi</a>
                <a href="/admin/needs" class="block px-6 py-3 hover:bg-emerald-600">Kebutuhan Material</a>
                <a href="/donations" class="block px-6 py-3 hover:bg-emerald-600">Transaksi Donasi</a>
                <a href="#" class="block px-6 py-3 hover:bg-emerald-600">Laporan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-6 py-3 hover:bg-white-600">Logout</button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                <hr class="border-t border-gray-300 my-4">
                <div class="text-sm text-gray-600">
                    Login sebagai: <span class="font-semibold">Admin</span>
                </div>

            </div>

            <!-- Content -->
            <div class="bg-white p-6 rounded shadow">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>