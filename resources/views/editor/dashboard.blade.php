@extends('layouts.dashboard')

@section('title', 'Dashboard Editor')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Editor Content</h1>
    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}! Kelola berita dan galeri sekolah.</p>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-indigo-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_posts'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Artikel</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform text-pink-600">
            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_gallery'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Galeri Foto</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Artikel Terakhir Kamu</h3>
        <a href="{{ route('editor.posts.create') }}" class="text-[10px] font-bold text-blue-600 uppercase border-b-2 border-blue-600 hover:text-blue-700">Tulis Berita Baru</a>
    </div>
    @if($recent_posts->isEmpty())
        <div class="p-12 text-center">
            <p class="text-xs text-slate-400 italic">Belum ada konten yang diterbitkan.</p>
        </div>
    @else
        <div class="divide-y divide-slate-50">
            @foreach($recent_posts as $post)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                    <span class="text-xs font-semibold text-slate-700">{{ $post->title }}</span>
                    <span class="text-[10px] text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
