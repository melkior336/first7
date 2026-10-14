<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var array<string, array<string, list<string>>>
     */
    private const EXISTING_TABLES = [
        '0001_01_01_000000_create_users_table' => [
            'user' => ['id_user', 'username', 'nama', 'email', 'password', 'role', 'remember_token', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000001_create_guru_table' => [
            'guru' => ['id_guru', 'id_user', 'no_guru', 'nama_guru', 'jenis_kelamin', 'no_telp', 'email', 'alamat', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000002_create_kelas_table' => [
            'kelas' => ['id_kelas', 'nama_kelas', 'tingkat', 'jurusan', 'wali_kelas_id', 'tahun_ajaran', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000003_create_guru_bk_table' => [
            'guru_bk' => ['id_guru_bk', 'id_guru', 'status_aktif', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000004_create_siswa_table' => [
            'siswa' => ['id_siswa', 'id_user', 'no_siswa', 'nama_siswa', 'id_kelas', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_telp', 'poin_pelanggaran', 'poin_penghargaan', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000005_create_mata_pelajaran_table' => [
            'mata_pelajaran' => ['id_mapel', 'kode_mapel', 'nama_mapel', 'tingkat', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000006_create_jadwal_pelajaran_table' => [
            'jadwal_pelajaran' => ['id_jadwal', 'id_kelas', 'id_mapel', 'id_guru', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000007_create_absensi_table' => [
            'absensi' => ['id_absensi', 'id_siswa', 'id_guru', 'tanggal', 'jam_masuk', 'jam_pulang', 'status', 'latitude', 'longitude', 'foto_biometrik', 'keterangan', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000008_create_konseling_table' => [
            'konseling' => ['id_konseling', 'id_siswa', 'id_guru_bk', 'tanggal_konseling', 'jam_konseling', 'jenis_layanan', 'topik_pembahasan', 'hasil_konseling', 'status', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000009_create_jenis_pelanggaran_table' => [
            'jenis_pelanggaran' => ['id_pelanggaran', 'nama_pelanggaran', 'kategori', 'poin', 'sanksi', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000010_create_pelanggaran_siswa_table' => [
            'pelanggaran_siswa' => ['id_pelanggaran_siswa', 'id_siswa', 'id_pelanggaran', 'id_guru_bk', 'tanggal_kejadian', 'keterangan', 'tindak_lanjut', 'status_penanganan', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000011_create_ekstrakurikuler_table' => [
            'ekstrakurikuler' => ['id_ekskul', 'nama_ekskul', 'pembina', 'hari_kegiatan', 'jam_kegiatan', 'tempat', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000012_create_anggota_ekskul_table' => [
            'anggota_ekskul' => ['id_anggota_ekskul', 'id_siswa', 'id_ekskul', 'jabatan', 'tanggal_bergabung', 'created_at', 'updated_at'],
        ],
        '2026_10_08_000013_create_prestasi_table' => [
            'prestasi' => ['id_prestasi', 'id_siswa', 'nama_prestasi', 'tingkat', 'poin', 'tanggal_perolehan', 'sertifikat', 'created_at', 'updated_at'],
        ],
    ];

    /**
     * @var array<string, array<string, list<string>>>
     */
    private const OPTIONAL_GROUPS = [
        '0001_01_01_000001_create_cache_table' => [
            'cache' => ['key', 'value', 'expiration'],
            'cache_locks' => ['key', 'owner', 'expiration'],
        ],
        '0001_01_01_000002_create_jobs_table' => [
            'jobs' => ['id', 'queue', 'payload', 'attempts', 'reserved_at', 'available_at', 'created_at'],
            'job_batches' => ['id', 'name', 'total_jobs', 'pending_jobs', 'failed_jobs', 'failed_job_ids', 'options', 'cancelled_at', 'created_at', 'finished_at'],
            'failed_jobs' => ['id', 'uuid', 'connection', 'queue', 'payload', 'exception', 'failed_at'],
        ],
        '2026_10_09_014724_create_sessions_table' => [
            'sessions' => ['id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'],
        ],
    ];

    public function up(): void
    {
        $migrated = DB::table('migrations')->pluck('migration')->all();
        $baseline = [];

        foreach (self::EXISTING_TABLES as $migration => $tables) {
            $this->validateAndRecordExistingMigration($migration, $tables, $baseline, $migrated);
        }

        foreach (self::OPTIONAL_GROUPS as $migration => $tables) {
            $existingTableCount = collect(array_keys($tables))
                ->filter(fn (string $table): bool => Schema::hasTable($table))
                ->count();

            if ($existingTableCount !== 0 && $existingTableCount !== count($tables)) {
                throw new RuntimeException(
                    "Cannot safely baseline {$migration}: only some of its tables exist.",
                );
            }

            if ($existingTableCount === count($tables)) {
                $this->validateAndRecordExistingMigration($migration, $tables, $baseline, $migrated);
            }
        }

        if ($baseline !== []) {
            DB::table('migrations')->insert($baseline);
        }
    }

    /**
     * @param  array<string, list<string>>  $tables
     * @param  list<array{migration: string, batch: int}>  $baseline
     * @param  list<string>  $migrated
     */
    private function validateAndRecordExistingMigration(
        string $migration,
        array $tables,
        array &$baseline,
        array $migrated,
    ): void {
        if (in_array($migration, $migrated, true)) {
            return;
        }

        $existingTableCount = collect(array_keys($tables))
            ->filter(fn (string $table): bool => Schema::hasTable($table))
            ->count();

        if ($existingTableCount === 0) {
            return;
        }

        if ($existingTableCount !== count($tables)) {
            throw new RuntimeException(
                "Cannot safely baseline {$migration}: only some of its tables exist.",
            );
        }

        foreach ($tables as $table => $requiredColumns) {
            $missingColumns = array_diff($requiredColumns, Schema::getColumnListing($table));

            if ($missingColumns !== []) {
                throw new RuntimeException(
                    "Cannot safely baseline {$migration}: {$table} is missing columns "
                    .implode(', ', $missingColumns).'.',
                );
            }
        }

        $baseline[] = ['migration' => $migration, 'batch' => 0];
    }

    public function down(): void
    {
        throw new RuntimeException('The existing schema baseline cannot be rolled back safely.');
    }
};
