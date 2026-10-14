<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1761ec">
    <title>Absensi Siswa</title>
    <style>
        :root {
            color-scheme: light;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            --blue: #1761ec;
            --ink: #202b3d;
            --muted: #8796ad;
            --canvas: #f3f6fb;
            --line: #e7edf5;
            --green: #099b70;
        }

        * { box-sizing: border-box; }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 28px 16px;
            color: var(--ink);
            background: #e8ebf0 radial-gradient(#d4d9e2 0.8px, transparent 0.8px);
            background-size: auto, 18px 18px;
        }

        .attendance-device {
            position: relative;
            width: min(100%, 410px);
            height: min(790px, calc(100vh - 56px));
            min-height: 650px;
            overflow: hidden;
            border: 8px solid #172233;
            border-radius: 47px;
            background: var(--canvas);
            box-shadow: 0 24px 55px rgb(21 34 54 / 24%), 0 4px 10px rgb(21 34 54 / 12%);
            isolation: isolate;
        }

        .attendance-header {
            position: absolute;
            z-index: 1;
            inset: 0 0 auto;
            min-height: 148px;
            padding: 15px 18px 35px;
            overflow: hidden;
            border-radius: 0 0 37px 37px;
            background: linear-gradient(130deg, #1758dc, #216bf5 72%, #2c79f8);
            color: white;
        }

        .attendance-header::after {
            position: absolute;
            top: -100px;
            right: -67px;
            width: 230px;
            height: 230px;
            border: 1px solid rgb(255 255 255 / 12%);
            border-radius: 50%;
            box-shadow: 0 0 0 25px rgb(255 255 255 / 4%), 0 0 0 54px rgb(255 255 255 / 3%);
            content: "";
        }

        .attendance-statusbar,
        .attendance-brand,
        .attendance-device-icons,
        .attendance-heading,
        .attendance-summary-top,
        .attendance-record,
        .attendance-record-status,
        .attendance-pagination,
        .attendance-bottom-nav {
            display: flex;
            align-items: center;
        }

        .attendance-statusbar {
            position: relative;
            z-index: 1;
            height: 15px;
            justify-content: space-between;
            gap: 7px;
            font-size: 9px;
            font-weight: 700;
        }

        .attendance-brand { gap: 5px; overflow: hidden; font-size: 8px; opacity: .86; white-space: nowrap; }
        .attendance-brand svg, .attendance-device-icons svg { width: 13px; height: 13px; flex: 0 0 auto; }
        .attendance-device-icons { gap: 3px; }

        .attendance-heading {
            position: relative;
            z-index: 1;
            justify-content: space-between;
            gap: 10px;
            margin-top: 17px;
        }

        .attendance-heading h1 { margin: 0; font-size: 17px; font-weight: 800; line-height: 1.2; }
        .attendance-heading p { margin: 4px 0 0; color: rgb(255 255 255 / 78%); font-size: 10px; }

        .attendance-total {
            min-width: 82px;
            padding: 7px 10px;
            border: 1px solid rgb(255 255 255 / 24%);
            border-radius: 13px;
            background: rgb(255 255 255 / 13%);
            text-align: right;
        }

        .attendance-total span, .attendance-total strong { display: block; }
        .attendance-total span { color: rgb(255 255 255 / 74%); font-size: 7px; font-weight: 700; }
        .attendance-total strong { margin-top: 2px; font-size: 14px; line-height: 1; }

        .attendance-main {
            position: absolute;
            inset: 0;
            overflow-y: auto;
            padding: 135px 14px 95px;
            scrollbar-width: none;
        }

        .attendance-main::-webkit-scrollbar, .attendance-tabs::-webkit-scrollbar { display: none; }

        .attendance-live-time {
            position: absolute;
            z-index: 2;
            top: 110px;
            left: 50%;
            display: inline-flex;
            min-height: 29px;
            align-items: center;
            gap: 5px;
            padding: 0 12px;
            transform: translateX(-50%);
            border: 1px solid #eaf0fa;
            border-radius: 999px;
            background: white;
            color: var(--blue);
            box-shadow: 0 3px 8px rgb(29 49 83 / 12%);
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .attendance-live-time svg { width: 12px; height: 12px; }

        .attendance-summary { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; padding-top: 13px; }

        .attendance-summary-card {
            min-width: 0;
            min-height: 91px;
            padding: 11px 12px;
            border: 1px solid var(--line);
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 14px rgb(32 58 99 / 6%);
        }

        .attendance-summary-card.is-present { border-color: #bceedd; box-shadow: 0 4px 13px rgb(9 155 112 / 8%); }
        .attendance-summary-top { justify-content: space-between; }

        .attendance-summary-icon {
            display: grid;
            width: 31px;
            height: 31px;
            place-items: center;
            border-radius: 11px;
            background: #eafaf4;
            color: var(--green);
        }

        .attendance-summary-card:not(.is-present) .attendance-summary-icon { background: #eff3f8; color: #61718a; }
        .attendance-summary-icon svg { width: 17px; height: 17px; }

        .attendance-summary-count {
            padding: 4px 7px;
            border-radius: 999px;
            background: #e4f9f1;
            color: var(--green);
            font-size: 8px;
            font-weight: 800;
        }

        .attendance-summary-card:not(.is-present) .attendance-summary-count { background: #f0f3f7; color: #65748a; }
        .attendance-summary-label { display: block; margin-top: 7px; color: #74839a; font-size: 9px; font-weight: 700; }
        .attendance-summary-value { margin-top: 1px; font-size: 17px; font-weight: 800; line-height: 1.2; }
        .attendance-summary-value small { color: #8998ad; font-size: 8px; font-weight: 500; }

        .attendance-filters {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            margin-top: 12px;
            padding: 10px;
            border: 1px solid #e9eef5;
            border-radius: 14px;
            background: white;
            box-shadow: 0 4px 12px rgb(32 58 99 / 4%);
        }

        .attendance-filter-label { min-width: 0; color: #8291a6; font-size: 8px; font-weight: 700; }

        .attendance-filter-label input, .attendance-filter-label select {
            display: block;
            width: 100%;
            min-height: 33px;
            margin-top: 4px;
            padding: 0 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fbfcfe;
            color: var(--ink);
            font: inherit;
            font-size: 9px;
        }

        .attendance-filter-actions { display: flex; grid-column: 1 / -1; align-items: center; justify-content: flex-end; gap: 12px; }
        .attendance-filter-actions button, .attendance-filter-actions a { padding: 4px 2px; border: 0; background: transparent; color: var(--blue); font: inherit; font-size: 9px; font-weight: 800; text-decoration: none; cursor: pointer; }

        .attendance-tabs {
            display: flex;
            gap: 4px;
            overflow-x: auto;
            margin-top: 11px;
            padding: 4px;
            border-radius: 12px;
            background: #e8edf5;
            scrollbar-width: none;
        }

        .attendance-tab {
            min-height: 27px;
            flex: 0 0 auto;
            padding: 0 10px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #728198;
            font: inherit;
            font-size: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        .attendance-tab.is-active { background: white; color: var(--blue); box-shadow: 0 2px 5px rgb(32 58 99 / 9%); }

        .attendance-search { position: relative; display: flex; align-items: center; margin-top: 10px; }
        .attendance-search svg { position: absolute; left: 11px; width: 15px; height: 15px; color: #9aa8ba; pointer-events: none; }

        .attendance-search input {
            width: 100%;
            min-height: 37px;
            padding: 0 12px 0 34px;
            border: 1px solid #e6ebf2;
            border-radius: 999px;
            outline: none;
            background: white;
            color: var(--ink);
            font: inherit;
            font-size: 9px;
        }

        .attendance-search input:focus { border-color: #8db4ff; box-shadow: 0 0 0 3px rgb(23 97 236 / 9%); }

        .attendance-list-heading { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin: 12px 2px 7px; color: #8b99ac; font-size: 8px; }
        .attendance-list-heading strong { color: #64748b; font-size: 9px; }
        .attendance-list { display: grid; gap: 9px; }

        .attendance-record {
            display: grid;
            min-height: 71px;
            grid-template-columns: 36px minmax(0, 1fr) auto;
            align-items: center;
            gap: 9px;
            padding: 10px 11px;
            border: 1px solid #edf1f7;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 13px rgb(32 58 99 / 5%);
            animation: record-enter 260ms ease both;
        }

        .attendance-record[hidden], .attendance-empty[hidden] { display: none; }

        .attendance-record-icon { display: grid; width: 35px; height: 35px; place-items: center; border-radius: 12px; background: #eafaf4; color: var(--green); }
        .attendance-record-icon svg { width: 17px; height: 17px; }
        .attendance-record[data-status="terlambat"] .attendance-record-icon { background: #fff7e7; color: #c17a0b; }
        .attendance-record[data-status="izin"] .attendance-record-icon, .attendance-record[data-status="sakit"] .attendance-record-icon { background: #eef5ff; color: #5078ba; }
        .attendance-record[data-status="alpa"] .attendance-record-icon, .attendance-record[data-status="alpha"] .attendance-record-icon { background: #fff0f0; color: #d24e58; }
        .attendance-student { min-width: 0; }

        .attendance-student-name { overflow: hidden; color: #303d50; font-size: 10px; font-weight: 800; line-height: 1.3; text-overflow: ellipsis; white-space: nowrap; }
        .attendance-student-meta { overflow: hidden; margin-top: 4px; color: #8c9bb0; font-size: 8px; text-overflow: ellipsis; white-space: nowrap; }
        .attendance-student-meta span + span::before { margin: 0 5px; color: #c4cdda; content: "·"; }
        .attendance-record-status { flex-direction: column; align-items: flex-end; gap: 5px; }

        .attendance-status-pill {
            max-width: 100px;
            overflow: hidden;
            padding: 5px 8px;
            border: 1px solid #a9efd5;
            border-radius: 999px;
            background: #edfff7;
            color: #078a63;
            font-size: 8px;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .attendance-record[data-status="terlambat"] .attendance-status-pill { border-color: #f4d598; background: #fff8e9; color: #a96905; }
        .attendance-record[data-status="izin"] .attendance-status-pill, .attendance-record[data-status="sakit"] .attendance-status-pill { border-color: #d7e4fa; background: #f1f6ff; color: #5575a6; }
        .attendance-record[data-status="alpa"] .attendance-status-pill, .attendance-record[data-status="alpha"] .attendance-status-pill { border-color: #ffd5d7; background: #fff3f3; color: #c44952; }
        .attendance-time { color: #94a2b6; font-size: 8px; font-weight: 700; white-space: nowrap; }

        .attendance-empty { padding: 25px 14px; border: 1px dashed #dbe3ee; border-radius: 14px; background: rgb(255 255 255 / 75%); color: #75849a; font-size: 10px; text-align: center; }
        .attendance-pagination { justify-content: space-between; gap: 10px; margin: 12px 1px 0; color: #8492a7; font-size: 9px; }
        .attendance-pagination a { display: inline-flex; min-height: 30px; align-items: center; padding: 0 10px; border: 1px solid #e5ebf3; border-radius: 9px; background: white; color: var(--blue); font-weight: 800; text-decoration: none; }
        .attendance-pagination a[aria-disabled="true"] { color: #aeb9c8; pointer-events: none; }

        .attendance-bottom-nav {
            position: absolute;
            z-index: 3;
            inset: auto 0 0;
            height: 57px;
            justify-content: space-around;
            border-top: 1px solid #e8edf5;
            background: rgb(255 255 255 / 97%);
            box-shadow: 0 -4px 15px rgb(32 58 99 / 4%);
        }

        .attendance-nav-link { display: flex; height: 100%; flex-direction: column; align-items: center; justify-content: center; gap: 3px; color: #95a2b5; font-size: 8px; font-weight: 700; text-decoration: none; }
        .attendance-nav-link svg { width: 17px; height: 17px; }
        .attendance-nav-link.is-active { color: var(--blue); }

        @keyframes record-enter { from { transform: translateY(5px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        @media (max-width: 440px) {
            body { display: block; padding: 0; background: var(--canvas); }
            .attendance-device { width: 100%; height: 100vh; height: 100dvh; min-height: 580px; border: 0; border-radius: 0; box-shadow: none; }
        }

        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <div class="attendance-device">
        <header class="attendance-header">
            <div class="attendance-statusbar">
                <span id="device-clock">03:40</span>
                <span class="attendance-brand"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 3 9 16H3L12 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9 14h6M10 17h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>SMK TI BALI GLOBAL BADUNG</span>
                <span class="attendance-device-icons" aria-hidden="true"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M2 20h3V14H2v6Zm5 0h3V10H7v10Zm5 0h3V6h-3v14Zm5 0h3V2h-3v18Z"/></svg><svg viewBox="0 0 24 24" fill="none"><path d="M3 9a14 14 0 0 1 18 0M6.5 12.5a9 9 0 0 1 11 0M10 16a3.5 3.5 0 0 1 4 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="19" r="1" fill="currentColor"/></svg><svg viewBox="0 0 24 24" fill="none"><rect x="3" y="6" width="17" height="12" rx="2" stroke="currentColor" stroke-width="2"/><path d="M22 10v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M6 9h11v6H6z" fill="currentColor"/></svg></span>
            </div>
            <div class="attendance-heading">
                <div><h1>Absensi Siswa</h1><p>Pemantauan presensi hari ini</p></div>
                <div class="attendance-total"><span>TOTAL CATATAN</span><strong>{{ number_format($records->total(), 0, ',', '.') }}</strong></div>
            </div>
        </header>

        <div class="attendance-live-time" aria-live="polite"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>JAM <span id="live-clock">03:40</span> WITA</div>

        <main class="attendance-main">
            @php
                $pageRecords = $records->getCollection();
                $presentOnPage = $pageRecords->filter(fn ($record) => in_array(strtolower($record->status_label), ['hadir', 'terlambat'], true))->count();
                $onTimeOnPage = $pageRecords->filter(fn ($record) => strtolower($record->status_label) === 'hadir')->count();
                $lateOnPage = $pageRecords->filter(fn ($record) => strtolower($record->status_label) === 'terlambat')->count();
                $alphaOnPage = $pageRecords->filter(fn ($record) => in_array(strtolower($record->status_label), ['alpa', 'alpha'], true))->count();
                $excusedOnPage = $pageRecords->filter(fn ($record) => in_array(strtolower($record->status_label), ['izin', 'sakit'], true))->count();
            @endphp

            <section class="attendance-summary" aria-label="Ringkasan catatan absensi">
                <article class="attendance-summary-card is-present">
                    <div class="attendance-summary-top"><span class="attendance-summary-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="attendance-summary-count">{{ $records->count() }} data</span></div>
                    <span class="attendance-summary-label">Hadir / Terlambat</span>
                    <div class="attendance-summary-value">{{ $presentOnPage }} <small>dari halaman ini</small></div>
                </article>
                <article class="attendance-summary-card">
                    <div class="attendance-summary-top"><span class="attendance-summary-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="attendance-summary-count">{{ $excusedOnPage }} data</span></div>
                    <span class="attendance-summary-label">Izin / Sakit</span>
                    <div class="attendance-summary-value">{{ $excusedOnPage }} <small>dari halaman ini</small></div>
                </article>
            </section>

            <form class="attendance-filters" method="GET" action="{{ route($indexRoute) }}">
                <label class="attendance-filter-label">Tanggal<input type="date" name="tanggal" value="{{ request('tanggal') }}"></label>
                <label class="attendance-filter-label">Kelas
                    <select name="kelas"><option value="">Semua kelas</option>
                        @foreach (($filters[2]['options'] ?? []) as $classId => $className)
                            @if ($classId !== '')<option value="{{ $classId }}" @selected((string) request('kelas') === (string) $classId)>{{ $className }}</option>@endif
                        @endforeach
                    </select>
                </label>
                <label class="attendance-filter-label">Siswa
                    <select name="siswa"><option value="">Semua siswa</option>
                        @foreach (($filters[1]['options'] ?? []) as $studentId => $studentName)
                            @if ($studentId !== '')<option value="{{ $studentId }}" @selected((string) request('siswa') === (string) $studentId)>{{ $studentName }}</option>@endif
                        @endforeach
                    </select>
                </label>
                <div class="attendance-filter-actions"><a href="{{ route($indexRoute) }}">Reset filter</a><button type="submit">Terapkan</button></div>
            </form>

            <div class="attendance-tabs" role="tablist" aria-label="Filter status absensi">
                <button class="attendance-tab is-active" type="button" role="tab" aria-selected="true" data-filter="semua">Semua ({{ $records->count() }})</button>
                <button class="attendance-tab" type="button" role="tab" aria-selected="false" data-filter="hadir">Hadir ({{ $onTimeOnPage }})</button>
                <button class="attendance-tab" type="button" role="tab" aria-selected="false" data-filter="terlambat">Terlambat ({{ $lateOnPage }})</button>
                <button class="attendance-tab" type="button" role="tab" aria-selected="false" data-filter="izin-sakit">Izin / Sakit ({{ $excusedOnPage }})</button>
                <button class="attendance-tab" type="button" role="tab" aria-selected="false" data-filter="alpa">Alpa ({{ $alphaOnPage }})</button>
            </div>

            <label class="attendance-search"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="2"/><path d="m16 16 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg><input id="student-search" type="search" placeholder="Cari nama siswa atau NIS..." autocomplete="off" aria-label="Cari nama siswa atau NIS"></label>
            <div class="attendance-list-heading"><strong>Daftar catatan absensi</strong><span id="result-count">{{ $records->count() }} ditampilkan</span></div>

            <section class="attendance-list" id="attendance-list" aria-label="Daftar absensi siswa">
                @forelse ($records as $record)
                    @php($normalizedStatus = strtolower($record->status_label))
                    <article class="attendance-record" data-status="{{ $normalizedStatus }}" data-search="{{ strtolower(($record->siswa?->nama_siswa ?? '') . ' ' . ($record->siswa?->no_siswa ?? '') . ' ' . ($record->siswa?->kelas?->nama_kelas ?? '')) }}">
                        <span class="attendance-record-icon" aria-hidden="true">
                            @if (in_array($normalizedStatus, ['hadir', 'terlambat'], true))
                                <svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            @else
                                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            @endif
                        </span>
                        <span class="attendance-student">
                            <span class="attendance-student-name">{{ $record->siswa?->nama_siswa ?? 'Siswa tidak ditemukan' }}</span>
                            <span class="attendance-student-meta"><span>{{ $record->siswa?->no_siswa ?? 'NIS -' }}</span><span>{{ $record->siswa?->kelas?->nama_kelas ?? 'Kelas -' }}</span></span>
                        </span>
                        <span class="attendance-record-status"><span class="attendance-status-pill">{{ $record->status_label }}</span><time class="attendance-time">{{ $record->jam_masuk ? substr((string) $record->jam_masuk, 0, 5) . ' WITA' : $record->tanggal?->format('d/m/Y') }}</time></span>
                    </article>
                @empty
                    <div class="attendance-empty">Belum ada catatan absensi untuk filter ini.</div>
                @endforelse
                <div class="attendance-empty" id="no-match-state" hidden>Tidak ada catatan yang cocok dengan pencarian.</div>
            </section>

            @if ($records->hasPages())
                <nav class="attendance-pagination" aria-label="Navigasi halaman absensi">
                    <a href="{{ $records->previousPageUrl() ?? '#' }}" @if (!$records->previousPageUrl()) aria-disabled="true" @endif>← Sebelumnya</a>
                    <span>Halaman {{ $records->currentPage() }} dari {{ $records->lastPage() }}</span>
                    <a href="{{ $records->nextPageUrl() ?? '#' }}" @if (!$records->nextPageUrl()) aria-disabled="true" @endif>Berikutnya →</a>
                </nav>
            @endif
        </main>

        <nav class="attendance-bottom-nav" aria-label="Navigasi utama">
            <a class="attendance-nav-link" href="{{ route('dashboard.admin') }}"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>Dashboard</a>
            <a class="attendance-nav-link is-active" href="{{ route($indexRoute) }}" aria-current="page"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 4h14a2 2 0 0 1 2 2v14H3V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2"/><path d="M8 2v4m8-4v4M7 10h10M7 14h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>Absensi</a>
            <a class="attendance-nav-link" href="{{ route('admin.absensi.report') }}"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V5m0 14h17M8 15l3-4 3 2 5-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>Rekap</a>
        </nav>
    </div>

    <script>
        (() => {
            const updateClock = () => {
                const time = new Intl.DateTimeFormat('id-ID', {
                    timeZone: 'Asia/Makassar',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                }).format(new Date());
                document.getElementById('device-clock').textContent = time;
                document.getElementById('live-clock').textContent = time;
            };

            const searchInput = document.getElementById('student-search');
            const records = [...document.querySelectorAll('.attendance-record')];
            const tabs = [...document.querySelectorAll('.attendance-tab')];
            const resultCount = document.getElementById('result-count');
            const noMatchState = document.getElementById('no-match-state');
            let activeFilter = 'semua';

            const matchesStatus = (status, filter) => {
                if (filter === 'semua') return true;
                if (filter === 'hadir') return status === 'hadir';
                if (filter === 'terlambat') return status === 'terlambat';
                if (filter === 'izin-sakit') return status === 'izin' || status === 'sakit';
                return status === 'alpa' || status === 'alpha';
            };

            const applyFilters = () => {
                const searchTerm = searchInput.value.trim().toLocaleLowerCase('id-ID');
                let visibleCount = 0;
                records.forEach((record) => {
                    const isVisible = record.dataset.search.includes(searchTerm)
                        && matchesStatus(record.dataset.status, activeFilter);
                    record.hidden = !isVisible;
                    visibleCount += Number(isVisible);
                });
                resultCount.textContent = `${visibleCount} ditampilkan`;
                noMatchState.hidden = visibleCount > 0 || records.length === 0;
            };

            searchInput.addEventListener('input', applyFilters);
            tabs.forEach((tab) => {
                tab.addEventListener('click', () => {
                    activeFilter = tab.dataset.filter;
                    tabs.forEach((item) => {
                        const isActive = item === tab;
                        item.classList.toggle('is-active', isActive);
                        item.setAttribute('aria-selected', String(isActive));
                    });
                    applyFilters();
                });
            });

            updateClock();
            window.setInterval(updateClock, 30000);
        })();
    </script>
</body>
</html>