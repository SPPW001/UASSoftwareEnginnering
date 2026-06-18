<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id('id_detail');
            $table->foreignId('id_transaksi')->constrained('transaksis', 'id_transaksi')->cascadeOnDelete();
            $table->foreignId('id_tiket')->nullable()->constrained('tikets', 'id_tiket')->nullOnDelete();
            $table->foreignId('id_produk')->nullable()->constrained('merchandises', 'id_produk')->nullOnDelete();
            $table->foreignId('id_upsell_package')->nullable()->constrained('upsell_packages')->nullOnDelete();
            $table->string('jenis_item', 30);
            $table->string('nama_item', 120);
            $table->integer('jumlah')->default(1);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('kontribusi_konservasi', 15, 2)->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('detail_transaksis'); }
};
