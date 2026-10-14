<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Informasi Kesiswaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">

    {{-- ============ DESKTOP SIDEBAR (hidden on mobile) ============ --}}
    <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col border-r border-slate-200 bg-white lg:flex">
        {{-- Sidebar header --}}
        <div class="flex items-center gap-3 border-b border-slate-200 px-5 py-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-600 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.657-1.343-3-3-3S6 9.343 6 11m6 0c0-1.657 1.343-3 3-3s3 1.343 3 3m-6 0v1m-6-1a9 9 0 1118 0 9 9 0 01-18 0z"/></svg>
            </div>
            <div class="min-w-0">
                <p class="truncate text-sm font-bold text-slate-800">SIK ABSENSI</p>
                <p class="truncate text-xs text-slate-500">Sistem Informasi Kesiswaan</p>
            </div>
        </div>

        {{-- Nav links --}}
        <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
            <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-3 rounded-xl bg-primary-50 px-4 py-3 text-sm font-semibold text-primary-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                Beranda
            </a>
            <a href="{{ route('admin.absensi.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Absensi Siswa
            </a>
            <a href="{{ route('admin.guru.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.768-.231-1.48-.634-2.073M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.768.231-1.48.634-2.073M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Monitoring Guru
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197V21"/></svg>
                Pemantauan Guru
            </a>
            <a href="{{ route('admin.absensi.report') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.573-1.066z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pengaturan Absensi
            </a>
            <a href="{{ route('bk.pelanggaran.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pelanggaran
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Kelola Akun
            </a>
            <a href="{{ route('cek-db') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                Tabel ERD
            </a>
        </nav>

        {{-- Logout --}}
        <div class="border-t border-slate-200 px-4 py-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-rose-600 hover:bg-rose-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ============ MAIN CONTENT ============ --}}
    <div class="lg:ml-64">
        {{-- Mobile-only: fixed bottom nav --}}
        <nav class="fixed inset-x-0 bottom-0 z-40 flex items-center justify-around border-t border-slate-200 bg-white py-2 lg:hidden">
            <a href="{{ route('dashboard.admin') }}" class="flex flex-col items-center gap-0.5 text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                <span class="text-[10px] font-semibold">Beranda</span>
            </a>
            <a href="{{ route('scan') }}" class="relative -mt-6 flex h-14 w-14 items-center justify-center rounded-full bg-primary-600 text-white shadow-lg shadow-primary-600/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm0 0c0 1.657 1.343 3 3 3s3-1.343 3-3-1.343-3-3-3-3 1.343-3 3zm-1 8h2m-7-4h.01M18 15h.01M7 9h.01M17 9h.01"/></svg>
            </a>
            <a href="{{ route('cek-db') }}" class="flex flex-col items-center gap-0.5 text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                <span class="text-[10px] font-medium">Tabel ERD</span>
            </a>
        </nav>

        {{-- Desktop top bar (hidden on mobile) --}}
        <header class="sticky top-0 z-20 hidden border-b border-slate-200 bg-white lg:block">
            <div class="flex items-center justify-between px-8 py-4">
                <div>
                    <p class="text-sm text-slate-500">Selamat datang kembali</p>
                    <h1 class="text-lg font-bold text-slate-800">{{ $name }}</h1>
                </div>
                <div class="flex items-center gap-4">
                    <span class="rounded-full bg-primary-100 px-4 py-1.5 text-xs font-semibold text-primary-700">
                        <span id="desktopClock"></span> WITA
                    </span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Administrator Aktif
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-1.5 text-sm font-semibold text-rose-600 hover:bg-rose-50">Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        {{-- ===== MOBILE HEADER (hidden on desktop) ===== --}}
        <div class="lg:hidden">
            {{-- Blue gradient header --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 px-5 pb-14 pt-8">
                {{-- Top bar --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs text-white/80">
                        <span id="mobileClock" class="font-medium"></span>
                        <span class="rounded bg-white/20 px-2 py-0.5 text-[10px]">SIK ABSENSI</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.437L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>

                {{-- Greeting --}}
                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-white/70">Selamat Pagi</p>
                        <h1 class="mt-0.5 text-xl font-bold text-white">{{ $name }}</h1>
                        <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-emerald-400/20 px-3 py-1 text-xs font-semibold text-emerald-100">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Administrator Aktif (ID: ADM-01)
                        </span>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Time badge (overlapping header) --}}
            <div class="flex justify-center -mt-5">
                <div class="rounded-full bg-white px-6 py-2 text-sm font-bold text-primary-700 shadow-md">
                    JAM <span id="mobileTime"></span> WITA
                </div>
            </div>
        </div>

        {{-- ===== MAIN DASHBOARD CONTENT ===== --}}
        <main class="px-4 pb-24 pt-6 sm:px-6 lg:px-8 lg:pb-8 lg:pt-6">
            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Feature cards --}}
            <section class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
                {{-- Absensi Siswa --}}
                <a href="{{ route('admin.absensi.index') }}" class="group flex flex-col items-center rounded-2xl bg-white p-5 shadow-sm transition hover:shadow-md lg:flex-row lg:gap-4 lg:p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary-100 text-primary-600 transition group-hover:bg-primary-600 group-hover:text-white lg:h-12 lg:w-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 lg:h-6 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div class="mt-3 text-center lg:mt-0 lg:text-left">
                        <p class="text-sm font-bold text-slate-800">Absensi Siswa</p>
                        <p class="mt-0.5 text-xs text-slate-500">{{ $siswaHadirCount }} Siswa Hadir</p>
                    </div>
                </a>

                {{-- Monitoring Guru --}}
                <a href="{{ route('admin.guru.index') }}" class="group flex flex-col items-center rounded-2xl bg-white p-5 shadow-sm transition hover:shadow-md lg:flex-row lg:gap-4 lg:p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white lg:h-12 lg:w-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 lg:h-6 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.768-.231-1.48-.634-2.073M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.768.231-1.48.634-2.073M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="mt-3 text-center lg:mt-0 lg:text-left">
                        <p class="text-sm font-bold text-slate-800">Monitoring Guru</p>
                        <p class="mt-0.5 text-xs text-slate-500">{{ $totalGuru }} Guru Aktif</p>
                    </div>
                </a>

                {{-- Pemantauan Guru (was Konseling BK) --}}
                <a href="{{ route('admin.siswa.index') }}" class="group flex flex-col items-center rounded-2xl bg-white p-5 shadow-sm transition hover:shadow-md lg:flex-row lg:gap-4 lg:p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white lg:h-12 lg:w-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 lg:h-6 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197V21"/></svg>
                    </div>
                    <div class="mt-3 text-center lg:mt-0 lg:text-left">
                        <p class="text-sm font-bold text-slate-800">Pemantauan Guru</p>
                        <p class="mt-0.5 text-xs text-slate-500">Jurnal Pendataan</p>
                    </div>
                </a>

                {{-- Pengaturan Absensi --}}
                <a href="{{ route('admin.absensi.report') }}" class="group flex flex-col items-center rounded-2xl bg-white p-5 shadow-sm transition hover:shadow-md lg:flex-row lg:gap-4 lg:p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-amber-100 text-amber-600 transition group-hover:bg-amber-600 group-hover:text-white lg:h-12 lg:w-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 lg:h-6 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.573-1.066z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="mt-3 text-center lg:mt-0 lg:text-left">
                        <p class="text-sm font-bold text-slate-800">Pengaturan Absensi</p>
                        <p class="mt-0.5 text-xs text-slate-500">Geofence & Wajah</p>
                    </div>
                </a>
            </section>

            {{-- Attendance stats bar --}}
            <section class="mt-5 flex items-center justify-center gap-6 rounded-2xl bg-white px-5 py-4 shadow-sm lg:justify-start">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-semibold text-slate-700">Siswa Hadir: <span class="text-primary-600">{{ $siswaHadirPersen }}%</span></span>
                </div>
                <div class="h-5 w-px bg-slate-200"></div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-sm font-semibold text-slate-700">Guru: <span class="text-primary-600">{{ $guruHadirPersen }}%</span></span>
                </div>
            </section>

            {{-- Status Parameter Absensi + Quick Stats (desktop: side by side) --}}
            <div class="mt-5 grid gap-5 lg:grid-cols-2">
                {{-- Status Parameter Absensi --}}
                <section class="rounded-2xl bg-white shadow-sm">
                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                        <h2 class="text-sm font-bold text-slate-800">Status Parameter Absensi</h2>
                        <a href="{{ route('admin.absensi.report') }}" class="text-xs font-semibold text-primary-600 hover:underline">Ubah</a>
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-500">Radius Geofence</p>
                                <p class="mt-1 text-sm font-bold text-slate-800">100 Meter</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Face AI Threshold</p>
                                <p class="mt-1 text-sm font-bold text-slate-800">0.80 (80%)</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Titik Kampus</p>
                            <p class="mt-1 text-sm font-bold text-slate-800">-8.63683, 115.17424</p>
                        </div>
                    </div>
                </section>

                {{-- Quick numbers (desktop only expansion) --}}
                <section class="rounded-2xl bg-white shadow-sm">
                    <div class="border-b border-slate-100 px-5 py-4">
                        <h2 class="text-sm font-bold text-slate-800">Ringkasan Hari Ini</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-4 p-5">
                        <div class="rounded-xl bg-primary-50 p-4 text-center">
                            <p class="text-2xl font-extrabold text-primary-700">{{ $totalSiswa }}</p>
                            <p class="mt-1 text-xs font-medium text-primary-600">Total Siswa</p>
                        </div>
                        <div class="rounded-xl bg-blue-50 p-4 text-center">
                            <p class="text-2xl font-extrabold text-blue-700">{{ $totalGuru }}</p>
                            <p class="mt-1 text-xs font-medium text-blue-600">Total Guru</p>
                        </div>
                        <div class="rounded-xl bg-emerald-50 p-4 text-center">
                            <p class="text-2xl font-extrabold text-emerald-700">{{ $siswaHadirCount }}</p>
                            <p class="mt-1 text-xs font-medium text-emerald-600">Siswa Hadir</p>
                        </div>
                        <div class="rounded-xl bg-amber-50 p-4 text-center">
                            <p class="text-2xl font-extrabold text-amber-700">{{ $guruHadirCount }}</p>
                            <p class="mt-1 text-xs font-medium text-amber-600">Guru Hadir</p>
                        </div>
                    </div>
                </section>
            </div>

            {{-- Action button --}}
            <div class="mt-5 flex justify-center lg:justify-start">
                <a href="{{ route('admin.absensi.index') }}" class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary-600/30 transition hover:from-primary-700 hover:to-primary-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.573-1.066z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Kelola Pengaturan Absensi
                </a>
            </div>
        </main>
    </div>

    {{-- Clock script --}}
    <script>
        function updateClocks() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit', hour12: false, timeZone: 'Asia/Makassar' };
            const full = new Intl.DateTimeFormat('id-ID', options).format(now);
            const withSec = new Intl.DateTimeFormat('id-ID', { ...options, second: '2-digit' }).format(now);

            const el = (id) => document.getElementById(id);
            if (el('mobileClock'))  el('mobileClock').textContent  = full;
            if (el('mobileTime'))   el('mobileTime').textContent   = full;
            if (el('desktopClock')) el('desktopClock').textContent = withSec;
        }
        updateClocks();
        setInterval(updateClocks, 1000);

        // Greeting time-aware
        (function () {
            const hour = new Date().toLocaleString('id-ID', { hour: '2-digit', hour12: false, timeZone: 'Asia/Makassar' }).replace(/\D/g, '');
            const h = parseInt(hour, 10);
            let greeting = 'Selamat Pagi';
            if (h >= 11 && h < 15) greeting = 'Selamat Siang';
            else if (h >= 15 && h < 18) greeting = 'Selamat Sore';
            else if (h >= 18 || h < 4) greeting = 'Selamat Malam';

            document.querySelectorAll('[data-greeting]').forEach(el => el.textContent = greeting);
        })();
    </script>
</body>
</html>

