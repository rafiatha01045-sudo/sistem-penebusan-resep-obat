<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('resep_id')->nullable()->constrained('reseps')->onDelete('set null');
            $table->string('nama_pasien');
            $table->integer('total_harga');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['pending', 'lunas', 'batal'])->default('pending');
            $table->date('tgl_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
