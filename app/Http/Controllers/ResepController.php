<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DetailResep;
use App\Models\Obat;
use App\Http\Requests\StoreResepRequest;
use App\Http\Requests\UpdateResepRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function index()
    {
        $reseps = Resep::latest()->paginate(10);
        return view('resep.index', compact('reseps'));
    }

    public function create()
    {
        $obats = Obat::where('stok', '>', 0)->where('status', 'tersedia')->get();
        return view('resep.create', compact('obats'));
    }

    public function store(StoreResepRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            if ($request->hasFile('foto_resep')) {
                $data['foto_resep'] = $request->file('foto_resep')->store('resep', 'public');
            }
            $resep = Resep::create($data);

            if ($request->has('obats')) {
                foreach ($request->obats as $obatData) {
                    DetailResep::create([
                        'resep_id' => $resep->id,
                        'obat_id' => $obatData['id'],
                        'qty' => $obatData['qty'],
                    ]);
                }
            }
        });

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function show(Resep $resep)
    {
        $resep->load('detail_reseps.obat');
        return view('resep.show', compact('resep'));
    }

    public function edit(Resep $resep)
    {
        $resep->load('detail_reseps');
        $obats = Obat::where('stok', '>', 0)->where('status', 'tersedia')->get();
        return view('resep.edit', compact('resep', 'obats'));
    }

    public function update(UpdateResepRequest $request, Resep $resep)
    {
        DB::transaction(function () use ($request, $resep) {
            $data = $request->validated();
            if ($request->hasFile('foto_resep')) {
                if ($resep->foto_resep) Storage::disk('public')->delete($resep->foto_resep);
                $data['foto_resep'] = $request->file('foto_resep')->store('resep', 'public');
            }
            $resep->update($data);

            if ($request->has('obats')) {
                $resep->detail_reseps()->delete();
                foreach ($request->obats as $obatData) {
                    DetailResep::create([
                        'resep_id' => $resep->id,
                        'obat_id' => $obatData['id'],
                        'qty' => $obatData['qty'],
                    ]);
                }
            }
        });

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }

    public function destroy(Resep $resep)
    {
        if ($resep->foto_resep) Storage::disk('public')->delete($resep->foto_resep);
        $resep->delete();
        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus!');
    }
}
