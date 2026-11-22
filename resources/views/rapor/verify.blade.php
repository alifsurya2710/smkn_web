@extends('layouts.landing')

@section('title', 'Cek E-Rapor Siswa')

@section('content')
<div class="min-h-screen bg-slate-50 pt-28 pb-20 flex flex-col justify-center relative overflow-hidden">
    <!-- Ambient Background Glows -->
    <div class="absolute inset-0 pointer-events-none opacity-40">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-gradient-to-tr from-green-300 via-blue-200 to-indigo-200 rounded-full blur-[140px]"></div>
    </div>

    <div class="max-w-md w-full mx-auto px-4 sm:px-6 relative z-10">
        <!-- Header Brand & Title -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-white shadow-xl shadow-slate-200/60 p-2.5 mx-auto mb-4 border border-slate-100 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo RA AL-IKHWAN" class="w-full h-full object-contain">
            </div>
            <span class="inline-block py-1 px-3 rounded-full bg-green-100/80 text-green-800 text-[10px] font-bold uppercase tracking-widest mb-2 border border-green-200">
                Layanan Akademik Digital
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-[#0D2461] font-outfit uppercase tracking-tight">
                Cek E-Rapor Siswa
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1.5 leading-relaxed">
                Masukkan Nama Lengkap dan NISN peserta didik untuk melihat & mengunduh laporan hasil belajar resmi.
            </p>
        </div>

        <!-- Form Card Container -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl shadow-slate-200/50 border border-slate-100">
            @if(session('error'))
                <div class="mb-5 p-3.5 bg-red-50 border border-red-200 rounded-2xl text-xs font-semibold text-red-700 flex items-start gap-2.5 animate-shake">
                    <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form class="space-y-5" action="{{ route('rapor.verify.post') }}" method="POST">
                @csrf
                
                <!-- Input Nama Lengkap -->
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                        <span>Nama Lengkap Siswa</span>
                        <span class="text-[10px] text-slate-400 font-normal">Sesuai Rapot</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input id="username" name="username" type="text" required 
                               value="{{ old('username') }}"
                               placeholder="Contoh: Muhammad Rayhan" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:border-green-500 focus:ring-green-500 shadow-sm transition-all font-medium">
                    </div>
                </div>

                <!-- Input NISN -->
                <div>
                    <label for="nisn" class="block text-xs font-bold text-slate-700 mb-1.5 flex items-center justify-between">
                        <span>NISN (Nomor Induk Siswa Nasional)</span>
                        <span class="text-[10px] text-slate-400 font-normal">10 Digit Angka</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                        </div>
                        <input id="nisn" name="nisn" type="text" required 
                               value="{{ old('nisn') }}"
                               placeholder="Masukkan 10 digit NISN" 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:border-green-500 focus:ring-green-500 shadow-sm transition-all font-mono font-medium">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" 
                            class="w-full py-3 px-5 rounded-xl text-white bg-gradient-to-r from-[#0D2461] to-green-700 hover:from-[#0a1c4f] hover:to-green-800 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-blue-900/20 text-xs sm:text-sm font-bold uppercase tracking-wider flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Cek &amp; Download Rapor</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
