<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    protected $fillable = ['resep_id', 'obat_id', 'qty'];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
