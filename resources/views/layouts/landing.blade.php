<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RA AL-IKHWAN - @yield('title', 'Welcome')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Outfit', sans-serif; }
        
        .nav-item { position: relative; }
        .dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            min-width: 250px;
            z-index: 50;
        }
        .nav-item:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        @keyframes soft-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-soft-zoom {
            animation: soft-zoom 20s ease-in-out infinite alternate;
        }

        @keyframes typewriter {
            from { width: 0; }
            to { width: 100%; }
        }
        .typewriter {
            overflow: hidden;
            white-space: nowrap;
            letter-spacing: 0.15em;
            animation: typewriter 2s steps(40, end);
        }

        @keyframes bounce-down {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .animate-bounce-down {
            animation: bounce-down 2s infinite;
        }
        
        [x-cloak] { display: none !important; }
        
        @stack('styles')
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="absolute top-0 w-full z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo RA AL-IKHWAN" class="w-12 h-12 object-contain">
                    <span class="text-lg sm:text-xl font-bold text-[#0D2461] font-outfit uppercase tracking-tight">RA AL-IKHWAN</span>
                </a>
                
                <div class="hidden lg:flex items-center space-x-1">
                    <!-- Profile -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Profil <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-[11px] font-bold hover:bg-green-50 rounded-md text-green-700 uppercase tracking-widest">Tentang Kami</a>
                            <a href="{{ route('extracurriculars.index') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Ekstrakurikuler</a>
                            <a href="{{ route('facilities') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Fasilitas Sekolah</a>
                            <a href="{{ route('staff.index') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Guru & Staff</a>
                        </div>
                    </div>

                    <!-- Bidang Kerja -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Bidang Kerja <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('bidang-kerja.item', 'kurikulum') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Kurikulum</a>
                            <a href="{{ route('bidang-kerja.item', 'kesiswaan') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Kesiswaan</a>
                            <a href="{{ route('bidang-kerja.item', 'sarana-prasarana') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Sarana Prasarana</a>
                        </div>
                    </div>

                    <!-- Pusat Media -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Pusat Media <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('e-rapor') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">E-Rapor</a>
                            <a href="{{ route('berita.index') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Berita & Artikel</a>
                            <a href="{{ route('gallery.index') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Galeri</a>
                        </div>
                    </div>

                    <!-- Program Unggulan -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Program Unggulan <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('prestasi.index') }}" class="block px-4 py-2 text-[11px] hover:bg-green-50 rounded-md uppercase tracking-widest font-semibold">Prestasi</a>
                        </div>
                    </div>

                    <a href="{{ route('ppdb.index') }}" class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors uppercase tracking-widest">SPMB</a>
                    <a href="{{ route('contact') }}" class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-green-700 transition-colors uppercase tracking-widest">Kontak Kami</a>
                    
                    {{-- User Auth Pill (Desktop) --}}
                    @auth
                    <div x-data="{ userMenuOpen: false }" class="relative ml-3" @click.away="userMenuOpen = false">
                        <button @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center gap-2.5 bg-white border border-gray-100 shadow-sm hover:shadow-md rounded-full pl-2 pr-3 py-1.5 transition-all duration-200 hover:border-gray-200 focus:outline-none group">
                            {{-- Avatar --}}
                            <div class="w-7 h-7 rounded-full overflow-hidden flex items-center justify-center font-bold text-xs text-white shrink-0 bg-green-600">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </div>
                            {{-- Name --}}
                            <span class="text-[11px] font-bold text-gray-700 max-w-[90px] truncate leading-none">{{ Auth::user()->name }}</span>
                            {{-- Chevron --}}
                            <svg class="w-3 h-3 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="userMenuOpen" x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                             class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                            {{-- User Info Header --}}
                            <div class="px-4 py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl overflow-hidden flex items-center justify-center font-bold text-sm text-white shrink-0 bg-green-600">
                                        @if(Auth::user()->photo)
                                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                                        @else
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                        @if(Auth::user()->hasRole(['super_admin', 'super-admin']))
                                            <span class="inline-block text-[9px] font-black uppercase tracking-widest text-purple-600 bg-purple-50 px-1.5 py-0.5 rounded-full mt-0.5">Super Admin</span>
                                        @elseif(Auth::user()->hasRole(['admin']))
                                            <span class="inline-block text-[9px] font-black uppercase tracking-widest text-green-700 bg-green-50 px-1.5 py-0.5 rounded-full mt-0.5">Admin</span>
                                        @elseif(Auth::user()->hasRole(['guru']))
                                            <span class="inline-block text-[9px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-full mt-0.5">Guru</span>
                                        @else
                                            <span class="inline-block text-[9px] font-black uppercase tracking-widest text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded-full mt-0.5">Murid Baru</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="p-1.5">
                                <a href="{{ url('/dashboard') }}" class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-semibold text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-xl transition-colors">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    Dashboard
                                </a>

                                <div class="my-1 border-t border-gray-50"></div>

                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2.5 text-xs font-semibold text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>

                {{-- Mobile Menu Button (Hamburger) --}}
                <div class="lg:hidden text-gray-600 flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md hover:bg-gray-100 transition-colors focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden absolute top-full left-0 w-full z-50 bg-white border-t border-b border-gray-100 rounded-b-3xl shadow-2xl max-h-[calc(100vh-5rem)] overflow-y-auto">
            <div class="px-6 py-6 space-y-5">
                <!-- Profil Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0D2461] uppercase tracking-widest">
                        Profil <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-green-100 pl-4">
                        <a href="{{ route('about') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Tentang Kami</a>
                        <a href="{{ route('extracurriculars.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Ekstrakurikuler</a>
                        <a href="{{ route('facilities') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Fasilitas Sekolah</a>
                        <a href="{{ route('staff.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Guru & Staff</a>
                    </div>
                </div>

                <!-- Bidang Kerja Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0D2461] uppercase tracking-widest">
                        Bidang Kerja <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-green-100 pl-4">
                        <a href="{{ route('bidang-kerja.item', 'kurikulum') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Kurikulum</a>
                        <a href="{{ route('bidang-kerja.item', 'kesiswaan') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Kesiswaan</a>
                        <a href="{{ route('bidang-kerja.item', 'sarana-prasarana') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Sarana Prasarana</a>
                    </div>
                </div>

                <!-- Pusat Media Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0D2461] uppercase tracking-widest">
                        Pusat Media <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-green-100 pl-4">
                        <a href="{{ route('e-rapor') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">E-Rapor</a>
                        <a href="{{ route('berita.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Berita & Artikel</a>
                        <a href="{{ route('gallery.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Galeri</a>
                    </div>
                </div>

                <!-- Program Unggulan Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0D2461] uppercase tracking-widest">
                        Program Unggulan <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-green-100 pl-4">
                        <a href="{{ route('prestasi.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Prestasi</a>
                    </div>
                </div>

                <!-- SPMB & Kontak Mobile -->
                <a href="{{ route('ppdb.index') }}" class="block text-[13px] font-bold text-[#0D2461] uppercase tracking-widest">SPMB</a>
                <a href="{{ route('contact') }}" class="block text-[13px] font-bold text-green-700 uppercase tracking-widest">Kontak Kami</a>

                @auth
                    {{-- Mobile User Card --}}
                    <div class="border border-gray-100 rounded-2xl overflow-hidden">
                        {{-- User Info --}}
                        <div class="flex items-center gap-3 px-4 py-4 bg-gray-50">
                            <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center font-bold text-sm text-white shrink-0 bg-green-600">
                                @if(Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                @if(Auth::user()->hasRole(['super_admin', 'super-admin']))
                                    <span class="text-[10px] font-black text-purple-600 uppercase tracking-widest">Super Admin</span>
                                @elseif(Auth::user()->hasRole(['admin']))
                                    <span class="text-[10px] font-black text-green-700 uppercase tracking-widest">Admin</span>
                                @elseif(Auth::user()->hasRole(['guru']))
                                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Guru</span>
                                @else
                                    <span class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Murid Baru</span>
                                @endif
                            </div>
                        </div>
                        {{-- Actions --}}
                        <div class="divide-y divide-gray-50">
                            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 text-sm font-semibold text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3.5 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="mt-20">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-[#0D2461] text-white pt-20 pb-10">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo RA AL-IKHWAN" class="w-12 h-12 object-contain">
                        <span class="text-xl font-bold font-outfit uppercase">RA AL-IKHWAN</span>
                    </div>
                    <p class="text-[13px] text-gray-400 leading-relaxed font-inter mb-6">
                        Membangun masa depan cerah melalui pendidikan anak usia dini yang islami, berkualitas, dan berkarakter.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/smkn1katapang" target="_blank" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-500 hover:via-red-500 hover:to-purple-600 transition-colors" title="Instagram">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@smkn1katapang" target="_blank" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-black transition-colors" title="TikTok">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.62 4.2 1.13 1.2 2.68 1.92 4.3 2.11v4.02c-1.7-.17-3.33-.87-4.63-1.99-.28-.24-.53-.5-.77-.77v7.58c.01 2.84-1.39 5.53-3.79 7.07-2.67 1.73-6.17 1.83-8.94.27-3.02-1.7-4.81-5.18-4.52-8.66.3-3.39 2.91-6.19 6.29-6.66 1.09-.15 2.19-.03 3.22.35v4.11c-.81-.43-1.72-.61-2.63-.5-1.57.19-2.92 1.25-3.44 2.76-.6 1.76.13 3.75 1.74 4.67.92.53 2.01.62 3 .24 1-.42 1.66-1.38 1.67-2.47V0h3.18z"/></svg>
                        </a>
                        <a href="mailto:raalikhwancincin@gmail.com" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-600 transition-colors" title="Email">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-green-700 transition-colors" title="Facebook">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-red-600 transition-colors" title="YouTube">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                        </a>
                    </div>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">AKSES CEPAT</h4>
                    <ul class="space-y-4 text-[13px] text-gray-300 font-inter">
                        <li><a href="{{ route('ppdb.index') }}" class="hover:text-green-400 transition-colors flex items-center gap-2"><span>&bull;</span> Informasi SPMB</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-green-400 transition-colors flex items-center gap-2"><span>&bull;</span> Berita & Artikel</a></li>
                        <li><a href="{{ route('e-rapor') }}" class="hover:text-green-400 transition-colors flex items-center gap-2"><span>&bull;</span> E-Rapor Siswa</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-green-400 transition-colors flex items-center gap-2"><span>&bull;</span> Galeri Sekolah</a></li>
                    </ul>
                </div>

                <!-- Kontak Kami -->
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">KONTAK KAMI</h4>
                    <ul class="space-y-4 text-sm text-gray-300 font-inter">
                        <li class="flex flex-col gap-1">
                            <span class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Kp. Sukarame RT 01/RW 09, Desa Sukajadi, Kec. Soreang, Kab. Bandung, Jawa Barat</span>
                            </span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 858-6406-9090</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:raalikhwancincin@gmail.com" class="hover:text-green-400">raalikhwancincin@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Lokasi -->
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">LOKASI</h4>
                    <div class="h-32 w-full bg-gray-800 rounded-xl overflow-hidden relative">
                        <iframe 
                            src="https://maps.google.com/maps?q=-7.031968,107.541624&hl=id&z=17&output=embed"
                            height="100%" 
                            width="100%"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-6 text-[11px] font-inter text-gray-500 text-center md:text-left">
                <div>
                    <p>© {{ date('Y') }} RA AL-IKHWAN. Hak Cipta Dilindungi Undang-Undang.</p>
                    <p class="mt-1 text-gray-600">Developed by <a href="https://www.instagram.com/mochalifsurya/?__pwa=1#" target="_blank" rel="noopener noreferrer" class="text-gray-400 font-semibold hover:text-green-400 transition-colors">Moch Alif Surya Ramadhan</a></p>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="w-8 h-8 rounded-full border border-gray-700 flex items-center justify-center hover:bg-gray-800 transition" title="Login System">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Popup Modal -->
    @php
        $activePopup = \App\Models\PopupAnnouncement::active()->latest()->first();
    @endphp

    @if($activePopup)
    <div 
        x-data="{ 
            showPopup: false,
            hasSeen: sessionStorage.getItem('hasSeenPopup_{{ $activePopup->id }}'),
            init() {
                if(!this.hasSeen) {
                    setTimeout(() => { this.showPopup = true }, 1500);
                }
            },
            closePopup() {
                this.showPopup = false;
                sessionStorage.setItem('hasSeenPopup_{{ $activePopup->id }}', 'true');
            }
        }"
        x-show="showPopup"
        x-cloak
        class="fixed inset-0 z-[10000] flex items-center justify-center p-4 sm:p-6"
    >
        <!-- Backdrop -->
        <div 
            x-show="showPopup"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-[#0D2461]/80 backdrop-blur-sm"
            @click="closePopup"
        ></div>

        <!-- Modal Container -->
        <div 
            x-show="showPopup"
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 scale-90 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-10"
            class="relative w-auto max-w-[90vw] md:max-w-[450px] bg-white rounded-[2rem] overflow-hidden shadow-2xl border border-white/20"
        >
            <!-- Close Button -->
            <button 
                @click="closePopup"
                class="absolute top-4 right-4 w-10 h-10 bg-black/40 hover:bg-black/60 backdrop-blur-md text-white rounded-full flex items-center justify-center transition-all z-10 border border-white/20"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Image Content -->
            <div class="relative bg-gray-100 flex justify-center items-center">
                @if($activePopup->link)
                <a href="{{ $activePopup->link }}" target="_blank" class="block w-full text-center">
                    <img src="{{ asset('storage/' . $activePopup->image) }}" class="max-w-full h-auto max-h-[75vh] object-contain mx-auto" alt="Pengumuman">
                </a>
                @else
                <img src="{{ asset('storage/' . $activePopup->image) }}" class="max-w-full h-auto max-h-[75vh] object-contain mx-auto" alt="Pengumuman">
                @endif
                
                @if($activePopup->title)
                <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-black/80 to-transparent">
                    @if($activePopup->link)
                        <a href="{{ $activePopup->link }}" target="_blank" class="inline-block hover:opacity-80 transition-opacity">
                            <h3 class="text-xl font-black text-white font-outfit uppercase tracking-tight">{{ $activePopup->title }}</h3>
                        </a>
                    @else
                        <h3 class="text-xl font-black text-white font-outfit uppercase tracking-tight">{{ $activePopup->title }}</h3>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out',
        });
    </script>
    @stack('scripts')

    <!-- Click Spark Effect -->
    <canvas id="spark-canvas" style="position:fixed;inset:0;width:100%;height:100%;pointer-events:none;z-index:99999;"></canvas>
    <script>
    (function() {
        const canvas = document.getElementById('spark-canvas');
        const ctx = canvas.getContext('2d');
        let sparks = [];

        const CONFIG = {
            sparkColor: '#16a34a',
            sparkSize: 12,
            sparkRadius: 40,
            sparkCount: 10,
            duration: 500,
            extraScale: 1.2,
        };

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        function easeOut(t) { return t * (2 - t); }

        function draw(timestamp) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            sparks = sparks.filter(spark => {
                const elapsed = timestamp - spark.startTime;
                if (elapsed >= CONFIG.duration) return false;
                const progress = elapsed / CONFIG.duration;
                const eased = easeOut(progress);
                const distance = eased * CONFIG.sparkRadius * CONFIG.extraScale;
                const lineLength = CONFIG.sparkSize * (1 - eased);
                const x1 = spark.x + distance * Math.cos(spark.angle);
                const y1 = spark.y + distance * Math.sin(spark.angle);
                const x2 = spark.x + (distance + lineLength) * Math.cos(spark.angle);
                const y2 = spark.y + (distance + lineLength) * Math.sin(spark.angle);
                const alpha = 1 - eased;
                ctx.strokeStyle = CONFIG.sparkColor;
                ctx.globalAlpha = alpha;
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(x1, y1);
                ctx.lineTo(x2, y2);
                ctx.stroke();
                ctx.globalAlpha = 1;
                return true;
            });
            requestAnimationFrame(draw);
        }
        requestAnimationFrame(draw);

        document.addEventListener('click', function(e) {
            const now = performance.now();
            for (let i = 0; i < CONFIG.sparkCount; i++) {
                sparks.push({
                    x: e.clientX,
                    y: e.clientY,
                    angle: (2 * Math.PI * i) / CONFIG.sparkCount,
                    startTime: now,
                });
            }
        });
    })();
    </script>
</body>
</html>
