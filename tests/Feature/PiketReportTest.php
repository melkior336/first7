<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\LaporanPiket;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class PiketReportTest extends TestCase
{
    use RefreshDatabase;

    /** @var list<string> */
    private array $filesBefore = [];

    protected function setUp(): void
    {
        parent::setUp();

        File::ensureDirectoryExists(public_path('uploads/piket'));
        $this->filesBefore = File::files(public_path('uploads/piket'));
    }

    protected function tearDown(): void
    {
        foreach (File::files(public_path('uploads/piket')) as $file) {
            if (! in_array($file, $this->filesBefore, true)) {
                File::delete($file);
            }
        }

        parent::tearDown();
    }

    public function test_piket_report_requires_photo_evidence(): void
    {
        [$studentUser] = $this->makeStudentWithWali();

        $this->actingAs($studentUser)
            ->post(route('piket.confirm'), ['checklist' => []], ['Accept' => 'application/json'])
            ->assertStatus(422);

        $this->assertDatabaseCount('laporan_piket', 0);
    }

    public function test_confirmed_piket_report_reaches_the_matching_wali_kelas_dashboard(): void
    {
        [$studentUser, $waliUser, $kelas] = $this->makeStudentWithWali();
        $siswa = $studentUser->siswa;

        $this->actingAs($studentUser)
            ->post(route('piket.confirm'), [
                'foto_bukti' => UploadedFile::fake()->create('bukti.jpg', 50, 'image/jpeg'),
                'checklist' => [['title' => 'Menyapu lantai', 'done' => true]],
            ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('laporan_piket', [
            'id_kelas' => $kelas->id_kelas,
            'id_siswa' => $siswa->id_siswa,
            'status' => 'Selesai',
        ]);

        $this->actingAs($waliUser)
            ->get(route('dashboard.guru'))
            ->assertOk()
            ->assertSee('Laporan Piket Masuk')
            ->assertSee($siswa->nama_siswa);
    }

    public function test_confirmed_piket_report_supports_multiple_photos(): void
    {
        [$studentUser, , $kelas] = $this->makeStudentWithWali();

        $this->actingAs($studentUser)
            ->post(route('piket.confirm'), [
                'foto_bukti' => [
                    UploadedFile::fake()->create('foto1.jpg', 50, 'image/jpeg'),
                    UploadedFile::fake()->create('foto2.png', 50, 'image/png'),
                ],
                'checklist' => json_encode([['title' => 'Mengepel lantai', 'done' => true]]),
            ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $laporan = LaporanPiket::where('id_kelas', $kelas->id_kelas)->first();
        $this->assertNotNull($laporan);
        $this->assertCount(2, $laporan->foto_bukti_list);
        $this->assertSame('Selesai', $laporan->status);
    }

    /**
     * @return array{0: User, 1: User, 2: Kelas}
     */
    private function makeStudentWithWali(): array
    {
        $kelas = Kelas::create([
            'nama_kelas' => 'XI PPLG 1',
            'tingkat' => 'XI',
            'jurusan' => 'PPLG',
            'tahun_ajaran' => '2026/2027',
        ]);

        $waliUser = User::factory()->create(['role' => 'guru']);
        $wali = Guru::create([
            'id_user' => $waliUser->id_user,
            'no_guru' => '900001',
            'nama_guru' => 'Wali Kelas Tes',
            'jenis_kelamin' => 'L',
        ]);

        $kelas->update(['wali_kelas_id' => $wali->id_guru]);

        $studentUser = User::factory()->create(['role' => 'siswa']);
        Siswa::create([
            'id_user' => $studentUser->id_user,
            'no_siswa' => '2411999',
            'nama_siswa' => 'Anggota Piket Tes',
            'id_kelas' => $kelas->id_kelas,
            'jenis_kelamin' => 'L',
        ]);

        return [$studentUser->refresh(), $waliUser, $kelas];
    }
}
