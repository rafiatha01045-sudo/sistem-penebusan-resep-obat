@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Detail Resep</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                @if($resep->foto_resep)
                <img src="{{ asset('storage/' . $resep->foto_resep) }}" alt="Foto Resep" class="img-fluid rounded border p-1" style="max-height: 300px; object-fit: cover;">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center text-secondary border mx-auto" style="height: 300px; width: 100%;">
                    <span>Tidak ada foto fisik</span>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <h4 class="fw-bold mb-3">Pasien: {{ $resep->nama_pasien }}</h4>
                <div class="mb-3">
                    <span class="badge bg-primary rounded-pill">Dokter: {{ $resep->nama_dokter }}</span>
                    @php
                        $badgeColor = 'secondary';
                        if($resep->status == 'menunggu') $badgeColor = 'warning text-dark';
                        if($resep->status == 'diproses') $badgeColor = 'primary';
                        if($resep->status == 'selesai') $badgeColor = 'success';
                    @endphp
                    <span class="badge bg-{{ $badgeColor }} rounded-pill">{{ ucfirst($resep->status) }}</span>
                    <span class="badge bg-light text-dark border">{{ \Carbon\Carbon::parse($resep->tgl_resep)->format('d F Y') }}</span>
                </div>
                <hr>
                <h5 class="fw-bold mb-3">Daftar Obat</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse($resep->detail_reseps as $detail)
                            @php 
                                $subtotal = $detail->qty * ($detail->obat->harga ?? 0);
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $detail->obat->nama_obat ?? 'Obat terhapus' }}</td>
                                <td>Rp {{ number_format($detail->obat->harga ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada obat ditambahkan</td>
                            </tr>
                            @endforelse
                            @if($resep->detail_reseps->count() > 0)
                            <tr>
                                <th colspan="3" class="text-end">Estimasi Total:</th>
                                <th class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <a href="{{ route('resep.index') }}" class="btn btn-light px-4 border">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
