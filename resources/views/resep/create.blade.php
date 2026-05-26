@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Tambah Resep</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('resep.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Nama Pasien <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" value="{{ old('nama_pasien') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Nama Dokter <span class="text-danger">*</span></label>
                    <input type="text" name="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" value="{{ old('nama_dokter') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Tanggal Resep <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_resep" class="form-control @error('tgl_resep') is-invalid @enderror" value="{{ old('tgl_resep', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="menunggu" {{ old('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label fw-medium">Foto Resep Fisik</label>
                    <input type="file" name="foto_resep" class="form-control @error('foto_resep') is-invalid @enderror" accept="image/*">
                </div>
            </div>
            
            <hr>
            <h5 class="fw-bold mb-3">Daftar Obat</h5>
            <div class="table-responsive mb-3">
                <table class="table table-bordered" id="obatTable">
                    <thead class="table-light">
                        <tr>
                            <th>Pilih Obat</th>
                            <th width="20%">Qty</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="obats[0][id]" class="form-select" required>
                                    <option value="">-- Pilih Obat --</option>
                                    @foreach($obats as $o)
                                    <option value="{{ $o->id }}">{{ $o->nama_obat }} (Stok: {{ $o->stok }})</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="obats[0][qty]" class="form-control" min="1" value="1" required>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger remove-row" disabled>Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-sm btn-success" id="addRow">Tambah Obat</button>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('resep.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let rowIdx = 1;
    document.getElementById('addRow').addEventListener('click', function() {
        const tbody = document.querySelector('#obatTable tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select name="obats[${rowIdx}][id]" class="form-select" required>
                    <option value="">-- Pilih Obat --</option>
                    @foreach($obats as $o)
                    <option value="{{ $o->id }}">{{ $o->nama_obat }} (Stok: {{ $o->stok }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="obats[${rowIdx}][qty]" class="form-control" min="1" value="1" required>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
        rowIdx++;
    });

    document.getElementById('obatTable').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush
