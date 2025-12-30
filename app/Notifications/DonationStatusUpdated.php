<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Donation;

class DonationStatusUpdated extends Notification
{
    use Queueable;

    protected $donation;

    /**
     * Create a new notification instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $status = $this->donation->status;

        $detail = '';

        if ($this->donation->jenis_donasi === 'uang') {
            $detail = 'uang sebesar Rp ' . number_format($this->donation->nominal, 0, ',', '.');
        } else {
            $namaBarang = $this->donation->need->nama_barang ?? 'Barang';
            $jumlah = $this->donation->jumlah_barang;
            $detail = "{$jumlah} {$namaBarang}";
        }

        $pesan = '';
        $icon = '';
        $color = '';

        if ($status === 'sukses') {
            $pesan = "Alhamdulillah, donasi {$detail} Anda telah diterima. Terima kasih orang baik!";
            $icon = 'fa-check-circle';
            $color = 'text-green-500';
        } elseif ($status === 'ditolak') {
            $pesan = "Mohon maaf, verifikasi donasi {$detail} belum berhasil. Mohon cek kembali data / bukti transfer anda.";
            $icon = 'fa-exclamation-circle';
            $color = 'text-red-500';
        }

        return [
            'donation_id' => $this->donation->id,
            'pesan' => $pesan,
            'icon' => $icon,
            'color' => $color,
            'url' => route('history'), // Arahkan ke halaman riwayat donasi pengguna
            'time' => now()->diffForHumans(),
        ];
    }
}
