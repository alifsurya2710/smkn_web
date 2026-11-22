@extends('layouts.dashboard')

@section('title', 'Dashboard Guru')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Pengajar</h1>
    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}! Kelola dan input data E-Rapor siswa RA AL-IKHWAN.</p>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-green-700">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        </div>
        @php
            $totalRapor = \App\Models\StudentReport::count();
        @endphp
        <p class="text-3xl font-bold text-slate-900">{{ $totalRapor }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total E-Rapor Terdata</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 sm:p-12 text-center">
    <div class="max-w-md mx-auto">
        <div class="h-20 w-20 bg-green-50 text-green-600 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Manajemen E-Rapor Digital</h3>
        <p class="text-sm text-slate-500 mb-8">Sebagai guru di RA AL-IKHWAN, Anda memiliki akses untuk menginput data nilai siswa serta mengelola file E-Rapor.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('super_admin.rapor.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all shadow-sm">
                Buka E-Rapor Siswa
            </a>
            <a href="{{ route('super_admin.rapor.create') }}" class="bg-white text-slate-900 border border-slate-200 px-6 py-3 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-all">
                + Input Rapor Baru
            </a>
        </div>
    </div>
</div>
@endsection
