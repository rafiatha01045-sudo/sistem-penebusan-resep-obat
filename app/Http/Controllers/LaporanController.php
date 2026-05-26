<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;

class LaporanController extends Controller
{
    public function transaksi(Request $request)
    {
        $query = Transaksi::query();
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tgl_transaksi', [$request->start_date, $request->end_date]);
        }
        $transaksis = $query->latest()->get();
        return view('laporan.transaksi', compact('transaksis'));
    }

    public function stok()
    {
        $obats = Obat::with('kategori')->orderBy('stok', 'asc')->get();
        return view('laporan.stok', compact('obats'));
    }
}
