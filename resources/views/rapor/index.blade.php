@extends('layouts.landing')

@section('title', 'E-Rapor Digital — RA AL-IKHWAN')

@section('content')
<div class="min-h-screen bg-slate-50 pt-28 pb-20 relative overflow-hidden">

    {{-- Ambient Background Glows --}}
    <div class="absolute inset-0 pointer-events-none opacity-30">
        <div class="absolute top-0 left-1/4 w-[500px] h-[300px] bg-gradient-to-br from-green-300 via-teal-200 to-transparent rounded-full blur-[130px]"></div>
        <div class="absolute bottom-0 right-1/4 w-[400px] h-[300px] bg-gradient-to-tl from-indigo-200 via-blue-200 to-transparent rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                {{-- Logo --}}
                <div class="w-14 h-14 rounded-2xl bg-white shadow-xl shadow-slate-200/60 p-2 border border-slate-100 flex items-center justify-center shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RA AL-IKHWAN" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="inline-block py-0.5 px-2.5 rounded-full bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-widest border border-green-200 mb-1">
                        Layanan Akademik
                    </span>
                    <h1 class="text-xl sm:text-2xl font-black text-[#0D2461] leading-tight">E-Rapor Digital</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Laporan hasil belajar peserta didik RA AL-IKHWAN</p>
                </div>
            </div>

            {{-- Logout Button --}}
            <form id="logout-rapor" action="{{ route('rapor.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button onclick="document.getElementById('logout-rapor').submit();"
                class="inline-flex items-center gap-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-4 py-2.5 rounded-xl transition-all shadow-sm self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar Sesi
            </button>
        </div>

        {{-- Student Info Card --}}
        <div class="bg-gradient-to-r from-[#0D2461] to-[#1a3a7a] rounded-3xl p-5 sm:p-6 mb-6 shadow-2xl shadow-blue-900/30 border border-white/10 relative overflow-hidden">
            {{-- Decorative circles --}}
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-green-400/10 rounded-full"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center border border-white/20 shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-blue-200 text-[10px] font-bold uppercase tracking-widest mb-0.5">Peserta Didik</p>
                    <h2 class="text-lg sm:text-xl font-black text-white">{{ session('rapor_username') }}</h2>
                    <p class="text-blue-200 text-xs mt-0.5">NISN: <span class="font-mono font-bold text-white">{{ session('rapor_nisn') }}</span></p>
                </div>
                <div class="flex items-center gap-2 bg-green-500/20 border border-green-400/30 rounded-2xl px-4 py-2.5 self-start sm:self-auto">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-green-300 text-xs font-bold">Sesi Aktif</span>
                </div>
            </div>
        </div>

        {{-- Reports Card --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden mb-6">
            {{-- Card Header --}}
            <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-[#0D2461]/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-[#0D2461]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-black text-slate-800">Daftar Rapor</h3>
                </div>
                @if(!$reports->isEmpty())
                    <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-[10px] font-bold px-2.5 py-1 rounded-full border border-blue-100">
                        {{ $reports->count() }} Rapor Tersedia
                    </span>
                @endif
            </div>

            {{-- Empty State --}}
            @if($reports->isEmpty())
                <div class="p-12 sm:p-16 text-center">
                    <div class="w-20 h-20 rounded-3xl bg-slate-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-base font-black text-slate-800 mb-2">Belum Ada Rapor Tersedia</h4>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-xs mx-auto">
                        Rapor Anda belum diunggah oleh guru atau administrator. Silakan hubungi wali kelas untuk informasi lebih lanjut.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 mt-5 text-xs font-bold text-green-700 hover:text-green-800 bg-green-50 hover:bg-green-100 border border-green-200 px-4 py-2 rounded-xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Hubungi Tata Usaha
                    </a>
                </div>
            @else
                {{-- Desktop Table --}}
                <div class="hidden sm:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="px-6 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tahun Ajaran</th>
                                <th class="px-6 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Semester</th>
                                <th class="px-6 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan Guru</th>
                                <th class="px-6 py-3.5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Unduh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($reports as $report)
                            @php
                                $signedUrl = URL::temporarySignedRoute(
                                    'rapor.download',
                                    now()->addMinutes(60),
                                    ['report' => $report->id]
                                );
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-[#0D2461]/8 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-[#0D2461]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-black text-slate-800">{{ $report->academicYear->name ?? $report->academic_year }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold border
                                        {{ $report->semester == 'Ganjil'
                                            ? 'bg-blue-50 text-blue-700 border-blue-100'
                                            : 'bg-purple-50 text-purple-700 border-purple-100' }}">
                                        {{ $report->semester }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-xs text-slate-500 max-w-xs truncate leading-relaxed">
                                        {{ $report->teacher_notes ?? '—' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ $signedUrl }}"
                                       class="inline-flex items-center gap-2 bg-gradient-to-r from-[#0D2461] to-green-700 hover:from-[#0a1c4f] hover:to-green-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-md shadow-blue-900/20 hover:shadow-lg active:scale-95">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Unduh PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card List --}}
                <div class="sm:hidden divide-y divide-slate-100">
                    @foreach($reports as $report)
                    @php
                        $signedUrlMobile = URL::temporarySignedRoute(
                            'rapor.download',
                            now()->addMinutes(60),
                            ['report' => $report->id]
                        );
                    @endphp
                    <div class="p-4 hover:bg-slate-50/60 transition-colors">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-sm font-black text-slate-800">{{ $report->academicYear->name ?? $report->academic_year }}</span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border
                                        {{ $report->semester == 'Ganjil'
                                            ? 'bg-blue-50 text-blue-700 border-blue-100'
                                            : 'bg-purple-50 text-purple-700 border-purple-100' }}">
                                        {{ $report->semester }}
                                    </span>
                                </div>
                                @if($report->teacher_notes)
                                    <p class="text-[11px] text-slate-500 leading-relaxed truncate">{{ $report->teacher_notes }}</p>
                                @endif
                            </div>
                            <a href="{{ $signedUrlMobile }}"
                               class="inline-flex items-center gap-1.5 bg-gradient-to-r from-[#0D2461] to-green-700 text-white px-3 py-2 rounded-xl text-[11px] font-bold transition-all shadow-md active:scale-95 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Unduh
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Security Notice --}}
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200/70 rounded-2xl p-4 sm:p-5 flex gap-3.5 items-start">
            <div class="w-9 h-9 rounded-xl bg-green-100 border border-green-200 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-black text-green-900 mb-1">Keamanan Data Terjamin</h4>
                <p class="text-[11px] text-green-700 leading-relaxed">
                    File rapor disimpan di server terenkripsi dan hanya dapat diakses melalui tautan sementara yang aman.
                    Tautan unduhan berlaku selama <strong>60 menit</strong>. Jangan bagikan tautan kepada siapapun.
                </p>
            </div>
        </div>

        {{-- Back to Home --}}
        <div class="mt-5 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-slate-600 transition-colors font-medium">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>
@endsection
