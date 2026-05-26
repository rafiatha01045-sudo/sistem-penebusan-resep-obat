@extends('layouts.app')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <h4 class="mb-0 text-dark fw-bold">Detail Transaksi #{{ $transaksi->id }}</h4>
    <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank" class="btn btn-outline-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16"><path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/><path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/></svg>
        Cetak Struk
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Item Pembelian</h5>
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
                            @foreach($transaksi->detail_transaksis as $detail)
                            <tr>
                                <td>{{ $detail->obat->nama_obat ?? 'Obat terhapus' }}</td>
                                <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="3" class="text-end">Total Akhir:</th>
                                <th class="text-primary fs-5">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Informasi Transaksi</h5>
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted">Tanggal</td>
                        <td class="text-end fw-medium">{{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->format('d F Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kasir</td>
                        <td class="text-end fw-medium">{{ $transaksi->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pasien</td>
                        <td class="text-end fw-medium">{{ $transaksi->nama_pasien }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td class="text-end">
                            <span class="badge bg-{{ $transaksi->status_pembayaran == 'lunas' ? 'success' : 'warning text-dark' }} rounded-pill">{{ ucfirst($transaksi->status_pembayaran) }}</span>
                        </td>
                    </tr>
                    @if($transaksi->resep_id)
                    <tr>
                        <td class="text-muted">No. Resep</td>
                        <td class="text-end fw-medium">
                            <a href="{{ route('resep.show', $transaksi->resep_id) }}">#{{ $transaksi->resep_id }}</a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        @if($transaksi->bukti_pembayaran)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <h5 class="fw-bold border-bottom pb-2 mb-3 text-start">Bukti Pembayaran</h5>
                <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" alt="Bukti" class="img-fluid rounded border" style="max-height: 200px;">
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
