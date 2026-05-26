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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_obats')->onDelete('cascade');
            $table->string('nama_obat');
            $table->string('gambar')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->date('tgl_expired');
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
