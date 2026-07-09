@extends('layouts.dashboard')

@section('title', 'Profil')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    {{-- Alerts --}}
    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-100 dark:border-red-900/30" role="alert">
            <span class="font-bold">Error!</span> {{ session('error') }}
        </div>
    @endif

    <div class="p-6 sm:p-10 bg-white dark:bg-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none rounded-3xl border border-slate-100 dark:border-slate-700/50 transition-all duration-300">
        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-6 sm:p-10 bg-white dark:bg-slate-800 shadow-xl shadow-slate-200/50 dark:shadow-none rounded-3xl border border-slate-100 dark:border-slate-700/50 transition-all duration-300">
        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    @if(!auth()->user()->hasRole(['admin', 'editor']))
    <div class="p-6 sm:p-10 bg-red-50/50 dark:bg-red-900/10 shadow-xl shadow-red-200/20 dark:shadow-none rounded-3xl border border-red-100 dark:border-red-900/20 transition-all duration-300">
        <div class="max-w-2xl text-red-900 dark:text-red-200">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
    @else
    <div class="p-6 sm:p-10 bg-amber-50 dark:bg-amber-900/10 shadow-sm rounded-3xl border border-amber-100 dark:border-amber-900/20">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-amber-100 dark:bg-amber-900/30 rounded-2xl text-amber-600 dark:text-amber-400">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-amber-900 dark:text-amber-200">Keamanan Akun</h3>
                <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">Akun Admin dan Editor hanya dapat dihapus oleh Super Admin untuk alasan keamanan data website.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
