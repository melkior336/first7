@extends('layouts.app')

@section('title', 'Jadwal & Tugas Piket Kelas')

@section('content')
<div class="w-full space-y-6"
     x-data="{
        piketList: [
            { title: 'Menyapu dan mengepel lantai kelas', desc: 'Dikerjakan pagi hari sebelum jam pertama (07:05 WITA)', done: true },
            { title: 'Bersihkan papan tulis & rapikan spidol', desc: 'Pastikan penghapus bersih & siap digunakan guru (07:05 WITA)', done: true },
            { title: 'Rapikan meja lab & kabel PC Lab PPLG 1', desc: 'Setelah praktikum kejuruan selesai (12:25 WITA)', done: false },
            { title: 'Kosongkan tong sampah & matikan AC/Lampu', desc: 'Pukul 12:25 WITA saat jam pulang sekolah sebelum kelas dikunci', done: false }
        ],
        selectedHari: '{{ in_array(now()->locale("id")->isoFormat("dddd"), ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"]) ? now()->locale("id")->isoFormat("dddd") : "Kamis" }}',
        jadwalPiket: {
            'Senin': {
                regu: 'Regu 1',
                hariTitle: 'Senin • Regu 1',
                area: 'Kelas XI PPLG 1 & Lab PPLG 1',
                timPreview: 'Weda, Adi, Gus Al, Bintang, Rama, Mahesa, Arie Satria',
                anggota: [
                    { nama: 'I Gede Mahesh Weda Prayata', panggilan: 'Weda', peran: 'Koordinator' },
                    { nama: 'I Made Suranadi', panggilan: 'Adi', peran: 'Anggota Regu' },
                    { nama: 'Ida Bagus Altissimo Nareswara', panggilan: 'Gus Al', peran: 'Anggota Regu' },
                    { nama: 'Bintang Ramadani', panggilan: 'Bintang', peran: 'Anggota Regu' },
                    { nama: 'Kadek Rama Adiputra', panggilan: 'Rama', peran: 'Anggota Regu' },
                    { nama: 'Putu Mahesa Kris Mulyana', panggilan: 'Mahesa', peran: 'Anggota Regu' },
                    { nama: 'I Made Arie Pinandhita', panggilan: 'Arie Satria', peran: 'Anggota Regu' }
                ]
            },
            'Selasa': {
                regu: 'Regu 2',
                hariTitle: 'Selasa • Regu 2',
                area: 'Kelas XI PPLG 1 & Lab PPLG 1',
                timPreview: 'Aiden, Melkior, Excel, Abhy, Dekdiah, Arvio, Satya',
                anggota: [
                    { nama: 'Given Aidenly Pilatus Kandores', panggilan: 'Aiden', peran: 'Koordinator' },
                    { nama: 'Melkior Majesta Kapu', panggilan: 'Melkior', peran: 'Anggota Regu' },
                    { nama: 'Excel Febriano', panggilan: 'Excel', peran: 'Anggota Regu' },
                    { nama: 'I Kadek Abhyasastra Wirawan', panggilan: 'Abhy', peran: 'Anggota Regu' },
                    { nama: 'Ni Kadek Diah Purnama Dewi', panggilan: 'Dekdiah', peran: 'Anggota Regu' },
                    { nama: 'Arviogalvin Evaldo Simanjuntak', panggilan: 'Arvio', peran: 'Anggota Regu' },
                    { nama: 'I Kadek Satya Semara Putra', panggilan: 'Satya', peran: 'Anggota Regu' }
                ]
            },
            'Rabu': {
                regu: 'Regu 3',
                hariTitle: 'Rabu • Regu 3',
                area: 'Kelas XI PPLG 1 & Lab PPLG 1',
                timPreview: 'Adhyaksa, Aditya, Jefferson, Bagus, Kevin, Pandu, Krishna',
                anggota: [
                    { nama: 'I Dewa Made Adyaksa Bayusena', panggilan: 'Adhyaksa', peran: 'Koordinator' },
                    { nama: 'I Gede Agus Aditiya', panggilan: 'Aditya', peran: 'Anggota Regu' },
                    { nama: 'Jefferson Edbert Wiranata', panggilan: 'Jefferson', peran: 'Anggota Regu' },
                    { nama: 'I Wayan Bagus Aditya Prawira', panggilan: 'Bagus', peran: 'Anggota Regu' },
                    { nama: 'Muhamad Kevin Akarim', panggilan: 'Kevin', peran: 'Anggota Regu' },
                    { nama: 'I Nyoman Pandu Kusuma Wijaya', panggilan: 'Pandu', peran: 'Anggota Regu' },
                    { nama: 'I Putu Krishna Paramartha Putra', panggilan: 'Krishna', peran: 'Anggota Regu' }
                ]
            },
            'Kamis': {
                regu: 'Regu 4',
                hariTitle: 'Kamis • Regu 4',
                area: 'Kelas XI PPLG 1 & Lab PPLG 1',
                timPreview: 'Intan, Tristan, Dito, Radithya, Gazel, Ilal, Prama',
                anggota: [
                    { nama: 'I Gusti Ayu Intan Pradnyani', panggilan: 'Intan', peran: 'Koordinator' },
                    { nama: 'Tristan Ibni Pratama', panggilan: 'Tristan', peran: 'Anggota Regu' },
                    { nama: 'I Komang Dito Pradnya', panggilan: 'Dito', peran: 'Anggota Regu' },
                    { nama: 'Kadek Radithya Danadyaksa', panggilan: 'Radithya', peran: 'Anggota Regu' },
                    { nama: 'Andhika Maraville Gazelle', panggilan: 'Gazel', peran: 'Anggota Regu' },
                    { nama: 'Zala Ilal Akbar', panggilan: 'Ilal', peran: 'Anggota Regu' },
                    { nama: 'I Gede Pande Prama Daniswara', panggilan: 'Prama', peran: 'Anggota Regu' }
                ]
            },
            'Jumat': {
                regu: 'Regu 5',
                hariTitle: 'Jumat • Regu 5',
                area: 'Kelas XI PPLG 1 & Lab PPLG 1',
                timPreview: 'Dedi, Dwi, Revan, Ello, Dwika, Hendra, Dwipa',
                anggota: [
                    { nama: 'I Putu Gede Widiardana', panggilan: 'Dedi', peran: 'Koordinator' },
                    { nama: 'I Made Dwi Dharma Yasa', panggilan: 'Dwi', peran: 'Anggota Regu' },
                    { nama: 'Revan Zaelani', panggilan: 'Revan', peran: 'Anggota Regu' },
                    { nama: 'Antonius Alfa Danielo Lotu', panggilan: 'Ello', peran: 'Anggota Regu' },
                    { nama: 'I Kadek Dwika Pradnyana', panggilan: 'Dwika', peran: 'Anggota Regu' },
                    { nama: 'I Komang Hendra Ardi Pratama', panggilan: 'Hendra', peran: 'Anggota Regu' },
                    { nama: 'I Gede Made Dwipa Chandra Sedana', panggilan: 'Dwipa', peran: 'Anggota Regu' }
                ]
            }
        },

        get currentRegu() {
            return this.jadwalPiket[this.selectedHari] || this.jadwalPiket['Kamis'];
        },

        isTuntas: {{ (!empty($piketHariIni) && $piketHariIni->status === 'Selesai') ? 'true' : 'false' }},
        showNotifTuntas: false,
        notifMessage: 'Laporan piket kebersihan kelas berhasil dikirim ke Wali Kelas.',
        errorMessage: '',
        fotoBuktiList: [],
        loading: false,

        getGreeting() {
            const hr = new Date().getHours();
            if (hr >= 4 && hr < 11) return 'Selamat Pagi,';
            if (hr >= 11 && hr < 15) return 'Selamat Siang,';
            if (hr >= 15 && hr < 18) return 'Selamat Sore,';
            return 'Selamat Malam,';
        },

        init() {
            const oldSaved = localStorage.getItem('piket_items_state');
            if (oldSaved && (oldSaved.includes('14:00') || oldSaved.includes('15:30') || oldSaved.includes('07:15') || oldSaved.includes('RPL 2'))) {
                localStorage.removeItem('piket_items_state');
            }
            const savedItems = localStorage.getItem('piket_items_state_v3');
            if (savedItems) {
                try {
                    const parsed = JSON.parse(savedItems);
                    if (Array.isArray(parsed) && parsed.length === this.piketList.length) {
                        this.piketList = parsed;
                    }
                } catch(e) {}
            }
            if (localStorage.getItem('piket_is_tuntas') === 'true') {
                this.isTuntas = true;
            }
            this.$nextTick(() => {
                if (window.lucide) lucide.createIcons();
            });
        },

        get completedCount() {
            return this.piketList.filter(item => item.done).length;
        },

        pilihFoto(event) {
            const files = Array.from(event.target.files || []);
            this.errorMessage = '';
            for (const file of files) {
                if (!file.type.startsWith('image/')) {
                    this.errorMessage = 'Semua file bukti harus berupa gambar (JPG, PNG, atau WEBP).';
                    continue;
                }
                this.fotoBuktiList.push(file);
            }
            event.target.value = '';
        },

        hapusFoto(index) {
            this.fotoBuktiList.splice(index, 1);
        },

        toggleItem(index) {
            this.piketList[index].done = !this.piketList[index].done;
            this.isTuntas = (this.completedCount === this.piketList.length);
            localStorage.setItem('piket_items_state_v3', JSON.stringify(this.piketList));
            localStorage.setItem('piket_items_state', JSON.stringify(this.piketList));
            localStorage.setItem('piket_is_tuntas', this.isTuntas ? 'true' : 'false');
            this.$nextTick(() => {
                if (window.lucide) lucide.createIcons();
            });
        },

        konfirmasiPiket() {
            if (!this.fotoBuktiList || this.fotoBuktiList.length === 0) {
                this.errorMessage = 'Bukti foto wajib diunggah sebelum laporan dikirim.';
                return;
            }

            this.loading = true;
            this.errorMessage = '';

            const formData = new FormData();
            this.fotoBuktiList.forEach(file => {
                formData.append('foto_bukti[]', file);
            });
            formData.append('checklist', JSON.stringify(this.piketList));

            fetch('{{ route('piket.confirm') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            }).then(async res => {
                const data = await res.json().catch(() => ({}));
                if (!res.ok || data.success === false) {
                    throw new Error(data.message || 'Gagal mengirim laporan piket.');
                }
                return data;
            }).then(data => {
                this.loading = false;
                this.piketList.forEach(item => item.done = true);
                this.isTuntas = true;
                localStorage.setItem('piket_items_state_v3', JSON.stringify(this.piketList));
                localStorage.setItem('piket_items_state', JSON.stringify(this.piketList));
                localStorage.setItem('piket_is_tuntas', 'true');
                if (data.message) this.notifMessage = data.message;
                this.showNotifTuntas = true;
                this.$nextTick(() => {
                    if (window.lucide) lucide.createIcons();
                });
            }).catch(err => {
                this.loading = false;
                this.errorMessage = err.message;
            });
        }
     }">

    <!-- ========================================================================= -->
    <!-- 1. TOP HEADER HERO (Identical Across Mapel, BK, Piket)                     -->
    <!-- ========================================================================= -->
    <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 text-white rounded-3xl sm:rounded-[32px] p-5 sm:p-7 shadow-lg shadow-blue-500/15 relative overflow-hidden">
        <!-- Ambient decorative shapes -->
        <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full bg-indigo-500/20 blur-xl pointer-events-none"></div>

        <!-- Top Navigation Row: Back Button, School Brand, Notification Bell -->
        <div class="relative z-10 flex items-center justify-between pb-4 sm:pb-5 border-b border-white/10">
            <a href="{{ route('dashboard') }}" 
               class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/15 hover:bg-white/25 backdrop-blur-md flex items-center justify-center text-white transition-all active:scale-95 shadow-sm"
               title="Kembali ke Dashboard">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>

            <!-- Logo Resmi SMK TI Bali Global Badung (Sesuai Mockup Desain) -->
            <div class="flex items-center space-x-2 shrink-0">
                <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK TI Bali Global Badung" class="h-7 sm:h-8 w-auto object-contain drop-shadow-sm">
                <span class="font-extrabold text-[11px] sm:text-xs tracking-wider uppercase text-white drop-shadow-xs">SMK TI BALI GLOBAL BADUNG</span>
            </div>

            <div class="relative">
                <button type="button" 
                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/15 hover:bg-white/25 backdrop-blur-md flex items-center justify-center text-white transition-all active:scale-95 shadow-sm"
                        title="Pemberitahuan Piket">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-blue-600"></span>
                </button>
            </div>
        </div>

        <!-- Middle Row: Greeting & Name on Left; White Circular Avatar on Right -->
        <div class="relative z-10 flex items-center justify-between pt-4 sm:pt-5">
            <div>
                <p class="text-xs sm:text-sm text-blue-100 font-medium" x-text="getGreeting()">Selamat Pagi,</p>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-tight mt-0.5">
                    {{ $siswa->nama ?? 'Nama Siswa' }}
                </h1>
                <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-blue-500/50 sm:bg-white/20 text-[11px] sm:text-xs font-semibold text-white backdrop-blur-md mt-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Kelas {{ $siswa->kelas ?? 'XI PPLG 1' }} • NIS {{ $siswa->nis ?? '2026042' }}</span>
                </div>
            </div>

            <!-- Avatar -->
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-white text-blue-600 flex items-center justify-center shadow-lg ring-4 ring-white/25 shrink-0">
                <i data-lucide="user" class="w-8 h-8 sm:w-9 sm:h-9"></i>
            </div>
        </div>

        <!-- Bottom Row: Segmented 3-Pill Navigation: Mapel, Tugas BK, Piket (ACTIVE) -->
        <div class="relative z-10 mt-5 bg-blue-900/60 backdrop-blur-md p-1.5 rounded-full flex items-center gap-1 border border-white/15 shadow-inner">
            <a href="{{ route('mapel') }}" 
               class="flex-1 flex items-center justify-center space-x-1.5 sm:space-x-2 py-2 px-3 text-xs sm:text-sm font-bold text-white/80 hover:text-white hover:bg-white/10 transition-all rounded-full">
                <i data-lucide="book-open" class="w-4 h-4"></i>
                <span>Mapel</span>
            </a>

            <a href="{{ route('bk') }}" 
               class="flex-1 flex items-center justify-center space-x-1.5 sm:space-x-2 py-2 px-3 text-xs sm:text-sm font-bold text-white/80 hover:text-white hover:bg-white/10 transition-all rounded-full">
                <i data-lucide="user-check" class="w-4 h-4 text-rose-300"></i>
                <span>Tugas BK</span>
                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
            </a>

            <!-- Tab 3: Piket (ACTIVE) -->
            <div class="flex-1 flex items-center justify-center space-x-1.5 sm:space-x-2 py-2 px-3 text-xs sm:text-sm font-extrabold bg-white text-blue-700 rounded-full shadow-md">
                <i data-lucide="sparkles" class="w-4 h-4 text-blue-600"></i>
                <span>Piket</span>
            </div>
        </div>
    </div>

    <!-- NOTIFIKASI TUNTAS (Muncul saat dikonfirmasi) -->
    <div x-show="showNotifTuntas" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="p-4 rounded-2xl bg-emerald-600 text-white shadow-xl shadow-emerald-600/25 border border-emerald-500 flex items-start justify-between">
        <div class="flex items-center space-x-3.5">
            <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0">
                <i data-lucide="check-circle-2" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <span class="bg-white text-emerald-800 text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase tracking-wider">TUNTAS</span>
                    <h4 class="font-extrabold text-sm text-white">Laporan Kebersihan Terkirim</h4>
                </div>
                <p class="text-xs text-emerald-100 mt-0.5" x-text="notifMessage"></p>
            </div>
        </div>
        <button type="button" @click="showNotifTuntas = false" class="text-emerald-200 hover:text-white p-1 rounded-lg cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>

    <!-- NOTIFIKASI GAGAL -->
    <div x-show="errorMessage" x-cloak
         class="p-4 rounded-2xl bg-rose-600 text-white shadow-xl shadow-rose-600/25 border border-rose-500 flex items-start space-x-3">
        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-white"></i>
        </div>
        <p class="text-xs font-bold" x-text="errorMessage"></p>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. MAIN RESPONSIVE CONTENT GRID (Mobile: 1 Column, Desktop: 12 Columns)   -->
    <!-- ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- ===================================================================== -->
        <!-- LEFT COLUMN (lg:col-span-8) - SCHEDULE & CHECKLIST                     -->
        <!-- ===================================================================== -->
        <div class="lg:col-span-7 xl:col-span-8 space-y-5">

            <!-- SCHEDULE BANNER: TUGAS HARI INI -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 rounded-3xl p-6 text-white space-y-4 shadow-lg shadow-emerald-600/15">
                <div class="flex items-center justify-between">
                    <span class="bg-white/20 backdrop-blur-md text-white font-extrabold text-[11px] px-3 py-1 rounded-full uppercase"
                          x-text="'Tugas Piket ' + selectedHari">
                    </span>
                    <div class="flex items-center space-x-2">
                        <template x-if="isTuntas">
                            <span class="text-xs bg-emerald-400 text-slate-900 px-3 py-1 rounded-full font-black flex items-center space-x-1 shadow-sm">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                <span>Tuntas</span>
                            </span>
                        </template>
                        <template x-if="!isTuntas">
                            <span class="text-xs bg-white/10 px-2.5 py-1 rounded-full font-bold" x-text="currentRegu.anggota.length + ' Anggota Regu'"></span>
                        </template>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-black" x-text="currentRegu.hariTitle"></h3>
                    <p class="text-xs text-emerald-100 mt-0.5">Waktu piket: Sebelum jam 07:05 WITA & setelah jam pulang sekolah (12:25 WITA)</p>
                </div>
                <div class="pt-2 flex items-center space-x-2 text-xs">
                    <span class="text-emerald-200">Area Tugas:</span>
                    <span class="bg-white text-emerald-900 font-extrabold px-3 py-1 rounded-full" x-text="currentRegu.area"></span>
                </div>
            </div>

            <!-- ANGGOTA REGU PIKET HARI INI -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-soft space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-400">ANGGOTA REGU PIKET KELAS XI PPLG 1</h4>
                        <p class="text-[11px] text-slate-500 font-medium" x-text="'Jadwal Hari ' + selectedHari + ' (' + currentRegu.regu + ')'"></p>
                    </div>
                    <span class="text-xs bg-blue-100 text-blue-700 font-extrabold px-3 py-1 rounded-full" x-text="currentRegu.regu"></span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <template x-for="(m, idx) in currentRegu.anggota" :key="selectedHari + '-' + idx">
                        <div class="p-3.5 rounded-2xl border flex items-center space-x-3 transition-all"
                             :class="idx === 0 ? 'bg-blue-50/80 border-blue-200' : 'bg-slate-50/80 border-slate-200/80 hover:bg-slate-100/70'">
                            <div class="w-8 h-8 rounded-full font-black flex items-center justify-center shrink-0 shadow-xs"
                                 :class="idx === 0 ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-700'"
                                 x-text="idx + 1">
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center space-x-1.5">
                                    <p class="font-bold text-slate-900 truncate" x-text="m.nama"></p>
                                    <span class="text-[10px] font-black uppercase text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded shrink-0" x-text="m.panggilan"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- INTERACTIVE CHECKLIST KEBERSIHAN -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-soft space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-400">CHECKLIST KEBERSIHAN KELAS 11</h4>
                        <p class="text-[11px] text-slate-500 font-medium">Rentang jam wajib: 07:05 WITA s/d 12:25 WITA</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <template x-if="isTuntas">
                            <span class="bg-emerald-100 text-emerald-800 text-[11px] font-black px-2.5 py-0.5 rounded-full uppercase">
                                Tuntas
                            </span>
                        </template>
                        <template x-if="!isTuntas">
                            <span class="text-xs font-extrabold text-emerald-600" x-text="completedCount + ' dari ' + piketList.length + ' Selesai (' + Math.round((completedCount/piketList.length)*100) + '%)'"></span>
                        </template>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full transition-all duration-300" :style="'width: ' + ((completedCount/piketList.length)*100) + '%'"></div>
                </div>

                <div class="space-y-3 pt-2">
                    <template x-for="(item, idx) in piketList" :key="idx">
                        <div class="p-4 rounded-2xl border flex items-start justify-between transition-all cursor-pointer"
                             :class="item.done ? 'bg-emerald-50/40 border-emerald-200 hover:bg-emerald-50/70' : 'bg-white border-slate-200 hover:bg-slate-50'"
                             @click="toggleItem(idx)">
                            <div class="flex items-start space-x-3 text-xs">
                                <input type="checkbox" :checked="item.done" class="mt-0.5 rounded text-emerald-600 focus:ring-emerald-500 pointer-events-none accent-emerald-600">
                                <div>
                                    <p :class="item.done ? 'line-through text-slate-400 font-medium' : 'text-slate-900 font-bold'" x-text="(idx + 1) + '. ' + item.title"></p>
                                    <p class="text-[11px] text-slate-500 mt-0.5" x-text="item.desc"></p>
                                </div>
                            </div>
                            <span :class="item.done ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'" 
                                  class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0 ml-2" 
                                  x-text="item.done ? 'Selesai' : 'Belum'">
                            </span>
                        </div>
                    </template>
                </div>

                <!-- UPLOAD BUKTI FOTO (BISA LEBIH DARI 1) -->
                <div class="pt-2">
                    <label for="foto_bukti" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Bukti Foto Kebersihan <span class="text-rose-500">*wajib</span>
                    </label>
                    <label for="foto_bukti"
                           class="flex items-center justify-center space-x-2 w-full border-2 border-dashed rounded-2xl py-4 px-4 cursor-pointer transition-all"
                           :class="fotoBuktiList.length > 0 ? 'border-emerald-300 bg-emerald-50/50' : 'border-slate-300 bg-slate-50 hover:border-blue-400 hover:bg-blue-50/40'">
                        <i data-lucide="camera" class="w-5 h-5" :class="fotoBuktiList.length > 0 ? 'text-emerald-600' : 'text-slate-400'"></i>
                        <span class="text-xs font-bold" :class="fotoBuktiList.length > 0 ? 'text-emerald-700' : 'text-slate-600'"
                              x-text="fotoBuktiList.length > 0 ? '+ Tambah Foto Lainnya' : 'Pilih Foto Bukti (Bisa lebih dari 1)'"></span>
                    </label>
                    <input id="foto_bukti" type="file" accept="image/*" multiple class="hidden" @change="pilihFoto($event)">

                    <!-- Preview Thumbnail List -->
                    <template x-if="fotoBuktiList.length > 0">
                        <div class="mt-3 space-y-2">
                            <div class="flex items-center justify-between text-xs text-slate-600 font-semibold">
                                <span x-text="fotoBuktiList.length + ' Foto Dipilih'"></span>
                                <button type="button" @click="fotoBuktiList = []" class="text-rose-600 hover:underline text-[11px]">Hapus semua</button>
                            </div>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5">
                                <template x-for="(file, idx) in fotoBuktiList" :key="idx">
                                    <div class="relative group rounded-xl overflow-hidden border border-slate-200 aspect-square bg-slate-100">
                                        <img :src="URL.createObjectURL(file)" alt="Pratinjau bukti foto" class="w-full h-full object-cover">
                                        <button type="button" @click="hapusFoto(idx)"
                                                class="absolute top-1 right-1 bg-black/60 text-white hover:bg-rose-600 rounded-full w-5 h-5 flex items-center justify-center text-xs transition-colors">
                                            &times;
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- TOMBOL KONFIRMASI -->
                <button type="button" 
                        @click="konfirmasiPiket()" 
                        :disabled="loading || fotoBuktiList.length === 0"
                        :class="(fotoBuktiList.length === 0 || loading) ? 'bg-slate-300 cursor-not-allowed shadow-none' : (isTuntas ? 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-500/25' : 'bg-blue-600 hover:bg-blue-700 shadow-blue-500/25')"
                        class="w-full text-white font-extrabold py-3.5 rounded-2xl shadow-lg flex items-center justify-center space-x-2 transition-all mt-4 cursor-pointer active:scale-98">
                    <template x-if="loading">
                        <span class="inline-flex items-center space-x-2">
                            <i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>
                            <span>Mengirim laporan...</span>
                        </span>
                    </template>
                    <template x-if="!loading">
                        <span class="inline-flex items-center space-x-2">
                            <i data-lucide="check-check" class="w-5 h-5"></i>
                            <span x-text="fotoBuktiList.length === 0 ? 'Pilih Foto Bukti Untuk Melapor' : (isTuntas ? 'Laporan Piket Sudah Dikirim' : 'Kirim Laporan Piket')"></span>
                        </span>
                    </template>
                </button>
            </div>

            <!-- CATATAN WALI KELAS -->
            <div class="p-4 rounded-2xl bg-blue-50 border border-blue-200/80 flex items-start space-x-3 text-xs text-blue-900">
                <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 text-[10px] font-bold">i</div>
                <div>
                    <p class="font-extrabold">Catatan Wali Kelas XI PPLG 1:</p>
                    <p class="mt-0.5 text-blue-800/80">Siswa yang tidak hadir piket wajib mengganti piket 2 hari berturut-turut.</p>
                </div>
            </div>

        </div>

        <!-- ===================================================================== -->
        <!-- RIGHT COLUMN (lg:col-span-4) - DESKTOP SIDEBAR WIDGETS                -->
        <!-- ===================================================================== -->
        <div class="lg:col-span-5 xl:col-span-4 space-y-5">

            <!-- Jadwal Regu Piket Sepekan -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-soft space-y-4">
                <div class="flex items-center space-x-2.5 pb-3 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold">
                        <i data-lucide="calendar" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-slate-900">Jadwal Regu Piket</h4>
                        <p class="text-[11px] text-slate-500">Kelas XI PPLG 1 (Klik hari untuk melihat)</p>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <template x-for="hariName in ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']" :key="hariName">
                        <div @click="selectedHari = hariName" 
                             class="p-3 rounded-2xl border flex items-center justify-between cursor-pointer transition-all active:scale-98"
                             :class="selectedHari === hariName ? 'bg-emerald-50 border-emerald-300 ring-2 ring-emerald-400/30 shadow-xs' : 'bg-slate-50 border-slate-100 hover:bg-slate-100/80'">
                            <div class="min-w-0 flex-1 mr-2">
                                <div class="flex items-center space-x-2">
                                    <span class="font-extrabold" :class="selectedHari === hariName ? 'text-emerald-900' : 'text-slate-900'" x-text="hariName"></span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold"
                                          :class="selectedHari === hariName ? 'bg-emerald-200 text-emerald-800' : 'bg-slate-200 text-slate-600'"
                                          x-text="jadwalPiket[hariName].regu"></span>
                                </div>
                                <p class="text-[11px] truncate mt-0.5" 
                                   :class="selectedHari === hariName ? 'text-emerald-700 font-medium' : 'text-slate-500'" 
                                   x-text="jadwalPiket[hariName].timPreview"></p>
                            </div>
                            <span class="text-[10px] font-extrabold px-2.5 py-1 rounded-full shrink-0"
                                  :class="selectedHari === hariName ? 'bg-emerald-600 text-white' : 'bg-slate-200/80 text-slate-600'"
                                  x-text="selectedHari === hariName ? 'Dipilih' : 'Lihat'">
                            </span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Ketentuan Piket Kelas -->
            <div class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-3xl p-5 sm:p-6 shadow-soft space-y-3.5">
                <div class="flex items-center space-x-2 text-teal-300 text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    <span>Ketentuan Piket Kelas</span>
                </div>
                <h4 class="font-black text-base text-white">Panduan Piket XI PPLG 1</h4>
                <ul class="text-xs text-slate-200 space-y-2 leading-relaxed">
                    <li class="flex items-start space-x-2">
                        <span class="text-teal-400 font-bold">•</span>
                        <span>Piket dilaksanakan sebelum bel masuk pagi (<strong>07:05 WITA</strong>) dan saat jam pulang sekolah (<strong>12:25 WITA</strong>).</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-teal-400 font-bold">•</span>
                        <span>Pastikan komputer di Lab PPLG 1 telah dimatikan dan stopkontak dicabut saat jam pulang.</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-teal-400 font-bold">•</span>
                        <span>Tutup jendela, matikan lampu dan AC, serta pastikan pintu kelas terkunci sebelum pulang.</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>
@endsection
