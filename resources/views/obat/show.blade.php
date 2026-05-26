@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Detail Obat</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                @if($obat->gambar)
                <img src="{{ asset('storage/' . $obat->gambar) }}" alt="Gambar Obat" class="img-fluid rounded border p-1" style="max-height: 300px; object-fit: cover;">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center text-secondary border mx-auto" style="height: 300px; width: 100%;">
                    <span>Tidak ada gambar</span>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <h3 class="fw-bold mb-3">{{ $obat->nama_obat }}</h3>
                <div class="mb-2">
                    <span class="badge bg-{{ $obat->status == 'tersedia' ? 'primary' : 'secondary' }} rounded-pill">{{ ucfirst($obat->status) }}</span>
                    <span class="badge bg-info rounded-pill">{{ $obat->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                </div>
                <hr>
                <table class="table table-borderless">
                    <tr>
                        <th width="30%" class="text-secondary ps-0">Harga</th>
                        <td class="fw-bold fs-5 text-primary">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-secondary ps-0">Stok</th>
                        <td>{{ $obat->stok }} unit</td>
                    </tr>
                    <tr>
                        <th class="text-secondary ps-0">Tanggal Expired</th>
                        <td>{{ \Carbon\Carbon::parse($obat->tgl_expired)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-secondary ps-0 align-top">Deskripsi</th>
                        <td>{{ $obat->deskripsi ?? 'Tidak ada deskripsi.' }}</td>
                    </tr>
                </table>
                <div class="mt-4">
                    <a href="{{ route('obat.index') }}" class="btn btn-light px-4 border">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
