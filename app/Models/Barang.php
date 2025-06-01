<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $timestamps = false;

    public function transaksi()
{
    return $this->belongsToMany(Transaksi::class, 'transaksi_detail', 'barang_id', 'transaksi_id')
                ->withPivot('jumlah', 'harga_satuan');
}

}
