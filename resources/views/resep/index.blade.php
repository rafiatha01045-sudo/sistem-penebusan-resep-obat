@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-dark fw-bold">Data Resep</h4>
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
    <a href="{{ route('resep.create') }}" class="btn btn-primary shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
        Tambah Resep
    </a>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="resepTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Status</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reseps as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tgl_resep)->format('d/m/Y') }}</td>
                        <td class="fw-medium">{{ $r->nama_pasien }}</td>
                        <td>{{ $r->nama_dokter }}</td>
                        <td>
                            @php
                                $badgeColor = 'secondary';
                                if($r->status == 'menunggu') $badgeColor = 'warning text-dark';
                                if($r->status == 'diproses') $badgeColor = 'primary';
                                if($r->status == 'selesai') $badgeColor = 'success';
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} rounded-pill">{{ ucfirst($r->status) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('resep.show', $r->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
                                <a href="{{ route('resep.edit', $r->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('resep.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
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
            {{ $reseps->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#resepTable').DataTable({
            "paging": false,
            "info": false,
            "language": { "search": "Cari:" },
            "order": [[ 1, "desc" ]]
        });
    });
</script>
@endpush
