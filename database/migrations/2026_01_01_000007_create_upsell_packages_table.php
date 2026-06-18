<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('upsell_packages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket', 100);
            $table->decimal('harga', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('upsell_packages'); }
};
