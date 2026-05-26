@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Tambah Transaksi</h4>
</div>

<div class="row g-4">
    <div class="col-lg-4 order-lg-2">
        <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-secondary mb-0">Ringkasan Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal:</span>
                    <span class="fw-bold" id="summarySubtotal">Rp 0</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total:</span>
                    <span class="fw-bold fs-5 text-primary" id="summaryTotal">Rp 0</span>
                </div>
                <button type="button" class="btn btn-primary w-100 py-2 fw-medium" id="btnSubmitForm">Simpan Transaksi</button>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8 order-lg-1">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data" id="transaksiForm">
                    @csrf
                    <input type="hidden" name="total_harga" id="inputTotalHarga" value="0">
                    
                    <h5 class="fw-bold border-bottom pb-2 mb-3">Informasi Umum</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Tanggal Transaksi <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="tgl_transaksi" class="form-control" value="{{ date('Y-m-d\TH:i') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Nama Pasien <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pasien" class="form-control" id="namaPasien" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Status Pembayaran <span class="text-danger">*</span></label>
                            <select name="status_pembayaran" class="form-select" required>
                                <option value="lunas">Lunas</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-medium">Pilih Resep (Opsional)</label>
                            <select name="resep_id" class="form-select" id="resepSelect">
                                <option value="">-- Tanpa Resep --</option>
                                @foreach($reseps as $r)
                                <option value="{{ $r->id }}" data-pasien="{{ $r->nama_pasien }}">Resep #{{ $r->id }} - {{ $r->nama_pasien }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Jika menggunakan resep, nama pasien akan terisi otomatis.</div>
                        </div>
                    </div>
                    
                    <h5 class="fw-bold border-bottom pb-2 mb-3 mt-4">Daftar Obat <span class="text-danger">*</span></h5>
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered" id="obatTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Pilih Obat</th>
                                    <th width="15%">Harga</th>
                                    <th width="15%">Qty</th>
                                    <th width="20%">Subtotal</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="obats[0][id]" class="form-select obat-select" required>
                                            <option value="" data-harga="0">-- Pilih Obat --</option>
                                            @foreach($obats as $o)
                                            <option value="{{ $o->id }}" data-harga="{{ $o->harga }}">{{ $o->nama_obat }} (Stok: {{ $o->stok }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="align-middle text-end harga-text">Rp 0</td>
                                    <td>
                                        <input type="number" name="obats[0][qty]" class="form-control qty-input" min="1" value="1" required>
                                    </td>
                                    <td class="align-middle text-end subtotal-text">Rp 0</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger remove-row" disabled>Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-success" id="addRow">Tambah Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let rowIdx = 1;
    
    // Objek opsi obat untuk reusability
    const obatOptions = `<option value="" data-harga="0">-- Pilih Obat --</option>` + 
        `@foreach($obats as $o)<option value="{{ $o->id }}" data-harga="{{ $o->harga }}">{{ $o->nama_obat }} (Stok: {{ $o->stok }})</option>@endforeach`;

    document.getElementById('addRow').addEventListener('click', function() {
        const tbody = document.querySelector('#obatTable tbody');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select name="obats[${rowIdx}][id]" class="form-select obat-select" required>
                    ${obatOptions}
                </select>
            </td>
            <td class="align-middle text-end harga-text">Rp 0</td>
            <td>
                <input type="number" name="obats[${rowIdx}][qty]" class="form-control qty-input" min="1" value="1" required>
            </td>
            <td class="align-middle text-end subtotal-text">Rp 0</td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger remove-row">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
        rowIdx++;
        updateDeleteButtons();
    });

    document.getElementById('obatTable').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            updateDeleteButtons();
            calculateTotal();
        }
    });

    document.getElementById('obatTable').addEventListener('change', function(e) {
        if(e.target.classList.contains('obat-select')) {
            updateRowValues(e.target.closest('tr'));
        }
    });

    document.getElementById('obatTable').addEventListener('input', function(e) {
        if(e.target.classList.contains('qty-input')) {
            updateRowValues(e.target.closest('tr'));
        }
    });

    document.getElementById('resepSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if(selected.value !== '') {
            document.getElementById('namaPasien').value = selected.getAttribute('data-pasien');
            document.getElementById('namaPasien').setAttribute('readonly', true);
        } else {
            document.getElementById('namaPasien').value = '';
            document.getElementById('namaPasien').removeAttribute('readonly');
        }
    });

    function updateRowValues(tr) {
        const select = tr.querySelector('.obat-select');
        const qty = tr.querySelector('.qty-input').value;
        const harga = select.options[select.selectedIndex].getAttribute('data-harga') || 0;
        
        tr.querySelector('.harga-text').innerText = formatRupiah(harga);
        tr.querySelector('.subtotal-text').innerText = formatRupiah(harga * qty);
        tr.setAttribute('data-subtotal', harga * qty);
        
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('#obatTable tbody tr').forEach(tr => {
            const subtotal = parseInt(tr.getAttribute('data-subtotal')) || 0;
            total += subtotal;
        });
        
        document.getElementById('summarySubtotal').innerText = formatRupiah(total);
        document.getElementById('summaryTotal').innerText = formatRupiah(total);
        document.getElementById('inputTotalHarga').value = total;
    }

    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function updateDeleteButtons() {
        const buttons = document.querySelectorAll('.remove-row');
        if(buttons.length === 1) {
            buttons[0].disabled = true;
        } else {
            buttons.forEach(btn => btn.disabled = false);
        }
    }

    document.getElementById('btnSubmitForm').addEventListener('click', function() {
        if(document.getElementById('inputTotalHarga').value == 0) {
            Swal.fire('Error', 'Pilih minimal 1 obat!', 'error');
            return;
        }
        if(!document.getElementById('transaksiForm').checkValidity()) {
            document.getElementById('transaksiForm').reportValidity();
            return;
        }
        document.getElementById('transaksiForm').submit();
    });
</script>
@endpush
