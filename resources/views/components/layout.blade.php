<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DonasiKita' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30L15 15 0 30l15 15zm0 0l15-15 15 15-15 15zm0 0l15 15-15 15-15-15zm0 0L15 45 0 30l15-15z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <header class="bg-green-700 text-white w-full relative z-50 shadow-md shadow-white/30">
        <div class="container mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/">
                    <span class="text-2xl font-bold tracking-wide">DonasiKita</span></a>
            </div>
            <!-- Nav -->
            <nav class="hidden md:flex items-center space-x-8 font-bold text-sm">
                <div class="flex space-x-6">
                    <a href="/about" class="hover:text-amber-300 transition flex items-center gap-1 group">
                        Tentang Kami
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 opacity-70 group-hover:rotate-180 transition-transform duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    <a href="/login"
                        class="bg-amber-500 text-white px-6 py-2 rounded text-xs font-bold hover:bg-amber-600 transition shadow-lg uppercase tracking-wider inline-block">
                        DONASI
                    </a>
                </div>
            </nav>
        </div>
    </header>

    {{ $slot }}

    <footer class="mt-auto py-6 text-center text-stone-50 text-sm bg-green-700">
        &copy; 2024 DonasiKita
    </footer>

</body>

</html>