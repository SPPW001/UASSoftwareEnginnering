<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->string('nama_perusahaan', 100);
            $table->string('email', 100)->nullable();
            $table->string('kontak', 30)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('perusahaans'); }
};
