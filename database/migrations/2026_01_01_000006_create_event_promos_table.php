<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_promos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('diskon_persen', 5, 2)->default(0);
            $table->text('deskripsi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('event_promos'); }
};
