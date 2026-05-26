<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalObat = Obat::count();
        $totalTransaksi = Transaksi::count();
        $totalUser = User::count();
        $totalResep = Resep::count();

        $transaksiBulanan = Transaksi::selectRaw('MONTH(tgl_transaksi) as bulan, SUM(total_harga) as total')
            ->whereYear('tgl_transaksi', date('Y'))
            ->groupBy('bulan')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('F', mktime(0, 0, 0, $i, 1));
            $found = $transaksiBulanan->firstWhere('bulan', $i);
            $data[] = $found ? $found->total : 0;
        }

        $stokObat = Obat::select('nama_obat', 'stok')->orderBy('stok', 'asc')->limit(5)->get();

        return view('dashboard.index', compact('totalObat', 'totalTransaksi', 'totalUser', 'totalResep', 'labels', 'data', 'stokObat'));
    }
}
