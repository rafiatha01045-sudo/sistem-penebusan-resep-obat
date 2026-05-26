<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\KategoriObat;
use App\Http\Requests\StoreObatRequest;
use App\Http\Requests\UpdateObatRequest;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('kategori')->latest()->paginate(10);
        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        $kategori = KategoriObat::all();
        return view('obat.create', compact('kategori'));
    }

    public function store(StoreObatRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('obat', 'public');
        }
        Obat::create($data);
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        $kategori = KategoriObat::all();
        return view('obat.edit', compact('obat', 'kategori'));
    }

    public function update(UpdateObatRequest $request, Obat $obat)
    {
        $data = $request->validated();
        if ($request->hasFile('gambar')) {
            if ($obat->gambar) Storage::disk('public')->delete($obat->gambar);
            $data['gambar'] = $request->file('gambar')->store('obat', 'public');
        }
        $obat->update($data);
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui!');
    }

    public function destroy(Obat $obat)
    {
        if ($obat->gambar) Storage::disk('public')->delete($obat->gambar);
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus!');
    }
}
