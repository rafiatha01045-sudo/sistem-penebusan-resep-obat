@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h4 class="mb-0 text-dark fw-bold">Profil Saya</h4>
</div>

<div class="row">
    <!-- Informasi Profil -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="fw-bold text-dark mb-1">Informasi Profil</h5>
                <p class="text-muted small">Perbarui informasi profil dan alamat email akun Anda.</p>
            </div>
            <div class="card-body">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email" class="form-control bg-light" value="{{ $user->email }}" readonly>
                        
                        <div class="mt-2 text-muted small">
                            Silakan hubungi Administrator jika Anda perlu mengubah nama atau email.
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Ubah Password -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="fw-bold text-dark mb-1">Ubah Password</h5>
                <p class="text-muted small">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label class="form-label fw-medium">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" required autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium">Password Baru</label>
                        <input type="password" name="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" required autocomplete="new-password">
                        @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        @if (session('status') === 'password-updated')
                            <span class="text-success small fw-medium" id="status-message-password">Tersimpan.</span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(function() {
        var statusMsg = document.getElementById('status-message');
        if(statusMsg) statusMsg.style.display = 'none';
        
        var passMsg = document.getElementById('status-message-password');
        if(passMsg) passMsg.style.display = 'none';
    }, 3000);
</script>
@endpush
