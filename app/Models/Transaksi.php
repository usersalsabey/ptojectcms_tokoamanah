<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Sesuaikan dengan huruf besar semua agar Oracle mengenali
    protected $table = 'TRANSAKSI';
    protected $primaryKey = 'ID'; // sesuaikan jika di Oracle pakai ID huruf besar
    public $timestamps = false;

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'TRANSAKSI_ID');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'TRANSAKSI_DETAIL', 'TRANSAKSI_ID', 'BARANG_ID')
                    ->withPivot('JUMLAH', 'HARGA_SATUAN');
    }
}
