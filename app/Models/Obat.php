<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = ['kategori_id', 'nama_obat', 'gambar', 'harga', 'stok', 'deskripsi', 'tgl_expired', 'status'];

    public function kategori()
    {
        return $this->belongsTo(KategoriObat::class, 'kategori_id');
    }
}
