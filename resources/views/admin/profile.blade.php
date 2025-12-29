<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

@php
    $isAdmin = auth()->user()->role === 'admin';
@endphp

<div class="max-w-4xl mx-auto py-10 px-4">

    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Profil {{ $isAdmin ? 'Admin' : 'User' }}
            </h1>
            <p class="text-gray-500">
                Kelola informasi dan foto profil Anda
            </p>
        </div>

        <a href="{{ $isAdmin ? '/admin/dashboard' : '/dashboard' }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition">
            ← Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-xl shadow p-6 grid md:grid-cols-3 gap-6">

        <!-- Foto Profil -->
        <div class="flex flex-col items-center">
            <img
                id="preview"
                src="{{ auth()->user()->photo
                    ? asset('storage/' . auth()->user()->photo)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                @class([
                    'w-32 h-32 rounded-full object-cover border-4',
                    'border-green-500' => $isAdmin,
                    'border-blue-500' => ! $isAdmin,
                ])
            >

            <label
                @class([
                    'mt-4 cursor-pointer text-sm font-semibold',
                    'text-green-700' => $isAdmin,
                    'text-blue-700' => ! $isAdmin,
                ])
            >
                Ganti Foto
                <input type="file" class="hidden" accept="image/*" onchange="previewImage(event)">
            </label>
        </div>

        <!-- Form Profil -->
        <div class="md:col-span-2">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-gray-600">Nama</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ auth()->user()->name }}"
                            @class([
                                'w-full mt-1 px-4 py-2 border rounded-lg outline-none focus:ring-2',
                                'focus:ring-green-500' => $isAdmin,
                                'focus:ring-blue-500' => ! $isAdmin,
                            ])
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ auth()->user()->email }}"
                            @class([
                                'w-full mt-1 px-4 py-2 border rounded-lg outline-none focus:ring-2',
                                'focus:ring-green-500' => $isAdmin,
                                'focus:ring-blue-500' => ! $isAdmin,
                            ])
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Role</label>
                        <input
                            type="text"
                            value="{{ $isAdmin ? 'Administrator' : 'User' }}"
                            disabled
                            class="w-full mt-1 px-4 py-2 border rounded-lg bg-gray-100 text-gray-500"
                        >
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        @class([
                            'text-white px-6 py-2 rounded-lg font-semibold transition',
                            'bg-green-600 hover:bg-green-700' => $isAdmin,
                            'bg-blue-600 hover:bg-blue-700' => ! $isAdmin,
                        ])
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = () => document.getElementById('preview').src = reader.result;
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
