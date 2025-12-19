<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $fillable = [
        'nama_barang',
        'target_jumlah',
        'jumlah_terkumpul',
        'satuan'
    ];

    public function donation() {
        return $this->hasMany(Donation::class);
    }
}
