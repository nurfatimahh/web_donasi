{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto py-10 px-4">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Admin</h1>
        <p class="text-gray-500">Kelola informasi dan foto profil Anda</p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-xl shadow p-6 grid md:grid-cols-3 gap-6">
        
        <!-- Foto Profil -->
        <div class="flex flex-col items-center">
            <img
                id="preview"
                src="https://ui-avatars.com/api/?name=Admin&background=16a34a&color=fff"
                class="w-32 h-32 rounded-full object-cover border-4 border-green-500"
            />

            <label class="mt-4 cursor-pointer text-sm text-green-700 font-semibold">
                Ganti Foto
                <input
                    type="file"
                    class="hidden"
                    accept="image/*"
                    onchange="previewImage(event)"
                />
            </label>
        </div>

        <!-- Form Profil -->
        <div class="md:col-span-2">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Nama</label>
                        <input
                            type="text"
                            value="Admin DonasiKita"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input
                            type="email"
                            value="admin@donasikita.test"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                        />
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Role</label>
                        <input
                            type="text"
                            value="Administrator"
                            disabled
                            class="w-full mt-1 px-4 py-2 border rounded-lg bg-gray-100 text-gray-500"
                        />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Script Preview Foto -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-4">
    
    <!-- Header + Tombol Kembali -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Profil Admin</h1>
            <p class="text-gray-500">Kelola informasi dan foto profil Anda</p>
        </div>

        <!-- Tombol Kembali -->
        <a href="/dashboard"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold transition">
            ← Kembali
        </a>
    </div>

    <!-- Card Profil -->
    <div class="bg-white rounded-xl shadow p-6 grid md:grid-cols-3 gap-6">
        
        <!-- Foto Profil -->
        <div class="flex flex-col items-center">
            <img
                id="preview"
                src="https://ui-avatars.com/api/?name=Admin&background=16a34a&color=ffffff"
                class="w-32 h-32 rounded-full object-cover border-4 border-green-500"
            >

            <label class="mt-4 cursor-pointer text-sm text-green-700 font-semibold">
                Ganti Foto
                <input
                    type="file"
                    class="hidden"
                    accept="image/*"
                    onchange="previewImage(event)"
                >
            </label>
        </div>

        <!-- Form Profil -->
        <div class="md:col-span-2">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Nama</label>
                        <input
                            type="text"
                            value="Admin DonasiKita"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input
                            type="email"
                            value="admin@donasikita.test"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none"
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Role</label>
                        <input
                            type="text"
                            value="Administrator"
                            disabled
                            class="w-full mt-1 px-4 py-2 border rounded-lg bg-gray-100 text-gray-500"
                        >
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        type="button"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Script Preview Foto -->
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>


</body>
</html>


