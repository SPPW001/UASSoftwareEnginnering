<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id('id_partnership');
            $table->foreignId('id_perusahaan')->constrained('perusahaans', 'id_perusahaan')->cascadeOnDelete();
            $table->string('jenis_kerjasama', 50);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->decimal('kontribusi', 15, 2)->default(0);
            $table->string('status', 20)->default('diajukan');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('partnerships'); }
};
