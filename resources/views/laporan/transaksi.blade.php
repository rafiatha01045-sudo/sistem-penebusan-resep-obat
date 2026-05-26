@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Laporan Transaksi</h4>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <form action="{{ route('laporan.transaksi') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-medium">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary px-4">Filter</button>
                <a href="{{ route('laporan.transaksi') }}" class="btn btn-light px-4">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="laporanTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Pasien</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalSemua = 0; @endphp
                    @foreach($transaksis as $t)
                    @if($t->status_pembayaran == 'lunas')
                        @php $totalSemua += $t->total_harga; @endphp
                    @endif
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d/m/Y H:i') }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>{{ $t->nama_pasien }}</td>
                        <td>
                            <span class="badge bg-{{ $t->status_pembayaran == 'lunas' ? 'success' : ($t->status_pembayaran == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($t->status_pembayaran) }}</span>
                        </td>
                        <td class="text-end">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <th colspan="5" class="text-end">Total Pendapatan (Lunas):</th>
                        <th class="text-end text-primary fs-5">Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#laporanTable').DataTable({
            "paging": true,
            "language": { "search": "Cari:" }
        });
    });
</script>
@endpush
