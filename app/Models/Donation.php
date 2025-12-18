<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'nama_donatur',
        'jenis_donasi',
        'nominal',
        'need_id',
        'jumlah_barang',
        'bukti_transfer',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function need(){
        return $this->belongsTo(Need::class);
    }
}
