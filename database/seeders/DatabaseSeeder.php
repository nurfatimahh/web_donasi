<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Need;
use App\Models\Donation;
use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============================================
        // SEEDER UNTUK TABEL USERS
        // ============================================

        // Admin user
        User::create([
            'name' => 'Admin Donasi',
            'email' => 'admin@donasikita.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Sample users
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // ============================================
        // SEEDER UNTUK TABEL NEEDS
        // ============================================

        $needs = [
            [
                'nama_barang' => 'Semen',
                'target_jumlah' => 100,
                'jumlah_terkumpul' => 45,
                'satuan' => 'Sak',
            ],
            [
                'nama_barang' => 'Pasir',
                'target_jumlah' => 50,
                'jumlah_terkumpul' => 20,
                'satuan' => 'm³',
            ],
            [
                'nama_barang' => 'Batu Bata',
                'target_jumlah' => 5000,
                'jumlah_terkumpul' => 2500,
                'satuan' => 'Pcs',
            ],
            [
                'nama_barang' => 'Besi Beton',
                'target_jumlah' => 200,
                'jumlah_terkumpul' => 80,
                'satuan' => 'Batang',
            ],
            [
                'nama_barang' => 'Keramik',
                'target_jumlah' => 150,
                'jumlah_terkumpul' => 60,
                'satuan' => 'Box',
            ],
            [
                'nama_barang' => 'Cat Tembok',
                'target_jumlah' => 80,
                'jumlah_terkumpul' => 30,
                'satuan' => 'Kaleng',
            ],
            [
                'nama_barang' => 'Genteng',
                'target_jumlah' => 1000,
                'jumlah_terkumpul' => 400,
                'satuan' => 'Lembar',
            ],
            [
                'nama_barang' => 'Paku',
                'target_jumlah' => 500,
                'jumlah_terkumpul' => 200,
                'satuan' => 'Kg',
            ],
        ];

        foreach ($needs as $need) {
            Need::create($need);
        }

        // ============================================
        // SEEDER UNTUK TABEL PROGRAMS
        // ============================================

        $programs = [
            [
                'nama_program' => 'Renovasi Masjid Al-Ikhlas',
                'deskripsi' => 'Program renovasi masjid untuk memperbaiki atap yang bocor dan memperindah interior masjid. Target donasi untuk pembelian material bangunan dan biaya tukang.',
                'gambar' => null,
                'tanggal_mulai' => '2025-01-01',
                'tanggal_selesai' => '2025-06-30',
            ],
            [
                'nama_program' => 'Pembangunan TPA (Taman Pendidikan Al-Quran)',
                'deskripsi' => 'Membangun gedung TPA untuk kegiatan belajar mengajar Al-Quran bagi anak-anak. Program ini bertujuan untuk meningkatkan kualitas pendidikan agama di lingkungan sekitar.',
                'gambar' => null,
                'tanggal_mulai' => '2025-02-01',
                'tanggal_selesai' => '2025-08-31',
            ],
            [
                'nama_program' => 'Santunan Anak Yatim Ramadhan',
                'deskripsi' => 'Program santunan bulanan untuk anak yatim berupa uang tunai, paket sembako, dan perlengkapan sekolah. Program ini berlangsung selama bulan Ramadhan.',
                'gambar' => null,
                'tanggal_mulai' => '2025-03-01',
                'tanggal_selesai' => '2025-03-31',
            ],
            [
                'nama_program' => 'Bantuan Modal Usaha Kecil',
                'deskripsi' => 'Memberikan bantuan modal usaha untuk warga yang membutuhkan untuk memulai atau mengembangkan usaha kecil mereka. Program ini bertujuan untuk meningkatkan ekonomi masyarakat.',
                'gambar' => null,
                'tanggal_mulai' => '2025-04-01',
                'tanggal_selesai' => '2025-12-31',
            ],
            [
                'nama_program' => 'Pembangunan Sumur Wakaf',
                'deskripsi' => 'Membangun sumur wakaf di daerah yang kesulitan akses air bersih. Program ini akan membantu masyarakat mendapatkan akses air bersih untuk kebutuhan sehari-hari.',
                'gambar' => null,
                'tanggal_mulai' => '2025-05-01',
                'tanggal_selesai' => '2025-10-31',
            ],
            [
                'nama_program' => 'Bantuan Pendidikan Anak Tidak Mampu',
                'deskripsi' => 'Membantu biaya pendidikan untuk anak-anak dari keluarga tidak mampu. Bantuan meliputi biaya SPP, buku pelajaran, seragam, dan perlengkapan sekolah lainnya.',
                'gambar' => null,
                'tanggal_mulai' => '2025-06-01',
                'tanggal_selesai' => '2025-12-31',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }

        // ============================================
        // SEEDER UNTUK TABEL DONATIONS
        // ============================================
        // Catatan: Donation bergantung pada User dan Need, jadi harus dijalankan setelah keduanya

        $users = User::all();
        $needs = Need::all();

        if ($users->isEmpty() || $needs->isEmpty()) {
            $this->command->warn('Pastikan User dan Need sudah dibuat terlebih dahulu!');
            return;
        }

        $donations = [
            // Donasi uang
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Budi Santoso',
                'jenis_donasi' => 'uang',
                'nominal' => 500000,
                'need_id' => null,
                'jumlah_barang' => null,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Siti Nurhaliza',
                'jenis_donasi' => 'uang',
                'nominal' => 1000000,
                'need_id' => null,
                'jumlah_barang' => null,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Ahmad Fauzi',
                'jenis_donasi' => 'uang',
                'nominal' => 250000,
                'need_id' => null,
                'jumlah_barang' => null,
                'bukti_transfer' => null,
                'status' => 'pending',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Dewi Sartika',
                'jenis_donasi' => 'uang',
                'nominal' => 750000,
                'need_id' => null,
                'jumlah_barang' => null,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            // Donasi barang
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Rizki Pratama',
                'jenis_donasi' => 'barang',
                'nominal' => null,
                'need_id' => $needs->where('nama_barang', 'Semen')->first()->id,
                'jumlah_barang' => 10,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Hamba Allah',
                'jenis_donasi' => 'barang',
                'nominal' => null,
                'need_id' => $needs->where('nama_barang', 'Pasir')->first()->id,
                'jumlah_barang' => 5,
                'bukti_transfer' => null,
                'status' => 'pending',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Budi Santoso',
                'jenis_donasi' => 'barang',
                'nominal' => null,
                'need_id' => $needs->where('nama_barang', 'Batu Bata')->first()->id,
                'jumlah_barang' => 500,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Siti Nurhaliza',
                'jenis_donasi' => 'barang',
                'nominal' => null,
                'need_id' => $needs->where('nama_barang', 'Besi Beton')->first()->id,
                'jumlah_barang' => 20,
                'bukti_transfer' => null,
                'status' => 'sukses',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Ahmad Fauzi',
                'jenis_donasi' => 'uang',
                'nominal' => 300000,
                'need_id' => null,
                'jumlah_barang' => null,
                'bukti_transfer' => null,
                'status' => 'ditolak',
            ],
            [
                'user_id' => $users->random()->id,
                'nama_donatur' => 'Dewi Sartika',
                'jenis_donasi' => 'barang',
                'nominal' => null,
                'need_id' => $needs->where('nama_barang', 'Keramik')->first()->id,
                'jumlah_barang' => 15,
                'bukti_transfer' => null,
                'status' => 'pending',
            ],
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}
