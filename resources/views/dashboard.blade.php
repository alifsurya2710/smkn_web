@extends('layouts.dashboard')

@section('title', 'Selamat Datang')

@section('content')
<div class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded-lg transition-colors duration-300">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Selamat Datang di SMKN 1 Katapang!</h1>
        <p class="text-gray-600 dark:text-gray-400">Anda masuk sebagai <strong class="text-gray-900 dark:text-white">{{ Auth::user()->name }}</strong> dengan peran <strong class="text-blue-600 dark:text-blue-400">{{ Auth::user()->roles->first()->name ?? 'N/A' }}</strong>.</p>
        
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Stats Card -->
            <div class="bg-blue-50 dark:bg-slate-700/50 p-6 rounded-xl border border-blue-100 dark:border-slate-700 transition-colors duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-600 rounded-lg shadow-sm">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Statistik Cepat</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Ringkasan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
