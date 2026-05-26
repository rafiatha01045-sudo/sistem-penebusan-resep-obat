@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Edit Obat</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Kategori Obat <span class="text-danger">*</span></label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id', $obat->kategori_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                    @error('nama_obat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $obat->harga) }}" min="0" required>
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $obat->stok) }}" min="0" required>
                    @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Tanggal Expired <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_expired" class="form-control @error('tgl_expired') is-invalid @enderror" value="{{ old('tgl_expired', $obat->tgl_expired) }}" required>
                    @error('tgl_expired')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="tersedia" {{ old('status', $obat->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="habis" {{ old('status', $obat->status) == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-medium">Gambar Obat</label>
                    @if($obat->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $obat->gambar) }}" alt="Gambar" width="100" class="rounded border">
                    </div>
                    @endif
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Maksimal ukuran file: 2MB. Kosongkan jika tidak ingin mengubah gambar.</div>
                    @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label fw-medium">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $obat->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update</button>
                <a href="{{ route('obat.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
