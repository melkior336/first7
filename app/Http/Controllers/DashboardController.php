<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Izin;
use App\Models\LaporanPiket;
use App\Models\Mapel;
use App\Models\PelanggaranSiswa;
use App\Models\Piket;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        abort_unless($user instanceof User, 403);

        return redirect()->route($user->dashboardRoute());
    }

    public function siswa(Request $request): View
    {
        $user = $request->user();
        abort_unless($user instanceof User, 403);

        $siswa = $user->siswa()->with('kelas')->first();

        if (! $siswa) {
            return view('dashboard siswa.dashboard', [
                'siswa' => null,
                'studentName' => $user->nama,
                'studentNumber' => null,
                'className' => null,
                'profileComplete' => false,
                'presensiHariIni' => null,
                'totalHadir' => 0,
                'totalIzinBulanIni' => 0,
            ]);
        }

        $nowMakassar = Carbon::now('Asia/Makassar');
        $today = $nowMakassar->hour < 6
            ? $nowMakassar->copy()->subDay()->toDateString()
            : $nowMakassar->toDateString();
        $studentId = $siswa->id_siswa ?? $siswa->id;

        $presensiHariIni = null;
        $totalHadirBulanIni = 0;
        $totalIzinBulanIni = 0;
        $persenHadir = 100;
        $tugasAktif = 0;
        $piketHariIni = null;

        try {
            if (Schema::hasTable('absensi')) {
                $presensiHariIni = Absensi::where('id_siswa', $studentId)
                    ->whereDate('tanggal', $today)
                    ->whereNotNull('jam_masuk')
                    ->first();

                $totalHadirBulanIni = Absensi::where('id_siswa', $studentId)
                    ->whereIn('status', ['Hadir', 'Terlambat'])
                    ->count();
            }

            if (! $presensiHariIni && Schema::hasTable('presensi')) {
                $presensiHariIni = Presensi::where('siswa_id', $studentId)
                    ->whereDate('tanggal', $today)
                    ->whereNotNull('jam_masuk')
                    ->first();
            }

            // Bersihkan data jam_pulang tidak valid dini hari sebelum jam 6 pagi (seperti 00:28 dari testing semalam)
            if ($presensiHariIni && ! empty($presensiHariIni->jam_pulang) && $presensiHariIni->jam_pulang < '06:00:00') {
                $presensiHariIni->jam_pulang = null;
                $presensiHariIni->save();
            }

            if ($totalHadirBulanIni === 0 && Schema::hasTable('presensi')) {
                $totalHadirBulanIni = Presensi::where('siswa_id', $studentId)
                    ->whereIn('status', ['Hadir', 'Terlambat'])
                    ->count();
            }

            $totalPresensi = Schema::hasTable('absensi')
                ? Absensi::where('id_siswa', $studentId)->count()
                : (Schema::hasTable('presensi') ? Presensi::where('siswa_id', $studentId)->count() : 0);

            if ($totalPresensi > 0) {
                $persenHadir = round(($totalHadirBulanIni / $totalPresensi) * 100);
            }

            if (Schema::hasTable('izin')) {
                $totalIzinBulanIni = Izin::where('id_siswa', $studentId)
                    ->whereMonth('tgl_mulai', Carbon::now()->month)
                    ->sum('durasi_hari') ?: 0;
            }

            if (Schema::hasTable('mapel')) {
                $tugasAktif = Mapel::where('status', 'Aktif')->count();
            }

            if (Schema::hasTable('piket')) {
                $indonesianDays = [
                    'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu',
                ];
                $currentDayName = $indonesianDays[Carbon::now()->format('l')] ?? 'Senin';
                $piketHariIni = Piket::where('hari', $currentDayName)->first();
            }
        } catch (Exception $e) {
        }

        if (view()->exists('dashboard siswa.dashboard')) {
            return view('dashboard siswa.dashboard', [
                'siswa' => $siswa,
                'studentName' => $siswa->nama_siswa ?? $siswa->nama ?? $user->nama,
                'studentNumber' => $siswa->no_siswa ?? $siswa->nis ?? null,
                'className' => $siswa->kelas?->nama_kelas,
                'profileComplete' => true,
                'presensiHariIni' => $presensiHariIni,
                'totalHadir' => $totalHadirBulanIni,
                'persenHadir' => $persenHadir,
                'totalIzinBulanIni' => $totalIzinBulanIni,
                'tugasAktif' => $tugasAktif,
                'piketHariIni' => $piketHariIni,
            ]);
        }

        return view('dashboard.role', [
            'roleLabel' => 'Siswa',
            'name' => $siswa->nama_siswa,
            'profileDetails' => [
                'Nomor siswa' => $siswa->no_siswa,
                'Kelas' => $siswa->kelas->nama_kelas,
            ],
            'metrics' => [
                'Poin pelanggaran' => $siswa->poin_pelanggaran,
                'Poin penghargaan' => $siswa->poin_penghargaan,
            ],
            'students' => collect(),
        ]);
    }

    public function guru(Request $request): View
    {
        $user = $request->user();
        abort_unless($user instanceof User, 403);

        $guru = $user->guru()->with('kelasWali')->first();

        $laporanPiket = collect();
        $laporanPiketBaru = 0;

        if ($guru?->kelasWali && Schema::hasTable('laporan_piket')) {
            try {
                $laporanPiket = LaporanPiket::with('siswa')
                    ->where('id_kelas', $guru->kelasWali->id_kelas)
                    ->orderByDesc('tanggal')
                    ->limit(10)
                    ->get();

                $laporanPiketBaru = $laporanPiket->where('dibaca', false)->count();
                // ponytail: belum ada aksi tandai-terbaca, jadi semua laporan tampil "Baru".
                // Tambah tombol tandai-dibaca saat wali kelas butuh badge unread yang akurat.
            } catch (Exception $e) {
                $laporanPiket = collect();
            }
        }

        if (view()->exists('dashboard guru.dashboardguru')) {
            return view('dashboard guru.dashboardguru', [
                'guru' => $guru,
                'user' => $user,
                'laporanPiket' => $laporanPiket,
                'laporanPiketBaru' => $laporanPiketBaru,
            ]);
        }

        return view('dashboard.role', [
            'roleLabel' => 'Guru',
            'name' => $guru?->nama_guru ?? $user->nama,
            'profileDetails' => [
                'Nomor guru' => $guru?->no_guru ?? '-',
                'Kelas wali' => $guru?->kelasWali?->nama_kelas ?? 'Belum ditetapkan',
            ],
            'metrics' => [],
            'students' => collect(),
        ]);
    }

    public function guruBk(Request $request): View
    {
        $user = $request->user();
        abort_unless($user instanceof User, 403);

        $guru = $user->guru()
            ->whereHas('guruBk', fn ($query) => $query->where('status_aktif', true))
            ->firstOrFail();

        $students = Siswa::query()
            ->with('kelas')
            ->orderBy('nama_siswa')
            ->get(['id_siswa', 'nama_siswa', 'id_kelas', 'poin_pelanggaran']);

        return view('dashboard.role', [
            'roleLabel' => 'Guru BK',
            'name' => $guru->nama_guru,
            'profileDetails' => [
                'Nomor guru' => $guru->no_guru,
            ],
            'metrics' => [
                'Jumlah siswa' => $students->count(),
                'Catatan pelanggaran' => PelanggaranSiswa::count(),
            ],
            'students' => $students,
        ]);
    }

    public function admin(Request $request): View
    {
        $today = Carbon::today();
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();

        $siswaHadirCount = Absensi::whereDate('tanggal', $today)
            ->where('status', 'Hadir')
            ->distinct('id_siswa')
            ->count('id_siswa');

        $guruHadirCount = Absensi::whereDate('tanggal', $today)
            ->whereNotNull('id_guru')
            ->distinct('id_guru')
            ->count('id_guru');

        $siswaHadirPersen = $totalSiswa > 0
            ? round(($siswaHadirCount / $totalSiswa) * 100)
            : 0;

        $guruHadirPersen = $totalGuru > 0
            ? round(($guruHadirCount / $totalGuru) * 100)
            : 0;

        $user = $request->user();

        return view('dashboard.admin', [
            'name' => $user?->nama ?? 'Admin',
            'totalSiswa' => $totalSiswa,
            'totalGuru' => $totalGuru,
            'siswaHadirCount' => $siswaHadirCount,
            'guruHadirCount' => $guruHadirCount,
            'siswaHadirPersen' => $siswaHadirPersen,
            'guruHadirPersen' => $guruHadirPersen,
        ]);
    }
}
