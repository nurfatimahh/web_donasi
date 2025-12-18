<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_donatur',
        'jenis_donasi',       // uang | material
        'nominal',            // untuk donasi uang
        'need_id',            // nullable (jika donasi material)
        'jumlah_barang',      // jumlah material
        'bukti_transfer',
        'status'              // pending | sukses | ditolak
    ];

    /**
     * Relasi:
     * Donasi dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi:
     * Donasi material mengarah ke satu kebutuhan
     */
    public function need()
    {
        return $this->belongsTo(Need::class);
    }
}
