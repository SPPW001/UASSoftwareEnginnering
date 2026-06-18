<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_transaksi')->constrained('transaksis', 'id_transaksi')->cascadeOnDelete();
            $table->string('metode', 50);
            $table->string('status', 20)->default('berhasil');
            $table->decimal('nominal', 15, 2);
            $table->string('kode_referensi', 80)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pembayarans'); }
};
