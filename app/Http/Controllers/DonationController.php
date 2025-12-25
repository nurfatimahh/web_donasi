<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Need;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

/**
 * Controller untuk mengelola DATA DONASI
 * (uang & barang)
 */
class DonationController extends Controller
{
    /**
     * READ
     * Menampilkan daftar seluruh donasi
     */
    public function index(Request $request)
    {
        // 1. Query dasar dengan Eager Loading
        $query = Donation::with(['user', 'need']);

        // 2. Logika Pencarian & Filter (Pindahkan dari View ke sini)
        if ($request->search) {
            $query->where('nama_donatur', 'like', '%' . $request->search . '%');
        }
        if ($request->type) {
            $query->where('jenis_donasi', $request->type);
        }

        // 3. Hitung Statistik dari Database (BUKAN dari data dummy)
        $totalUang = Donation::where('status', 'sukses')->where('jenis_donasi', 'uang')->sum('nominal');
        $totalBarang = Donation::where('status', 'sukses')->where('jenis_donasi', 'barang')->sum('jumlah_barang');
        $pendingCount = Donation::where('status', 'pending')->count();

        // 4. Ambil data dengan paginasi
        $donations = Donation::with(['user', 'need'])
            ->latest()
            ->paginate(10);
        return view('admin.donations.index', compact(
            'donations',
            'totalUang',
            'totalBarang',
            'pendingCount'
        ));
    }

    /**
     * CREATE
     * Menampilkan form tambah donasi
     */
    public function create()
    {
        // Ambil daftar kebutuhan untuk donasi barang
        $needs = Need::orderBy('nama_barang')->get();

        return view('admin.donations.create', compact('needs'));
    }

    /**
     * CREATE
     * Menyimpan data donasi baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'nama_donatur' => ['required', 'string', 'max:255'],
            'jenis_donasi' => ['required', 'in:uang,barang'],
            'nominal' => ['nullable', 'integer', 'min:1'],
            'need_id' => ['nullable', 'exists:needs,id'],
            'jumlah_barang' => ['nullable', 'integer', 'min:1'],
            'bukti_transfer' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Ambil user yang sedang login
        $validated['user_id'] = Auth::id();

        // Logika berdasarkan jenis donasi
        if ($validated['jenis_donasi'] === 'uang') {
            // Donasi uang tidak punya jumlah barang
            $validated['jumlah_barang'] = null;
        } else {
            // Donasi barang tidak punya nominal
            $validated['nominal'] = null;
        }

        // Upload bukti transfer jika ada
        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] =
                $request->file('bukti_transfer')->store('donations', 'public');
        }

        // 2. Simpan ke tabel Donations
        // $donation = \App\Models\Donation::create($validated);


        // 3. Update tabel Needs (Store ke Need)
        if ($validated['jenis_donasi'] === 'barang' && $request->need_id) {
            $need = \App\Models\Need::find($request->need_id);
            $need->increment('jumlah_terkumpul', $request->jumlah_barang);
        }

        return redirect()->back()->with('success', 'Terima kasih, donasi berhasil dicatat!');

    }

    /**
     * UPDATE
     * Menampilkan form edit donasi
     */
    public function edit(Donation $donation)
    {
        $needs = Need::orderBy('nama_barang')->get();

        return view('admin.donations.edit', compact('donation', 'needs'));
    }

    /**
     * UPDATE
     * Menyimpan perubahan data donasi
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'nama_donatur' => ['required', 'string', 'max:255'],
            'jenis_donasi' => ['required', 'in:uang,barang'],
            'nominal' => ['nullable', 'integer', 'min:1'],
            'need_id' => ['nullable', 'exists:needs,id'],
            'jumlah_barang' => ['nullable', 'integer', 'min:1'],
            'bukti_transfer' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Update user yang melakukan perubahan
        $validated['user_id'] = Auth::id();

        // Logika jenis donasi
        if ($validated['jenis_donasi'] === 'uang') {
            $validated['jumlah_barang'] = null;
        } else {
            $validated['nominal'] = null;
        }

        // Upload ulang bukti transfer jika diganti
        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] =
                $request->file('bukti_transfer')->store('donations', 'public');
        }

        $donation->update($validated);


        return redirect()->route(view('admin.donations.index'))
            ->with('success', 'Donasi berhasil diperbarui.');
    }

    /**
     * DELETE
     * Menghapus data donasi
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donasi berhasil dihapus.');
    }

    /**
     * pdf reporting
     * Generate PDF report of donations
     */
    public function view_pdf()
    {
        // Mengambil semua data (tanpa pagination agar masuk semua ke PDF)
        $donations = Donation::with(['user', 'need'])->latest()->get();

        // Membuat variabel tanggal
        $date = \Carbon\Carbon::now()->format('d/m/Y');

        // Menghitung total donasi uang
        $totalAmount = $donations->where('jenis_donasi', 'uang')->sum('nominal');

        $mpdf = new \Mpdf\Mpdf();

        // Pastikan path view benar: admin/donations/donation.blade.php
        $html = view('admin.donations.donation', compact('donations', 'date', 'totalAmount'))->render();

        $mpdf->WriteHTML($html);
        return $mpdf->Output('Laporan-Donasi.pdf', 'I');
    }

}