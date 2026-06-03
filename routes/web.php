<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriObatController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('laporan/transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
        Route::get('laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    });

    // Apoteker Routes (Kelola Obat & Resep)
    Route::middleware(['apoteker'])->group(function () {
        Route::resource('kategori', KategoriObatController::class)->except(['index', 'show']);
        Route::resource('obat', ObatController::class)->except(['index', 'show']);
        Route::resource('resep', ResepController::class)->except(['index', 'show']);
    });

    // Kasir Routes (Kelola Transaksi)
    Route::middleware(['kasir'])->group(function () {
        Route::resource('transaksi', TransaksiController::class)->except(['index', 'show']);
        Route::get('transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    });

    // Shared View Routes
    // Kategori & Obat (Bisa dilihat semua role)
    Route::get('kategori', [KategoriObatController::class, 'index'])->name('kategori.index');
    Route::get('kategori/{kategori}', [KategoriObatController::class, 'show'])->name('kategori.show');
    Route::get('obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('obat/{obat}', [ObatController::class, 'show'])->name('obat.show');

    // Resep (Bisa dilihat Admin, Apoteker, Kasir)
    Route::get('resep', [ResepController::class, 'index'])->name('resep.index');
    Route::get('resep/{resep}', [ResepController::class, 'show'])->name('resep.show');

    // Transaksi (Bisa dilihat Admin, Apoteker, Kasir)
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
});

require __DIR__ . '/auth.php';
