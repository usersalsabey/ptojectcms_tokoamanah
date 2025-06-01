<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;


    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'transaksi_detail', 'transaksi_id', 'barang_id')
                    ->withPivot('jumlah', 'harga_satuan');
    }
}
