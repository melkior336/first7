@extends('layouts.auth')

@section('title', 'Scan Kartu Pelajar')

@section('content')
<div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xl text-center space-y-6">
    <div>
        <!-- Logo Resmi SMK TI Bali Global Badung -->
        <div class="flex items-center justify-center mb-3">
            <img src="{{ asset('images/logo-smk.png') }}" alt="Logo SMK TI Bali Global Badung" class="w-24 sm:w-28 h-auto object-contain drop-shadow-sm">
        </div>
        
        <h2 class="text-2xl font-black text-slate-900 mt-2">SCAN DISINI!</h2>
        <p class="text-xs text-slate-500">Gunakan kamera untuk memindai kartu pelajar Anda.</p>
    </div>

    @if (session('error'))
        <p class="rounded-xl bg-rose-50 border border-rose-200 p-3 text-sm font-semibold text-rose-700">{{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p class="rounded-xl bg-emerald-50 border border-emerald-200 p-3 text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <p class="rounded-xl bg-rose-50 border border-rose-200 p-3 text-sm font-semibold text-rose-700">{{ $errors->first() }}</p>
    @endif

    @php
        $activeSiswa = $siswa ?? (auth()->check() ? auth()->user()->siswa : null);
    @endphp

    @if ($activeSiswa)
        <p class="text-sm text-slate-600 bg-slate-50 border border-slate-200 rounded-xl py-2 px-3">
            Akun aktif: <strong>{{ $activeSiswa->nama_siswa }}</strong>
        </p>
    @endif

    <div class="pt-1">
        @if (auth()->check())
            <a href="{{ auth()->user()->isSiswa() ? route('dashboard.siswa') : route('dashboard') }}" class="text-sm font-semibold text-blue-700 hover:underline">
                Kembali ke dashboard
            </a>
        @else
            <a href="{{ route('landing') }}" class="text-sm font-semibold text-blue-700 hover:underline">
                Kembali ke halaman utama
            </a>
        @endif
    </div>

    <div class="flex items-center justify-center my-1">
        <span class="text-xs font-bold text-slate-400 uppercase px-4 bg-white">ATAU</span>
    </div>
    <a href="{{ route('login') }}"
       class="w-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 font-extrabold py-3 rounded-2xl flex items-center justify-center space-x-2 transition-all text-xs block text-center">
        <i data-lucide="user-check" class="w-4 h-4 inline-block mr-1"></i>
        <span>MASUK DENGAN AKUN</span>
    </a>
</div>
@endsection
