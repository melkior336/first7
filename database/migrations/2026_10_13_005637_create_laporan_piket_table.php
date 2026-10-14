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
        Schema::create('laporan_piket', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->cascadeOnDelete();
            $table->foreignId('id_siswa')->nullable()->constrained('siswa', 'id_siswa')->nullOnDelete();
            $table->string('hari', 10);
            $table->date('tanggal');
            $table->string('status', 30)->default('Belum Selesai');
            $table->json('checklist')->nullable();
            $table->string('foto_bukti', 255);
            $table->text('catatan')->nullable();
            $table->boolean('dibaca')->default(false);
            $table->timestamps();

            $table->unique(['id_kelas', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_piket');
    }
};
