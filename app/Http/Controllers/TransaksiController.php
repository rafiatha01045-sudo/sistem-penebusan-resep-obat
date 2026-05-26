<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Obat;
use App\Models\Resep;
use App\Http\Requests\StoreTransaksiRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create(Request $request)
    {
        $obats = Obat::where('stok', '>', 0)->where('status', 'tersedia')->get();
        $reseps = Resep::where('status', 'menunggu')->get();
        return view('transaksi.create', compact('obats', 'reseps'));
    }

    public function store(StoreTransaksiRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            
            if ($request->hasFile('bukti_pembayaran')) {
                $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
            }

            $transaksi = Transaksi::create($data);

            if ($request->has('obats')) {
                foreach ($request->obats as $obatData) {
                    $obat = Obat::find($obatData['id']);
                    if ($obat) {
                        DetailTransaksi::create([
                            'transaksi_id' => $transaksi->id,
                            'obat_id' => $obat->id,
                            'qty' => $obatData['qty'],
                            'harga_satuan' => $obat->harga,
                            'subtotal' => $obat->harga * $obatData['qty'],
                        ]);
                        
                        $obat->decrement('stok', $obatData['qty']);
                        if ($obat->stok <= 0) {
                            $obat->update(['status' => 'habis']);
                        }
                    }
                }
            }

            if ($request->resep_id) {
                Resep::find($request->resep_id)->update(['status' => 'selesai']);
            }
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('detail_transaksis.obat');
        return view('transaksi.show', compact('transaksi'));
    }

    public function cetak($id)
    {
        $transaksi = Transaksi::with('detail_transaksis.obat', 'user')->findOrFail($id);
        return view('transaksi.cetak', compact('transaksi'));
    }
}
