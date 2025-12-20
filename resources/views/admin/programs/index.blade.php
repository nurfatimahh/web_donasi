@extends('layouts.admin')

@section('title', 'Program Donasi')
@section('page-title', 'Program Donasi')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600">Daftar program/kegiatan donasi</p>

        <a href="{{ route('admin.programs.create') }}"
            class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-500">
            + Tambah Program
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border w-16">No</th>
                    <th class="px-4 py-2 border">Nama Program</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- 2. Looping data dari controller --}}
                @forelse($programs as $program)
                    <tr class="text-center border-b">
                        {{-- $loop->iteration otomatis bikin nomor urut --}}
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border text-left">{{ $program->nama_program }}</td>
                        <td class="px-4 py-2 border text-left">{{ Str::limit($program->deskripsi, 50) }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline"
                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                            Belum ada data program donasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- 3. Tambahkan link navigasi pagination --}}
    <div class="mt-4">
        {{ $programs->links() }}
    </div>

@endsection