<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMKN 1 KATAPANG - @yield('title', 'Welcome')</title>
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

        /* Chatbot Custom Styles */
        .chatbot-toggle-btn {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            border: none;
            border-radius: 50%; /* Membuat tombol bulat sempurna */
            width: 60px;
            height: 60px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .chatbot-toggle-btn:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.4);
        }

        .chatbot-window {
            position: fixed;
            bottom: 90px;
            right: 25px;
            width: 380px;
            height: 550px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            z-index: 9999;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .chatbot-window.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateY(30px) scale(0.95);
            pointer-events: none;
        }

        .chatbot-header {
            background: #2563eb;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .chatbot-header h4 { margin: 0; font-size: 16px; font-weight: 600; }
        
        .chatbot-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: #fdfdfd;
            scroll-behavior: smooth;
        }

        .message {
            max-width: 85%;
            padding: 12px 16px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.5;
            font-family: 'Inter', sans-serif;
        }

        .bot-message {
            background: #f1f5f9;
            color: #1e293b;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .user-message {
            background: #2563eb;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 2px;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
        }

        .chatbot-input-area {
            padding: 15px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
            background: white;
        }

        .chatbot-input-area input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            font-size: 14px;
            transition: border 0.3s ease;
        }

        .chatbot-input-area input:focus {
            border-color: #2563eb;
        }

        .chatbot-input-area button {
            background: #2563eb;
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .chatbot-input-area button:hover {
            background: #1d4ed8;
            transform: scale(1.05);
        }

        @media (max-width: 480px) {
            .chatbot-window {
                width: calc(100% - 40px);
                height: 70vh;
                right: 20px;
                bottom: 80px;
            }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="absolute top-0 w-full z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Katapang" class="w-12 h-12 object-contain">
                    <span class="text-lg sm:text-xl font-bold text-[#0A142F] font-outfit uppercase tracking-tight">SMKN 1 KATAPANG</span>
                </a>
                
                <div class="hidden lg:flex items-center space-x-1">
                    <!-- Profile -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Profil <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-[11px] font-bold hover:bg-blue-50 rounded-md text-blue-600 uppercase tracking-widest">Tentang Kami</a>
                            <a href="{{ route('extracurriculars.index') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Ekstrakurikuler</a>
                            <a href="{{ route('facilities') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Fasilitas Sekolah</a>
                            <a href="{{ route('profile.item', 'dapo-dikdasmen-profile') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Dapo Dikdasmen</a>
                            <a href="{{ route('profile.item', 'blud') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">BLUD</a>
                            <a href="{{ route('profile.item', 'teaching-factory') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Teaching Factory</a>
                            <a href="{{ route('staff.index') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Guru & Staff</a>
                        </div>
                    </div>

                    <!-- Bidang Kerja -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Bidang Kerja <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('bidang-kerja.item', 'kurikulum') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Kurikulum</a>
                            <a href="{{ route('bidang-kerja.item', 'kesiswaan') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Kesiswaan</a>
                            <a href="{{ route('bidang-kerja.item', 'sarana-prasarana') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Sarana Prasarana</a>
                            <a href="{{ route('bidang-kerja.item', 'hubungan-industri') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Hubungan Industri</a>
                        </div>
                    </div>

                    <!-- Program Keahlian -->
                    <a href="{{ route('jurusan.index') }}" class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors uppercase tracking-widest">
                        Program Keahlian
                    </a>

                    <!-- Pusat Media -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Pusat Media <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="#" class="block px-4 py-2 text-[11px] font-bold hover:bg-blue-50 rounded-md text-blue-600 uppercase tracking-widest">Portal E-Learning</a>
                            <a href="{{ route('e-rapor') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">E-Rapor</a>
                            <a href="{{ route('berita.index') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Berita & Artikel</a>
                            <a href="{{ route('gallery.index') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Gallery</a>
                        </div>
                    </div>

                    <!-- Program Unggulan -->
                    <div class="nav-item">
                        <button class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors flex items-center gap-1 uppercase tracking-widest">
                            Program Unggulan <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="dropdown p-2 border border-gray-100">
                            <a href="{{ route('program-unggulan.item', 'lsp-p1') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">LSP P1</a>
                            <a href="{{ route('prestasi.index') }}" class="block px-4 py-2 text-[11px] hover:bg-blue-50 rounded-md uppercase tracking-widest font-semibold">Prestasi</a>
                        </div>
                    </div>

                    <a href="{{ route('ppdb.index') }}" class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors uppercase tracking-widest">PPDB</a>
                    <a href="{{ route('contact') }}" class="px-3 py-2 rounded-md text-[11px] font-bold text-gray-700 hover:text-blue-600 transition-colors uppercase tracking-widest">Kontak Kami</a>
                    
                   
                </div>

                <!-- Mobile Menu Button (Hamburger) -->
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
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden bg-white border-t border-gray-100 shadow-2xl absolute w-full top-20 left-0 z-40 max-h-[calc(100vh-5rem)] overflow-y-auto">
            <div class="px-4 py-8 space-y-6">
                <!-- Profil Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">
                        Profil <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-gray-50 pl-4">
                        <a href="{{ route('about') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Tentang Kami</a>
                        <a href="{{ route('extracurriculars.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Ekstrakurikuler</a>
                        <a href="{{ route('facilities') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Fasilitas Sekolah</a>
                        <a href="{{ route('profile.item', 'dapo-dikdasmen-profile') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Dapo Dikdasmen</a>
                        <a href="{{ route('profile.item', 'blud') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">BLUD</a>
                        <a href="{{ route('profile.item', 'teaching-factory') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Teaching Factory</a>
                        <a href="{{ route('staff.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Guru & Staff</a>
                    </div>
                </div>

                <!-- Bidang Kerja Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">
                        Bidang Kerja <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-gray-50 pl-4">
                        <a href="{{ route('bidang-kerja.item', 'kurikulum') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Kurikulum</a>
                        <a href="{{ route('bidang-kerja.item', 'kesiswaan') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Kesiswaan</a>
                        <a href="{{ route('bidang-kerja.item', 'sarana-prasarana') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Sarana Prasarana</a>
                        <a href="{{ route('bidang-kerja.item', 'hubungan-industri') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Hubungan Industri</a>
                    </div>
                </div>

                <!-- Program Keahlian Mobile -->
                <a href="{{ route('jurusan.index') }}" class="block text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">Program Keahlian</a>

                <!-- Pusat Media Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">
                        Pusat Media <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-gray-50 pl-4">
                        <a href="#" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Portal E-Learning</a>
                        <a href="{{ route('e-rapor') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">E-Rapor</a>
                        <a href="{{ route('berita.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Berita & Artikel</a>
                        <a href="{{ route('gallery.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Gallery</a>
                    </div>
                </div>

                <!-- Program Unggulan Mobile -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">
                        Program Unggulan <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-gray-50 pl-4">
                        <a href="{{ route('program-unggulan.item', 'lsp-p1') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">LSP P1</a>
                        <a href="{{ route('prestasi.index') }}" class="block text-[11px] font-semibold text-gray-600 uppercase tracking-wider">Prestasi</a>
                    </div>
                </div>

                <!-- PPDB & Kontak Mobile -->
                <a href="{{ route('ppdb.index') }}" class="block text-[13px] font-bold text-[#0A142F] uppercase tracking-widest">PPDB</a>
                <a href="{{ route('contact') }}" class="block text-[13px] font-bold text-blue-600 uppercase tracking-widest">Kontak Kami</a>

                @auth
                    <a href="{{ url('/dashboard') }}" class="block py-4 px-6 bg-blue-600 text-white rounded-2xl text-center font-bold uppercase tracking-widest text-[11px]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block py-4 px-6 bg-[#0A142F] text-white rounded-2xl text-center font-bold uppercase tracking-widest text-[11px]">Login System</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="mt-20">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-[#0A142F] text-white pt-20 pb-10">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 1 Katapang" class="w-12 h-12 object-contain">
                        <span class="text-xl font-bold font-outfit uppercase">SMKN 1 KATAPANG</span>
                    </div>
                    <p class="text-[13px] text-gray-400 leading-relaxed font-inter mb-6">
                        Membangun masa depan cerah melalui pendidikan vokasi yang berkualitas dan relevan dengan industri.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="mailto:smkn1katapang@gmail.com" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z"/></svg>
                        </a>
                    </div>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">AKSES CEPAT</h4>
                    <ul class="space-y-4 text-[13px] text-gray-300 font-inter">
                        <li><a href="{{ route('ppdb.index') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Informasi PPDB</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Berita & Artikel</a></li>
                        <li><a href="{{ route('e-rapor') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> E-Rapor Siswa</a></li>
                        <li><a href="{{ route('bidang-kerja.item', 'hubungan-industri') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Alumni & Karir (BKK)</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Galeri Sekolah</a></li>
                        <li><a href="{{ route('profile.item', 'blud') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Profil BLUD</a></li>
                        <li><a href="{{ route('profile.item', 'teaching-factory') }}" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>&bull;</span> Teaching Factory</a></li>
                    </ul>
                </div>

                <!-- Kontak Kami -->
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">KONTAK KAMI</h4>
                    <ul class="space-y-4 text-sm text-gray-300 font-inter">
                        <li class="flex flex-col gap-1">
                            <span class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>Jl. Ceuri Jalan Terusan Kopo No.KM 13, RW.5, Katapang, Kec. Katapang, Kabupaten Bandung, Jawa Barat 40971, Indonesia</span>
                            </span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>+62 22 5893737</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <a href="mailto:smkn1katapang@gmail.com" class="hover:text-blue-400">smkn1katapang@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Lokasi -->
                <div class="col-span-1">
                    <h4 class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-6 font-outfit">LOKASI</h4>
                    <div class="h-32 w-full bg-gray-800 rounded-xl overflow-hidden relative">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0037570893996!2d107.54296787205506!3d-7.008839453141066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ee9f1c88006d%3A0xbadb406ee9e678ba!2sSMK%20Negeri%201%20Katapang!5e0!3m2!1sen!2sin!4v1773213919609!5m2!1sen!2sin"
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-6 text-[11px] font-inter text-gray-500 text-center md:text-left">
                <p>© {{ date('Y') }} SMKN 1 KATAPANG. Hak Cipta Dilindungi Undang-Undang.</p>
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
    <!-- Chatbot Widget -->
    <button id="chatbot-toggle" class="chatbot-toggle-btn" title="Tanya AI SMKN 1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="28" height="28">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <div id="chatbot-window" class="chatbot-window hidden">
        <div class="chatbot-header">
            <h4>AI Asisten Sekolah</h4>
            <button id="chatbot-close" class="text-white hover:text-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="message bot-message">
                Halo! Saya AI Asisten SMKN 1 Katapang. Ada yang bisa saya bantu mengenai info jurusan, ekskul, atau profil sekolah?
            </div>
        </div>
        <div class="chatbot-input-area">
            <input type="text" id="chatbot-input" placeholder="Tulis pertanyaan Anda...">
            <button id="chatbot-send">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </div>

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
            class="absolute inset-0 bg-[#0A142F]/80 backdrop-blur-sm"
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


        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('chatbot-toggle');
            const closeBtn = document.getElementById('chatbot-close');
            const chatbotWindow = document.getElementById('chatbot-window');
            const sendBtn = document.getElementById('chatbot-send');
            const inputField = document.getElementById('chatbot-input');
            const messagesContainer = document.getElementById('chatbot-messages');

            toggleBtn.addEventListener('click', () => {
                chatbotWindow.classList.toggle('hidden');
                if(!chatbotWindow.classList.contains('hidden')) {
                    inputField.focus();
                }
            });

            closeBtn.addEventListener('click', () => {
                chatbotWindow.classList.add('hidden');
            });

            inputField.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') sendBtn.click();
            });

            sendBtn.addEventListener('click', async () => {
                const message = inputField.value.trim();
                if (!message) return;

                addMessage(message, 'user');
                inputField.value = '';

                const loadingId = addMessage('Sedang mengetik...', 'bot');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch('{{ route("chat.send") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: message })
                    });

                    const data = await response.json();
                    removeMessage(loadingId);

                    if (response.ok) {
                        addMessage(data.reply, 'bot');
                    } else {
                        addMessage(data.reply || 'Maaf, sistem sedang sibuk. Silakan coba lagi nanti.', 'bot');
                    }
                } catch (error) {
                    removeMessage(loadingId);
                    addMessage('Maaf, koneksi terputus atau terjadi kesalahan sistem.', 'bot');
                }
            });

            function addMessage(text, sender) {
                const msgDiv = document.createElement('div');
                msgDiv.className = `message ${sender}-message`;
                msgDiv.textContent = text;
                const id = 'msg-' + Date.now() + Math.random();
                msgDiv.id = id;
                messagesContainer.appendChild(msgDiv);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                return id;
            }

            function removeMessage(id) {
                const el = document.getElementById(id);
                if (el) el.remove();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
