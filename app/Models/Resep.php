<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = ['nama_pasien', 'nama_dokter', 'foto_resep', 'tgl_resep', 'status'];

    public function detail_reseps()
    {
        return $this->hasMany(DetailResep::class, 'resep_id');
    }
}
