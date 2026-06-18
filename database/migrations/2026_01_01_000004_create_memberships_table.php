<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id('id_member');
            $table->foreignId('id_pengunjung')->constrained('pengunjungs', 'id_pengunjung')->cascadeOnDelete();
            $table->string('status_member', 20)->default('Silver');
            $table->date('tanggal_daftar');
            $table->integer('jumlah_kunjungan')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('memberships'); }
};
