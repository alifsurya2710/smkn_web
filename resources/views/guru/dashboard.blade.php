@extends('layouts.dashboard')

@section('title', 'Dashboard Guru')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Pengajar</h1>
    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}! Kelola data siswa dan pantau perkembangan jurusan.</p>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-blue-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_students'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Siswa Aktif</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-emerald-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['my_majors'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Jurusan Diampu</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
    <div class="max-w-md mx-auto">
        <div class="h-20 w-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
            <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <h3 class="text-lg font-bold text-slate-900 mb-2">Pantau Data Siswa</h3>
        <p class="text-sm text-slate-500 mb-8">Sebagai pengajar, Anda dapat melihat data siswa di bawah naungan jurusan Anda.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button class="bg-slate-900 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all">Lihat Daftar Siswa</button>
            <button class="bg-white text-slate-900 border border-slate-200 px-6 py-3 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-all">Input Nilai</button>
        </div>
    </div>
</div>
@endsection
