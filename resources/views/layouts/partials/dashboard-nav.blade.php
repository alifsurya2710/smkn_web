@php
    $user = Auth::user();
@endphp

<!-- MAIN -->
<div class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 mt-2 px-2">Main</div>
<li>
    <a href="{{ route('dashboard') }}" 
       class="{{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
        Dashboard
    </a>
</li>

<li>
    <a href="{{ route('profile.edit') }}" 
       class="{{ request()->routeIs('profile.*') ? 'bg-green-600 text-white shadow-lg shadow-green-600/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
        Edit Profil
    </a>
</li>

@if($user->hasRole(['super_admin', 'super-admin', 'admin', 'editor']))
<li>
    <a href="{{ route('home') }}" target="_blank"
       class="text-slate-400 hover:bg-emerald-700 hover:text-white group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
        <svg class="h-5 w-5 shrink-0 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
        </svg>
        Lihat Website
    </a>
</li>
@endif

<!-- KONTEN WEBSITE -->
<div class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 mt-8 px-2">Konten Website</div>

{{-- Hero & Landing (Super Admin Only) --}}
@if($user->hasRole(['super_admin', 'super-admin']))
    <li>
        <a href="{{ route('super_admin.landing_settings.index') }}" class="{{ request()->routeIs('super_admin.landing_settings.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.landing_settings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" /></svg>
            Hero & Landing
        </a>
    </li>
@endif

{{-- Background Login (Super Admin & Admin) --}}
@if($user->hasRole(['super_admin', 'super-admin', 'admin']))
    @php
        $bgLoginRoute = $user->hasRole(['super_admin','super-admin'])
            ? route('super_admin.auth_appearance.index')
            : route('admin.auth_appearance.index');
        $bgLoginActive = request()->routeIs('super_admin.auth_appearance.*') || request()->routeIs('admin.auth_appearance.*');
    @endphp
    <li>
        <a href="{{ $bgLoginRoute }}" class="{{ $bgLoginActive ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ $bgLoginActive ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Background Login
        </a>
    </li>
@endif

@if($user->hasRole(['super_admin', 'super-admin', 'admin']))
    @php
        $pendingPpdbCount = \App\Models\PpdbApplication::where('status', 'pending')->count();
    @endphp
    <li>
        <a href="{{ route('super_admin.ppdb_applications.index') }}" class="{{ request()->routeIs('super_admin.ppdb_applications.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex items-center justify-between rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <div class="flex items-center gap-x-3">
                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.ppdb_applications.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                <span>Pendaftar SPMB</span>
            </div>
            @if($pendingPpdbCount > 0)
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-500 text-white">
                    {{ $pendingPpdbCount }}
                </span>
            @endif
        </a>
    </li>
@endif

@if($user->hasRole(['super_admin', 'super-admin']))
    <li>
        <a href="{{ route('super_admin.ppdb_settings.index') }}" class="{{ request()->routeIs('super_admin.ppdb_settings.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.ppdb_settings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg>
            Banner & Brosur SPMB
        </a>
    </li>
    <li>
        <a href="{{ route('super_admin.bidang_kerja_settings.index') }}" class="{{ request()->routeIs('super_admin.bidang_kerja_settings.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.bidang_kerja_settings.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" /></svg>
            Bidang Kerja
        </a>
    </li>
    <li>
        <a href="{{ route('super_admin.popup_announcements.index') }}" class="{{ request()->routeIs('super_admin.popup_announcements.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.popup_announcements.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
            Pengumuman Popup
        </a>
    </li>
@endif


@if($user->hasRole(['super_admin', 'super-admin', 'admin']))
    {{-- Kelola Kelas RA --}}
    <li>
        <a href="{{ route('super_admin.jurusan.index') }}" class="{{ request()->routeIs('super_admin.jurusan.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.jurusan.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            Kelola Kelas
        </a>
    </li>

    {{-- Profil Sekolah --}}
    <li>
        <a href="{{ route('super_admin.school_profile.edit') }}" class="{{ request()->routeIs('super_admin.school_profile.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.school_profile.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
            Profil Sekolah
        </a>
    </li>

    {{-- Ekskul & Prestasi --}}
    <li>
        <a href="{{ route('super_admin.ekskul.index') }}" class="{{ request()->routeIs('super_admin.ekskul.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.ekskul.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.875a3.375 3.375 0 01-3.375-3.375V9.75c0-.621.503-1.125 1.125-1.125h5.875c.622 0 1.125.504 1.125 1.125v3.375c0 .621-.504 1.125-1.125 1.125h-.875a3.375 3.375 0 01-3.375 3.375V18.75" /></svg>
            Program Ekskul
        </a>
    </li>

    {{-- Prestasi --}}
    <li>
        <a href="{{ route('super_admin.prestasi.index') }}" class="{{ request()->routeIs('super_admin.prestasi.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.prestasi.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.11 7.223l5.89 5.89a.5.5 0 010 .707l-5.89 5.89a.5.5 0 01-.707 0l-5.89-5.89a.5.5 0 010-.707l5.89-5.89a.5.5 0 01.707 0zM12 2a10 10 0 110 20 10 10 0 010-20z" /></svg>
            Prestasi Siswa
        </a>
    </li>

    {{-- Fasilitas --}}
    <li>
        <a href="{{ route('super_admin.sarana.index') }}" class="{{ request()->routeIs('super_admin.sarana.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.sarana.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.875c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21H3.375c-.621 0-1.125-.504-1.125-1.125V9.75M8.25 21h8.25" /></svg>
            Sarana & Fasilitas
        </a>
    </li>

    {{-- Testimoni --}}
    <li>
        <a href="{{ route('super_admin.testimonis.index') }}" class="{{ request()->routeIs('super_admin.testimonis.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.testimonis.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M12 18.75c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8z" /></svg>
            Kelola Testimoni
        </a>
    </li>
