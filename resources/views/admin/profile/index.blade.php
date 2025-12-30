<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Profil {{ auth()->user()->role === 'admin' ? 'Admin' : 'User' }}</h1>
            <p class="text-gray-500">Kelola informasi dan foto profil Anda</p>
        </div>
        {{-- Mengarahkan kembali ke dashboard admin atau user --}}
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('home') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition">
            ← Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tampilan Error Validasi Laravel --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6 grid md:grid-cols-3 gap-6">
        {{-- PENTING: Gunakan route('profile.update') dan method POST --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="md:col-span-3 grid md:grid-cols-3 gap-6">
            @csrf
            <div class="flex flex-col items-center">
                {{-- Foto Profil --}}
                <img id="preview" 
                     src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                     class="w-32 h-32 rounded-full object-cover border-4 {{ auth()->user()->role === 'admin' ? 'border-green-500' : 'border-blue-500' }}">
                
                <label class="mt-4 cursor-pointer text-sm font-semibold {{ auth()->user()->role === 'admin' ? 'text-green-700' : 'text-blue-700' }}">
                    Ganti Foto
                    <input type="file" name="photo" class="hidden" accept="image/*" onchange="previewImage(event)">
                </label>
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama --}}
                    <div>
                        <label class="text-sm text-gray-600">Nama</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 {{ auth()->user()->role === 'admin' ? 'focus:ring-green-500' : 'focus:ring-blue-500' }}">
                         @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    {{-- Email --}}
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 {{ auth()->user()->role === 'admin' ? 'focus:ring-green-500' : 'focus:ring-blue-500' }}">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    {{-- Role (Non-editable) --}}
                    <div>
                        <label class="text-sm text-gray-600">Role</label>
                        <input type="text" value="{{ auth()->user()->role }}" disabled class="w-full mt-1 px-4 py-2 border rounded-lg bg-gray-100 text-gray-500">
                    </div>
                </div>
                
                {{-- Tombol Simpan --}}
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-lg font-semibold {{ auth()->user()->role === 'admin' ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700' }}">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
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