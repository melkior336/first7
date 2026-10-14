<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#1761ec">
    <title>Monitoring Guru KBM</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="min-h-screen pb-20 lg:pb-8">
        <header class="relative overflow-hidden rounded-b-[2rem] bg-gradient-to-br from-blue-700 via-blue-600 to-sky-500 text-white shadow-lg shadow-blue-900/10">
            <div class="pointer-events-none absolute -right-24 -top-28 h-80 w-80 rounded-full border border-white/10 shadow-[0_0_0_34px_rgba(255,255,255,0.04),0_0_0_70px_rgba(255,255,255,0.03)]"></div>
            <div class="relative mx-auto max-w-7xl px-4 pb-12 pt-5 sm:px-6 lg:px-8 lg:pb-10">
                <div class="flex items-center justify-between gap-4 text-xs text-blue-100">
                    <a href="/dashboard/admin" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/15 transition hover:bg-white/25" aria-label="Kembali ke dashboard">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m15 18-6-6 6-6M9 12h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <div class="flex min-w-0 items-center gap-2 font-semibold tracking-wide">
                        <svg class="h-4 w-4 shrink-0 text-cyan-200" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 3 9 16H3L12 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9 14h6M10 17h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span class="truncate">SMK TI BALI GLOBAL BADUNG</span>
                    </div>
                    <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/15" aria-hidden="true">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"><path d="M4 19V5m0 14h17M8 15l3-4 3 2 5-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                </div>

                <div class="mt-6 flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-blue-100">Pantau aktivitas guru &amp; siswa di kelas</p>
                        <h1 class="mt-1 text-2xl font-extrabold sm:text-3xl">Monitoring KBM</h1>
                        <p class="mt-2 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1.5 text-xs font-semibold text-blue-50">
                            <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-300"></span>
                            Pratinjau data monitoring
                        </p>
                    </div>
                    <div class="min-w-28 rounded-2xl border border-white/20 bg-white/10 px-4 py-3 text-right backdrop-blur-sm">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-blue-100">Total Guru</span>
                        <strong class="mt-0.5 block text-xl font-extrabold">58 Guru</strong>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto -mt-5 max-w-7xl space-y-4 px-4 sm:px-6 lg:mt-6 lg:space-y-6 lg:px-8">
            <div class="flex w-fit items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-2 text-xs font-extrabold text-blue-700 shadow-md shadow-slate-900/5">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                JAM <span id="live-time">23:50</span> WITA
            </div>

            <section class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4" aria-label="Ringkasan monitoring">
                <article class="rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex items-start justify-between gap-2">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="13" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 21h8m-4-4v4M7 9h4m-4 4h2m6-5 1.5 1.5L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-extrabold text-emerald-700">54 Aktif</span>
                    </div>
                    <p class="mt-3 text-xs font-semibold text-slate-500">Guru Hadir (KBM)</p>
                    <p class="mt-1 text-xl font-extrabold text-slate-800">93.1% <span class="text-xs font-medium text-slate-400">/ 58 Guru</span></p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:p-5">
                    <div class="flex items-start justify-between gap-2">
                        <span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V8l8-4 8 4v11M2 20h20M8 11h.01M12 11h.01M16 11h.01M9 20v-5h6v5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="rounded-full bg-blue-50 px-2 py-1 text-[10px] font-extrabold text-blue-700">1.240 Anak</span>
                    </div>
                    <p class="mt-3 text-xs font-semibold text-slate-500">Siswa Mengikuti</p>
                    <p class="mt-1 text-xl font-extrabold text-slate-800">94% <span class="text-xs font-medium text-slate-400">Kehadiran</span></p>
                </article>

                <article class="col-span-2 rounded-2xl border border-blue-100 bg-white p-4 shadow-sm sm:p-5 lg:col-span-2">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2 text-sm font-extrabold text-blue-800">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 7v5h-5M4 17v-5h5m10.2-2A7.5 7.5 0 0 0 6.4 6.4L4 9m16 6-2.4 2.6A7.5 7.5 0 0 1 4.8 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Sinkronisasi Monitoring Kelas
                        </div>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-extrabold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Live Stream</span>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2 sm:grid-cols-4">
                        <div class="rounded-xl bg-slate-50 px-3 py-2 text-xs text-slate-500 sm:col-span-2">Ruang KBM Aktif <strong class="float-right text-slate-800">18 Kelas</strong></div>
                        <div class="rounded-xl bg-slate-50 px-3 py-2 text-xs text-slate-500 sm:col-span-2">Guru Standby / Piket <strong class="float-right text-slate-800">4 Guru</strong></div>
                    </div>
                </article>
            </section>

            <section class="space-y-3" aria-label="Daftar monitoring guru">
                <div class="grid gap-3 sm:grid-cols-[1fr_auto] sm:items-center">
                    <div class="flex gap-1 overflow-x-auto rounded-2xl bg-slate-200/70 p-1" role="tablist" aria-label="Filter status guru">
                        <button class="monitor-tab shrink-0 rounded-xl bg-white px-3 py-2 text-xs font-extrabold text-blue-700 shadow-sm" type="button" role="tab" aria-selected="true" data-filter="semua">Semua Kelas (6)</button>
                        <button class="monitor-tab shrink-0 rounded-xl px-3 py-2 text-xs font-semibold text-slate-500 hover:bg-white/70" type="button" role="tab" aria-selected="false" data-filter="mengajar">Sedang Mengajar (5)</button>
                        <button class="monitor-tab shrink-0 rounded-xl px-3 py-2 text-xs font-semibold text-slate-500 hover:bg-white/70" type="button" role="tab" aria-selected="false" data-filter="kosong">Tugas / Jam Kosong (1)</button>
                    </div>

                    <label class="relative block">
                        <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" stroke="currentColor" stroke-width="2"/><path d="m16 16 5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <input id="teacher-search" class="min-h-10 w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-3 text-xs text-slate-700 outline-none placeholder:text-slate-400 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 sm:w-72" type="search" placeholder="Cari nama guru, mapel, atau kelas..." autocomplete="off" aria-label="Cari nama guru, mata pelajaran, atau kelas">
                    </label>
                </div>

                <div id="teacher-list" class="grid gap-3 lg:grid-cols-2">
                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="mengajar" data-search="i made sukadana pemrograman web mobile xi rpl 1 lab komputer 03">
                        <div class="flex items-start gap-3">
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-50 text-emerald-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21v-1a8 8 0 0 1 16 0v1M18 8h4m-2-2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <div><h2 class="text-sm font-extrabold text-slate-800">I Made Sukadana, S.Kom.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Pemrograman Web &amp; Mobile</p></div>
                                    <span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">Sedang KBM</span>
                                </div>
                                <p class="mt-1 text-[10px] text-slate-400">NIP: 19840211</p>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]">
                            <span class="font-semibold text-slate-600">XI RPL 1 <span class="mx-1 text-slate-300">·</span> Lab Komputer 03</span>
                            <span class="font-bold text-blue-700">07:38 - 09:45 WITA</span>
                        </div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]">
                            <span class="text-slate-500">Kehadiran kelas <strong class="text-blue-700">97%</strong></span>
                            <span class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">35 / 36 hadir</span>
                        </div>
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                            <div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Total Siswa</span><strong class="mt-0.5 block text-xs text-slate-700">36</strong></div>
                            <div class="rounded-lg border border-emerald-100 bg-emerald-50/60 px-2 py-2"><span class="block text-[9px] text-emerald-700/70">Siswa Hadir</span><strong class="mt-0.5 block text-xs text-emerald-700">35</strong></div>
                            <div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Belum Hadir</span><strong class="mt-0.5 block text-xs text-slate-700">1</strong></div>
                        </div>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[9px]">
                            <span class="text-slate-500">Integrasi REST API &amp; Model Database</span>
                            <span class="inline-flex items-center gap-1 font-bold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dalam radius (32m)</span>
                        </div>
                    </article>

                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="mengajar" data-search="ni kadek ayu lestari bahasa inggris xi tkj 1 ruang 12">
                        <div class="flex items-start gap-3">
                            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-sky-50 text-sky-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21v-1a8 8 0 0 1 16 0v1M18 8h4m-2-2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>
                            <div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="text-sm font-extrabold text-slate-800">Ni Kadek Ayu Lestari, S.Pd.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Bahasa Inggris</p></div><span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">Sedang KBM</span></div><p class="mt-1 text-[10px] text-slate-400">NIP: 19861124</p></div>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]"><span class="font-semibold text-slate-600">XI TKJ 1 <span class="mx-1 text-slate-300">·</span> Ruang 12</span><span class="font-bold text-blue-700">08:00 - 09:30 WITA</span></div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]"><span class="text-slate-500">Kehadiran kelas <strong class="text-blue-700">94%</strong></span><span class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">32 / 34 hadir</span></div>
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center"><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Total Siswa</span><strong class="mt-0.5 block text-xs text-slate-700">34</strong></div><div class="rounded-lg border border-emerald-100 bg-emerald-50/60 px-2 py-2"><span class="block text-[9px] text-emerald-700/70">Siswa Hadir</span><strong class="mt-0.5 block text-xs text-emerald-700">32</strong></div><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Belum Hadir</span><strong class="mt-0.5 block text-xs text-slate-700">2</strong></div></div>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[9px]"><span class="text-slate-500">Materi: Descriptive Text</span><span class="inline-flex items-center gap-1 font-bold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dalam radius (18m)</span></div>
                    </article>

                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="mengajar" data-search="i putu gede pratama matematika x pplg 2 ruang 08">
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-amber-50 text-amber-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21v-1a8 8 0 0 1 16 0v1M18 8h4m-2-2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="text-sm font-extrabold text-slate-800">I Putu Gede Pratama, S.Pd.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Matematika</p></div><span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">Sedang KBM</span></div><p class="mt-1 text-[10px] text-slate-400">NIP: 19870916</p></div></div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]"><span class="font-semibold text-slate-600">X PPLG 2 <span class="mx-1 text-slate-300">·</span> Ruang 08</span><span class="font-bold text-blue-700">08:15 - 09:45 WITA</span></div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]"><span class="text-slate-500">Kehadiran kelas <strong class="text-blue-700">91%</strong></span><span class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">30 / 33 hadir</span></div>
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center"><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Total Siswa</span><strong class="mt-0.5 block text-xs text-slate-700">33</strong></div><div class="rounded-lg border border-emerald-100 bg-emerald-50/60 px-2 py-2"><span class="block text-[9px] text-emerald-700/70">Siswa Hadir</span><strong class="mt-0.5 block text-xs text-emerald-700">30</strong></div><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Belum Hadir</span><strong class="mt-0.5 block text-xs text-slate-700">3</strong></div></div>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[9px]"><span class="text-slate-500">Materi: Persamaan Linear</span><span class="inline-flex items-center gap-1 font-bold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dalam radius (24m)</span></div>
                    </article>

                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="mengajar" data-search="ni luh putu sri wahyuni sejarah indonesia xi akl 1 ruang 04">
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-rose-50 text-rose-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21v-1a8 8 0 0 1 16 0v1M18 8h4m-2-2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="text-sm font-extrabold text-slate-800">Ni Luh Putu Sri Wahyuni, S.Pd.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Sejarah Indonesia</p></div><span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">Sedang KBM</span></div><p class="mt-1 text-[10px] text-slate-400">NIP: 19851203</p></div></div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]"><span class="font-semibold text-slate-600">XI AKL 1 <span class="mx-1 text-slate-300">·</span> Ruang 04</span><span class="font-bold text-blue-700">08:00 - 09:30 WITA</span></div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]"><span class="text-slate-500">Kehadiran kelas <strong class="text-blue-700">96%</strong></span><span class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">28 / 29 hadir</span></div>
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center"><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Total Siswa</span><strong class="mt-0.5 block text-xs text-slate-700">29</strong></div><div class="rounded-lg border border-emerald-100 bg-emerald-50/60 px-2 py-2"><span class="block text-[9px] text-emerald-700/70">Siswa Hadir</span><strong class="mt-0.5 block text-xs text-emerald-700">28</strong></div><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Belum Hadir</span><strong class="mt-0.5 block text-xs text-slate-700">1</strong></div></div>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[9px]"><span class="text-slate-500">Materi: Pergerakan Nasional</span><span class="inline-flex items-center gap-1 font-bold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dalam radius (41m)</span></div>
                    </article>

                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="mengajar" data-search="komang gede bagus santika basis data xi pplg 1 lab komputer 02">
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-violet-50 text-violet-700"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21v-1a8 8 0 0 1 16 0v1M18 8h4m-2-2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="text-sm font-extrabold text-slate-800">Komang Gede Bagus Santika, S.Kom.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Basis Data</p></div><span class="rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">Sedang KBM</span></div><p class="mt-1 text-[10px] text-slate-400">NIP: 19881109</p></div></div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]"><span class="font-semibold text-slate-600">XI PPLG 1 <span class="mx-1 text-slate-300">·</span> Lab Komputer 02</span><span class="font-bold text-blue-700">08:30 - 10:00 WITA</span></div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]"><span class="text-slate-500">Kehadiran kelas <strong class="text-blue-700">92%</strong></span><span class="rounded-full bg-blue-50 px-2.5 py-1 font-bold text-blue-700">33 / 36 hadir</span></div>
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center"><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Total Siswa</span><strong class="mt-0.5 block text-xs text-slate-700">36</strong></div><div class="rounded-lg border border-emerald-100 bg-emerald-50/60 px-2 py-2"><span class="block text-[9px] text-emerald-700/70">Siswa Hadir</span><strong class="mt-0.5 block text-xs text-emerald-700">33</strong></div><div class="rounded-lg border border-slate-100 px-2 py-2"><span class="block text-[9px] text-slate-400">Belum Hadir</span><strong class="mt-0.5 block text-xs text-slate-700">3</strong></div></div>
                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3 text-[9px]"><span class="text-slate-500">Materi: Relasi Database</span><span class="inline-flex items-center gap-1 font-bold text-emerald-700"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Dalam radius (27m)</span></div>
                    </article>

                    <article class="teacher-card rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md sm:p-5" data-state="kosong" data-search="ketut arimbawa pendidikan jasmani pjok xi dkv 1 lapangan sekolah">
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-slate-100 text-slate-600"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span><div class="min-w-0 flex-1"><div class="flex flex-wrap items-center justify-between gap-2"><div><h2 class="text-sm font-extrabold text-slate-800">Ketut Arimbawa, S.Pd.</h2><p class="mt-0.5 text-xs font-semibold text-blue-700">Pendidikan Jasmani</p></div><span class="rounded-full border border-slate-200 bg-slate-100 px-2.5 py-1 text-[10px] font-bold text-slate-600">Jam kosong</span></div><p class="mt-1 text-[10px] text-slate-400">NIP: 19830914</p></div></div>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 rounded-xl bg-slate-50 px-3 py-2 text-[10px]"><span class="font-semibold text-slate-600">XI DKV 1 <span class="mx-1 text-slate-300">·</span> Lapangan Sekolah</span><span class="font-bold text-slate-500">10:00 - 11:30 WITA</span></div>
                        <div class="mt-3 flex items-center justify-between gap-3 text-[10px]"><span class="text-slate-500">Jadwal berikutnya</span><strong class="text-slate-700">XI DKV 2 · 12:30 WITA</strong></div>
                        <div class="mt-3 rounded-xl border border-amber-100 bg-amber-50/70 px-3 py-2 text-[10px] text-amber-800">Guru standby untuk jadwal berikutnya.</div>
                    </article>
                </div>

                <p id="empty-search" class="hidden rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-500">Tidak ada guru yang cocok dengan pencarian.</p>
            </section>
        </main>

        <nav class="fixed inset-x-0 bottom-0 z-30 grid grid-cols-2 border-t border-slate-200 bg-white/95 px-6 py-2 backdrop-blur lg:hidden" aria-label="Navigasi utama">
            <a href="/dashboard/admin" class="flex flex-col items-center gap-1 py-1 text-slate-400">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V10Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                <span class="text-[10px] font-semibold">Beranda</span>
            </a>
            <a href="/admin/monitoring-guru" aria-current="page" class="flex flex-col items-center gap-1 py-1 text-blue-700">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4" width="18" height="13" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 21h8m-4-4v4M7 9h4m-4 4h2m6-5 1.5 1.5L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="text-[10px] font-bold">Monitoring</span>
            </a>
        </nav>
    </div>

    <script>
        (() => {
            const updateClock = () => {
                document.getElementById('live-time').textContent = new Intl.DateTimeFormat('id-ID', {
                    timeZone: 'Asia/Makassar',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false,
                }).format(new Date());
            };

            const searchInput = document.getElementById('teacher-search');
            const teacherCards = [...document.querySelectorAll('.teacher-card')];
            const filterTabs = [...document.querySelectorAll('.monitor-tab')];
            const emptySearch = document.getElementById('empty-search');
            let activeFilter = 'semua';

            const filterTeachers = () => {
                const query = searchInput.value.trim().toLocaleLowerCase('id-ID');
                let visibleCards = 0;
                teacherCards.forEach((card) => {
                    const matchesQuery = card.dataset.search.includes(query);
                    const matchesFilter = activeFilter === 'semua' || card.dataset.state === activeFilter;
                    const isVisible = matchesQuery && matchesFilter;
                    card.hidden = !isVisible;
                    visibleCards += Number(isVisible);
                });
                emptySearch.classList.toggle('hidden', visibleCards > 0);
            };

            searchInput.addEventListener('input', filterTeachers);
            filterTabs.forEach((tab) => {
                tab.addEventListener('click', () => {
                    activeFilter = tab.dataset.filter;
                    filterTabs.forEach((item) => {
                        const isSelected = item === tab;
                        item.classList.toggle('bg-white', isSelected);
                        item.classList.toggle('text-blue-700', isSelected);
                        item.classList.toggle('shadow-sm', isSelected);
                        item.classList.toggle('font-extrabold', isSelected);
                        item.classList.toggle('text-slate-500', !isSelected);
                        item.classList.toggle('font-semibold', !isSelected);
                        item.setAttribute('aria-selected', String(isSelected));
                    });
                    filterTeachers();
                });
            });

            updateClock();
            window.setInterval(updateClock, 30000);
        })();
    </script>
</body>
</html>