@endif

{{-- Album & Galeri --}}
@if($user->hasRole(['super_admin', 'super-admin', 'admin', 'editor']))
    <li>
        <a href="{{ route('super_admin.albums.index') }}" class="{{ request()->routeIs('super_admin.albums.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.albums.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            Album & Galeri
        </a>
    </li>
    <li>
        <a href="{{ route('super_admin.youtube_videos.index') }}" class="{{ request()->routeIs('super_admin.youtube_videos.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.youtube_videos.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            Video YouTube
        </a>
    </li>
@endif

{{-- Berita & Konten (Super Admin, Admin, Editor) --}}
@if($user->hasRole(['super_admin', 'super-admin', 'admin', 'editor']))
    <li>
        <div x-data="{ open: {{ request()->routeIs('editor.posts.*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="flex w-full items-center gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 text-slate-400 hover:bg-slate-800 hover:text-white transition-all group">
                <svg class="h-5 w-5 shrink-0 text-slate-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>
                Berita & Artikel
                <svg :class="open ? 'rotate-90' : ''" class="ml-auto h-4 w-4 shrink-0 text-slate-500 transition-transform" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
            </button>
            <ul x-show="open" class="mt-1 space-y-1 px-8 border-l border-slate-800 ml-5">
                <li><a href="{{ route('editor.posts.index') }}" class="block p-2 text-xs font-medium text-slate-400 hover:text-white transition-colors">Semua Artikel</a></li>
                <li><a href="{{ route('editor.posts.create') }}" class="block p-2 text-xs font-medium text-slate-400 hover:text-white transition-colors">Tulis Artikel</a></li>
            </ul>
        </div>
    </li>
@endif

<!-- ADMINISTRASI -->
@if($user->hasRole(['super_admin', 'super-admin', 'admin', 'guru']))
<div class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 mt-8 px-2">Administrasi</div>

@if($user->hasRole(['super_admin', 'super-admin', 'admin']))
    {{-- Reset Password Requests --}}
    @php
        $pendingResetCount = \App\Models\PasswordResetRequest::where('status','pending')->count();
    @endphp
    <li>
        @php
            $resetRoute = $user->hasRole(['super_admin','super-admin'])
                ? route('super_admin.password_reset_requests.index')
                : route('admin.password_reset_requests.index');
            $isResetActive = request()->routeIs('super_admin.password_reset_requests.*') || request()->routeIs('admin.password_reset_requests.*');
        @endphp
        <a href="{{ $resetRoute }}"
           class="{{ $isResetActive ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ $isResetActive ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
            Reset Password
            @if($pendingResetCount > 0)
                <span class="ml-auto inline-flex items-center justify-center w-5 h-5 text-[10px] font-black bg-red-500 text-white rounded-full">
                    {{ $pendingResetCount > 9 ? '9+' : $pendingResetCount }}
                </span>
            @endif
        </a>
    </li>
@endif

    {{-- E-Rapor --}}
    <li>
        <a href="{{ route('super_admin.rapor.index') }}" class="{{ request()->routeIs('super_admin.rapor.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all">
             <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.rapor.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
             E-Rapor Digital
        </a>
    </li>
@endif

<!-- MANAJEMEN SISTEM -->
@if($user->hasRole(['super_admin', 'super-admin', 'admin']))
    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 mt-8 px-2">Manajemen Sistem</div>
    <li>
        <a href="{{ route('super_admin.teachers.index') }}" class="{{ request()->routeIs('super_admin.teachers.*') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.teachers.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            Kelola Guru
        </a>
    </li>
@endif
@if($user->hasRole(['super_admin', 'super-admin']))
    <li>
        <a href="{{ route('super_admin.users') }}" class="{{ request()->routeIs('super_admin.users') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.users') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
            Kelola Users
        </a>
    </li>
    <li>
        <a href="{{ route('super_admin.activity_log') }}" class="{{ request()->routeIs('super_admin.activity_log') ? 'bg-green-600 text-white shadow-lg shadow-blue-500/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} group flex gap-x-3 rounded-lg p-2.5 text-sm font-semibold leading-6 transition-all duration-200">
            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('super_admin.activity_log') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
            Activity Log
        </a>
    </li>
@endif
