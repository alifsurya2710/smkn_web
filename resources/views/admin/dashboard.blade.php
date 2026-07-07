@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Administrator</h1>
    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}! Kelola pendaftaran siswa dan e-rapor.</p>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Similar Cards as Super Admin but for PPDB/Rapor -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-blue-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_ppdb'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Pendaftar PPDB</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-emerald-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_reports'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Rapor Diupload</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Pendaftaran PPDB Terbaru</h3>
            <a href="{{ route('admin.ppdb') }}" class="text-[10px] font-bold text-blue-600 uppercase">Lihat PPDB</a>
        </div>
         <div class="p-8 text-center bg-slate-50/20">
            <p class="text-xs text-slate-400">Belum ada pendaftaran masuk.</p>
         </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Rapor Siswa Terbaru</h3>
            <a href="{{ route('admin.e_rapor') }}" class="text-[10px] font-bold text-blue-600 uppercase">Input Rapor</a>
        </div>
        <div class="p-8 text-center bg-slate-50/20">
            <p class="text-xs text-slate-400">Belum ada rapor diupload hari ini.</p>
         </div>
    </div>
</div>
@endsection
