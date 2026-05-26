<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriObat extends Model
{
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function obats()
    {
        return $this->hasMany(Obat::class, 'kategori_id');
    }
}
