@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0 text-dark fw-bold">Dashboard ({{ ucfirst(auth()->user()->role) }})</h4>
    </div>

    @if(auth()->user()->role == 'admin')
        {{-- =====================================
        DASHBOARD ADMIN
        ===================================== --}}
        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total Obat</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalObat }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total Transaksi</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalTransaksi }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #0dcaf0 0%, #0bacce 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total Resep</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalResep }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total User</h6>
                                <h3 class="mb-0 fw-bold text-dark">{{ $totalUser }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="mb-0 fw-bold text-secondary">Grafik Transaksi Bulanan</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="transaksiChart" height="100" data-labels="{{ json_encode($labels) }}"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="mb-0 fw-bold text-secondary">Stok Obat Menipis</h6>
                    </div>
                    <div class="card-body">
                        @if($stokObat->isEmpty())
                            <p class="text-muted mb-0">Semua stok obat aman.</p>
                        @else
                            <ul class="list-group list-group-flush">
                                @foreach($stokObat as $o)
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center border-0">
                                        {{ $o->nama_obat }}
                                        <span
                                            class="badge bg-{{ $o->stok <= 10 ? 'danger' : 'warning' }} rounded-pill">{{ $o->stok }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @elseif(auth()->user()->role == 'apoteker')

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total Obat Terdaftar</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalObat }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #0dcaf0 0%, #0bacce 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Total Resep Diproses</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalResep }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="mb-0 fw-bold text-secondary">Perhatian: Stok Obat Menipis</h6>
                    </div>
                    <div class="card-body">
                        @if($stokObat->isEmpty())
                            <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Seluruh stok obat masih dalam batas aman.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <tbody>
                                        @foreach($stokObat as $o)
                                            <tr>
                                                <td class="ps-0"><span class="fw-medium text-dark">{{ $o->nama_obat }}</span></td>
                                                <td class="text-end pe-0">
                                                    <span
                                                        class="badge bg-{{ $o->stok <= 10 ? 'danger' : 'warning' }} rounded-pill px-3">{{ $o->stok }}
                                                        Tersisa</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm h-100 border-0 bg-primary bg-opacity-10 text-primary">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                            class="bi bi-file-earmark-medical mb-3" viewBox="0 0 16 16">
                            <path
                                d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2-3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                            <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                        </svg>
                        <h5 class="fw-bold">Manajemen Resep</h5>
                        <p class="mb-4">Kelola semua resep pasien dengan cepat dan efisien. Pastikan semua data resep
                            terverifikasi sebelum diproses ke bagian kasir.</p>
                        <a href="{{ route('resep.create') }}" class="btn btn-primary px-4 rounded-pill">Tambah Resep Baru</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12 col-md-6">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #198754 0%, #146c43 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Transaksi Hari Ini</h6>
                                <h3 class="mb-0 fw-bold">{{ $totalTransaksiHariIni }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100 border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color: white;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Pendapatan Hari Ini</h6>
                                <h3 class="mb-0 fw-bold text-dark">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
                            </div>
                            <div class="p-3 bg-white bg-opacity-25 rounded-3 text-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-secondary">5 Transaksi Terakhir</h6>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">ID Transaksi</th>
                                        <th class="border-0 py-3">Tanggal</th>
                                        <th class="border-0 py-3">Kasir</th>
                                        <th class="border-0 py-3 text-end px-4">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksiTerbaru as $t)
                                        <tr>
                                            <td class="px-4"><span
                                                    class="badge bg-light text-dark border">#TRX-{{ str_pad($t->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d M Y H:i') }}</td>
                                            <td>{{ $t->user->name ?? 'System' }}</td>
                                            <td class="text-end px-4 fw-medium text-success">Rp
                                                {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">Belum ada transaksi hari ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@if(auth()->user()->role == 'admin')
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var canvas = document.getElementById('transaksiChart');
            if (canvas) {
                var ctx = canvas.getContext('2d');
                var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(13, 110, 253, 0.5)');
                gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: JSON.parse(canvas.getAttribute('data-labels')),
                        datasets: [{
                            label: 'Total Transaksi (Rp)',
                            data: JSON.parse('{!! json_encode($data) !!}'),
                            backgroundColor: gradient,
                            borderColor: '#0d6efd',
                            borderWidth: 2,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#0d6efd',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { borderDash: [5, 5], color: '#f0f0f0' },
                                ticks: { callback: function (value) { return 'Rp ' + value.toLocaleString('id-ID'); } }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endif