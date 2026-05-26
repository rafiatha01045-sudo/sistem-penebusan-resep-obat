@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Laporan Stok Obat</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="stokTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                        <th>Tgl Expired</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obats as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $o->kategori->nama_kategori ?? '-' }}</td>
                        <td class="fw-medium">{{ $o->nama_obat }}</td>
                        <td>Rp {{ number_format($o->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($o->tgl_expired)->format('d/m/Y') }}</td>
                        <td>
                            @if($o->stok <= 10)
                                <span class="badge bg-danger rounded-pill">{{ $o->stok }}</span>
                            @else
                                <span class="badge bg-success rounded-pill">{{ $o->stok }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-{{ $o->status == 'tersedia' ? 'primary' : 'secondary' }} rounded-pill">{{ ucfirst($o->status) }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#stokTable').DataTable({
            "paging": true,
            "language": { "search": "Cari:" }
        });
    });
</script>
@endpush
