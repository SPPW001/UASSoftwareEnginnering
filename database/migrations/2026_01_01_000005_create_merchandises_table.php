<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk', 100);
            $table->string('kategori', 50)->nullable();
            $table->decimal('harga', 15, 2);
            $table->integer('stok')->default(0);
            $table->integer('jumlah_terjual')->default(0);
            $table->decimal('kontribusi', 15, 2)->default(10); // persen ke konservasi
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('merchandises'); }
};
