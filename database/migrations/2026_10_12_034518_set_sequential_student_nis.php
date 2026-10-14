<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Setel no_siswa mengikuti pola berurutan: NIS = nomor_absen + 1406.
     */
    public function up(): void
    {
        // Fase 1: pindahkan semua ke nilai sementara agar update terakhir tidak
        // menabrak unique constraint (absen 33 masih memegang nilai 1430).
        DB::table('siswa')
            ->whereNotNull('nomor_absen')
            ->orderBy('nomor_absen')
            ->get(['id_siswa'])
            ->each(function (object $student): void {
                DB::table('siswa')
                    ->where('id_siswa', $student->id_siswa)
                    ->update(['no_siswa' => 'T'.str_pad((string) $student->id_siswa, 6, '0', STR_PAD_LEFT)]);
            });

        // Fase 2: setel NIS berurutan mengikuti pola NIS = nomor_absen + 1406.
        DB::table('siswa')
            ->whereNotNull('nomor_absen')
            ->orderBy('nomor_absen')
            ->get(['id_siswa', 'nomor_absen'])
            ->each(fn (object $student): int => DB::table('siswa')
                ->where('id_siswa', $student->id_siswa)
                ->update(['no_siswa' => (string) ($student->nomor_absen + 1406)]));
    }

    /**
     * Kembalikan ke pola placeholder 7 digit (seperti seeder lama).
     */
    public function down(): void
    {
        DB::table('siswa')
            ->whereNotNull('nomor_absen')
            ->orderBy('nomor_absen')
            ->get(['id_siswa', 'nomor_absen'])
            ->each(fn (object $student): int => DB::table('siswa')
                ->where('id_siswa', $student->id_siswa)
                ->update(['no_siswa' => sprintf('%07d', $student->nomor_absen)]));
    }
};
