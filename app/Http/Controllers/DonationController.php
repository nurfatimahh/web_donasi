<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Need;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DonationStatusUpdated;

class DonationController extends Controller
{
    /**
     * Menampilkan daftar seluruh donasi
     */
    public function index(Request $request)
    {
        $query = Donation::with(['user', 'need']);
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('nama_donatur', 'like', '%' . $request->search . '%');
        });
        // Statistik (Hanya menghitung yang SUKSES)
        $totalAmount = Donation::where('status', 'sukses')
            ->where('jenis_donasi', 'uang')
            ->sum('nominal');

        // Total Barang yang benar-benar masuk
        $totalBarang = Donation::where('status', 'sukses')
            ->where('jenis_donasi', 'barang')
            ->sum('jumlah_barang');
        // Menghitung yang masih PENDING
        $pendingCount = Donation::where('status', 'pending')->count();

        // Ambil data terbaru dengan paginasi
        $donations = Donation::with(['user', 'need'])
            ->latest()
            ->paginate(10);

        return view('admin.donations.index', compact(
            'donations',
            'totalAmount',
            'totalBarang',
            'pendingCount'
        ));
    }

    /**
     * Menyimpan data donasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_donatur' => ['required', 'string', 'max:255'],
            'jenis_donasi' => ['required', 'in:uang,barang'],
            'nominal' => ['nullable', 'integer', 'min:1'],
            'need_id' => ['nullable', 'exists:needs,id'],
            'jumlah_barang' => ['nullable', 'integer', 'min:1'],
            'bukti_transfer' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['user_id'] = \Illuminate\Support\Facades\Auth::id();

        // SEMUA jenis donasi status awalnya PENDING
        $validated['status'] = 'pending';

        if ($validated['jenis_donasi'] === 'uang') {
            $validated['jumlah_barang'] = null;
        } else {
            $validated['nominal'] = null;
        }

        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('donations', 'public');
        }

        \App\Models\Donation::create($validated);

        return redirect('/')->with('success', 'Donasi berhasil dikirim dan menunggu verifikasi.');
    }

    /**
     * Fungsi verifikasi untuk Uang dan Barang
     */
    public function verify(\App\Models\Donation $donation)
    {
        if ($donation->status === 'pending') {
            $donation->update(['status' => 'sukses']);

            // Jika yang diverifikasi adalah barang, tambah jumlah terkumpul
            if ($donation->jenis_donasi === 'barang' && $donation->need_id) {
                $donation->need->increment('jumlah_terkumpul', $donation->jumlah_barang);
            }

            // Kirim notifikasi kepada pemilik donasi
            if ($donation->user) {
                $donation->user->notify(new DonationStatusUpdated($donation));
            }

            return redirect()->back()->with('success', 'Donasi berhasil diverifikasi!');
        }

        return redirect()->back()->with('error', 'Donasi sudah diproses.');
    }

    /**
     * Fungsi Reject (Tolak)
     */
    public function reject(Donation $donation)
    {
        if ($donation->status === 'pending') {
            $donation->update(['status' => 'ditolak']);
            // Kirim notifikasi kepada pemilik donasi
            if ($donation->user) {
                $donation->user->notify(new DonationStatusUpdated($donation));
            }

            return redirect()->back()->with('success', 'Donasi telah ditolak.');
        }
        return redirect()->back()->with('error', 'Status donasi tidak valid untuk ditolak.');
    }

    public function edit(Donation $donation)
    {
        $needs = Need::orderBy('nama_barang')->get();
        return view('admin.donations.edit', compact('donation', 'needs'));
    }

    /**
     * Menyimpan perubahan (Update)
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'nama_donatur' => ['required', 'string', 'max:255'],
            'jenis_donasi' => ['required', 'in:uang,barang'],
            'nominal' => ['nullable', 'integer', 'min:1'],
            'need_id' => ['nullable', 'exists:needs,id'],
            'jumlah_barang' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:pending,sukses,ditolak'], // Tambahkan validasi status
        ]);

        if ($request->hasFile('bukti_transfer')) {
            $validated['bukti_transfer'] = $request->file('bukti_transfer')->store('donations', 'public');
        }

        $donation->update($validated);

        if (in_array($validated['status'], ['sukses', 'ditolak']) && $donation->user) {
            $donation->user->notify(new DonationStatusUpdated($donation));
        }

        // PERBAIKAN: Gunakan nama rute yang benar
        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil diperbarui.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dihapus.');
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
