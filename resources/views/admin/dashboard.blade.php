@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="mb-8 p-6 bg-emerald-100 border-l-4 border-emerald-600 rounded">
        <h2 class="text-2xl font-bold text-emerald-800">Selamat datang, Admin!</h2>
        <p class="text-emerald-700">Panel kendali sistem donasi Anda sudah siap. Silakan kelola program dan pantau transaksi
            masuk melalui menu di samping.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow border hover:shadow-md transition-shadow">
            <div class="text-gray-500 text-sm font-bold uppercase">Total Program</div>
            <div class="text-3xl font-bold text-emerald-600">12</div>
        </div>
        <div class="bg-white p-6 rounded shadow border hover:shadow-md transition-shadow">
            <div class="text-gray-500 text-sm font-bold uppercase">Kebutuhan Material</div>
            <div class="text-3xl font-bold text-blue-600">45</div>
        </div>
        <div class="bg-white p-6 rounded shadow border hover:shadow-md transition-shadow">
            <div class="text-gray-500 text-sm font-bold uppercase">Total Transaksi</div>
            <div class="text-3xl font-bold text-orange-600">1,250</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-5 rounded shadow border">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Program Terbaru</h3>
            <ul class="space-y-3">
                <li class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                    <span class="text-gray-700 font-medium">Donasi Pembangunan Masjid Al-Ikhlas</span>
                    <span class="text-gray-400">20/12/2023</span>
                </li>
                <li class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                    <span class="text-gray-700 font-medium">Santunan 100 Anak Yatim Piatu</span>
                    <span class="text-gray-400">18/12/2023</span>
                </li>
            </ul>
        </div>

        <div class="bg-white p-5 rounded shadow border">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Donasi Terakhir</h3>
            <ul class="space-y-3">
                <li class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                    <div>
                        <p class="font-semibold text-gray-700">Hamba Allah</p>
                        <p class="text-xs text-gray-500">Uang Tunai</p>
                    </div>
                    <span class="font-bold text-emerald-600">Rp 500,000</span>
                </li>
                <li class="flex justify-between items-center text-sm border-b border-gray-50 pb-2">
                    <div>
                        <p class="font-semibold text-gray-700">Siti Maryam</p>
                        <p class="text-xs text-gray-500">Barang (Sembako)</p>
                    </div>
                    <span class="font-bold text-emerald-600">20 Paket</span>
                </li>
            </ul>
        </div>
    </div>
@endsection