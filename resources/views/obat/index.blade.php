@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-dark fw-bold">Data Obat</h4>
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
    <a href="{{ route('obat.create') }}" class="btn btn-primary shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
        Tambah Obat
    </a>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="obatTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Gambar</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($obats as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($o->gambar)
                            <img src="{{ asset('storage/' . $o->gambar) }}" alt="Gambar" class="rounded" width="50" height="50" style="object-fit: cover;">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-secondary" style="width:50px; height:50px; font-size:10px;">No Img</div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $o->nama_obat }}</td>
                        <td>{{ $o->kategori->nama_kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($o->harga, 0, ',', '.') }}</td>
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
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('obat.show', $o->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
                                <a href="{{ route('obat.edit', $o->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('obat.destroy', $o->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $obats->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#obatTable').DataTable({
            "paging": false,
            "info": false,
            "language": { "search": "Cari:" }
        });
    });
</script>
@endpush
