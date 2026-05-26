<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['user_id', 'resep_id', 'nama_pasien', 'total_harga', 'bukti_pembayaran', 'status_pembayaran', 'tgl_transaksi'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id');
    }

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}
