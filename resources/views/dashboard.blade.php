@extends('layouts.dashboard')

@section('title', 'Selamat Datang')

@section('content')
<div class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded-lg transition-colors duration-300">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Selamat Datang di RA AL-IKHWAN!</h1>
        @php
            $roleName = Auth::user()->roles->first()->name ?? null;
            $roleLabel = match($roleName) {
                'super_admin', 'super-admin' => 'Super Admin',
                'admin'     => 'Admin',
                'guru'      => 'Guru',
                'pendaftar' => 'Murid Baru',
                default     => 'Murid Baru',
            };
        @endphp
        <p class="text-gray-600 dark:text-gray-400">Anda masuk sebagai <strong class="text-gray-900 dark:text-white">{{ Auth::user()->name }}</strong> dengan peran <strong class="text-green-700 dark:text-green-400">{{ $roleLabel }}</strong>.</p>
        
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Profil Saya Link Card -->
            <a href="{{ route('profile.edit') }}" class="group bg-green-50 dark:bg-slate-700/50 p-6 rounded-2xl border border-green-100 dark:border-slate-700 hover:border-green-300 dark:hover:border-green-500 transition-all duration-300 hover:shadow-md block">
                <div class="flex items-center">
                    <div class="p-3 bg-green-600 rounded-xl shadow-sm text-white group-hover:scale-105 transition-transform">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-green-700 dark:group-hover:text-green-400 transition-colors">Edit Profil & Akun</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Ubah profil, ganti kata sandi, & hapus akun</p>
                    </div>
                </div>
            </a>

            <!-- Form SPMB Info / Link Card -->
            <a href="{{ route('ppdb.index') }}" class="group bg-blue-50 dark:bg-slate-700/50 p-6 rounded-2xl border border-blue-100 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-md block">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-600 rounded-xl shadow-sm text-white group-hover:scale-105 transition-transform">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">Formulir SPMB</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Isi atau cek pendaftaran murid baru</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
