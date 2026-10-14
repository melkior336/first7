<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1761ec">
    <title>Dashboard Admin</title>
    <style>
        :root {
            color-scheme: light;
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            --admin-blue: #1761ec;
            --admin-blue-dark: #1050d4;
            --admin-ink: #202b3d;
            --admin-muted: #8796ad;
            --admin-line: #e8edf5;
            --admin-canvas: #f4f7fc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 30px 16px;
            color: var(--admin-ink);
            background-color: #e8ebf0;
            background-image: radial-gradient(#d4d9e2 0.8px, transparent 0.8px);
            background-size: 18px 18px;
        }

        .admin-dashboard {
            position: relative;
            width: min(100%, 410px);
            height: min(790px, calc(100vh - 60px));
            min-height: 680px;
            overflow: hidden;
            border: 8px solid #172233;
            border-radius: 48px;
            background: var(--admin-canvas);
            box-shadow: 0 24px 55px rgb(21 34 54 / 24%), 0 4px 10px rgb(21 34 54 / 12%);
            isolation: isolate;
        }

        .admin-header {
            position: absolute;
            z-index: 1;
            inset: 0 0 auto;
            height: 154px;
            padding: 16px 20px 30px;
            color: white;
            background: linear-gradient(125deg, #1758dc 0%, #216bf5 70%, #2878fa 100%);
            border-radius: 0 0 38px 38px;
        }

        .admin-header::after {
            position: absolute;
            top: -70px;
            right: -52px;
            width: 210px;
            height: 210px;
            border: 1px solid rgb(255 255 255 / 12%);
            border-radius: 50%;
            content: "";
            box-shadow: 0 0 0 24px rgb(255 255 255 / 4%), 0 0 0 50px rgb(255 255 255 / 3%);
            pointer-events: none;
        }

        .admin-statusbar {
            position: relative;
            z-index: 2;
            display: flex;
            height: 12px;
            align-items: center;
            justify-content: space-between;
            margin: 0 1px 10px;
            font-size: 9px;
            font-weight: 700;
        }

        .admin-school {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 8px;
            letter-spacing: 0.04em;
            opacity: 0.78;
        }

        .admin-system-icons {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .admin-system-icons svg {
            width: 13px;
            height: 13px;
        }

        .admin-greeting-row {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .admin-greeting {
            margin: 0 0 2px;
            color: rgb(255 255 255 / 82%);
            font-size: 11px;
        }

        .admin-name {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.25;
        }

        .admin-active-pill {
            display: inline-flex;
            min-height: 23px;
            align-items: center;
            gap: 6px;
            margin-top: 5px;
            padding: 4px 10px;
            border: 1px solid rgb(255 255 255 / 22%);
            border-radius: 999px;
            background: rgb(255 255 255 / 13%);
            color: #f1f6ff;
            font-size: 9px;
            white-space: nowrap;
        }

        .admin-active-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #52e5a7;
            box-shadow: 0 0 0 3px rgb(82 229 167 / 15%);
        }

        .admin-profile {
            display: grid;
            width: 42px;
            height: 42px;
            flex: 0 0 auto;
            place-items: center;
            margin-left: 8px;
            border: 0;
            border-radius: 50%;
            background: white;
            color: var(--admin-blue);
            box-shadow: 0 4px 12px rgb(11 43 113 / 22%);
        }

        .admin-profile svg {
            width: 23px;
            height: 23px;
        }

        .admin-main {
            position: absolute;
            inset: 0;
            overflow-y: auto;
            padding: 183px 17px 102px;
            scrollbar-width: none;
        }

        .admin-main::-webkit-scrollbar {
            display: none;
        }

        .admin-time-pill {
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
            color: var(--admin-blue);
            box-shadow: 0 3px 8px rgb(29 49 83 / 12%);
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .admin-time-pill svg {
            width: 12px;
            height: 12px;
        }

        .admin-menu-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 11px;
        }

        .admin-menu-card {
            display: flex;
            min-height: 103px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 7px;
            border: 1px solid #eef2f8;
            border-radius: 16px;
            background: white;
            box-shadow: 0 5px 15px rgb(32 58 99 / 6%);
            text-align: center;
            text-decoration: none;
            transition: transform 160ms ease, box-shadow 160ms ease;
        }

        .admin-menu-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgb(32 58 99 / 10%);
        }

        .admin-menu-icon {
            display: grid;
            width: 37px;
            height: 37px;
            place-items: center;
            margin-bottom: 7px;
            border-radius: 14px;
            background: #f0f6ff;
            color: var(--admin-blue);
        }

        .admin-menu-icon svg {
            width: 20px;
            height: 20px;
        }

        .admin-menu-title {
            color: var(--admin-ink);
            font-size: 10px;
            font-weight: 800;
            line-height: 1.3;
        }

        .admin-menu-detail {
            margin-top: 3px;
            color: #93a0b3;
            font-size: 9px;
        }

        .admin-menu-card.is-highlight .admin-menu-title {
            color: var(--admin-blue);
        }

        .admin-menu-card.is-highlight .admin-menu-detail {
            color: #159a73;
        }

        .admin-database-summary {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 12px 0;
            padding: 10px 12px;
            border: 1px solid #e5edfb;
            border-radius: 13px;
            background: #edf4ff;
        }

        .admin-database-count {
            display: grid;
            width: 30px;
            height: 30px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 10px;
            background: var(--admin-blue);
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .admin-database-summary strong,
        .admin-database-summary small {
            display: block;
        }

        .admin-database-summary strong {
            color: #263851;
            font-size: 10px;
        }

        .admin-database-summary small {
            margin-top: 2px;
            color: #7185a2;
            font-size: 9px;
        }

        .admin-record-panel {
            margin-top: 10px;
            padding: 13px;
            border: 1px solid #edf1f7;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 15px rgb(32 58 99 / 6%);
            scroll-margin-top: 15px;
        }

        .admin-record-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 11px;
        }

        .admin-record-heading h2 {
            margin: 0;
            color: var(--admin-ink);
            font-size: 11px;
            font-weight: 800;
        }

        .admin-record-heading span {
            padding: 4px 7px;
            border-radius: 999px;
            background: #eef5ff;
            color: var(--admin-blue);
            font-size: 8px;
            font-weight: 800;
        }

        .admin-record-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 7px;
            margin: 0;
        }

        .admin-record-field {
            min-width: 0;
            padding: 8px 9px;
            border: 1px solid #eef2f7;
            border-radius: 10px;
            background: #f8fafd;
        }

        .admin-record-field dt {
            overflow-wrap: anywhere;
            color: #8796ad;
            font-size: 9px;
        }

        .admin-record-field dd {
            overflow-wrap: anywhere;
            margin: 4px 0 0;
            color: var(--admin-ink);
            font-size: 10px;
            font-weight: 800;
        }

        .admin-record-field.is-wide {
            grid-column: 1 / -1;
        }

        .admin-field-type {
            display: inline-block;
            margin-left: 4px;
            padding: 2px 4px;
            border-radius: 4px;
            background: #eaf1fd;
            color: #52709b;
            font-size: 7px;
            font-weight: 800;
            vertical-align: 1px;
        }

        .admin-database-relation {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-top: 10px;
            padding: 9px 11px;
            border-left: 3px solid #48b891;
            border-radius: 0 10px 10px 0;
            background: #eef9f5;
            color: #377b67;
            font-size: 9px;
            scroll-margin-top: 15px;
        }

        .admin-database-relation strong {
            color: #246852;
            font-size: 9px;
        }

        .admin-attendance-summary {
            display: flex;
            width: fit-content;
            min-height: 30px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 12px auto;
            padding: 0 13px;
            border: 1px solid #edf1f7;
            border-radius: 999px;
            background: white;
            box-shadow: 0 4px 12px rgb(32 58 99 / 7%);
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-attendance-summary span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .admin-attendance-summary svg {
            width: 13px;
            height: 13px;
            color: var(--admin-blue);
        }

        .admin-summary-divider {
            width: 1px;
            height: 12px;
            background: #dce3ed;
        }

        .admin-settings-panel {
            padding: 13px 13px 12px;
            border: 1px solid #edf1f7;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 15px rgb(32 58 99 / 6%);
        }

        .admin-settings-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .admin-settings-heading h2 {
            margin: 0;
            font-size: 11px;
            font-weight: 800;
        }

        .admin-text-button {
            padding: 4px 2px;
            border: 0;
            background: transparent;
            color: var(--admin-blue);
            font: inherit;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
        }

        .admin-setting-values {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .admin-setting-values[hidden] {
            display: none;
        }

        .admin-setting-item {
            min-height: 48px;
            padding: 8px 9px;
            border: 1px solid #eef2f7;
            border-radius: 11px;
            background: #f8fafd;
        }

        .admin-setting-label {
            display: block;
            margin-bottom: 3px;
            color: #8898ad;
            font-size: 9px;
        }

        .admin-setting-value {
            font-size: 10px;
            font-weight: 800;
        }

        .admin-campus-location {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            margin-top: 11px;
            color: #8a9ab0;
            font-size: 9px;
        }

        .admin-campus-coordinates {
            color: var(--admin-blue);
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-settings-form {
            display: none;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
            margin-top: 10px;
        }

        .admin-settings-form.is-visible {
            display: grid;
        }

        .admin-settings-form label {
            color: #71819a;
            font-size: 9px;
            font-weight: 700;
        }

        .admin-settings-form input {
            width: 100%;
            min-height: 34px;
            margin-top: 4px;
            padding: 0 8px;
            border: 1px solid #dfe7f1;
            border-radius: 8px;
            background: white;
            color: var(--admin-ink);
            font: inherit;
            font-size: 11px;
        }

        .admin-form-actions {
            display: flex;
            grid-column: 1 / -1;
            justify-content: flex-end;
            gap: 12px;
        }

        .admin-manage-button {
            display: flex;
            min-height: 38px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin: 12px auto 0;
            padding: 0 15px;
            border: 1px solid #edf1f7;
            border-radius: 999px;
            background: white;
            color: var(--admin-ink);
            box-shadow: 0 4px 12px rgb(32 58 99 / 7%);
            font: inherit;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
        }

        .admin-manage-button svg {
            width: 14px;
            height: 14px;
            color: var(--admin-blue);
        }

        .admin-bottom-nav {
            position: absolute;
            z-index: 3;
            inset: auto 0 0;
            display: grid;
            height: 57px;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            border-top: 1px solid #e8edf5;
            background: rgb(255 255 255 / 96%);
            box-shadow: 0 -4px 15px rgb(32 58 99 / 4%);
        }

        .admin-nav-item {
            display: flex;
            height: 100%;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            border: 0;
            background: transparent;
            color: #95a2b5;
            font: inherit;
            font-size: 9px;
            cursor: pointer;
            text-decoration: none;
        }

        .admin-nav-item svg {
            width: 17px;
            height: 17px;
        }

        .admin-nav-item.is-active {
            color: var(--admin-blue);
            font-weight: 800;
        }

        .admin-fingerprint {
            position: absolute;
            z-index: 4;
            bottom: 8px;
            left: 50%;
            display: grid;
            width: 54px;
            height: 54px;
            place-items: center;
            transform: translateX(-50%);
            border: 4px solid white;
            border-radius: 50%;
            background: var(--admin-blue);
            color: white;
            box-shadow: 0 5px 13px rgb(23 97 236 / 32%);
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease;
            text-decoration: none;
        }

        .admin-fingerprint:hover {
            transform: translateX(-50%) scale(1.05);
        }

        .admin-fingerprint svg {
            width: 25px;
            height: 25px;
        }

        .admin-toast {
            position: absolute;
            z-index: 5;
            right: 12px;
            bottom: 73px;
            left: 12px;
            padding: 10px 13px;
            transform: translateY(8px);
            border: 1px solid #dce8ff;
            border-radius: 10px;
            background: white;
            color: #345276;
            box-shadow: 0 8px 20px rgb(21 34 54 / 12%);
            font-size: 10px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 160ms ease, transform 160ms ease;
        }

        .admin-toast.is-visible {
            transform: translateY(0);
            opacity: 1;
        }

        @media (max-width: 440px) {
            body {
                display: block;
                padding: 0;
                background: var(--admin-canvas);
            }

            .admin-dashboard {
                width: 100%;
                height: 100vh;
                height: 100dvh;
                min-height: 590px;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .admin-main {
                padding-right: 14px;
                padding-left: 14px;
            }
        }

        @media (max-height: 740px) and (min-width: 441px) {
            body {
                align-items: start;
            }

            .admin-dashboard {
                height: 790px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    @php($adminRecord = $admin ?? null)
    @php($attendanceSettings = $pengaturanAbsensi ?? null)

    <div class="admin-dashboard" id="dashboard">
        <header class="admin-header">
            <div class="admin-statusbar" aria-label="Status perangkat">
                <span id="status-clock">03:00</span>
                <span class="admin-school">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 3 9 16H3L12 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9 14h6M10 17h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    PANEL ADMINISTRATOR
                </span>
                <span class="admin-system-icons" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M2 20h3V14H2v6Zm5 0h3V10H7v10Zm5 0h3V6h-3v14Zm5 0h3V2h-3v18Z"/></svg>
                    <svg viewBox="0 0 24 24" fill="none"><path d="M3 9a14 14 0 0 1 18 0M6.5 12.5a9 9 0 0 1 11 0M10 16a3.5 3.5 0 0 1 4 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="19" r="1" fill="currentColor"/></svg>
                    <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="6" width="17" height="12" rx="2" stroke="currentColor" stroke-width="2"/><path d="M22 10v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M6 9h11v6H6z" fill="currentColor"/></svg>
                </span>
            </div>

            <div class="admin-greeting-row">
                <div>
                    <p class="admin-greeting" id="greeting">Selamat Pagi,</p>
                    <h1 class="admin-name">{{ $adminRecord?->nama_admin ?? 'Administrator' }}</h1>
                    <span class="admin-active-pill"><span class="admin-active-dot"></span>Data Administrator · ID {{ $adminRecord?->id_admin ?? 'Belum tersedia' }}</span>
                </div>
                <button class="admin-profile" type="button" aria-label="Profil admin" data-toast="Profil admin siap dihubungkan ke akun Anda.">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="9" cy="8" r="4" fill="currentColor"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0v1h-13v-1Z" fill="currentColor"/><circle cx="18" cy="16" r="5" fill="#c8dcff"/><path d="m16.3 16 1.2 1.2 2.3-2.5" stroke="#1761ec" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </header>

        <div class="admin-time-pill" aria-live="polite">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>JAM <span id="live-clock">03:00</span> WITA</span>
        </div>

        <main class="admin-main">
            <section class="admin-menu-grid" aria-label="Menu dashboard">
                <a class="admin-menu-card" href="#administrator-data">
                    <span class="admin-menu-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="9" cy="7" r="4" fill="currentColor"/><path d="M2 20a7 7 0 0 1 14 0v1H2v-1Z" fill="currentColor"/><path d="M17 5h5v5h-5z" fill="currentColor"/></svg></span>
                    <span class="admin-menu-title">ADMINISTRATOR</span>
                    <span class="admin-menu-detail">PK: id_admin · FK: id_user</span>
                </a>
                <a class="admin-menu-card is-highlight" href="#pengaturan-data">
                    <span class="admin-menu-icon"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="6" r="2" fill="white" stroke="currentColor" stroke-width="2"/><circle cx="15" cy="12" r="2" fill="white" stroke="currentColor" stroke-width="2"/><circle cx="8" cy="18" r="2" fill="white" stroke="currentColor" stroke-width="2"/></svg></span>
                    <span class="admin-menu-title">PENGATURAN_ABSENSI</span>
                    <span class="admin-menu-detail">PK: id_pengaturan · FK: id_admin</span>
                </a>
            </section>

            <div class="admin-database-summary" aria-label="Ringkasan struktur database">
                <span class="admin-database-count">2</span>
                <span><strong>Entitas Dashboard Admin</strong><small>Administrator terhubung ke pengaturan absensi melalui id_admin</small></span>
            </div>

            <section class="admin-record-panel" id="administrator-data" aria-labelledby="administrator-title">
                <div class="admin-record-heading">
                    <h2 id="administrator-title">ADMINISTRATOR</h2>
                    <span>DATA ADMIN</span>
                </div>
                <dl class="admin-record-grid">
                    <div class="admin-record-field">
                        <dt>id_admin <span class="admin-field-type">PK</span></dt>
                        <dd>{{ $adminRecord?->id_admin ?? 'Belum tersedia' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>id_user <span class="admin-field-type">FK</span></dt>
                        <dd>{{ $adminRecord?->id_user ?? 'Belum tersedia' }}</dd>
                    </div>
                    <div class="admin-record-field is-wide">
                        <dt>nama_admin</dt>
                        <dd>{{ $adminRecord?->nama_admin ?? 'Belum tersedia' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="admin-record-panel" id="pengaturan-data" aria-labelledby="settings-title">
                <div class="admin-record-heading">
                    <h2 id="settings-title">PENGATURAN_ABSENSI</h2>
                    <span>PARAMETER</span>
                </div>
                <dl class="admin-record-grid">
                    <div class="admin-record-field">
                        <dt>id_pengaturan <span class="admin-field-type">PK</span></dt>
                        <dd>{{ $attendanceSettings?->id_pengaturan ?? 'Belum tersedia' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>id_admin <span class="admin-field-type">FK</span></dt>
                        <dd>{{ $attendanceSettings?->id_admin ?? $adminRecord?->id_admin ?? 'Belum tersedia' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>updated_by <span class="admin-field-type">FK</span></dt>
                        <dd>{{ $attendanceSettings?->updated_by ?? 'Belum tersedia' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>radius_meter</dt>
                        <dd>{{ $attendanceSettings?->radius_meter !== null ? $attendanceSettings->radius_meter . ' meter' : 'Belum diatur' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>latitude_sekolah</dt>
                        <dd>{{ $attendanceSettings?->latitude_sekolah ?? 'Belum diatur' }}</dd>
                    </div>
                    <div class="admin-record-field">
                        <dt>longitude_sekolah</dt>
                        <dd>{{ $attendanceSettings?->longitude_sekolah ?? 'Belum diatur' }}</dd>
                    </div>
                    <div class="admin-record-field is-wide">
                        <dt>threshold_wajah</dt>
                        <dd>{{ $attendanceSettings?->threshold_wajah ?? 'Belum diatur' }}</dd>
                    </div>
                </dl>
            </section>

            <div class="admin-database-relation" id="database-relation">
                <span><strong>Relasi foreign key</strong><br>pengaturan_absensi.id_admin</span>
                <span aria-hidden="true">→</span>
                <span><strong>Primary key</strong><br>administrator.id_admin</span>
            </div>
        </main>

        <nav class="admin-bottom-nav" aria-label="Navigasi utama">
            <a class="admin-nav-item is-active" href="#dashboard" aria-current="page">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="m2 10 10-8 10 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Dashboard
            </a>
            <span aria-hidden="true"></span>
            <a class="admin-nav-item" href="#database-relation">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 8v4c0 1.7 3.6 3 8 3s8-1.3 8-3V8c-1.7 1.3-4.7 2-8 2s-6.3-.7-8-2Z"/><path d="M4 14v4c0 1.7 3.6 3 8 3s8-1.3 8-3v-4c-1.7 1.3-4.7 2-8 2s-6.3-.7-8-2Z"/></svg>
                Relasi ERD
            </a>
        </nav>

        <a class="admin-fingerprint" href="#database-relation" aria-label="Lihat relasi database" title="Lihat relasi database">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><ellipse cx="12" cy="5" rx="8" ry="3" stroke="currentColor" stroke-width="2"/><path d="M4 5v7c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 12v7c0 1.7 3.6 3 8 3s8-1.3 8-3v-7" stroke="currentColor" stroke-width="2"/></svg>
        </a>
    </div>

    <script>
        (() => {
            const updateClock = () => {
                const currentTime = new Intl.DateTimeFormat('id-ID', {
                    timeZone: 'Asia/Makassar',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                }).format(new Date());
                const hour = Number(currentTime.slice(0, 2));
                const greeting = hour >= 4 && hour < 11
                    ? 'Selamat Pagi,'
                    : hour >= 11 && hour < 15
                        ? 'Selamat Siang,'
                        : hour >= 15 && hour < 18
                            ? 'Selamat Sore,'
                            : 'Selamat Malam,';

                document.getElementById('status-clock').textContent = currentTime;
                document.getElementById('live-clock').textContent = currentTime;
                document.getElementById('greeting').textContent = greeting;
            };

            updateClock();
            window.setInterval(updateClock, 30000);
        })();
    </script>
</body>
</html>