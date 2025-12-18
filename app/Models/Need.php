<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'target_jumlah',
        'jumlah_terkumpul',
        'satuan'
    ];

    /**
     * Relasi:
     * 1 kebutuhan material bisa menerima banyak donasi
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
