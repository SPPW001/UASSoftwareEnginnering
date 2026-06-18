<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_pengunjung')->constrained('pengunjungs', 'id_pengunjung')->cascadeOnDelete();
            $table->date('tanggal');
            $table->decimal('total', 15, 2)->default(0);
            $table->string('status', 20)->default('menunggu');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('transaksis'); }
};
