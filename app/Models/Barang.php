<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'BARANG'; // pakai huruf besar semua sesuai Oracle
    public $timestamps = false;

    protected $fillable = [
        'ID',
        'NAMA_BARANG', // ini disesuaikan
        'STOK',
        'HARGA',
    ];

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'TRANSAKSI_DETAIL', 'BARANG_ID', 'TRANSAKSI_ID')
                    ->withPivot('JUMLAH', 'HARGA_SATUAN');
    }
}
