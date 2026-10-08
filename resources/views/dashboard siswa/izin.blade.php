@extends('dashboard siswa.app')

@section('title', 'Formulir Pengajuan Izin & Dispensasi')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-soft max-w-3xl mx-auto"
     x-data="{
        jenis: 'Izin',
        startDate: new Date().toISOString().slice(0, 10),
        endDate: new Date().toISOString().slice(0, 10),

        // Tanggal, Bulan, Tahun khusus Dispen
        dispenHari: new Date().getDate(),
        dispenBulan: new Date().getMonth() + 1,
        dispenTahun: new Date().getFullYear(),

        bulanNames: [
            { value: 1, name: 'Januari' },
            { value: 2, name: 'Februari' },
            { value: 3, name: 'Maret' },
            { value: 4, name: 'April' },
            { value: 5, name: 'Mei' },
            { value: 6, name: 'Juni' },
            { value: 7, name: 'Juli' },
            { value: 8, name: 'Agustus' },
            { value: 9, name: 'September' },
            { value: 10, name: 'Oktober' },
            { value: 11, name: 'November' },
            { value: 12, name: 'Desember' }
        ],

        alasan: '',
        uploadedFileName: '',

        init() {
            this.syncDispenToDates();
            this.$nextTick(() => {
                if (window.lucide) lucide.createIcons();
            });
        },

        setJenis(val) {
            this.jenis = val;
            if (val === 'Dispen') {
                this.syncDispenToDates();
            }
            this.$nextTick(() => {
                if (window.lucide) lucide.createIcons();
            });
        },

        syncDispenToDates() {
            const d = String(this.dispenHari).padStart(2, '0');
            const m = String(this.dispenBulan).padStart(2, '0');
            const y = this.dispenTahun;
            this.startDate = `${y}-${m}-${d}`;
            this.endDate = `${y}-${m}-${d}`;
        },

        get dispenDateFormatted() {
            const b = this.bulanNames.find(item => item.value == this.dispenBulan);
            return `${this.dispenHari} ${b ? b.name : ''} ${this.dispenTahun}`;
        },

        calculateDuration() {
            if (this.jenis === 'Dispen') return 1;
            if (!this.startDate || !this.endDate) return 1;
            const d1 = new Date(this.startDate);
            const d2 = new Date(this.endDate);
            const diffTime = Math.abs(d2 - d1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            return isNaN(diffDays) ? 1 : diffDays;
        },

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.uploadedFileName = `${file.name} (${(file.size / 1024).toFixed(1)} KB)`;
            }
        }
     }">
    
    <div class="flex items-center space-x-3 pb-6 border-b border-slate-100">
        <a href="{{ route('dashboard') }}" class="p-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Formulir Pengajuan</p>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900" x-text="'Form Pengajuan ' + jenis">
                Form Izin
            </h2>
        </div>
    </div>

    <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        <input type="hidden" name="jenis" :value="jenis">
        <input type="hidden" name="tgl_mulai" :value="startDate">
        <input type="hidden" name="tgl_selesai" :value="endDate">

        <!-- 1. PILIH JENIS KETERANGAN (Izin, Dispen, Sakit) -->
        <div>
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-500 mb-3">
                PILIH JENIS KETERANGAN
            </label>
            <div class="grid grid-cols-3 gap-3">
                <!-- 1.1 Izin -->
                <button type="button" @click="setJenis('Izin')" 
                        :class="jenis === 'Izin' ? 'bg-blue-600 text-white border-blue-600 shadow-md shadow-blue-500/20' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                        class="py-4 px-3 rounded-2xl border text-center transition-all flex flex-col items-center justify-center space-y-1.5 font-bold text-xs sm:text-sm cursor-pointer active:scale-95">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                    <span>Izin</span>
                </button>

                <!-- 1.2 Dispen (Dispensasi) -->
                <button type="button" @click="setJenis('Dispen')" 
                        :class="jenis === 'Dispen' ? 'bg-blue-600 text-white border-blue-600 shadow-md shadow-blue-500/20' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                        class="py-4 px-3 rounded-2xl border text-center transition-all flex flex-col items-center justify-center space-y-1.5 font-bold text-xs sm:text-sm cursor-pointer active:scale-95">
                    <i data-lucide="award" class="w-5 h-5"></i>
                    <span>Dispen</span>
                </button>

                <!-- 1.3 Sakit -->
                <button type="button" @click="setJenis('Sakit')" 
                        :class="jenis === 'Sakit' ? 'bg-blue-600 text-white border-blue-600 shadow-md shadow-blue-500/20' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                        class="py-4 px-3 rounded-2xl border text-center transition-all flex flex-col items-center justify-center space-y-1.5 font-bold text-xs sm:text-sm cursor-pointer active:scale-95">
                    <i data-lucide="cross" class="w-5 h-5"></i>
                    <span>Sakit</span>
                </button>
            </div>
        </div>

        <!-- 2. PILIHAN TANGGAL -->

        <!-- 2.A KHUSUS DISPEN: TANGGAL, BULAN, TAHUN -->
        <template x-if="jenis === 'Dispen'">
            <div class="bg-blue-50/70 p-5 rounded-2xl border border-blue-200/90 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <span class="text-xs font-bold text-blue-900 uppercase tracking-wider flex items-center space-x-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                        <span>TANGGAL DISPENSASI</span>
                    </span>
                    <span class="text-xs bg-blue-600 text-white font-extrabold px-3 py-1 rounded-full shadow-2xs" x-text="dispenDateFormatted">
                        8 Oktober 2026
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <!-- Tanggal -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">
                            Tanggal
                        </label>
                        <select x-model.number="dispenHari" @change="syncDispenToDates()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-hidden shadow-2xs">
                            <template x-for="d in 31" :key="d">
                                <option :value="d" x-text="d" :selected="d === dispenHari"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Bulan -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">
                            Bulan
                        </label>
                        <select x-model.number="dispenBulan" @change="syncDispenToDates()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-hidden shadow-2xs">
                            <template x-for="b in bulanNames" :key="b.value">
                                <option :value="b.value" x-text="b.name" :selected="b.value === dispenBulan"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">
                            Tahun
                        </label>
                        <select x-model.number="dispenTahun" @change="syncDispenToDates()" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2.5 text-xs font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:outline-hidden shadow-2xs">
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center space-x-1.5 text-[11px] text-blue-700 font-medium pt-1">
                    <i data-lucide="info" class="w-3.5 h-3.5 shrink-0"></i>
                    <span>Dispensasi diajukan untuk perwakilan lomba, tugas sekolah, atau kegiatan resmi kesiswaan.</span>
                </div>
            </div>
        </template>

        <!-- 2.B UNTUK IZIN & SAKIT: RENTANG TANGGAL & DURASI -->
        <template x-if="jenis !== 'Dispen'">
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center space-x-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                        <span x-text="'TANGGAL KAPAN ' + jenis.toUpperCase()">TANGGAL KAPAN IZIN</span>
                    </span>
                    <span class="text-xs bg-blue-100 text-blue-700 font-extrabold px-3 py-1 rounded-full" x-text="'Durasi: ' + calculateDuration() + ' Hari'">
                        Durasi: 1 Hari
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Mulai Tanggal</label>
                        <input type="date" x-model="startDate" class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Sampai Tanggal</label>
                        <input type="date" x-model="endDate" class="w-full bg-white border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:outline-hidden">
                    </div>
                </div>
            </div>
        </template>

        <!-- 3. ALASAN / KETERANGAN -->
        <div>
            <label class="block text-xs font-extrabold uppercase tracking-wider text-slate-500 mb-2 flex items-center space-x-1.5">
                <i data-lucide="align-left" class="w-3.5 h-3.5 text-blue-600"></i>
                <span x-text="jenis === 'Dispen' ? 'KETERANGAN DISPENSASI' : 'ALASAN KETERANGAN'">ALASAN KETERANGAN</span>
            </label>
            <textarea name="alasan" x-model="alasan" required rows="4" 
                      :placeholder="jenis === 'Dispen' 
                          ? 'Tuliskan keterangan kegiatan dispensasi (contoh: Mengikuti Lomba LKS Web Technologies tingkat Provinsi / Petugas Upacara Bendera / Rapat OSIS)...' 
                          : 'Tuliskan alasan lengkap mengenai ' + jenis.toLowerCase() + ' yang dialami...'" 
                      class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-xs font-medium focus:bg-white focus:ring-2 focus:ring-blue-500 focus:outline-hidden transition-all shadow-2xs"></textarea>
        </div>

        <!-- 4. LAMPIRKAN SURAT BUKTI / SURAT TUGAS -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="text-xs font-extrabold uppercase tracking-wider text-slate-500 flex items-center space-x-1.5">
                    <i data-lucide="paperclip" class="w-3.5 h-3.5 text-blue-600"></i>
                    <span x-text="jenis === 'Dispen' ? 'SURAT DISPEN / SURAT TUGAS' : 'LAMPIRKAN SURAT BUKTI'">LAMPIRKAN SURAT BUKTI</span>
                </label>
                <span class="text-[11px] text-slate-400 font-semibold">Opsional</span>
            </div>
            
            <input type="file" name="bukti_file" x-ref="fileInput" @change="handleFileUpload($event)" class="hidden" accept="image/*,application/pdf">

            <div class="border-2 border-dashed border-slate-300 hover:border-blue-500 rounded-2xl p-6 text-center bg-slate-50/50 hover:bg-blue-50/20 transition-all cursor-pointer relative"
                 @click="$refs.fileInput.click()">
                <div class="flex flex-col items-center justify-center space-y-2">
                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-800" x-text="uploadedFileName || (jenis === 'Dispen' ? 'Unggah Surat Dispensasi / Surat Tugas (PDF/Foto)' : 'Unggah Foto Surat / Berkas')">
                        Unggah Foto Surat / Berkas
                    </p>
                    <p class="text-[11px] text-slate-500">Format JPG, PNG, atau PDF (Maks. 4MB)</p>
                </div>
            </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-blue-500/25 flex items-center justify-center space-x-2 transition-all cursor-pointer active:scale-98">
            <i data-lucide="send" class="w-4 h-4"></i>
            <span x-text="'Kirim Pengajuan ' + jenis">Kirim Pengajuan Izin</span>
        </button>
    </form>
</div>
@endsection
