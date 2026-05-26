<?php

namespace App\Http\Controllers;

use App\Models\KategoriObat;
use App\Http\Requests\StoreKategoriObatRequest;
use App\Http\Requests\UpdateKategoriObatRequest;

class KategoriObatController extends Controller
{
    public function index()
    {
        $kategori = KategoriObat::latest()->paginate(10);
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(StoreKategoriObatRequest $request)
    {
        KategoriObat::create($request->validated());
        return redirect()->route('kategori.index')->with('success', 'Kategori obat berhasil ditambahkan!');
    }

    public function edit(KategoriObat $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriObatRequest $request, KategoriObat $kategori)
    {
        $kategori->update($request->validated());
        return redirect()->route('kategori.index')->with('success', 'Kategori obat berhasil diperbarui!');
    }

    public function destroy(KategoriObat $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori obat berhasil dihapus!');
    }
}
