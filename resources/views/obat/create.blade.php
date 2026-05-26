@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Tambah Obat</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Kategori Obat <span class="text-danger">*</span></label>
                    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat') }}" required>
                    @error('nama_obat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" min="0" required>
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" min="0" required>
                    @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Tanggal Expired <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_expired" class="form-control @error('tgl_expired') is-invalid @enderror" value="{{ old('tgl_expired') }}" required>
                    @error('tgl_expired')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="habis" {{ old('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-medium">Gambar Obat</label>
                    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    <div class="form-text">Maksimal ukuran file: 2MB. Format: JPG, PNG, JPEG.</div>
                    @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label fw-medium">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('obat.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
