@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-dark fw-bold">Data Transaksi</h4>
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
        Tambah Transaksi
    </a>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="transaksiTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Pasien</th>
                        <th>Total Harga</th>
                        <th>Status Bayar</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d/m/Y H:i') }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td class="fw-medium">{{ $t->nama_pasien }}</td>
                        <td class="text-primary fw-bold">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badgeColor = 'secondary';
                                if($t->status_pembayaran == 'pending') $badgeColor = 'warning text-dark';
                                if($t->status_pembayaran == 'lunas') $badgeColor = 'success';
                                if($t->status_pembayaran == 'batal') $badgeColor = 'danger';
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} rounded-pill">{{ ucfirst($t->status_pembayaran) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                <a href="{{ route('transaksi.cetak', $t->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Cetak</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $transaksis->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#transaksiTable').DataTable({
            "paging": false,
            "info": false,
            "language": { "search": "Cari:" },
            "order": [[ 1, "desc" ]]
        });
    });
</script>
@endpush
