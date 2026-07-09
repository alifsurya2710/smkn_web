<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50 dark:bg-slate-900 transition-colors duration-300"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) }" 
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - SMKN Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine initialized in Dashboard');
        });
        window.onload = () => {
            console.log('Window loaded in Dashboard, Alpine:', window.Alpine ? 'found' : 'missing');
        };
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div x-data="{ sidebarOpen: false }" class="min-h-full bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
        <!-- Off-canvas menu for mobile -->
        <div x-show="sidebarOpen" x-cloak class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" 
                 x-cloak                 x-transition:enter="transition-opacity ease-linear duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition-opacity ease-linear duration-300" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-gray-900/80"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition ease-in-out duration-300 transform" 
                     x-transition:enter-start="-translate-x-full" 
                     x-transition:enter-end="translate-x-0" 
                     x-transition:leave="transition ease-in-out duration-300 transform" 
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="-translate-x-full" 
                     class="relative mr-16 flex w-full max-w-xs flex-1">
                    
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button @click="sidebarOpen = false" type="button" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <!-- Sidebar content -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-4 ring-1 ring-white/10">
                        <div class="flex h-20 shrink-0 items-center gap-3">
                            <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="SMKN Logo">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-white uppercase tracking-wider">SMKN Dashboard</span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-widest">Admin Panel</span>
                            </div>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                @include('layouts.partials.dashboard-nav')
                                <li class="mt-auto -mx-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="group flex w-full gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-slate-400 hover:bg-slate-800 hover:text-white">
                                            <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-4 ring-1 ring-white/10">
                <div class="flex h-20 shrink-0 items-center gap-3 border-b border-white/5 mx-[-1.5rem] px-6">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="SMKN Logo">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">
                           @if(auth()->user()->hasRole(['super_admin', 'super-admin'])) SUPER ADMIN PANEL
                           @elseif(auth()->user()->hasRole('admin')) ADMIN PANEL
                           @else EDITOR PANEL @endif
                        </span>
                        <span class="text-[10px] text-slate-400 uppercase tracking-widest">SMKN Web Dashboard</span>
                    </div>
                </div>
                <nav class="flex flex-1 flex-col mt-4">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        @include('layouts.partials.dashboard-nav')
                        <li class="mt-auto -mx-2 border-t border-white/5 pt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="group flex w-full gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
                                    <svg class="h-6 w-6 shrink-0 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8 transition-colors duration-300">
                <button @click="sidebarOpen = true" type="button" class="-m-2.5 p-2.5 text-gray-700 dark:text-slate-300 lg:hidden focus:outline-none">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>

                <!-- Breadcrumbs/Search area placeholder -->
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 h-full items-center">
                    <div class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                        <span class="hover:text-slate-700 dark:hover:text-slate-200 cursor-pointer">Dashboard</span>
                        <svg class="h-4 w-4 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        <span class="text-slate-900 dark:text-white font-semibold">@yield('title')</span>
                    </div>
                    <!-- Logout Button (beside Dashboard breadcrumb) -->
                    <form method="POST" action="{{ route('logout') }}" class="ml-4">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors border border-red-200 dark:border-red-800/40">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                </div>

                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Theme Toggle -->
                    <button @click="darkMode = !darkMode" class="text-slate-400 hover:text-slate-600 dark:hover:text-amber-400 transition-colors focus:outline-none">
                        <svg x-show="!darkMode" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" x-cloak class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>

                    <div class="h-6 w-px bg-gray-200 dark:bg-slate-700" aria-hidden="true"></div>

                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button">
                            <span class="sr-only">Open user menu</span>
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col text-right hidden sm:flex">
                                <span class="text-xs font-semibold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-emerald-500 font-medium uppercase tracking-tight">Project Online</span>
                            </div>
                            <div class="h-9 w-9 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/20 overflow-hidden">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </div>
                            <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                        </div>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100" 
                         x-transition:enter-start="transform opacity-0 scale-95" 
                         x-transition:enter-end="transform opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-75" 
                         x-transition:leave-start="transform opacity-100 scale-100" 
                         x-transition:leave-end="transform opacity-0 scale-95" 
                         class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-xl bg-white dark:bg-slate-800 p-2 shadow-2xl ring-1 ring-black/5 dark:ring-white/10 focus:outline-none overflow-hidden transition-colors duration-300">
                        <div class="px-3 py-2 border-b border-slate-50 dark:border-slate-700/50 mb-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Masuk sebagai</p>
                            <p class="text-xs font-semibold text-slate-900 dark:text-white truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-colors">
                            <svg class="h-4 w-4 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2 px-3 py-2 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-8 bg-slate-50 dark:bg-slate-900 min-h-[calc(100vh-64px)] transition-colors duration-300">
            <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                @yield('content')
            </div>
            
            <footer class="mt-8 border-t border-slate-200 dark:border-slate-800 py-6 px-4 text-center transition-colors duration-300">
                <p class="text-[11px] font-medium text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                        &copy; 2026 Sekolah App - Official Website for National Vocational High School. All rights reserved.
                    </p>
                </footer>
            </main>
        </div>
    </div>

    {{-- Pop-up notifikasi permintaan reset password (Super Admin & Admin) --}}
    @auth
    @if(auth()->user()->hasRole(['super_admin', 'super-admin', 'admin']))
    @php
        $pendingResetPopup = \App\Models\PasswordResetRequest::where('status','pending')
            ->with('user')
            ->latest()
            ->get();
    @endphp
    @if($pendingResetPopup->isNotEmpty())
    <div x-data="{ show: true }" x-show="show" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-50 w-80 bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-100 dark:border-slate-700 overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-3 bg-amber-50 dark:bg-amber-900/30 border-b border-amber-100 dark:border-amber-800/40">
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                </span>
                <span class="text-xs font-black text-amber-800 dark:text-amber-300 uppercase tracking-widest">
                    {{ $pendingResetPopup->count() }} Permintaan Reset Password
                </span>
            </div>
            <button @click="show = false" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- List users --}}
        <div class="px-4 py-3 space-y-2.5 max-h-48 overflow-y-auto">
            @foreach($pendingResetPopup as $req)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-xs flex-shrink-0 overflow-hidden">
                    @if($req->user->photo)
                        <img src="{{ asset('storage/' . $req->user->photo) }}" class="w-full h-full object-cover" alt="">
                    @else
                        {{ strtoupper(substr($req->user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-800 dark:text-white truncate">{{ $req->user->name }}</p>
                    <p class="text-[10px] text-slate-400 truncate">{{ $req->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="px-4 pb-4">
            @php
                $resetIndexRoute = auth()->user()->hasRole(['super_admin','super-admin'])
                    ? route('super_admin.password_reset_requests.index')
                    : route('admin.password_reset_requests.index');
            @endphp
            <a href="{{ $resetIndexRoute }}"
               class="flex items-center justify-center gap-2 w-full py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-xs font-bold rounded-xl hover:bg-slate-700 dark:hover:bg-slate-100 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                Kelola Permintaan
            </a>
        </div>
    </div>
    @endif
    @endif
    @endauth

</body>
</html>
