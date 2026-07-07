@extends('layouts.dashboard')

@section('title', 'Dashboard Super Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Dashboard Super Admin</h1>
    <p class="text-sm text-slate-500">Selamat datang, {{ auth()->user()->name }}! Kelola semua konten website dari sini.</p>
</div>

<!-- TOP ACTIONS -->
<div class="flex flex-wrap gap-4 mb-8">
    <a href="{{ route('super_admin.users') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah User
    </a>
    <a href="{{ route('editor.posts.create') }}" class="inline-flex items-center gap-2 bg-white text-slate-900 border border-slate-200 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-all shadow-sm">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        Tulis Berita
    </a>
</div>

<!-- STATS GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <svg class="h-12 w-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 00-7 7v1h11v-1a7 7 0 00-7-7z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_users'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Users</p>
        <p class="text-[10px] text-slate-400 mt-2">Semua pengguna terdaftar</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <svg class="h-12 w-12 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_admin'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Admin</p>
        <p class="text-[10px] text-slate-400 mt-2">Administrator sistem</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <svg class="h-12 w-12 text-orange-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_guru'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Guru</p>
        <p class="text-[10px] text-slate-400 mt-2">Tenaga pengajar aktif</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <svg class="h-12 w-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/></svg>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_siswa'] }}</p>
        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mt-1">Total Siswa</p>
        <p class="text-[10px] text-slate-400 mt-2">Siswa terdaftar e-rapor</p>
    </div>
</div>

<!-- CHART AND SECONDARY STATS -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-6 flex items-center gap-2">
            <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Statistik Pendaftaran User 2026
        </h3>
        <div class="relative h-64">
            <canvas id="userChart"></canvas>
        </div>
    </div>
    <div class="space-y-6 text-slate-50">
        <div class="bg-slate-900 p-6 rounded-2xl shadow-lg shadow-slate-200">
             <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-slate-800 rounded-lg text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400">Pembersihan Berkala</h4>
             </div>
             <p class="text-2xl font-bold">{{ $stats['trash_posts'] }}</p>
             <p class="text-[10px] text-slate-500 uppercase tracking-wider mt-1">Artikel di Trash</p>
             <a href="{{ route('editor.posts.index', ['filter' => 'trash']) }}" class="mt-4 w-full py-2 bg-white text-slate-900 rounded-lg text-center text-[10px] font-bold uppercase tracking-widest hover:bg-slate-50 transition-colors">Lihat Sampah</a>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
             <h4 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">Akses Cepat</h4>
             <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('home') }}" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl flex flex-col items-center gap-1 transition-colors">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="text-[9px] font-bold text-slate-900 uppercase">Input Beranda</span>
                </a>
                <a href="{{ route('about') }}" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl flex flex-col items-center gap-1 transition-colors">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span class="text-[9px] font-bold text-slate-900 uppercase">Profil SMK</span>
                </a>
                <a href="{{ route('editor.posts.create') }}" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl flex flex-col items-center gap-1 transition-colors">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span class="text-[9px] font-bold text-slate-900 uppercase">Input Berita</span>
                </a>
                <a href="#" class="p-3 bg-slate-50 hover:bg-slate-100 rounded-xl flex flex-col items-center gap-1 transition-colors">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[9px] font-bold text-slate-900 uppercase">Produk SMK</span>
                </a>
             </div>
        </div>
    </div>
</div>

<!-- TABLES SECTION -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">User Management</h3>
            <a href="{{ route('super_admin.users') }}" class="text-[10px] font-bold text-blue-600 uppercase border-b-2 border-blue-600 hover:text-blue-700">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">User</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($recent_users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-xs uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-900">{{ $user->name }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $user->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-[9px] font-bold text-slate-600 uppercase tracking-tight ring-1 ring-inset ring-slate-500/10">
                                {{ $user->roles->first()->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-[9px] font-bold text-emerald-700 uppercase tracking-tight ring-1 ring-inset ring-emerald-600/10">
                                AKTIF
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 flex flex-col">
        <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Artikel Terbaru</h3>
            <a href="{{ route('editor.posts.index') }}" class="text-[10px] font-bold text-blue-600 uppercase border-b-2 border-blue-600 hover:text-blue-700">Lihat Semua</a>
        </div>
        @if($recent_posts->isEmpty())
            <div class="flex-1 flex flex-col items-center justify-center p-8 text-center">
                <div class="h-16 w-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4" /></svg>
                </div>
                <h4 class="text-sm font-bold text-slate-900">Belum ada artikel</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-[200px]">Mulai mempublikasikan konten untuk melihat artikel terbaru Anda.</p>
                <a href="{{ route('editor.posts.create') }}" class="mt-6 border border-slate-200 px-6 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-slate-50 transition-colors">Tulis Artikel Pertama</a>
            </div>
        @else
            <div class="divide-y divide-slate-50">
                @foreach($recent_posts as $post)
                    <div class="px-6 py-4 flex items-center gap-4 hover:bg-slate-50/50 transition-colors cursor-pointer group">
                        <div class="h-10 w-10 flex-shrink-0 bg-slate-100 rounded-lg overflow-hidden border border-slate-100">
                             @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="h-full w-full object-cover">
                             @else
                                <div class="h-full w-full flex items-center justify-center text-slate-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                             @endif
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="text-[11px] font-bold text-slate-900 truncate group-hover:text-blue-600 transition-colors">{{ $post->title }}</p>
                            <p class="text-[9px] text-slate-400 mt-0.5 uppercase tracking-tight">Terlampir oleh {{ $post->author->name ?? 'Admin' }}</p>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">PUBLISHED</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Jumlah User',
                data: [1, 2, 4, 3, 5, 4, 6, 8, 7, 9, 10, 12],
                borderColor: '#2563eb',
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#fff',
                pointBorderWidth: 3,
                fill: true,
                backgroundColor: 'rgba(37, 99, 235, 0.05)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: false },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endsection
