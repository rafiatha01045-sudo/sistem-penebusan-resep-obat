@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-dark fw-bold">Data User</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
        Tambah User
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="userTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-medium">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @php
                                $badgeColor = 'secondary';
                                if($u->role == 'admin') $badgeColor = 'danger';
                                if($u->role == 'apoteker') $badgeColor = 'primary';
                                if($u->role == 'kasir') $badgeColor = 'success';
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} rounded-pill">{{ ucfirst($u->role) }}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                @if(auth()->id() != $u->id)
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
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
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#userTable').DataTable({
            "paging": false,
            "info": false,
            "language": { "search": "Cari:" }
        });
    });
</script>
@endpush
